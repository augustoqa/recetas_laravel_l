@extends('layouts.app')

@section('botones')
    <a href="{{ route('recetas.create') }}" class="btn btn-primary mr-2">Crear Receta</a>
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
                            <form action="{{ route('recetas.destroy', $receta) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn btn-danger mr-1 d-block w-100 mb-2" value="Eliminar &times;">
                            </form>
                            <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-dark mr-1 d-block mb-2">Editar</a>
                            <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-success mr-1 d-block">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
