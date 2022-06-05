<?=$this->extend('auth/main')?>

<?=$this->section('title')?>
Login
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="/assets/css/style.css">
<?=$this->endSection()?>
<?=$this->section('content')?>

<section class="section">
    <div class="vh-100 row m-0 text-center align-items-center justify-content-center">
        <form class="border p-3 form " action="<?=base_url(route_to('signin'))?>" method="POST">
            <?php if(session('msg')):?>
            <article class="message is-<?=session('msg.type')?>">
                <div class="message-body">
                    <?= session('msg.body')?>
                </div>
            </article>
            <?php endif; ?>
            <h1 class="title">Login</h1>
            <h2 class="subtitle">Inicia sesión, antes de empezar.</h2>
            <div class="col-auto">
                <p class="control has-icons-left has-icons-right">
                    <input class="input" name="usuario" value='<?=old('usuario')?>' type="" placeholder="Usuario">
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </p>
                <p class="is-danger help"><?=session('errors.email')?></p>
            </div>
            <div class="col-auto">
                <p class="control has-icons-left">
                    <input class="input" name="password" type="password" placeholder="Contraseña">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
                <p class="is-danger help"><?=session('errors.password')?></p>
            </div>
            <div class="form-row justify-content-center">
                <p class="control">
                    <input type="submit" class="button is-link" value="Ingresar">
                </p>
            </div>
        </form>
    </div>
</section>
<?=$this->endSection()?>