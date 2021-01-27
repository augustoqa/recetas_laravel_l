@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" />
@endsection

@section('content')
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mb-4">Últimas Recetas</h2>

        <div class="owl-carousel owl-theme">
            @foreach ($nuevas as $nueva)
            <div class="card">
                <img src="/storage/{{ $nueva->imagen }}" class="card-img-top" alt="imagen receta">

                <div class="card-body">
                    <h3>{{ Str::title($nueva->titulo) }}</h3>

                    <p>{{ Str::words(strip_tags($nueva->preparacion), 20) }}</p>

                    <a href="{{ route('recetas.show', $nueva->id) }}" class="btn btn-primary d-block font-weight-bold text-uppercase">Ver Receta</a>
                </div>
            </div>    
            @endforeach
        </div>
    </div>
@endsection