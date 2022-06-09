<?= $this->extend('user/main') ?>

<?= $this->section('title') ?>
Mis Incidencias
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="/assets/css/style.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
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
                <h4>Tus incidencias reportadas</h4>
            </div>
            <div class="col-2">
                <a href="<?=base_url(route_to('addIncidenciaUser'))?>" class="btn btn-primary"> <span class="icon"><i
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
                                <p class="subtitle is-6">@<?=$key->mostrarUsuario($key->idUsuario)?> - <?=$key->nivel?>
                                </p>
                            </div>
                            <div class="content">
                                <?=$key->descripcion?>
                                <br>
                                <time datetime="2016-1-1"><?=$key->date_create->humanize()?></time>
                                <br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
</section>


<?= $this->endSection() ?>