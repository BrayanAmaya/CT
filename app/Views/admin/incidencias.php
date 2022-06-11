<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Incidencias
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?=$this->endSection()?>
<?=$this->section('content')?>
<section class="section">
    <?php if(session('msg')):?>
    <article class="message is-<?=session('msg.type')?>">
        <div class="message-body">
            <?=session('msg.body')?>
        </div>
    </article>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <form action="<?=base_url('admin/filtroIncidencia')?>" method="POST">
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="start">Fecha: de</label>
                        <input type="date" id="start" name="fechaInicio" value="<?= date('Y-m-d')?>" min="2018-01-01"
                            max="2022-12-12">
                        <label for="start"> hasta </label>
                        <input type="date" id="start" name="fechaFinal"
                            value="<?= date('Y-m-d',strtotime(date('Y-m-d').'+1 days'))?>" min="2018-01-01"
                            max="2022-12-12">
                    </div>

                    <div class="form-group col-md-2">
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

                    <div class="form-group col-md-2">
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

                    <div class="form-group col-md-2">
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
                    <div class="form-group col-md-2">
                        <div class="control">
                            <button class="button is-info">Filtrar</button>
                        </div>
                    </div>


                    <div class="col-12">
                        <a href="<?=base_url(route_to('addIncidencia'))?>" class="btn btn-primary"> <span
                                class="icon"><i class="fas fa-plus" aria-hidden="true"></i></span>
                            Nueva Incidencia
                        </a>
                    </div>
            </form>
            <?php foreach($incidencias as $key):?>

            <br>
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
                                <p class="subtitle is-6">@<?=$key->mostrarUsuario($key->idUsuario)?> - <?=$key->nivel?>
                                </p>
                            </div>
                            <div class="content">
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
    <div class="modal fade" id="Modal<?=$key->idIncidencia?>" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="title">Incidencia</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-row" action="#" method="POST">
                        <?php if(file_exists("C:/laragon/www/ct/public".$key->imagen)): ?>
                        <img src="<?=$key->imagen?>" class="card-img-top">
                        <?php else: ?>
                        <img src="/img/imagesIncidencias/default.jpg" class="card-img-top">
                        <?php endif;?>
                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Quien reporto</label>
                            <h6 class="subtitle is-6 has-text-centered"><?=$key->mostrarUsuario($key->idUsuario)?></h6>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Tipo de inidencia</label>
                            <h6 class="subtitle is-6 has-text-centered">
                                <?=$key->mostrarTipoIncidencia($key->idTipoIncidencia)?></h6>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">De que centro de tecnología es</label>
                            <h6 class="subtitle is-6 has-text-centered"><?=$key->mostrarCt($key->idCt)?></h6>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Nivel</label>
                            <h6 class="subtitle is-6 has-text-centered"><?=$key->nivel?></h6>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Descripción de la incidencia</label>
                            <h6 class="subtitle is-6 has-text-centered"><?=$key->descripcion?></h6>
                        </div>

                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Estado</label>
                            <?php if($key->estado == 1): ?>
                            <h6 class="subtitle is-6 has-text-centered">Pendiente</h6>
                            <?php else: ?>
                            <h6 class="subtitle is-6 has-text-centered">Resuelto</h6>
                            <?php endif;?>
                        </div>


                        <?php if($key->estado == 0): ?>
                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Resuelto por</label>
                            <h6 class="subtitle is-6 has-text-centered"><?=$key->mostrarUsuario($key->idUsuario)?></h6>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Comentario resolución</label>
                            <h6 class="subtitle is-6 has-text-centered"><?=$key->comentarioPor?></h6>
                        </div>
                        <?php endif;?>

                        <div class="form-group col-md-6">
                            <label class="label has-text-centered">Reportada</label>
                            <h6 class="subtitle is-6 has-text-centered"><?=$key->date_create->humanize()?></h6>
                        </div>
                        <?php if($key->estado == 0): ?>
                        <div class="form-group col-md-6">
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