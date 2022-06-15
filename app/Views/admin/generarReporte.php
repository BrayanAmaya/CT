<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Reporte&nbsp;-&nbsp;Digi Tech</title>
</head>
<?php $modelUsuario = model('UsuarioModel');?>

<body>
    <h5>Reporte</h5>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nombre del CT</th>
                <th>Encargado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cts as $key): ?>
            <tr>
                <td>
                    <?= $key->nombreCt ?>
                </td>
                <td>
                    <?php $usuario = $modelUsuario->find($key->idUsuario) ?>
                    <?=  $usuario->usuario ?>
                </td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</body>

</html>