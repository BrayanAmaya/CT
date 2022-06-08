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
            <a href="#" class="btn btn-primary">Filtrar</a>
        </div>
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
                    <img src="<?=$key->imagen?>" class="card-img-top">
                    <div class="card-content">
                        <div class="media-content">
                            <p class="title is-4"><?=$key->mostrarTipoIncidencia($key->idTipoIncidencia)?></p>
                            <p class="subtitle is-6">@<?=$key->mostrarUsuario($key->idUsuario)?> - <?=$key->nivel?></p>
                        </div>
                        <div class="content">
                            <?=$key->descripcion?>
                            <br>
                            <time datetime="2016-1-1"><?=$key->date_create->humanize()?></time>
                            <br><br>
                            <a href="#" class="btn btn-primary">Resolver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <?=$this->endSection()?>