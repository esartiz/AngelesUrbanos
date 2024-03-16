@extends('layouts.bodypaint')
@section('titulo'){{ ucwords($articulo->nombre) }} | BodyPainting Photography @endsection
@section('descripcion'){{ implode(' ', array_slice(str_word_count(strip_tags($articulo->text), 1), 0, 20)) }}@endsection
@section('imagen')bodypainting/blog/{{ $articulo->clave }}@endsection

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 text-center">{{ ucwords($articulo->nombre) }} BodyPainting</h1>
    
    <div class="text-center justify-center flex">
        <img src="/img/bodypainting/{{ $articulo->clave }}.jpg" alt="{{ $articulo->nombre }}" class="mt-4">
    </div>
    <div class="grid grid-cols-6 gap-4 py-8 px-4">
        Colors Used:
        @foreach (explode(',', $articulo->colores) as $pintura)
            <a href="/pintura-corporal/{{ $pintura }}">
                <img src="/img/bodypainting-colors/{{ $pintura }}.png" style="height: 100px"
                    alt="">
            </a>
        @endforeach
    </div>
    <div class="bodypaint-blog">
        <p>{!! $articulo->text !!}</p>
    </div>
</div>

<section class="bg-black py-8">
    <h2 class="text-2xl font-bold text-gray-300 text-center">More {{ ucwords(str_replace('_', ' ', Session::get('cat_save')[1])) }} BodyPainting Photos</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 justify-center p-1">
        @foreach ($fotos as $item)
        
        <a href="/bodypainting-photo/{{ $item->clave }}" title="{{ $item->nombre }} Bodypainting Design">
            <img class="rounded shadow-md" src="/img/bodypainting/thumb/{{ $item->clave }}.jpg"
                alt="{{ $item->nombre }} bodypainting">
        </a>
        @endforeach
    </div>
</section>
@endsection
