@php
    $categoriasBD = ['cosplay', 'women', 'guys', 'creative', 'neon', 'advertising', 'soccer', 'animals', 'bellypainting', 'clothes'];
@endphp
@extends('layouts.admin')

@section('content')
    <h1 class="bodypainting-usa">{{ $fotos->count() }} Fotos en la Galería</h1>
    <div class="text-center">
        <input type="text" placeholder="Buscar..." class="form-control search-input shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="text-center mt-5">
        O buscar por <b>color</b>
        <select name="" id="" onchange="filtrame(this)">
            <option value="">Seleccione Color</option>
            @foreach ($prods as $item)
            <option value="{{ $item->clave }}">{{ ucwords($item->tono.' '.$item->color) }}</option>
            @endforeach
        </select>  <b> | </b> buscar por<b> categoría </b>
        <select name="" id="" onchange="filtrame(this)">
            <option value="">Seleccione Categoría</option>
            @foreach ($categoriasBD as $item)
            <option value="{{ $item }}">{{ ucwords($item) }}</option>
            @endforeach
        </select>
    </div>

    <div class="container mx-auto px-2 pt-4 text-gray-800">
        <button onclick="abrirModal('admin/0/foto')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Cargar nueva foto a la galería
          </button>
    </div>
    <div class="flex flex-wrap mx-2 p-5">
    <section class="py-8 px-4">
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 xl:grid-cols-8 justify-center p-1">
            @foreach ($fotos as $item)
                <a href="#" class="cardBodyPaint" onclick="abrirModal('admin/{{$item->id}}/foto')">
                    <img class="rounded shadow-md" src="/img/bodypainting/thumb/{{ $item->clave }}.jpg"
                        alt="{{ $item->nombre }} bodypainting"><br>
                    {{ $item->nombre }}
                    <div style="font-size: 1px">{{ $item->colores }} {{ $item->cat }}</div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
