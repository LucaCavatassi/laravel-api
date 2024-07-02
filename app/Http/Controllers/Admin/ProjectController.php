<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ? $request->per_page : 10;
        $perLanguage = $request->per_language ? $request->per_language : null;
        // dd($perLanguage);
        // $projects = Project::all();
        
        if ($perLanguage === null or $perLanguage === "all") {
            $projects = Project::paginate($perPage)->appends(["per_page" => $perPage]);
        } else {
            $projects = Project::with('technologies')
                ->whereHas('technologies', function ($query) use ($perLanguage) {
                $query->where('technology_id', $perLanguage);
                })
                ->paginate($perPage)
                ->appends(["per_page" => $perPage]);
        }
        $technologies = Technology::all();
        // dd($perLanguage);
        
        return view("admin.projects.index" , compact("projects", "technologies","perLanguage"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.create", compact("types", "technologies"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $newProject = new Project();
        $newProject->fill($data);
        $newProject->slug = Str::slug($newProject->title);
        $newProject->cover_img = Storage::put("uploads", $data["cover_img"]);
        // dd(img_path);
        $newProject->save();

    
        if ($request->has("technologies")){
            $newProject->technologies()->attach($request->technologies);
        }

        return redirect()->route("admin.projects.index")->with("messageUpload", "Il progetto ". $newProject->title . " è stato aggiunto con successo!");;   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $project = Project::where("slug", $slug)->first();
        // dd($project);
        return view("admin.projects.show", compact("project"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $project = Project::where("slug", $slug)->first();
        $types = Type::all();
        $technologies = Technology::all();

        return view("admin.projects.edit", compact("project", "types","technologies"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project = Project::where("slug", $project->slug)->first();
        
        $data = $request->validated();
        
        $project->slug = Str::slug($request->title);
        if ($request->hasFile("cover_img")) {
            if($project->cover_img){
                Storage::delete($project->cover_img);
            }
            $image_path = Storage::put('post_images', $request->cover_img);
            $data['cover_img'] = $image_path;
        }
        
        $project->update($data);

        // dd($project);
        $project->technologies()->sync($request->technologies);
        // dd($project);
        return redirect()->route("admin.projects.index")->with("messageEdit", "Il progetto ". $project->title . " è stato aggiornato con successo!");;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);
        $project->technologies()->detach();
        $project->delete();
        
        return redirect()->route("admin.projects.index")->with("messageDelete", "Il progetto ". $project->title . " è stato eliminato con successo!");
    }

    public function editselector (){
        $projects = Project::all();
        $types = Type::all();
        $technologies = Technology::all();
        return view("admin.projects.editselector", compact("projects", "types","technologies"));
    }
}