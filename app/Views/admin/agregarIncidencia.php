<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Agregar incidencia
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?=$this->endSection()?>
<?=$this->section('content')?>
<?php if(session('msg')):?>
<article class="message is-<?=session('msg.type')?>">
    <div class="message-body">
        <?=session('msg.body')?>
    </div>
</article>
<?php endif;?>
<section class="container">
    <h1 class="title">Reporta una incidencia</h1>
    <h2 class="subtitle">
        Llena los siguientes datos para reportar una incidencia.
    </h2>
    <form class="border p-3 form" action="<?=base_url('admin/reportar-incidencia')?>" method="POST"
        enctype="multipart/form-data">

        <div class="form-row">
            <div class="form-group col-md-5">
                <label class="label">¿Qué tipo de incidencia es?</label>
                <div class="control select is-link">
                    <select name='incidencia'>
                        <option value="">...</option>
                        <?php foreach ($incidencia as $key): ?>
                        <option value="<?=password_hash($key->idTipoIncidencia,PASSWORD_DEFAULT)?>">
                            <?=$key->incidencia?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.incidencia')?></p>
            </div>

            <div class="form-group col-md-4">
                <label class="label">¿En dondé es?</label>
                <div class="control select is-link">
                    <select name='ct'>
                        <option value="">...</option>
                        <?php foreach ($ct as $key): ?>
                        <option value="<?=password_hash($key->idCt,PASSWORD_DEFAULT)?>">
                            <?=$key->nombreCt?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.ct')?></p>
            </div>

            <div class="form-group col-md-3">
                <div class="file has-name is-boxed">
                    <label class="file-label">
                        <input class="file-input" type="file" name="imagen" id="seleccionArchivos">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fas fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Subir imagen…
                            </span>
                        </span>
                        <img style="border: none;" width="210" height="50" id="imagenPrevisualizacion">
                        <p class="is-danger help"><?=session('errorImg.imagen')?></p>
                    </label>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label class="label">¿Cuál es la incidencia?</label>
                <div class="control">
                    <input name='descripcion' value='<?=old('descripcion')?>' class="input" type="text"
                        placeholder="Una breve descripción">
                </div>
                <p class="is-danger help"><?=session('errors.descripcion')?></p>
            </div>

            <div class="field is-grouped">
                <div class="control">
                    <button class="button is-primary">Reportar</button>
                </div>
            </div>
        </div>
    </form>
</section>

<?=$this->endSection()?>