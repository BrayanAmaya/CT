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

            <form action="<?=base_url('admin/filtro-incidencia')?>" method="POST">
                <div class="form-row">



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
                                        <p class="title is-4"><?=$key->mostrarTipoIncidencia($key->idTipoIncidencia)?>
                                        </p>
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
                                            class="btn btn-primary">Resolver </a>
                                        <?php endif;?>
                                        <a href="#Modal<?=$key->idIncidencia?>" data-toggle="modal"
                                            class="btn btn-primary">Ver</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>
                </div>
        </div>

        <?php foreach($incidencias as $key): ?>
        <div class="modal bd-example-modal-lg" id="Modal<?=$key->idIncidencia?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="title"><?=$key->mostrarTipoIncidencia($key->idTipoIncidencia)?></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-row" action="#" method="POST">
                            <div class="form-group col-md-12">
                                <?php if(file_exists("C:/laragon/www/ct/public".$key->imagen)): ?>
                                <img class="mx-auto d-block" src="<?=$key->imagen?>">
                                <?php else: ?>
                                <img class="mx-auto d-block" src="/img/imagesIncidencias/default.jpg">
                                <?php endif;?>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Quien reporto</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->mostrarUsuario($key->idUsuario)?>
                                </h6>
                            </div>


                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Tipo de inidencia</label>
                                <h6 class="subtitle is-6 has-text-centered">
                                    <?=$key->mostrarTipoIncidencia($key->idTipoIncidencia)?></h6>
                            </div>

                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Nivel</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->nivel?></h6>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="label has-text-centered">De que centro de tecnología es</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->mostrarCt($key->idCt)?></h6>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="label has-text-centered">Estado</label>
                                <?php if($key->estado == 1): ?>
                                <h6 class="subtitle is-6 has-text-centered">Pendiente</h6>
                                <?php else: ?>
                                <h6 class="subtitle is-6 has-text-centered">Resuelto</h6>
                                <?php endif;?>
                            </div>


                            <div class="form-group col-md-6">
                                <label class="label has-text-centered">Descripción de la incidencia</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->descripcion?></h6>
                            </div>


                            <?php if($key->estado == 0): ?>
                            <div class="form-group col-md-6">
                                <label class="label has-text-centered">Comentario resolución</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->comentarioPor?></h6>
                            </div>


                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Resuelto por</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->mostrarUsuario($key->idUsuario)?>
                                </h6>
                            </div>
                            <?php endif;?>


                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Reportada</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->date_create->humanize()?></h6>
                            </div>


                            <?php if($key->estado == 0): ?>
                            <div class="form-group col-md-4">
                                <label class="label has-text-centered">Resuelta</label>
                                <h6 class="subtitle is-6 has-text-centered"><?=$key->date_update->humanize()?></h6>
                            </div>
                            <?php endif; ?>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
        </script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
        </script>
</section>
<?=$this->endSection()?>