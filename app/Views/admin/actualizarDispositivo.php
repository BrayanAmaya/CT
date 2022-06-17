<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Actualizar CT
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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

        <h1 class="title">Actualizar dispositivo</h1>
        <h2 class="subtitle">
            Modifique los datos del dispositivo que desea actualizar.
        </h2>
        <form class="border p-3 form "
            action="<?=base_url('admin/actualizarDispositivo')?>?id=<?= password_hash($mostrar->idDispositivo,PASSWORD_DEFAULT)?>"
            method="POST">
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label class="label">Nombre del dispositivo</label>
                    <div class="control">
                        <input name='nombreDispositivo'
                            value='<?php if(old('nombreDispositivo') != null): ?><?=old('nombreDispositivo')?><?php else: ?><?= $mostrar->nombreDispositivo ?><?php endif; ?>'
                            class="input" type="text" placeholder="">
                    </div>
                    <p class="is-danger help"><?=session('errors.nombreDispositivo')?></p>
                </div>

                <div class="form-group col-md-5">
                    <label class="label">Número de serie</label>
                    <div class="control">
                        <input name='numeroDeSerie'
                            value='<?php if(old('numeroDeSerie') != null): ?><?=old('numeroDeSerie')?><?php else: ?><?= $mostrar->numeroDeSerie ?><?php endif; ?>'
                            class="input" type="text" placeholder="">
                    </div>
                    <p class="is-danger help"><?=session('errors.numeroDeSerie')?></p>
                </div>

                <div class="form-group col-md-3">
                    <label class="label">Estado del dispositivo</label>
                    <div class="control select is-link">
                        <select name='estado'>
                            <?php if(old('estado')!=null):?>
                            <option value="1" <?php if(old('estado') == 1): ?>selected<?php endif;?>>
                                Activo</option>
                            <option value="0" <?php if(old('estado') == 0): ?>selected<?php endif;?>>
                                No activo</option>
                            <?php else:?>
                            <option value="1" <?php if($mostrar->estado == 1): ?>selected<?php endif;?>>
                                Activo</option>
                            <option value="0" <?php if($mostrar->estado == 0): ?>selected<?php endif;?>>
                                No activo</option>
                            <?php endif;?>
                        </select>
                    </div>
                    <p class="is-danger help"><?=session('errors.estado')?></p>
                </div>


                <div class="form-group col-md-4">
                    <label class="label">Selecciona un tipo de dispositivo</label>
                    <div class="control select is-link">
                        <select name='Td'>
                            <?php if(old('Td')!=null):?>
                            <?php foreach ($Td as $key): ?>
                            <?php //if(!in_array($key->idTipoDispositivo,$ct)):?>
                            <option value="<?=password_hash($key->idTipoDispositivo,PASSWORD_DEFAULT)?>"
                                <?php if(password_verify($key->idTipoDispositivo, old('Td'))): ?>selected
                                <?php endif;?>>
                                <?=$key->dispositivo?></option>
                            <?php //endif;?>
                            <?php endforeach;?>
                            <?php else:?>
                            <?php foreach ($Td as $key): ?>
                            <?php //if(!in_array($key->idTipoDispositivo,$ct)):?>
                            <option value="<?=password_hash($key->idTipoDispositivo,PASSWORD_DEFAULT)?>"
                                <?php if($mostrar->idTipoDispositivo == $key->idTipoDispositivo ): ?>selected
                                <?php endif;?>>
                                <?=$key->dispositivo?></option>
                            <?php //endif;?>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <p class="is-danger help"><?=session('errors.Td')?></p>
                </div>

                <div class="form-group col-md-4">
                    <label class="label">Selecciona un centro de tecnología</label>
                    <div class="control select is-link">
                        <select name='Ct'>
                            <?php if(old('Ct')!=null):?>
                            <?php foreach ($Ct as $key): ?>
                            <?php //if(!in_array($key->idTipoDispositivo,$ct)):?>
                            <option value="<?=password_hash($key->idCt,PASSWORD_DEFAULT)?>"
                                <?php if(password_verify($key->idCt, old('Ct'))): ?>selected <?php endif;?>>
                                <?=$key->nombreCt?></option>
                            <?php //endif;?>
                            <?php endforeach;?>
                            <?php else:?>
                            <option value="">...</option>
                            <?php foreach ($Ct as $key): ?>
                            <?php //if(!in_array($key->idTipoDispositivo,$ct)):?>
                            <option value="<?=password_hash($key->idCt,PASSWORD_DEFAULT)?>"
                                <?php if($mostrar->idCt == $key->idCt ): ?>selected <?php endif;?>>
                                <?=$key->nombreCt?></option>
                            <?php //endif;?>
                            <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                    <p class="is-danger help"><?=session('errors.Ct')?></p>
                </div>


                <div class="form-group col-md-12">
                    <label class="label">Detalle</label>
                    <div class="control">
                        <input name='detalle'
                            value='<?php if(old('detalle') != null): ?><?=old('detalle')?><?php else: ?><?= $mostrar->detalle ?><?php endif; ?>'
                            class="input" type="text" placeholder="Ej: Una breve descripción">
                    </div>
                    <p class="is-danger help"><?=session('errors.detalle')?></p>
                </div>

                <div class="col-md-8 col-md-offset-3">
                    <div class="control">
                        <button class="button is-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?=$this->endSection()?>