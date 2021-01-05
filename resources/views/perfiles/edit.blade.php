@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('botones')
    <a href="{{ route('recetas.index') }}" class="btn btn-outline-primary mr-2 text-uppercase font-weight-bold">
        <svg class="icono" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
        </svg>
        Volver
    </a>
@endsection

@section('content')

    <h1 class="text-center">Editar Mi Perfil</h1>

    <div class="row justify-content-center mt-5">
        <div class="col-md-10 bg-white p-3">
            <form action="{{ route('perfiles.update', ['perfil' => $perfil->id]) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input
                        type="text"
                        name="nombre"
                        class="form-control @error('nombre') is-invalid @enderror"
                        id="nombre"
                        placeholder="Tu Nombre"
                        value="{{ $perfil->usuario->name }}"
                    >

                    @error('nombre')
                    <span class="invalid-feedback d-block" role="alert">
    					<strong>{{ $message }}</strong>
    				</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">Sitio Web</label>
                    <input
                        type="text"
                        name="url"
                        class="form-control @error('url') is-invalid @enderror"
                        id="url"
                        placeholder="Tu Sitio Web"
                        value="{{ $perfil->usuario->url }}"
                    >

                    @error('url')
                    <span class="invalid-feedback d-block" role="alert">
    					<strong>{{ $message }}</strong>
    				</span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="biografia">Biografía</label>
                    <input type="hidden" name="biografia" id="biografia" value="{{ $perfil->biografia }}">
                    <trix-editor
                        class="form-control @error('biografia') is-invalid @enderror"
                        input="biografia"
                    ></trix-editor>

                    @error('biografia')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="imagen">Tu imagen</label>

                    <input
                        name="imagen"
                        type="file"
                        id="imagen"
                        class="form-control  @error('imagen') is-invalid @enderror"
                    >

                    @if ( $perfil->imagen )
                        <div class="mt-4">
                            <p>Imagen Actual:</p>

                            <img src="/storage/{{ $perfil->imagen }}" style="width: 300px">
                        </div>

                        @error('imagen')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    @endif
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar Perfil">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous" defer></script>
@endsection
