@php
    $categoriasBD = ['cosplay', 'women', 'guys', 'creative', 'neon', 'advertising', 'soccer', 'animals', 'bellypainting', 'clothes'];
@endphp
@extends('layouts.bodypaint')
@section('titulo')BodyPainting Photos & Art | Giovanni Zitro @endsection
@section('descripcion') BodyPainting Gallery and Photos, modeling and beauty art painting on skin ideas body paint @endsection
@section('imagen'){{ 'blog/pintura-pinta-cuerpo-0' }}@endsection

@section('content')
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8234443054515429"
     crossorigin="anonymous"></script>
<!-- 728x90, creado 31/05/11 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-8234443054515429"
     data-ad-slot="0188810696"></ins>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({});
</script>
    <!-- Profile Section -->
    <section class="bg-black py-8">
        <div class="container mx-auto flex items-center flex-wrap p-5">
            <div class="w-full md:w-2/6">
                <img class="md:h-100" src="{{ asset('images/zitro.png') }}" alt="Giovanni Zitro Bodypainting Artist">
            </div>
            <div class="w-full md:w-3/6 text-center md:text-left">
                <p class="text-gray-300 text-lg">Giovanni Zitro</p>
                <h2 class="text-2xl font-bold text-gray-300">Angeles Urbanos Bodypaint</h2>
                <p class="text-white">
                    Giovanni Zitro is a latinomerican-renowned bodypainting artist with over 20 years of experience in this
                    art.
                    Giovanni has dedicated his life to the art of bodypainting, and has worked on some of the most
                    high-profile
                    projects and events across Colombia. If you're looking for a truly exceptional bodypainting artist with
                    decades of
                    experience and a true passion for his craft.
                    <a href="/zitro" title="Know more about Giovanni Zitro">
                        [See More]
                    </a>
                </p>
            </div>
            <div class="w-full md:w-1/6 text-center">
                <h5 class="text-2xl font-bold text-gray-300">Bodypaint of the Day</h5>
                <a href="/bodypainting-photo/{{ $bpDay->clave }}" title="{{ $bpDay->nombre }} Bodypainting">
                    <img src="{{ asset('img/bodypainting/' . $bpDay->clave . '.jpg') }}" class="md:w-48"
                        alt="{{ $bpDay->nombre }} Bodypainting">
                </a>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    @include('box_pintura')

    <!-- Lastest Works & News -->

    @include('noticias_lista')

    <!-- Portfolio BP Section -->
    <section class="bg-white py-8">
        <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
            <h2 class="text-3xl font-bold text-center">BodyPainting Gallery</h2>
            <div class="flex flex-wrap justify-center">

                @foreach ($categoriasBD as $key)

                <div class="w-full md:w-1/5 sm:w-1/2 p-6 flex flex-col">
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow">
                        <a href="/body-painting/{{ $key }}" class="flex flex-wrap no-underline hover:no-underline"
                            title="{{ ucfirst($key) }} Bodypainting">
                            <img src="{{ asset('images/bodypainting-' . $key . '.jpg') }}" class="rounded-t pb-6"
                                alt="{{ ucfirst($key) }} Bodypainting">
                            <p class="w-full text-gray-600 text-xs md:text-sm px-6">Ángeles Urbanos</p>
                            <div class="w-full font-bold text-xl text-gray-900 px-6">{{ ucfirst($key) }} bodypainting</div>
                        </a>
                    </div>
                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow p-6">
                        <div class="flex items-center justify-start">
                            <button
                                class="bg-gray-900 text-white px-2 py-1 rounded-full text-xs uppercase tracking-wide font-semibold">
                                See Gallery
                            </button>
                        </div>
                    </div>
                </div>
                
                @endforeach

            </div>
        </div>
    </section>


    <!-- Profile Section -->
    <section class="bg-black py-8">
        <div class="container mx-auto flex items-center flex-wrap p-5">
            <div class="w-full md:w-4/6 text-center md:text-left">
                <p class="text-gray-300 text-lg">Sculpture Project</p>
                <h2 class="text-2xl font-bold text-gray-300">Zoontropía / Zoontropy</h2>
                <p class="text-white">
                    Here, you will find a stunning collection of photos featuring exquisite body art that combines the
                    beauty of the human form
                    with the creativity of <b>sculptural design</b>. Giovanni Zitro has used their talents to transform
                    their subjects into living
                    <b>works of art</b>, capturing the essence of animal movement and emotion in each piece. From whimsical
                    creatures to intricate
                    geometric patterns, each <b>bodypainting sculpture</b> tells a unique story and invites you to explore
                    the endless possibilities
                    of this art form. So sit back, relax, and allow yourself to be transported to a world where the human
                    body is the canvas and
                    imagination knows no bounds.
                    <br>
                    <br>
                    <a href="https://www.giovannizitro.com" title="Join to Zoontropy Gallery"
                        class="bg-white text-black px-2 py-1 rounded-full text-xs uppercase tracking-wide font-semibold">
                        Join to Zoontropy
                    </a>
                </p>
            </div>
            <div class="w-full md:w-2/6">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8234443054515429"
                    crossorigin="anonymous"></script>
                <!-- todots_box-sec_AdSense1_1x1_as -->
                <ins class="adsbygoogle"
                    style="display:block"
                    data-ad-client="ca-pub-8234443054515429"
                    data-ad-slot="4058542850"
                    data-ad-format="auto"
                    data-full-width-responsive="true"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>
    </section>


@endsection
