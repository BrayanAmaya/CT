<?=$this->extend('admin/main')?>

<?=$this->section('title')?>
Incidencias
<?=$this->endSection()?>
<?=$this->section('css')?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<link rel="stylesheet" href="/assets/css/style_admin.css">
<?=$this->endSection()?>
<?=$this->section('content')?>
<?php if(session('msg')):?>
<article class="message is-<?=session('msg.type')?>">
    <div class="message-body">
        <?=session('msg.body')?>
    </div>
</article>
<?php endif; ?>
<br>
<div class="container">

  <div class="row">  
  <div class="col-10">
  <a href="#" class="btn btn-primary">Filtrar</a>  
  </div> 
  <div class="col-2">
  <a href="#" class="btn btn-primary"> <span class="icon"><i class="fas fa-plus" aria-hidden="true"></i></span>
   Nueva Incidencia
</a>  
  </div><br><br>    
  <div class="col-3">
    <div class="card">
    <div class="card" style="width: 22rem;">
  <img src="https://bulma.io/images/placeholders/1280x960.png" class="card-img-top" alt="...">
  <div class="card-content">
      <div class="media-content">
        <p class="title is-4">John Smith</p>
        <p class="subtitle is-6">@Encargado - Alto</p>
      </div>
    <div class="content">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Phasellus nec iaculis mauris. <a>@bulmaio</a>.
      <a href="#">#css</a> <a href="#">#responsive</a>
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
      <br><br>
      <a href="#" class="btn btn-primary">Resolver</a>  
    </div>
  </div>
</div>
    </div>
  </div>

  <div class="col-3">
    <div class="card">
    <div class="card" style="width: 22rem;">
  <img src="https://bulma.io/images/placeholders/1280x960.png" class="card-img-top" alt="...">
  <div class="card-content">
      <div class="media-content">
        <p class="title is-4">John Smith</p>
        <p class="subtitle is-6">@Encargado - Alto</p>
      </div>
    <div class="content">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Phasellus nec iaculis mauris. <a>@bulmaio</a>.
      <a href="#">#css</a> <a href="#">#responsive</a>
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
      <br><br>
      <a href="#" class="btn btn-primary">Resolver</a>  
    </div>
  </div>
</div>
    </div>
  </div>

  <div class="col-3">
    <div class="card">
    <div class="card" style="width: 22rem;">
  <img src="https://bulma.io/images/placeholders/1280x960.png" class="card-img-top" alt="...">
  <div class="card-content">
      <div class="media-content">
        <p class="title is-4">John Smith</p>
        <p class="subtitle is-6">@Encargado - Alto</p>
      </div>
    <div class="content">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Phasellus nec iaculis mauris. <a>@bulmaio</a>.
      <a href="#">#css</a> <a href="#">#responsive</a>
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
      <br><br>
      <a href="#" class="btn btn-primary">Resolver</a>  
    </div>
  </div>
</div>
    </div>
  </div>


  <div class="col-3">
    <div class="card">
    <div class="card" style="width: 22rem;">
  <img src="https://bulma.io/images/placeholders/1280x960.png" class="card-img-top" alt="...">
  <div class="card-content">
      <div class="media-content">
        <p class="title is-4">John Smith</p>
        <p class="subtitle is-6">@Encargado - Alto</p>
      </div>
    <div class="content">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit.
      Phasellus nec iaculis mauris. <a>@bulmaio</a>.
      <a href="#">#css</a> <a href="#">#responsive</a>
      <br>
      <time datetime="2016-1-1">11:09 PM - 1 Jan 2016</time>
      <br><br>
      <a href="#" class="btn btn-primary">Resolver</a>  
    </div>
  </div>
</div>
    </div>
  </div>
</div>

<?=$this->endSection()?>