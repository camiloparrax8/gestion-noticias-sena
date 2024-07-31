@extends('adminlte::page')

@section('title', 'Activa G10')

@section('content_header')
    <h1></h1>
@endsection

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            
            <div class="carousel-item">
                <img class="d-block w-100 custom-carousel-img" src="{{ asset('storage/img/ALO_8488.jpg') }}" alt="Second slide">
            </div>
            <div class="carousel-item active">
                <img class="d-block w-100 custom-carousel-img" src="{{ asset('storage/img/ALO_8409.jpg') }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 custom-carousel-img" src="{{ asset('storage/img/ALO_8473.jpg') }}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@endsection

@section('css')
    <style>
        .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .custom-carousel-img {
            width: 100%;
            height: 80vh; /* Ajusta la altura según tus necesidades */
            object-fit: cover; /* Recorta la imagen para que encaje dentro del contenedor manteniendo la proporción */
        }
    </style>
@endsection
