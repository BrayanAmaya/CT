<?= $this->extend('admin/main') ?>

<?= $this->section('title') ?>
Perfil
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/assets/css/style_admin.css">
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

    <!-- Modal -->
    <div id="miModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Contenido del modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="title">Perfil</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form class="border p-3 form" action="#" method="POST">
                    <div class="row">
                            <div class="col-md-12">
                                <h1 class="subtitle is-6 has-text-centered">
                                <i class="fa fa-user fa-5x" aria-hidden="true"></i>
                            </h1>
                        </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="label has-text-centered">Nombre</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $usuario->nombre ?></h6>
                            </div>
                            <div class="col-md-6">
                                <label class="label has-text-centered">Apellido</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $usuario->apellido ?></h6>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="label has-text-centered">Usuario</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $usuario->usuario ?></h6>
                            </div>
                            <div class="col-md-6">
                                <label class="label has-text-centered">Número de telefono</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $usuario->telefono ?></h6>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="label has-text-centered">Correo electronico</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $usuario->email ?></h6>
                            </div>
                            <div class="col-6">
                                <label class="label has-text-centered">Número de DUI</label>
                                <h6 class="subtitle is-6 has-text-centered"><?= $usuario->dui ?></h6>
                            </div>
                        </div><br>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#miModal").modal("show");
    </script>

</section>
<?= $this->endSection() ?>