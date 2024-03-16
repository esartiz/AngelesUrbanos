<form method="POST" class="grid grid-cols-2 gap-4" action="{{ route('art_edit') }}" enctype="multipart/form-data">
    <div>
        @csrf
        <input type="hidden" name="elID" value="{{ $datos->id ?? '0' }}">
        <label for="nombre">Titulo del Artículo</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            value="{{ $datos->nombre ?? '' }}" type="text" name="titulo" id="titulo">
    </div>
    <div>
        <label for="nombre">Foto Principal</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            type="file" name="foto" id="foto">
    </div>
    <div>
        <label for="nombre">Palabras Claves</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            value="{{ $datos->colores ?? '' }}" type="text" name="tags" id="tags">
    </div>
    <div>
        <label for="nombre">Categoria</label>
        <input
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            value="{{ $datos->cat ?? '' }}" type="text" name="cat" id="cat">
    </div>
    <img class="rounded shadow-md" src="/img/bodypainting/{{ $datos->clave ?? '' }}.jpg">

    <textarea required="required" class="ckeditor" style="width: 100%" name="texto" id="texto" rows="13">{!! $datos->text ?? '' !!}</textarea>

    <button type="submit"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-6">Guardar</button>
</form>
