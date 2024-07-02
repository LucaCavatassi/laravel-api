@extends('layouts.admin') 

@section('content')
        <div class="container">
            <h1 class="mt-2">Aggiungi Progetto</h1>
            <div class="d-flex justify-content-between">
                <p>Compila il form per aggiungere un nuovo progetto alla tua lista.</p>
                <a href="{{ route("admin.projects.index") }}" class="text-danger">Annulla</a>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="errors-style">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                
            @endif

            <form action="{{ route("admin.projects.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="titolo" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="titolo" aria-describedby="titolo" name="title" value="{{ old("title") }}">

                    <label for="descrizione" class="form-label">Descrizione</label>
                    <textarea type="text-area" class="form-control" id="descrizione" aria-describedby="descrizione" name="description">{{ old("description") }}</textarea>    

                    <div class="d-flex gap-5">
                        <div class="d-flex flex-column">
                            <label class="mt-2 mb-2" for="type">Seleziona un campo</label>
                            <select class="fs-6 p-1" name="type_id" id="type">
                                <option disabled="disabled" selected="selected">Seleziona un campo</option>
                                @foreach ($types as $type)
                                    <option @selected(old("type_id") == $type->id ? "selected" : "") value="{{$type->id}}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex flex-column">
                            <span class="mt-1 mb-2">Seleziona un linguaggio</span>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                @foreach ($technologies as $technology)
                                    <input @checked(in_array($technology->id, old("technologies", []))) type="checkbox" class="btn-check" id="technology - {{ $technology->id }}" value="{{$technology->id}}" name="technologies[]">
                                    <label class="btn btn-outline-primary" for="technology - {{ $technology->id }}">{{ $technology->name }}</label>
                                @endforeach
                            </div>
                        </div>
                        <div>
                            <label class="mt-2 mb-2" for="cover_img">Selezione un immagine come anteprima</label>
                            <input id="cover_img" name="cover_img" type="file" >
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Aggiungi</button>
            </form>
        </div>
@endsection