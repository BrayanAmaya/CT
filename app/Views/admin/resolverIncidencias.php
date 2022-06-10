<?= $this->extend('admin/main') ?>

<?= $this->section('title') ?>
Resolver la incidencia
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<section class="section">
    <?php

    use App\Entities\Incidencia;

    if (session('msg')) : ?>
        <article class="message is-<?= session('msg.type') ?>">
            <div class="message-body">
                <?= session('msg.body') ?>
            </div>
        </article>
    <?php endif; ?>

    <div class="container">

        <h1 class="title">Resuelve la incidencia
        </h1>
        <h2 class="subtitle">
            <?= $incidencia->mostrarTipoIncidencia($incidencia->idTipoIncidencia) ?>
        </h2>
        <form class="border p-3 form" action="<?= base_url('admin/resuelveIncidencia') ?>?id=<?= password_hash($incidencia->idIncidencia, PASSWORD_DEFAULT) ?>" method="POST">

            <div class="form-row">
                <div style="text-align: center;" class="form-group col-md-12" >
                <img src="<?= $incidencia->imagen ?>" width="200" height="50">
                </div>

                <div class="form-group col-md-1"></div>
                <label>Reportado por el usuario:</label>
                <div class="form-group col-md-2">
                <label class="label"><?= $incidencia->mostrarUsuario($incidencia->idUsuario) ?></label>
                </div>

                <label>Nivel de incidencia:</label>
                <div class="form-group col-md-2">
                <label class="label"><?= $incidencia->nivel ?></label>
                </div>

                <label>Centro de computo:</label>
                <div class="form-group col-md-2">
                <label class="label"><?= $incidencia->mostrarCt($incidencia->idCt) ?></label>
                </div>

               
                <div  style="text-align: center;" class="form-group col-md-12">
                <label>Descripcion:<label class="label"><?= $incidencia->descripcion ?></label></label>
               
                </div>

                 
                <div class="form-group col-md-12">
                <div class="field">
                    <label class="label">Comenta la resolución:</label>
                    <div class="control">
                        <input name='comentarioPor' value='<?= old('comentarioPor') ?>' class="input" type="text" placeholder="">
                    </div>
                    <p class="is-danger help"><?= session('errors.comentarioPor') ?></p>
                </div>  
                </div>
                           
                <div class="col-md-8 col-md-offset-3">
                    <div class="control">
                        <button class="button is-primary">Resuelve</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>