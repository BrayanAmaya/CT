<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Buscar CT
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
<?php $modelUsuario = model('UsuarioModel'); ?>
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
            <a class="button is-link has-text-black is-boxed" href="<?=base_url(route_to('searchCt'))?>?estado=1">
                <span class="has-text-white">Avtivos</span>
            </a>
        </p>
        <p class="control">
            <a class="button is-link has-text-black is-boxed" href="<?=base_url(route_to('searchCt'))?>?estado=0">
                <span class="has-text-white">Inactivos</span>
            </a>
        </p>
    </div>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Nombre del CT</th>
                <th>Encargado</th>
                <th>Acciones</th>
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
                <td>
                    <a href="<?=base_url(route_to('updateCt'))?>?id=<?= password_hash($key->idCt,PASSWORD_DEFAULT)?>">
                        <span class="icon has-text-warning"><i class="fas fa-sync" aria-hidden="true"></i></span>
                    </a>
                    <?php if($key->estado == 1): ?>
                    <a
                        href="<?=base_url(route_to('deleteCt'))?>?estado=0&id=<?= password_hash($key->idCt,PASSWORD_DEFAULT)?>">
                        <span class="icon has-text-danger"><i class="fas fa-eraser" aria-hidden="true"></i></span>
                    </a>
                    <?php else: ?>
                    <a
                        href="<?=base_url(route_to('backCt'))?>?estado=1&id=<?= password_hash($key->idCt,PASSWORD_DEFAULT)?>">
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