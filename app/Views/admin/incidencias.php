<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Incidencias
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?=$this->endSection()?>
<?=$this->section('content')?>
<?php if(session('msg')):?>
<article class="message is-<?=session('msg.type')?>">
    <div class="message-body">
        <?=session('msg.body')?>
    </div>
</article>
<?php endif; ?>
<br>
<div class="container">

    <div class="row">
        <div class="col-10">
            <form action="<?=base_url('admin/filtroIncidencia')?>" method="POST">
                <label for="start">Fecha: de</label>

                <input type="date" id="start" name="fechaInicio" value="<?= date('Y-m-d')?>" min="2018-01-01"
                    max="2022-12-12">
                <label for="start"> hasta </label>
                <input type="date" id="start" name="fechaFinal"
                    value="<?= date('Y-m-d',strtotime(date('Y-m-d').'+1 days'))?>" min="2018-01-01" max="2022-12-12">
                <div class="field control">
                    <label class="label">Estado: </label>
                    <div class="control select is-link">
                        <select name='filtroEstado'>
                            <option value="all" selected>Ambos</option>
                            <option value="1">Pendientes</option>
                            <option value="0">Resueltas</option>
                        </select>
                    </div>
                    <p class="is-danger help"><?=session('errors.filtroEstado')?></p>
                </div>
                <div class="field control">
                    <label class="label">Usuarios: </label>
                    <div class="control select is-link">
                        <select name='filtroUsuario'>
                            <?php if(old('filtroUsuario')!=null):?>
                            <option value="all" selected>Todos</option>
                            <?php foreach($usuarios as $key): ?>
                            <option value="<?=password_hash($key->idUsuario,PASSWORD_DEFAULT)?>"
                                <?php if(password_verify($key->idUsuario, old('filtroUsuario'))):?>selected
                                <?php endif;?>>
                                <?=$key->usuario?>
                            </option>
                            <?php endforeach;?>
                            <?php else: ?>
                            <option value="all" selected>Todos</option>
                            <?php foreach($usuarios as $key): ?>
                            <option value="<?=password_hash($key->idUsuario,PASSWORD_DEFAULT)?>"><?=$key->usuario?>
                            </option>
                            <?php endforeach;?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <p class="is-danger help"><?=session('errors.filtroUsuario')?></p>
                </div>

                <div class="field control">
                    <label class="label">Tipo de incidencia: </label>
                    <div class="control select is-link">
                        <select name='filtroTipoIncidencia'>
                            <option value="all" selected>Todas</option>
                            <?php foreach($tipoIncidencia as $key): ?>
                            <option value="<?=password_hash($key->idTipoIncidencia,PASSWORD_DEFAULT)?>">
                                <?=$key->incidencia?>
                            </option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <p class="is-danger help"><?=session('errors.filtroTipoIncidencia')?></p>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-info">Filtrar</button>
                    </div>
                </div>
        </div>
        </form>
        <div class="col-2">
            <a href="<?=base_url(route_to('addIncidencia'))?>" class="btn btn-primary"> <span class="icon"><i
                        class="fas fa-plus" aria-hidden="true"></i></span>
                Nueva Incidencia
            </a>
        </div><br><br>
        <?php foreach($incidencias as $key):?>
        <div class="col-3">
            <div class="card">
                <div class="card" style="width: 22rem;">
                    <?php if(file_exists("C:/laragon/www/ct/public".$key->imagen)): ?>
                    <img src="<?=$key->imagen?>" class="card-img-top">
                    <?php else: ?>
                    <img src="/img/imagesIncidencias/default.jpg" class="card-img-top">
                    <?php endif;?>
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-4"><?=$key->mostrarTipoIncidencia($key->idTipoIncidencia)?></p>
                            <p class="subtitle is-6">@<?=$key->mostrarUsuario($key->idUsuario)?> - <?=$key->nivel?></p>
                        </div>
                        <div class="content">
                            <?=$key->descripcion?>
                            <br>
                            <time datetime="2016-1-1"><?=$key->date_create->humanize()?></time>
                            <br>
                            <?php if($key->estado == 0): ?>
                            <p>Resuelto por <?=$key->mostrarUsuario($key->resueltoPor)?> <time
                                    datetime="2016-1-1"><?=$key->date_update->humanize()?></time></p>
                            <?php endif;?>
                            <?php if($key->estado == 1): ?>
                            <a href="<?=base_url(route_to('viewIncidencia'))?>?id=<?=password_hash($key->idIncidencia,PASSWORD_DEFAULT)?>"
                                class="btn btn-primary">Resolver</a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?=$this->endSection()?>