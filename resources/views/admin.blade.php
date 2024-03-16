<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        
        <input type="text" name="" id="titulo" style="width: 100%">

        <textarea required="required" class="ckeditor" style="width: 100%" name="texto" id="texto" rows="13"></textarea>

        <div id="salida"></div>

        <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
        crossorigin="anonymous"></script>

        <script src="https://virtual.instel.edu.co/js/ckeditor/ckeditor.js"></script>


        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>

        <script>
            function crearUrlAmigable(texto) {
                return texto
                    .toLowerCase() // Convertir a minúsculas
                    .replace(/[^\w\s]/g, '') // Eliminar caracteres especiales
                    .replace(/\s+/g, '-') // Reemplazar espacios con guiones
                    .replace(/-+/g, '-') // Reemplazar múltiples guiones con uno solo
                    .replace(/'/g, '´') // Reemplazar comillas simples por tilde invertida
                    .trim(); // Eliminar espacios en blanco al principio y al final
            }
            $('#titulo').change(function(){
                var lt = crearUrlAmigable($(this).val());
                $('#salida').text("INSERT INTO fotos VALUES(NULL, 'blog', '" + lt + "', 'tags', '" + $(this).val() + "', '" + CKEDITOR.instances.texto.getData() + "', NULL, NULL, NULL)");
            })
        </script>
    </body>
</html>
