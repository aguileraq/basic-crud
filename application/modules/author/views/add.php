<?php $this->load->view('admin/navigation');?>
	<ol class="breadcrumb">
        <li><a href="#">Admin</a></li>
        <li><a href="<?php echo base_url();?>admin/panel/">Panel</a></li>
        <li><a href="<?php echo base_url();?>admin/autores/">Autores</a></li>
        <li class="active">Agregar</li>
    </ol>
	<h1>Autor - Agregar</h1>

	<?php $attributes = array('id' => 'add_author_form', 'class' => 'form-horizontal', 'role' => 'form');?>
	<?php echo form_open(base_url('admin/autores/crear'), $attributes); ?>
        <div class="col-md-8">
            <div class="form-group">
                <label>Nombre de Autor</label>
                <input type="text" name="author_name" class="form-control" value="<?php echo set_value("author_name"); ?>">
            </div>
			<div class="form-group">
				<label>Estado</label>
				<select name="author_status" class="form-control">
					<option value="1">Publicado</option>
					<option value="0">No Publicado</option>
				</select>
			</div>
			<div class="form-group">
				<div id="res_msg"></div>
			</div>
			<div class="form-group">
				<button type="submit" id="add_author" name="add_author" value="Guardar" class="btn btn-default">Guardar</button>
				<button type="submit" name="add_cancel" value="cancelar" class="btn btn-default">Cancelar</button>
			</div>
		</div>
	<?php form_close();?>