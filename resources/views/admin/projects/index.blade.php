@extends('layouts.admin') 

@section('content')
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mt-2">Lista Progetti</h1>
                <span class="fs-4 add-btn d-flex align-items-center justify-content-center text-white me-5"><a href="{{ route("admin.projects.create") }}"><i class="fa-solid fa-plus"></i></a></span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <p>Clicca il nome per avere maggiori informazioni</p>
                <p class="me-1">Aggiungi progetto</p>
            </div>

            @if (session("messageDelete"))
                <div class="alert alert-success">
                    {{ session("messageDelete") }}
                </div>
            @endif

            @if (session("messageUpload"))
                <div class="alert alert-primary">
                    {{ session("messageUpload") }}
                </div>
            @endif

            @if (session("messageEdit"))
                <div class="alert alert-primary">
                    {{ session("messageEdit") }}
                </div>
            @endif

            <form action="{{ route("admin.projects.index") }}" method="GET">
                @csrf
                <div class="d-flex align-items-center gap-4">
                    <label for="per_page">Quanti elementi per pagina vuoi vedere?</label>
                    <select class="form-select" name="per_page" id="per_page" onchange="this.form.submit()">
                        <option value="5" @selected($projects->perPage()== 5)>5</option>
                        <option value="10" @selected($projects->perPage()== 10)>10</option>
                        <option value="15" @selected($projects->perPage()== 15)>15</option>
                    </select>
                </div>
            </form>

            <form action="{{ route("admin.projects.index") }}" method="GET">
                @csrf
                <div class="d-flex align-items-center gap-4">
                    <label for="per_language">Filtra per linguaggio</label>
                    <select class="form-select" name="per_language" id="per_language" onchange="this.form.submit()">
                            @foreach ($technologies as $technology)
                                <option value="{{ $technology->id  }}" {{ $perLanguage == $technology->id ? 'selected' : '' }}>{{$technology->name}}</option>
                            @endforeach
                            <option value="all">Tutti</option>
                    </select>
                </div>
            </form>

            <table class="table table-striped table-hove ms-body" >
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titolo</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Campo</th>
                        <th scope="col">Linguaggio</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td><a href="{{ route("admin.projects.show", ["project" => $project->slug]) }}">{{ $project->title }}</a></td>
                            <td>{{ $project->description }}</td>

                            <td>{{ $project->type?->name }}</td>
                            <td>
                            @forelse ($project->technologies as $technology)                               
                                {{ $technology->name }}
                            @empty
                                Nessuna tecnologia indicata
                            @endforelse
                            </td>
                            {{-- <td><a class="btn btn-primary" href="{{ route ("admin.projects.edit", ["project" => $project->slug])}}">Modifica</a></td> --}}
                            <td><button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Elimina</button></td>
                        </tr>

                        <!-- Modale Eliminazione -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    {{-- HEADEAR --}}
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="deleteModal">Conferma eliminazione</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    {{-- BODY --}}
                                    <div class="modal-body">
                                        <span>Vuoi davvero eliminare l'elemento definitivamente?</span>
                                    </div>
                                    {{-- FOOTER --}}
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Chiudi</button>
                                        {{-- DESTROY --}}
                                        <form action="{{ route ("admin.projects.destroy", ["project" => $project->id])}}" method="POST" >
                                            @method("DELETE")
                                            @csrf
                                            <button class="btn btn-danger">Elimina definitivamente</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            <div>
                {{ $projects->links() }}
            </div>
            
            
        </div>
@endsection