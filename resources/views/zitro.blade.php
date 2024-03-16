@extends('layouts.bodypaint')
@section('titulo'){{'Giovanni Zitro BodyPainting Artist'}}@endsection
@section('descripcion'){{'Body Painting portfolio by Giovanni Zitro, colombian artist'}}@endsection
@section('imagen'){{'zitro'}}@endsection

@section('content')
<div class="align-bottom grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 p-5" style="background-color: #b1b1b1;">
    <div>
        <img src="/images/giovanni-zitro.png" alt="Giovanni Zitro Artista del BodyPainting">
    </div>
    <div>
        <h1>Giovanni Zitro</h1>
        <h2>Maestro en Artes Visuales</h2>

        <h4>Objetivo Artístico / Artistic Goal</h4>
        Dedicar mi creatividad a la continua investigación e innovación de la 
        interpretación de la figura humana y la naturaleza, esto se ve reflejado
        en el trabajo realizado en los últimos 25 años.

        <h4>Zoontropía</h4>
        Serie de esculturas acompañadas de diferentes manifestaciones culturales
        donde la figura humana y su conexión con los animales es protagonista.

        <h4>Talentos</h4>
        - Fotografía <br>
        - Pintura aclírica, óleo y urbana <br>
        - BodyPainting / Pintura Corporal <br>
        - Escultura <br>
        - Dibujo digital y Análogo <br>
        - Maquillaje <br>
        - Docencia <br>
    </div>
    <div>
        <h4>Experiencia Profesional</h4>
        - Docente BodyPainting en la Escuela de Diseño LaSalle College<br> 
        - Docente Maquillaje Stock Models & Talent Bogotá<br> 
        - Director Escuela Art School Portada<br> 
        - Fotógrafo publicitario & Booking<br> 
        - Artista Freelance eventos y performance<br> 
        - Escultor<br> 

        <h4>Formación Académica</h4>
        - Artes visuales (UNAD, Colombia)<br>
        - Fotografía (Estudio Creativo Bogotá)<br>
        - Oficial (Escuela Militar de Aviación, Colombia) <br>

        <h4>Publicaciones</h4>
        - Revista Back Projection #6 Febrero 2021<br>
        - Revista Plan B. Octubre 2009<br>
    </div>
</div>



    @include('box_pintura')
@endsection
