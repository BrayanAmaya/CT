<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Registrar usuario
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

        <h1 class="title">Registrar un nuevo usuario</h1>
        <h2 class="subtitle">
            Llena los siguientes datos para agregar un nuevo usuario.
        </h2>
        <form class="border p-3 form" action="<?=base_url('admin/registrar')?>" method="POST">
            <div class=" form-row ">
                <div class="form-group col-md-4">
                    <label class="label">Nombres</label>
                    <div class="control">
                        <input name='nombre' value='<?=old('nombre')?>' class="form-control" type="text"
                            placeholder="Ej: Melvin Marvin">
                    </div>
                    <p class="is-danger help"><?=session('errors.nombre')?></p>
                </div>

                <div class="form-group col-md-4">
                    <label class="label">Apellidos</label>
                    <div class="control">
                        <input name='apellido' value='<?=old('apellido')?>' class="form-control" type="text"
                            placeholder="Ej: Quintanilla Saldivar">
                    </div>
                    <p class="is-danger help"><?=session('errors.apellido')?></p>
                </div>

                <div class="form-group col-md-4">
                    <label class="label">Correo Electronico</label>
                    <div class="control has-icons-left has-icons-right">
                        <input name='email' value='<?=old('email')?>' class="form-control" type=""
                            placeholder="email@gmail.com" value="">
                    </div>
                    <p class="is-danger help"><?=session('errors.email')?></p>
                </div>

                <div class="col-3">
                    <label class="label">Número de telefono</label>
                    <div class="control">
                        <input name='telefono' value='<?=old('telefono')?>' class="input" type="text"
                            placeholder="75757575">
                    </div>
                    <p class="is-danger help"><?=session('errors.telefono')?></p>
                </div>

                <div class="col-md-4 col-md-offset-3">
                    <label class="label">Número de DUI</label>
                    <div class="control">
                        <input name='dui' value='<?=old('dui')?>' class="input" type="text" placeholder="000000000">
                    </div>
                    <p class="is-danger help"><?=session('errors.dui')?></p>
                </div>
                <br><br>
                <div class="col-6">
                    <label class="label">Contraseña</label>
                    <div class="control">
                        <input name='password' class="input" type="password" placeholder="Contraseña">
                    </div>
                    <p class="is-danger help"><?=session('errors.password')?></p>
                </div>

                <div class="col-md-5 col-md-offset-4">
                    <label class="label">Repetir contraseña</label>
                    <div class="control">
                        <input name='c-password' class="input" type="password" placeholder="Repite contraseña">
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-3">
                    <div class="control">
                        <button class="button is-primary">Registrar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?=$this->endSection()?>

sc