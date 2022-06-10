<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title><?=$this->renderSection('title')?>&nbsp;-&nbsp;Digi Tech</title>
    <?=$this->renderSection('css')?>
    <?=$this->renderSection('js')?>
</head>

<body>
    <?=$this->include('admin/layout/header')?>
    <?=$this->renderSection('content')?>
    <?=$this->include('admin/layout/footer')?>
    <?=$this->renderSection('js')?>
    <script>
    const $seleccionArchivos = document.querySelector("#seleccionArchivos"),
        $imagenPrevisualizacion = document.querySelector("#imagenPrevisualizacion");

    // Escuchar cuando cambie
    $seleccionArchivos.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $seleccionArchivos.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPrevisualizacion.src = objectURL;
    })
    </script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
        })
    })
    </script>
</body>

</html>