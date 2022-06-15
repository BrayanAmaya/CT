<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Reportes
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
    <h1 class="title">Generar reporte</h1>
    <h2 class="subtitle">
        Seleccione y genere el reporte.
    </h2>
    <form class="border p-3 form" action="<?=base_url('admin/generar-report')?>" method="POST"
        enctype="multipart/form-data">

        <div class="field is-grouped">
            <div class="control">
                <button class="button is-primary">Generar</button>
            </div>
        </div>
        </div>
    </form>
</section>
<?=$this->endSection()?>