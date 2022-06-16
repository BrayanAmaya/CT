<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Reporte&nbsp;-&nbsp;Digi Tech</title>
</head>

<body>
    <?php $Date = date('d-m-Y');
          $Time = date('h:i:s');
    ?>  
    <h5>
        <img src="assets/img/DigiTechLogo.png" width="170" height="50">
        <br> 
        Usuario:<?= session('usuario'); ?>
        <br>
        Fecha:<?php echo $Date;?>
        <br>
        Hora:<?php echo $Time;?>
        <br>
        San Miguel, San Miguel
    </h5>
    <h1 style="text-align: center;">Reporte de incidencias</h1>
    <h2 style="text-align: center;">DigiTech</h2>

 <h4> 
 Fecha de reporte de:04/06/2022 Hasta:05/06/2022, Estados de la incidencia: Pendientes, Tipo de incidencia: daño de equipo  
</h4>   
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
            <?php foreach ($incidencias as $key) : ?>
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
                        <?php if ($key->estado == 1) : ?>
                            Pendiente
                        <?php else : ?>
                            Resuelta
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($key->resueltoPor != null) : ?>
                            <?= $key->mostrarUsuario($key->resueltoPor) ?>
                        <?php else : ?>
                            Aun no
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</body>

</html>

</html>