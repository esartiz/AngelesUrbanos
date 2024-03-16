@php
/*
    if (strpos($articulo->text, '<img') !== false) {
    // Agregar el código JavaScript después de la etiqueta <img>
    $codigoJavascript = "<div style=\"width:470px; margin: auto; margin-bottom:20px\">
    <script type=\"text/javascript\">
                            atOptions = {
                                'key' : '983ecc8a21d653ad66291c9a9d3ec2ad',
                                'format' : 'iframe',
                                'height' : 60,
                                'width' : 468,
                                'params' : {}
                            };
                            document.write('<scr' + 'ipt type=\"text/javascript\" src=\"//www.topcreativeformat.com/983ecc8a21d653ad66291c9a9d3ec2ad/invoke.js\"></scr' + 'ipt>');
                        </script></div>";
    
    $nuevoTexto = preg_replace('/(<img[^>]+>)/i', '$1 ' . $codigoJavascript, $articulo->text);
} else {
    $nuevoTexto = $articulo->text;
}
*/
$nuevoTexto = $articulo->text;
@endphp

@extends('layouts.bodypaint')
@section('titulo'){{ $articulo->nombre }} | BodyPainting Magazine @endsection
@section('descripcion'){{ implode(' ', array_slice(str_word_count(strip_tags($articulo->text), 1), 0, 20)) }}@endsection
@section('imagen')bodypainting/blog/{{ $articulo->clave }}@endsection

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800">{{ $articulo->nombre }}</h1>
    <img src="/img/blog/{{ $articulo->clave }}.jpg" alt="{{ $articulo->nombre }}" class="mt-4 img-fluid">
    <div class="bodypaint-blog">
        <p>{!! $nuevoTexto !!}</p>
        <!-- Aquí puedes agregar más contenido -->
    </div>
    <div class="mt-8 text-center">
        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Leer más artículos</a>
    </div>
</div>

@include('noticias_lista')

@endsection
