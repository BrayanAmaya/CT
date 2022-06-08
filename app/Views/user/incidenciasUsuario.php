<?= $this->extend('user/main') ?>

<?= $this->section('title') ?>
Perfil
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="/assets/css/style.css">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<section class="section">
    <?php if (session('msg')) : ?>
        <article class="message is-<?= session('msg.type') ?>">
            <div class="message-body">
                <?= session('msg.body') ?>
            </div>
        </article>
    <?php endif; ?>


  
<?= $this->endSection() ?>