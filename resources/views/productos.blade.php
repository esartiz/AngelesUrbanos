@php
    switch ($productos->first()->tono) {
  case "mate":
    $ttSec = 'Tonos Mate';
    $textoSec = 'Con los <b>tonos mate</b> de Ángeles Urbanos pueds crear diseños sin brillos ni reflejos en su acabado. 
    Es decir, la piel no se verá reflectante o brillante y da un viso opaco. En lugar de reflejar la luz, 
    absorbe la luz y produce una apariencia suave y plana. El resultado es un acabado suave y sin brillo 
    que es popular en ciertos diseños para crear un aspecto elegante y sofisticado.';
      break;
  case "neon":
    $ttSec = 'Tonos Neón';
    $textoSec = 'Las <b>pinturas corporales neón</b> son una opción popular para quienes buscan un efecto 
    llamativo y brillante en su maquillaje corporal. Estas pinturas contienen pigmentos fluorescentes que se iluminan bajo 
    la luz negra, lo que las hace ideales para fiestas, eventos nocturnos y festivales. Además de su efecto llamativo, son fáciles de aplicar, 
    secarse rápidamente y no dañar la piel. También son resistentes al agua y al sudor, lo que las hace ideales para eventos al aire libre 
    y actividades deportivas.';
    break;
  case "perlado":
    $ttSec = 'Tonos Perlados';
    $textoSec = 'Dale un acabado brillante y nacarado a tus diseños, su textura suave y sedosa ofrece fácil aplicación y mezcla para crear diferentes 
    tonalidades y efectos. Su brillo y tonalidad pueden variar según la luz y el ángulo desde el que se mire la piel, creando un efecto muy llamativo y 
    dinámico que puede ser utilizado para crear diseños muy interesantes y originales.';
    break;
  default:
    $ttSec = '';
    $textoSec = '';
  }
@endphp
@extends('layouts.bodypaint')
@section('titulo')Pintura Corporal Tono {{ $productos->first()->tono }}@endsection
@section('descripcion'){{ str_replace(array("\r", "\n"), '', $textoSec) }}@endsection
@section('imagen')pintura-corporal-{{ $productos->first()->tono }}@endsection

@section('content')
    <div class="container mx-auto flex items-center justify-between flex-wrap">

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="component flex max-w-sm pt-16">
                <div class="w-full px-8 pb-8 shadow-lg rounded-lg bg-gray-100 text-center relative">
                    <div class="absolute top-0 left-0 right-0 ">
                        <div class="inline-block bg-indigo-200 rounded-full p-8 transform -translate-y-1/2"><svg
                                class="w-6 text-indigo-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9"></line>
                                <line x1="9" y1="21" x2="9" y2="9"></line>
                            </svg></div>
                    </div>
                    <div class="mt-20 uppercase text-indigo-700 font-bold">Pintura Corporal Ángeles Urbanos Tono {{ $productos->first()->tono }}</div>
                    <div class="mt-6 text-sm text-gray-600">
                        {{ $textoSec }}
                    </div>
                    <div class="mt-6">
                        <div
                            class="uppercase font-bold border-b-2 text-indigo-500 border-indigo-200 hover:border-indigo-500 hover:text-indigo-600">
                            {{ $productos->count() }} colores disponibles
                        </div>
                    </div>
                </div>
            </div>

            @foreach ($productos as $item)
                
            <div class="max-w-sm rounded overflow-hidden shadow-lg">
                <img class="w-full" src="/images/base-corporal-liquida/{{ $item->clave }}.jpg"
                    alt="Pintura Corporal {{ $item->color }} {{ $item->tono }}">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $item->nombre }}</div>
                    <p class="text-gray-700 text-base">
                        Presentación de 20ml de Pintura Corporal <b>Color {{ $item->color }}</b> | <b>Tonalidad {{ $item->tono }}</b>
                    </p>
                    <p class="text-gray-700 text-base">
                        Precio: $ {{ $item->precio }} COP

                    <div class="flex my-4">
                        <a href="/pintura-corporal/{{ $item->clave }}"
                            class="m-2 component border rounded font-semibold tracking-wide text-sm px-5 py-2 focus:outline-none focus:shadow-outline border-gray-500 text-gray-500 hover:bg-gray-500 hover:text-gray-100 ">Ver
                            Catálogo Diseños</a>
                        <div class="m-2">
                            <form method="POST" action="{{ route('modCarrito') }}">
                                @csrf
                                <input type="hidden" name="prd" value="{{ $item->clave }}">
                                <input type="hidden" name="desde" value="foto">
                                <input type="hidden" name="cnt" value="1">
                                <button type="submit" class="component border rounded font-semibold tracking-wide text-sm px-5 py-2 focus:outline-none focus:shadow-outline border-red-500 text-red-500 hover:bg-red-500 hover:text-red-100">
                                    Add Cart
                                </button>
                            </form>
                        </div>
                    </div>
                    </p>
                </div>

            </div>
                        @endforeach


        </div>
    </div>

    @include('box_pintura')
@endsection
