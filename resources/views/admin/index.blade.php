@extends('layouts.admin')

@section('content')

<section class="bg-black py-8">
    <h2 class="text-2xl font-bold text-gray-300 text-center">BodyPainting Magazine</h2>

    <div class="text-center">
        <input type="text" placeholder="Buscar..." class="form-control search-input shadow appearance-none border rounded w-1/3 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
    </div>

    <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
        <button onclick="abrirModal('admin/0/articulo')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Crear nuevo artículo para el Blog
          </button>
    <div class="flex flex-wrap mx-2 p-5">

        @foreach ($lastBlg as $item)
        
        <div class="w-full lg:w-1/3 md:w-1/2 p-6 flex flex-col cardBodyPaint">
            <img class="w-full" src="{{ asset('img/blog/'.$item->clave.'.jpg') }}" alt="{{ $item->nombre }}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2" style="color: white">{{ $item->nombre}}</div>
                <p class="text-white text-base">
                    {{ implode(' ', array_slice(str_word_count(strip_tags($item->text), 1), 0, 30)) }}... [Read Article]
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                <a href="/blog-bodypaint/{{ $item->clave }}" target="_blank" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Ver</a>
                <button onclick="abrirModal('admin/{{ $item->id }}/articulo')" class="inline-block bg-green-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">Editar</button>
                <a href="{{ route('adm_art_delete', $item->id) }}" class="inline-block bg-red-400 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2" onclick="return confirm('¿Estás seguro de que deseas eliminar el artículo?')">Eliminar</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
</section>
    
@endsection