<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Buscar dispositivo
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="">
<?=$this->endSection()?>
<?=$this->section('js')?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
</script>
<?=$this->endSection()?>

<?=$this->section('content')?>
<?php $modelCt = model('CTModel');
    $modelTd = model('TipoDispositivoModel'); ?>
<section class="container"><br><br>
    <?php if(session('msg')):?>
    <article class="message is-<?=session('msg.type')?>">
        <div class="message-body">
            <?=session('msg.body')?>
        </div>
    </article>
    <?php endif; ?>
    <h5>Centro de tecnología</h5>
    <div class="field is-grouped has-text-centered">
        <p class="control">
            <a style=" text-decoration: none;" class="button is-link has-text-black is-boxed"
                href="<?=base_url(route_to('searchDispositivo'))?>?estado=1">
                <span class="has-text-white">Avtivos</span>
            </a>
        </p>
        <p class="control">
            <a style=" text-decoration: none;" class="button is-link has-text-black is-boxed"
                href="<?=base_url(route_to('searchDispositivo'))?>?estado=0">
                <span class="has-text-white">Inactivos</span>
            </a>
        </p>
    </div>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nombre del dispositivo</th>
                <th>Número de serie</th>
                <th>CT</th>
                <th>Tipo dispositivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dispositivos as $key): ?>
            <tr>
                <td>
                    <?= $key->nombreDispositivo ?>
                </td>
                <td>
                    <?=  $key->numeroDeSerie ?>
                </td>
                <td>
                    <?php $ct = $modelCt->find($key->idCt) ?>
                    <?=  $ct->nombreCt ?>
                </td>
                <td>
                    <?php $td = $modelTd->find($key->idTipoDispositivo) ?>
                    <?=  $td->dispositivo ?>
                </td>
                <td>
                    <a style=" text-decoration: none;"
                        href="<?=base_url(route_to('updateDispositivo'))?>?id=<?= password_hash($key->idDispositivo,PASSWORD_DEFAULT)?>">
                        <span class="icon has-text-warning"><i class="fas fa-sync" aria-hidden="true"></i></span>
                    </a>
                    <?php if($key->estado == 1): ?>
                    <a style=" text-decoration: none;"
                        href="<?=base_url(route_to('deleteDispositivo'))?>?estado=0&id=<?= password_hash($key->idDispositivo,PASSWORD_DEFAULT)?>">
                        <span class="icon has-text-danger"><i class="fas fa-eraser" aria-hidden="true"></i></span>
                    </a>
                    <?php else: ?>
                    <a style=" text-decoration: none;"
                        href="<?=base_url(route_to('backDispositivo'))?>?estado=1&id=<?= password_hash($key->idDispositivo,PASSWORD_DEFAULT)?>">
                        <span class="icon has-text-success"><i class="fas fa-file-upload" aria-hidden="true"></i></span>
                    </a>
                    <?php endif; ?>

                </td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</section>

<?=$this->endSection()?>