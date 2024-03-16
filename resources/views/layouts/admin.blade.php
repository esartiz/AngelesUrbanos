@php
    $categoriasBD = ['cosplay', 'women', 'guys', 'creative', 'neon', 'advertising', 'soccer', 'animals', 'bellypainting', 'clothes'];
    $menu = [['Inicio', '/admin'], ['Photos', '/adm_gallery'], ['Productos' , '/adm_prods'], ['Clientes', '/adm_clts']];
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" />
    <link rel="stylesheet" href="{{ asset('css/bodypainting.css') }}">

    <title>ADMINISTRADOR</title>

</head>

<body class="bg-gray-100 flex flex-col h-screen justify-between">

    <nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
        <div class="container px-6 mx-auto lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center justify-between flex-grow">
                    <div class="flex-shrink-0">
                        <a href="/"><img src="{{ asset('/images/bodypainting-logo.png') }}" style="height:35px" alt="BodyPanting Angeles Urbanos Maquillaje Corporal"></a>
                    </div>
                    <div class="hidden lg:block">
                        <div class="flex items-center">
                            @foreach ($menu as $item)
                            <a href="{{ $item[1] }}" class="flex flex-row items-center px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-md focus:outline-none focus:text-white focus:bg-gray-700">
                                <span class="ml-2">{{ $item[0] }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </nav>
    <h1 class="bodypainting_photos">Body Painting Photos Models Pics Pintura Corporal</h1>

    @if(session('message'))
    <div class="bg-{{ session('message')[0] }}-100 border-t-4 border-{{ session('message')[0] }}-500 rounded-b text-blue-900 px-4 py-3 shadow-md text-center" role="alert">
        {!! session('message')[1] !!}
    </div>
    @endif

    @yield('content')

    <!-- TODO MODAL -->
    <div class="modal hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex">
        <div class="modal-content bg-white h-auto m-auto p-6 rounded-lg w-full">
          <span class="close-modal absolute top-0 right-0 p-4 cursor-pointer">X</span>
          <p class="mb-4 modal-body">Modal content goes here.</p>
        </div>
    </div>
      

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
      
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript" src="https://checkout.epayco.co/checkout.js"></script>
    <script src="{{ asset('js/dt.js') }}"></script>
    <script src="{{ asset('js/bodypainting.js') }}"></script>
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    
    <script>
        $('.search-input').on('keyup', function() {
            filtrame(this)
        });

        function filtrame(dd){
            console.log($(dd).val())
            var searchText = $(dd).val().toLowerCase();
            $('.cardBodyPaint').each(function() {
                var cardText = $(this).text().toLowerCase();
                if (cardText.indexOf(searchText) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }

        function abrirModal(dt) {
            $('.modal-body').load(dt, function() {
                CKEDITOR.replace('texto', {
                    height: 450 // Altura en píxeles
                });
            });
            $('.modal').removeClass('hidden');
        }
        $('.close-modal').click(function() {
            $('.modal').addClass('hidden');
        });
        $(document).keydown(function(event) {
            if (event.key === "Escape") {
                $('.modal').addClass('hidden');
            }
        });

    </script>
</body>

</html>
