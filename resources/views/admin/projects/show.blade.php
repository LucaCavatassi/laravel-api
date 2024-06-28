@extends ("layouts.admin")

@section ("content")
    <div class="container">
        <div class="div mt-3 d-flex justify-content-between align-items-center">
            <h2 class="m-0 fw-bold text-primary">Titolo Progetto</h2>
            <a class="text-decoration-underline" href="{{ route("admin.projects.index")}}">Torna alla lista</a>
        </div>
        <h1>{{ $project->title }}</h1>
        <hr>
        <h2 class="fw-bold text-primary mt-3">Descrizione Progetto</h2>
        <p class="fs-2">{{ $project->description }}</p>
        <hr>
        <div class="d-flex gap-5">
            <div>
                <h4 class="fw-bold text-primary mt-3">Campo</h4>
                <p>{{ $project->type?->name }}</p>
            </div>
            <div>
                <h4 class="fw-bold text-primary mt-3">Tecnologia Utilizzata</h4>
                @forelse ($project->technologies as $technology)                               
                    <td>{{ $technology->name }}</td>
                @empty
                    <td>Nessuna tecnologia indicata</td>
                @endforelse
            </div>
        </div>
        <h6 class="fw-bold text-primary mt-3">Slug ID</h6>
        <p>{{ $project->slug }}</p>
    </div>
@endsection
