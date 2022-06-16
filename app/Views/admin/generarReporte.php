<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Reporte&nbsp;-&nbsp;Digi Tech</title>
</head>

<body>
    <h1>Reporte</h1>
    <table border="1" style="width:100%">
        <thead>
            <tr>
                <th>Tipo de incidencia</th>
                <th>Quien reporto</th>
                <th>En que CT</th>
                <th>Nivel</th>
                <th>Estado</th>
                <th>Resuelto por</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($incidencias as $key): ?>
            <tr>
                <td>
                    <?= $key->mostrarTipoIncidencia($key->idTipoIncidencia) ?>
                </td>
                <td>
                    <?= $key->mostrarUsuario($key->idUsuario) ?>
                </td>
                <td>
                    <?= $key->mostrarCt($key->idCt) ?>
                </td>
                <td>
                    <?= $key->nivel ?>
                </td>
                <td>
                    <?php if($key->estado == 1): ?>
                    Pendiente
                    <?php else:?>
                    Resuelta
                    <?php endif;?>
                </td>
                <td>
                    <?php if($key->resueltoPor != null): ?>
                    <?= $key->mostrarUsuario($key->resueltoPor)?>
                    <?php else:?>
                    Aun no
                    <?php endif;?>
                </td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</body>

</html>

</html>