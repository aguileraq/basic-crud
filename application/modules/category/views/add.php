<?php $this->load->view('admin/navigation');?>
    <ol class="breadcrumb">
        <li><a href="#">Admin</a></li>
        <li><a href="<?php echo base_url();?>admin/panel/">Panel</a></li>
        <li><a href="<?php echo base_url();?>admin/categorias/">Categorías</a></li>
        <li class="active">Agregar</li>
    </ol>

<h1>Categoría - Agregar</h1>

	<?php $attributes = array('id' => 'add_category_form', 'class' => 'form-horizontal', 'role' => 'form');?>
	<?php echo form_open(base_url('admin/categorias/crear'), $attributes); ?>
        <div class="col-md-8">
            <div class="form-group">
                <label>Nombre</label>
                <input type="text" name="category_name" class="form-control" value="<?php echo set_value("category_name"); ?>">
            </div>
			<div class="form-group">
				<label>Estado</label>
				<select name="category_status" class="form-control">
					<option value="1">Publicado</option>
					<option value="0">No Publicado</option>
				</select>
			</div>
			<div class="form-group">
				<div id="res_msg"></div>
			</div>
			<div class="form-group">
				<button type="submit" id="add_category" name="add_category" value="Guardar" class="btn btn-default">Guardar</button>
				<button type="submit" id="add_cancel" name="add_cancel" value="cancelar" class="btn btn-default">Cancelar</button>
			</div>
		</div>
	<?php echo form_close();?>