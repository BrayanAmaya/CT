<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Perfil
<?=$this->endSection()?>
<?=$this->section('css')?>

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

<!-- Modal -->
<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h1 class="title">Perfil</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   <form class="form-row" action="#" method="POST">

       <div class="form-group col-md-6">
           <label class="label has-text-centered">Nombre</label>
           <h6 class="subtitle is-6 has-text-centered"><?=$usuario->nombre?></h6>
       </div>

       <div class="form-group col-md-6">
           <label class="label has-text-centered">Apellido</label>
           <h6 class="subtitle is-6 has-text-centered"><?=$usuario->apellido?></h6>
       </div>

       <div class="form-group col-md-6">
           <label class="label has-text-centered">Usuario</label>
           <h6 class="subtitle is-6 has-text-centered"><?=$usuario->usuario?></h6>
       </div>

       <div class="form-group col-md-6">
           <label class="label has-text-centered">Número de telefono</label>
           <h6 class="subtitle is-6 has-text-centered"><?=$usuario->telefono?></h6>
       </div>

       <div class="form-group col-md-6">
           <label class="label has-text-centered">Correo electronico</label>
           <h6 class="subtitle is-6 has-text-centered"><?=$usuario->email?></h6>
       </div>

       <div class="form-group col-md-6">
           <label class="label has-text-centered">Número de DUI</label>
           <h6 class="subtitle is-6 has-text-centered"><?=$usuario->dui?></h6>
       </div>
   </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
   
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>   
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<!--script para javascript para que carga el modal -->
<script>
       
   $(document).ready(function()
   {
      $("#Modal").modal("show");
   });
</script>
</section>
<?=$this->endSection()?>
 