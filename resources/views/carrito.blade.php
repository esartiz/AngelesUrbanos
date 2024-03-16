@php
    $infoDesc = '';
    $categoriasBD = ["basico_amarillo","basico_azul","basico_blanco","basico_cafe","basico_magenta","basico_naranja","basico_negro","basico_piel","basico_rojo","basico_turquesa","basico_verde","basico_violeta","desmaquilladora","neon_ahuyama","neon_amarillo","neon_azul","neon_blanco","neon_naranja","neon_rojo","neon_rosa","neon_verde","neon_violeta","perlado_amarillo","perlado_azul","perlado_cereza","perlado_cobre","perlado_dorado","perlado_gamora","perlado_magenta","perlado_naranja","perlado_plata","perlado_rojo","perlado_verde","perlado_violeta"];
@endphp
@extends('layouts.bodypaint')
@section('titulo')Carrito de Compras | Angeles Urbanos @endsection
@section('descripcion')Compra pintura corporal en Promoción solamente en Ángeles Urbanos. Máxima cobertura y calidad.@endsection
@section('imagen'){{ 'zitro' }}@endsection

@section('content')
    <div class="container mx-auto flex flex-wrap p-5">
        <div class="w-full md:w-4/6 text-center md:text-left">
            <h2 class="text-center">Mi Carrito de Compras</h2>
            <div class="text-center">Cada referencia contiene 20 ml de Pintura Corporal con un costo por unidad de $19,900 COP</div>

            @if (collect(Session::get('carrito', []))->sum('cantidad') >= 5)
            <div class="bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20">
                            <path
                                d="M10 0C4.477 0 0 4.477 0 10s4.477 10 10 10 10-4.477 10-10S15.523 0 10 0zm0 18.75c-4.621 0-8.375-3.754-8.375-8.375S5.379 2 10 2s8.375 3.754 8.375 8.375S14.621 18.75 10 18.75zM9 14h2v2H9v-2zm0-6h2v4H9V8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Promoción activada</p>
                        <p class="text-sm">Por la compra de 5 o más referencias obtienes <b>Envío Gratis</b> a todo el país
                            a través de Interrapidísmo</p>
                    </div>
                </div>
            </div>
            @endif

            <div class="bg-white shadow-md rounded m-6">
                <table class="text-left w-full border-collapse">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">
                                Producto</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-center">
                                Cantidad</th>
                            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light text-right">
                                Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (collect(Session::get('carrito', [])) as $item)
                        @if (isset($item['clave']))
                        @php $infoDesc .= str_replace('_', ' ', $item['clave']).' - ' @endphp
                        <tr class="hover:bg-grey-lighter">
                            <td style="background-image: url(/img/bodypainting-colors/{{ $item['clave'] }}.png); background-position:center"></td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <a href="/pintura-corporal/{{ $item['clave'] }}">
                                    <b>{{ $item['nombre'] }}</b><br>Pintura
                                    corporal {{str_replace('_', ' ', $item['clave'])}} x 20ml
                                </a>
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light text-center">
                                <form method="POST" action="{{ route('modCarrito') }}" class="relative" id="form_{{ $loop->iteration }}">
                                    <input type="hidden" name="prd" value="{{ $item['clave'] }}">
                                    <input type="hidden" name="desde" value="carrito">

                                    <select idForm="{{ $loop->iteration }}" class="cambiaCantidad block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="cnt">
                                        <option value="0">Eliminar</option>
                                      @for ($i = 1; $i < 11; $i++)
                                        <option value="{{ $i }}"{{ ($i == $item['cantidad'] ? 'selected' : '') }}>{{ $i }}</option>
                                      @endfor
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </form>
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light text-right">$ {{number_format($item['precio'], 0, '', '.')}}</td>
                        </tr>
                        @endif
                        @endforeach

                        <tr class="bg-slate-300">
                            <td class="py-4 px-6 border-b border-grey-light"><b></b></td>
                            <td class="py-4 px-6 border-b border-grey-light"><b>TOTAL</b></td>
                            <td class="py-4 px-6 border-b border-grey-light text-center text-xl">{{ collect(Session::get('carrito', []))->sum('cantidad') }}</td>
                            <td class="py-4 px-6 border-b border-grey-light text-right text-xl">$ {{ number_format(collect(Session::get('carrito', []))->sum('precio'), 0, '', '.') }}</td>
                        </tr>

                        <form method="POST" action="{{ route('modCarrito') }}" class="relative" id="form_0">
                        <tr class="hover:bg-grey-lighter">
                            <td class="py-4 px-6 border-b border-grey-light">
                                @csrf
                                <input type="hidden" name="desde" value="carrito">
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <select idForm="0" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="prd">
                                    @foreach ($categoriasBD as $item)
                                        <option value="{{ $item }}">{{ucwords(str_replace('_', ' ', $item))}} x 20ml</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <select idForm="0" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="cnt">
                                  @for ($i = 1; $i < 11; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                  @endfor
                                </select>
                            </td>
                            <td class="py-4 px-6 border-b border-grey-light">
                                <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600" type="submit">Agregar</button>
                            </td>
                        </tr>
                        </form>

                    </tbody>
                </table>


            </div>

        </div>

        @if (collect(Session::get('carrito', []))->sum('cantidad') > 0)
        <div class="w-full md:w-2/6 p-3 bg-blue-100">
            <h3>Datos de envío y pago</h3>
            

            <form id="gotoCheckOut" method="POST">
                <!-- Datos ePayCo -->
                <input type="hidden" name="param_name" id="param_name" value="{{ collect(Session::get('carrito', []))->sum('cantidad') }} x 20ml Pintura Corporal">
                <input type="hidden" name="param_desc" id="param_desc" value="Referencias: {{ $infoDesc }} x 20ml c/u">
                <input type="hidden" name="param_inv" id="param_inv" value="{{ date('YmdHis') }}">
                <input type="hidden" name="param_amount" id="param_amount" value="{{ collect(Session::get('carrito', []))->sum('precio') }}">

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="nombre">Nombre completo</label>
                    <input class="w-full px-3 py-2 border rounded-md" type="text" id="nombre" name="nombre"
                        placeholder="Nombre y Apellidos" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="documento">Documento de identidad</label>
                    <input class="w-full px-3 py-2 border rounded-md" type="number" id="documento" name="documento"
                        placeholder="Solo números" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="documento">Correo Electrónico</label>
                    <input class="w-full px-3 py-2 border rounded-md" type="email" id="correo" name="correo"
                        placeholder="alguien@ejemplo.com" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="direccion">Dirección completa</label>
                    <input class="w-full px-3 py-2 border rounded-md" type="text" id="direccion" name="direccion"
                        placeholder="Ingrese su dirección completa" required>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="pais">País</label>
                    <select class="w-full px-3 py-2 border rounded-md fPais" name="pais" id="">
                        <option value="">--Seleccione--</option>
                        <option value="Colombia">COLOMBIA</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="estado">Estado</label>
                    <select class="w-full px-3 py-2 border rounded-md fEstado" name="estado" id="">
                        <option value="">--Seleccione--</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="ciudad">Ciudad</label>
                    <select class="w-full px-3 py-2 border rounded-md fCiudad" name="ciudad" id="">
                        <option value="">--Seleccione--</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="barrio">Barrio</label>
                    <input type="text" class="w-full px-3 py-2 border rounded-md" list="barrios" name="barrio" required>
                    <datalist class="fBarrio" id="barrios"></datalist>
                </div>

                <div class="mb-4">
                    <label class="block font-medium mb-2" for="telefono">Teléfono</label>
                    <input class="w-full px-3 py-2 border rounded-md" type="tel" id="telefono" name="telefono"
                        placeholder="Ingrese su número de teléfono">
                </div>
                <div class="toBuyBodyPainting">
                    <button class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600"
                        type="submit">Procesar Pedido</button>
                </div>
            </form>
        </div>
        @endif

    </div>
@endsection
