<section class="bg-black py-8">
    <h2 class="text-2xl font-bold text-gray-300 text-center">BodyPainting Magazine</h2>
    <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
    <div class="flex flex-wrap mx-2 p-5">

        @foreach ($lastBlg as $item)
        @if ($loop->iteration == 5)
        <div class="w-full lg:w-1/3 md:w-1/2 p-6 flex flex-col">
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
            
        @endif
        <a href="/blog-bodypaint/{{ $item->clave }}" title="{{ $item->nombre }}" class="w-full lg:w-1/3 md:w-1/2 p-6 flex flex-col">
            <img class="w-full" src="{{ asset('img/blog/'.$item->clave.'.jpg') }}" alt="{{ $item->nombre }}">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2" style="color: white">{{ $item->nombre}}</div>
                <p class="text-white text-base">
                    {{ implode(' ', array_slice(str_word_count(strip_tags($item->text), 1), 0, 30)) }}... [Read Article]
                </p>
            </div>
            <div class="px-6 pt-4 pb-2">
                @foreach (explode(',', $item->colores) as $metaTags)
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#{{ $metaTags }}</span>
                @endforeach
            </div>
        </a>
        @endforeach
    </div>
</div>
</section>