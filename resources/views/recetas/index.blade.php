@extends('layouts.app')

@section('botones')
    @include('ui.navagacion')
@endsection

@section('content')
    <h2 class="text-center mb-5">Recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Título</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recetas as $receta)
                    <tr>
                        <td>{{ $receta->titulo }}</td>
                        <td>{{ $receta->categoria->nombre }}</td>
                        <td>
                            <eliminar-receta
                                receta-id={{ $receta->id }}>
                            </eliminar-receta>
                            <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-dark mr-1 d-block mb-2">Editar</a>
                            <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-success mr-1 d-block">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-12 mt-4 justify-content-center d-flex">
            {{ $recetas->links() }}
        </div>
        
        <h2 class="text-center my-5">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">

            @if (count($usuario->meGusta) > 0)
            <ul class="list-group">
                @foreach ($usuario->meGusta as $receta)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <p>{{ $receta->titulo }}</p>

                    <a href="{{ route('recetas.show', ['receta' => $receta->id]) }}" class="btn btn-outline-success text-uppercase">
                        Ver
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-center">Aún no tienes recetas guardadas</p>
            @endif
        </div>
    </div>
@endsection
