<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Reportes
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css
">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<script>
< script src = "https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js" >
</script>
</script>
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
    <form action="<?=base_url('admin/generar-reporte')?>" method="POST">
        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="start">Fecha: de</label>
                <input type="date" id="start" name="fechaInicio" value="<?= date('Y-m-d')?>" min="2018-01-01"
                    max="2022-12-12">
                <label for="start"> hasta </label>
                <input type="date" id="start" name="fechaFinal"
                    value="<?= date('Y-m-d',strtotime(date('Y-m-d').'+1 days'))?>" min="2018-01-01" max="2022-12-12">
            </div>

            <div class="form-group col-md-2">
                <label class="label">Estado: </label>
                <div class="control select is-link">
                    <select name='filtroEstado'>
                        <option value="all" selected>Ambos</option>
                        <option value="1">Pendientes</option>
                        <option value="0">Resueltas</option>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.filtroEstado')?></p>
            </div>

            <div class="form-group col-md-2">
                <label class="label">Usuarios: </label>
                <div class="control select is-link">
                    <select name='filtroUsuario'>
                        <?php if(old('filtroUsuario')!=null):?>
                        <option value="all" selected>Todos</option>
                        <?php foreach($usuarios as $key): ?>
                        <option value="<?=password_hash($key->idUsuario,PASSWORD_DEFAULT)?>"
                            <?php if(password_verify($key->idUsuario, old('filtroUsuario'))):?>selected <?php endif;?>>
                            <?=$key->usuario?>
                        </option>
                        <?php endforeach;?>
                        <?php else: ?>
                        <option value="all" selected>Todos</option>
                        <?php foreach($usuarios as $key): ?>
                        <option value="<?=password_hash($key->idUsuario,PASSWORD_DEFAULT)?>"><?=$key->usuario?>
                        </option>
                        <?php endforeach;?>
                        <?php endif; ?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.filtroUsuario')?></p>
            </div>

            <div class="form-group col-md-2">
                <label class="label">Tipo de incidencia: </label>
                <div class="control select is-link">
                    <select name='filtroTipoIncidencia'>
                        <option value="all" selected>Todas</option>
                        <?php foreach($tipoIncidencia as $key): ?>
                        <option value="<?=password_hash($key->idTipoIncidencia,PASSWORD_DEFAULT)?>">
                            <?=$key->incidencia?>
                        </option>
                        <?php endforeach;?>
                    </select>
                </div>
                <p class="is-danger help"><?=session('errors.filtroTipoIncidencia')?></p>
            </div>
            <div class="form-group col-md-2">
                <div class="control">
                    <button class="button is-info">Generar</button>
                </div>
            </div>
    </form>
</section>
<?=$this->endSection()?>