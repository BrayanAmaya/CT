<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Filtrar Incidencia
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?=$this->endSection()?>
<?=$this->section('content')?>
<?php if(session('msg')):?>
<section class="container">
    <article class="message is-<?=session('msg.type')?>">
        <div class="message-body">
            <?=session('msg.body')?>
        </div>
    </article>
    <?php endif; ?>
    <br>
    <div class="container">
        <div class="row">
                <?php foreach($incidencias as $key):?>
                <div class="col-3"><br>
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
                                    <p class="subtitle is-6">@<?=$key->mostrarUsuario($key->idUsuario)?> -
                                        <?=$key->nivel?>
                                    </p>
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
                                        class="btn btn-primary">Resolver    </a>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <?php endforeach; ?>
                </div>
            </div>
</section>
<?=$this->endSection()?>