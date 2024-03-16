<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Prod;
use App\Models\Carrito;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;

use Session, URL, Response, Str;

class AdminController extends Controller
{
    public function adm(){
        $lastBlg = Foto::where('cat', 'blog')->get();
        return view('admin.index',compact('lastBlg'));
    }

    public function articulo($id, $slug){
        $datos = ($id === 0 ? [] : Foto::find($id));
        return view('admin.articulo',compact('datos'));
    }

    public function articulo_edit(Request $request){
        //Revisa si se trata de un nuevo registro o de una edición
        if($request->elID == "0"){
            $clave = Str::slug($request->titulo);
        } else {
            $art = Foto::find($request->elID);
            $clave = $art->clave;
        }

        //Carga la foto de ser necesario
        if ($request->hasFile('foto')) {
            // Obtener la extensión original de la imagen
            $extension = $request->file('foto')->getClientOriginalExtension();
        
            // Crear un nombre de archivo único para la imagen
            $filename = $clave . '.' . $extension;
        
            // Guardar la imagen original en public/images/blog
            $request->file('foto')->storeAs('public/blog', $filename);
        
            // Redimensionar la imagen a 640px de ancho
            $resizedImage = Image::make(storage_path('app/public/blog/' . $filename))
                ->resize(640, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg', 72);
        
            // Guardar la imagen redimensionada en public/images/blog
            Storage::disk('public')->put('blog/' . $clave . '.jpg', (string)$resizedImage);
        }

        //Guarda el Blog
        Foto::updateOrCreate(
            ['id' => $request->elID], // Verifica si existe un registro con el mismo ID
            [
                'clave' => $clave,
                'nombre' => $request->titulo,
                'cat' => $request->cat,
                'colores' => $request->tags,
                'text' => $request->texto,
                'bpday' => NULL
            ]
        );
        return redirect()->back();
    }

    public function adm_art_delete($id){
        $delArt = Foto::find($id);
        //Revisa si existe foto previa para eliminarla
        if (Storage::disk('public')->exists('blog/' . $delArt->clave . '.jpg')) {
            // Eliminar la imagen del almacenamiento
            Storage::disk('public')->delete('blog/' . $delArt->clave . '.jpg');
        }
        $delArt->delete();
        return redirect()->back();
    }

    public function adm_gallery(){
        $fotos = Foto::where('cat', 'NOT LIKE', 'blog')->where('cat', 'NOT LIKE', 'escultura')->get();
        $prods = Prod::all()->sortBy('clave');
        return view('admin.fotos',compact('fotos','prods'));
    }

    public function addPhotoPage(){
        $extension = $request->file('upload')->getClientOriginalExtension();
        $filename = 'bodypaint_'. date('YmdHis') . '.' . $extension;
        $request->file('upload')->storeAs('public/blog', $filename);
        $resizedImage = Image::make(storage_path('app/public/blog/' . $filename))
                ->resize(640, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode('jpg', 72);    
        Storage::disk('public')->put('blog/' . $clave . '.jpg', (string)$resizedImage);
    }
}
