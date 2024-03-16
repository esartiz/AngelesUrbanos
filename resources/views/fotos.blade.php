@php
    $titulo = str_replace('_', ' ', $slug);
@endphp

@extends('layouts.bodypaint')
@section('titulo')
    {{ ucwords($titulo) }} BodyPainting Gallery
@endsection

@section('descripcion')
    {{ ucwords($titulo) }} Body Painting portfolio by Giovanni Zitro, colombian artist
@endsection

@section('imagen')
    https://www.angelesurbanos.com/img/bodypainting/{{ $fotos->first()->clave }}.jpg
@endsection
@section('link')
    body-painting/{{ $slug }}
@endsection

@section('content')
    @if ($bannerPromo)
        <form method="POST" action="{{ route('modCarrito') }}" class="pintura-corporal-promocion">
            @csrf
            <input type="hidden" name="prd" value="{{ $slug }}">
            <input type="hidden" name="desde" value="foto">
            <input type="hidden" name="cnt" value="1">
            Adquiere 20ml de Pintura Corporal {{ ucwords($titulo) }} por tan sólo <b>$19,900 COP</b>
            <button type="submit"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Agregar al Carrito
            </button>
        </form>
    @endif
    <h1 class="bodypainting-usa">{{ ucwords($titulo) }} BodyPainting Gallery</h1>
    <h2 class="pinturacorporal">
        {{ $fotos->count() }} images found BodyPainting {{ ucfirst($titulo) }}
    </h2>
    <section class="py-8 px-4">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 justify-center p-1">
            @foreach ($fotos as $item)
                    <a href="/bodypainting-photo/{{ $item->clave }}" title="{{ $item->nombre }} Bodypainting Design">
                        <img class="rounded shadow-md" src="/img/bodypainting/thumb/{{ $item->clave }}.jpg"
                            alt="{{ $item->nombre }} bodypainting">
                    </a>
            @endforeach
        </div>
    </section>

    @include('box_pintura')
@endsection
