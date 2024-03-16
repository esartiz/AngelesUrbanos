<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\Prod;
use App\Models\Carrito;
use App\Models\Customer;
use Illuminate\Support\Facades\Http;

use Session, URL, Response;

class AngelesController extends Controller
{
    public function index(){
        $bpDay = Foto::where('bpday', date('Y-m-d'))->first();
        Session::put('cat_save', ['foto', explode(',',$bpDay->cat)[0]]);
        $lastBlg = Foto::where('cat','blog')->orderBy('updated_at', 'DESC')->take(5)->get();
        return view('index', compact('bpDay','lastBlg'));
    }

    public function blog($id){
        $articulo = Foto::where('cat','blog')->where('clave', $id)->first();
        $lastBlg = Foto::where('cat', 'blog')->where('id', '!=', $articulo->id)->inRandomOrder()->take(3)->get();
        return view('articulo', compact('articulo','lastBlg'));
    }

    public function verFoto($id){
        $articulo = Foto::where('clave', $id)->first();
        $fotos = Foto::where((Session::get('cat_save')[0] == 'foto' ? 'cat' : 'colores'), 'LIKE', '%' . Session::get('cat_save')[1] . '%')->where('id', '!=', $articulo->id)->inRandomOrder()->take(6)->get();
        return view('verfoto', compact('articulo','fotos'));
    }

    public function maquillajeCorporal($slug){
        $productos = Prod::where('tono',$slug)->get();
        return view('productos', compact('productos'));
    }

    public function galeria_color($slug){
        Session::put('cat_save', ['color', $slug]);
        $bannerPromo = true;
        $fotos = Foto::where('colores', 'LIKE', '%' . $slug . '%')->get();
        return view('fotos', compact('fotos','slug','bannerPromo'));
    }

    public function galeria($slug){
        Session::put('cat_save', ['foto', $slug]);
        $bannerPromo = false;
        $fotos = Foto::where('cat', 'LIKE', '%' . $slug . '%')->get();
        return view('fotos', compact('fotos','slug','bannerPromo'));
    }

    public function carritoAdd(Request $request)
    {
        $carrito = Session::get('carrito', []);
        
        $productoExistenteKey = array_search($request->prd, array_column($carrito, 'clave'));
        if ($productoExistenteKey !== false) {
            if ($request->cnt == 0) {
                unset($carrito[$productoExistenteKey]);
                $carrito = array_values($carrito); // Reindexar los elementos del arreglo
            } else {
                if ($request->desde == "foto") {
                    $carrito[$productoExistenteKey]['cantidad']++;
                } else {
                    $carrito[$productoExistenteKey]['cantidad'] = $request->cnt;
                }
                $carrito[$productoExistenteKey]['precio'] = $carrito[$productoExistenteKey]['cantidad'] * 19900;
            }
        } else {
            $elProd = Prod::where('clave', $request->prd)->first();
            $producto = ['id' => $elProd->id, 'nombre' => $elProd->nombre, 'clave' => $elProd->clave, 'precio' => $elProd->precio, 'cantidad' => 1];
            $carrito[] = $producto;
        }
        
        Session::put('carrito', $carrito);
        $mjsRet = ['blue', 'Carrito modificado <b><a href="/cart">Ir al Carrito</a></b>'];
        return back()->with('message', $mjsRet);
    }

    public function checkout(Request $request){

        $carrito = Session::get('carrito', []);
        $sesionID = Session::getId();

        foreach ($carrito as $producto) {
            $nCrt = Carrito::create([
                'ipUser' => $sesionID,
                'prod' => $producto['clave'],
                'cnt' => $producto['cantidad'],
                'total' => $producto['precio'],
                'fecha' => date('Y-m-d H:i:s'),
                'status' => 0
                // Otros campos que puedas tener en tu tabla
            ]);
        }
        
        $nCs = Customer::create([
            'nombre' => $request->nombre,
            'documento' => $request->nombre,
            'direccion' => $request->direccion,
            'pais' => $request->pais,
            'estado' => $request->estado,
            'ciudad' => $request->ciudad,
            'barrio' => $request->barrio,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'idCart' => $request->param_inv,
            'pedido' => $sesionID,
            'track' => 1
        ]);
        return 'Ok';
    }

    public function response(Request $request){
        $refPayco = $request->query('ref_payco');
        $url = "https://secure.epayco.co/validation/v1/reference/$refPayco";
        $response = Http::get($url);
        $data = $response->json();

        $x_cod_respuesta = $data['data']['x_cod_respuesta'];

        switch ($x_cod_respuesta) {
            case '1':
                $rData = ["green", "Transacción fue aprobada. Pronto estaremos en contacto contigo"];
                Session::forget('carrito');
                break;
            case '2':
                $rData = ["red", "Transacción rechazada. ".$data['data']['x_response_reason_text']];
                break;
            case '3':
                $rData = ["blue", "Transacción pendiente de aprobación por la entidad bancaria."];
                break;
            case '4':
                $rData = ["red", "La transacción no se realizó. ".$data['data']['x_response_reason_text']];
                break;
            case '6':
                $rData = ["red", "Transacción Reversada."];
                break;
            case '7':
                $rData = ["red", "Transacción Retenida."];
                break;
            case '8':
                $rData = ["red", "Transacción iniciada. ".$data['data']['x_response_reason_text']];
                break;
            case '9':
                $rData = ["red", "Transacción Caducada."];
                break;
            case '10':
                $rData = ["red", "Transacción Abandonada."];
                break;
            case '11':
                $rData = ["red", "Transacción abandonada."];
                break;
            default:
                $rData = ["red", "Transacción no realizada."];
        }
        return redirect()->route('inicio')->with('message', $rData);
    }

    public function sitemap(){
        $lasURL = '<url>
            <loc>' . URL::to('/') . '</loc>
            <lastmod>' . date('c') . '</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>' . URL::to('/zitro') . '</loc>
            <lastmod>' . date('c') . '</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>';

        //Categorias de las Fotos
        $categoriasBD = ['cosplay', 'women', 'guys', 'creative', 'neon', 'advertising', 'soccer', 'animals', 'bellypainting', 'clothes'];
        $lasURL .= $this->createURLSiteMap($categoriasBD, '/body-painting');
        //Tipos de Maquillaje Corporal
        $pinturasType = ['neon','mate','perlado'];
        $lasURL .= $this->createURLSiteMap($pinturasType, '/maquillaje-corporal');
        //Por colores 
        $lasURL .= $this->createURLSiteMap(Prod::pluck('clave')->toArray(), '/pintura-corporal');
        //Blog 
        $lasURL .= $this->createURLSiteMap(Foto::where('cat', 'blog')->pluck('clave')->toArray(), '/blog-bodypaint');
        //Las Fotos
        $lasURL .= $this->createURLSiteMap(Foto::where('cat', 'NOT LIKE','blog')->where('cat', 'NOT LIKE','esculturas')->pluck('clave')->toArray(), '/bodypainting-photo');

        $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
            '.$lasURL.'
            </urlset>';

        return Response::make($sitemapContent, 200, ['Content-Type' => 'application/xml']);
    }

    public function createURLSiteMap($array, $tipo){
        $url = '';
        foreach ($array as $item) {
            $url .= '<url>
            <loc>' . URL::to($tipo.'/'.$item) . '</loc>
            <lastmod>' . date('c') . '</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1.0</priority>
        </url>';
        }
        return $url;
    }
}