<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::with("technologies", "type")->paginate(3);
        $data = [
            "results" => $projects,
            "success" => true
        ];
        return response()->json($data);
    }

    public function show(string $project) {
        $project = Project::with("technologies", "type")->where("slug", $project)->first();

        $data = [
            "results" => $project,
            "success" => true
        ];

        if (!$project) {
            return response()->json([
                "success" => false
            ], 404);
        } else {
            return response()->json($data);
        }

    }

}
