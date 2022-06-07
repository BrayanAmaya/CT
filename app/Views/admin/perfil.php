<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Perfil
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
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
    <h1 class="title">Perfil</h1>
    <!--<h2 class="subtitle">
        Mis datos personales.
    </h2>-->
    <form action="#" method="POST">
        <div class="field">
            <label class="label has-text-centered">Nombre</label>
            <h6 class="subtitle is-6 has-text-centered"><?=$usuario->nombre?></h6>
        </div>

        <div class="field">
            <label class="label has-text-centered">Apellido</label>
            <h6 class="subtitle is-6 has-text-centered"><?=$usuario->apellido?></h6>
        </div>

        <div class="field">
            <label class="label has-text-centered">Usuario</label>
            <h6 class="subtitle is-6 has-text-centered"><?=$usuario->usuario?></h6>
        </div>

        <div class="field">
            <label class="label has-text-centered">Correo electronico</label>
            <h6 class="subtitle is-6 has-text-centered"><?=$usuario->email?></h6>
        </div>

        <div class="field">
            <label class="label has-text-centered">Número de telefono</label>
            <h6 class="subtitle is-6 has-text-centered"><?=$usuario->telefono?></h6>
        </div>

        <div class="field">
            <label class="label has-text-centered">Número de DUI</label>
            <h6 class="subtitle is-6 has-text-centered"><?=$usuario->dui?></h6>
        </div>
    </form>
</section>
<?=$this->endSection()?>