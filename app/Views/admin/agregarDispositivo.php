<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Agregar dispositivo
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?=$this->endSection()?>
<?=$this->section('content')?>

<section class="container">
    <?php if(session('msg')):?>
    <article class="message is-<?=session('msg.type')?>">
        <div class="message-body">
            <?=session('msg.body')?>
        </div>
    </article>
    <?php endif;?>
    <h1 class="title">Agregar dispositivos</h1>
    <h2 class="subtitle">
        Llena los siguientes datos para agregar un nuevo dispositivo.
    </h2>
    <form class="border p-3 form" action="<?=base_url('admin/addDispositivos')?>" method="POST"
        enctype="multipart/form-data">
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="label">Nombre del dispositivo</label>
                <div class="control">
                    <input name='nombreDispositivo' value='<?=old('nombreDispositivo')?>' class="input" type="text"
                        placeholder="">
                </div>
                <p class="is-danger help"><?=session('errors.nombreDispositivo')?></p>
            </div>

            <div class="form-group col-md-4">
                <label class="label">Número de serie</label>
                <div class="control">
                    <input name='numeroDeSerie' value='<?=old('numeroDeSerie')?>' class="input" type="text"
                        placeholder="">
                </div>
                <p class="is-danger help"><?=session('errors.numeroDeSerie')?></p>
            </div>

            <div class="form-group col-md-4">
                <label class="label">Detalle</label>
                <div class="control">
                    <input name='detalle' value='<?=old('detalle')?>' class="input" type="text" placeholder="">
                </div>
                <p class="is-danger help"><?=session('errors.detalle')?></p>
            </div>

            <div class="form-group col-md-2">
                <label class="label">Tipo de dispositivo</label>
                <div class="control select is-link">
                    <select name='td'>
                        <option value="">...</option>
                        <?php foreach ($td as $key): ?>
                        <option value="<?=password_hash($key->idTipoDispositivo,PASSWORD_DEFAULT)?>"
                            <?php if(password_verify($key->idTipoDispositivo,old('td'))): ?> selected<?php endif;?>>
                            <?=$key->dispositivo?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.td')?></p>
            </div>

            <div class="form-group col-md-2">
                <label class="label">Centro de tecnología</label>
                <div class="control select is-link">
                    <select name='ct'>
                        <option value="">...</option>
                        <?php foreach ($ct as $key): ?>
                        <option value="<?=password_hash($key->idCt,PASSWORD_DEFAULT)?>"
                            <?php if(password_verify($key->idCt,old('ct'))): ?>selected <?php endif;?>>
                            <?=$key->nombreCt?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.ct')?></p>
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
</section>

<?=$this->endSection()?>