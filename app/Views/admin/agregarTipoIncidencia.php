<?= $this->extend('admin/main') ?>

<?= $this->section('title') ?>
Agregar tipo incidencia
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<section class="container">
    <?php if (session('msg')) : ?>
        <article class="message is-<?= session('msg.type') ?>">
            <div class="message-body">
                <?= session('msg.body') ?>
            </div>
        </article>
    <?php endif; ?>
    <h1 class="title">Agregar un tipo de incidencia</h1>
    <h2 class="subtitle">
        Llena los siguientes datos para agregar un nuevo tipo de incidencia.
    </h2>
    <form class="border p-3 form" action="<?= base_url('admin/addTipoIncidencias') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="label">Tipo de incidencia</label>
                <div class="control">
                    <input name='tipoIncidencia' value='<?= old('tipoIncidencia') ?>' class="input" type="text" placeholder="">
                </div>
                <p class="is-danger help"><?= session('errors.tipoIncidencia') ?></p>
            </div>

            <div class="form-group col-md-12">
                <div class="field is-grouped">
                    <div class="control">
                        <button class="button is-primary">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</section>

<?= $this->endSection() ?>