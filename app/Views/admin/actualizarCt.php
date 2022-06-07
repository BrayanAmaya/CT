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

<?php //dd(old('encargado')); ?>

<section class="section">
    <?php if(session('msg')):?>
    <article class="message is-<?=session('msg.type')?>">
        <div class="message-body">
            <?=session('msg.body')?>
        </div>
    </article>
    <?php endif; ?>

    <div class="container">

        <h1 class="title">Actualizar centro de tecnología</h1>
        <h2 class="subtitle">
            Modifique los datos del CT que desea actualizar.
        </h2>
        <form class="border p-3 form "
            action="<?=base_url('admin/actualizarCt')?>?id=<?= password_hash($mostrar->idCt,PASSWORD_DEFAULT)?>"
            method="POST">
            <div class="field">
                <label class="label">Nombre del centro de tecnología</label>
                <div class="control">
                    <input name='nombreCt'
                        value='<?php if(old('nombreCt') != null): ?><?=old('nombreCt')?><?php else: ?><?= $mostrar->nombreCt ?><?php endif; ?>'
                        class="input" type="text" placeholder="Ej: Melvin Marvin">
                </div>
                <p class="is-danger help"><?=session('errors.nombreCt')?></p>
            </div>


            <div class="field control">
                <label class="label">Selecciona un encargado</label>
                <div class="control select is-link">
                    <select name='encargado'>
                        <?php if(old('encargado')!=null):?>
                        <?php foreach ($usuarios as $key): ?>
                        <?php if(!in_array($key->idUsuario,$ct)):?>
                        <option value="<?=password_hash($key->idUsuario,PASSWORD_DEFAULT)?>"
                            <?php if(password_verify($key->idUsuario, old('encargado'))): ?>selected <?php endif;?>>
                            <?=$key->nombre." ".$key->apellido?></option>
                        <?php endif;?>
                        <?php endforeach;?>
                        <?php else:?>
                        <?php foreach ($usuarios as $key): ?>
                        <?php if(!in_array($key->idUsuario,$ct)):?>
                        <option value="<?=password_hash($key->idUsuario,PASSWORD_DEFAULT)?>"
                            <?php if($mostrar->idUsuario == $key->idUsuario ): ?>selected <?php endif;?>>
                            <?=$key->nombre." ".$key->apellido?></option>
                        <?php endif;?>
                        <?php endforeach;?>
                        <?php endif;?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.encargado')?></p>
            </div>

            <div class="field">
                <label class="label">Descripción</label>
                <div class="control">
                    <textarea class="textarea" name='descripcion' class="input" type="text"
                        placeholder="Una breve descripcion"
                        row="10"><?php if(old('descripcion') != null): ?><?=old('descripcion')?><?php else: ?><?= $mostrar->descripcion ?><?php endif; ?></textarea>
                </div>
                <p class="is-danger help"><?=session('errors.descripcion')?></p>
            </div>

            <div class="col-md-8 col-md-offset-3">
                <div class="control">
                    <button class="button is-primary">Actualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>
<?=$this->endSection()?>