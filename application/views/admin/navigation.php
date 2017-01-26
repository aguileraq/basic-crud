	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Control Librería</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($this->uri->segment(2)=="panel") echo 'class="active"'; ?>>
        	<a href="<?php echo base_url();?>admin/panel">
        		<i class="fa fa-tachometer fa-lg" aria-hidden="true"></i><span> Panel</span>
        	</a>
        </li>
        <li <?php if($this->uri->segment(2)=="categorias") echo 'class="active"'; ?>>
        	<a href="<?php echo base_url();?>admin/categorias"><i class="fa fa-list-alt fa-lg" aria-hidden="true"></i><span> Categorías</span>
        	</a>
        </li>
        <li <?php if($this->uri->segment(2)=="autores") echo 'class="active"'; ?>>
			<a href="<?php echo base_url();?>admin/autores"><i class="fa fa-address-book fa-lg" aria-hidden="true"></i><span> Autores</span>
        	</a>
        </li>
        <li <?php if($this->uri->segment(2)=="libros") echo 'class="active"'; ?>">
			<a href="<?php echo base_url();?>admin/libros"><i class="fa fa-book fa-lg" aria-hidden="true"></i><span> Libros</span>
        	</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $this->session->userdata('username');?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url();?>admin/dashboard/salir">Salir</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <div class="container">
		<div class="row">