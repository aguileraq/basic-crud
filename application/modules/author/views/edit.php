<?php $this->load->view('admin/navigation');?>
	<ol class="breadcrumb">
        <li><a href="#">Admin</a></li>
        <li><a href="<?php echo base_url();?>admin/panel/">Panel</a></li>
        <li><a href="<?php echo base_url();?>admin/autores/">Autores</a></li>
        <li class="active">Editar</li>
    </ol>
	<h1>Autor - Editar</h1>

<?php foreach ($author as $item): ?>
	<?php $attributes = array('id' => 'edit_author_form', 'class' => 'form-horizontal', 'role' => 'form');?>
	<?php echo form_open(base_url('admin/autores/editar/'.$item->id), $attributes); ?>
			<div class="col-md-8">
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" name="author_name" class="form-control" value="<?php echo $item->name; ?>">
				</div>
				<div class="form-group">
					<label>Estado</label>
					<select name="author_status" class="form-control">
						<option value="1" <?php echo ($item->active == 1 ? 'selected' : '');?>>Publicado</option>
						<option value="0" <?php echo ($item->active == 0 ? 'selected' : '');?>>No Publicado</option>
					</select>
				</div>
				<div class="form-group">
					<div id="res_msg"></div>
				</div>
				<div class="form-group">
					<button type="submit" id="edit_author" name="edit_author" value="Actualizar" class="btn btn-default">Actualizar</button>
					<button type="submit" name="edit_cancel" value="Cancelar" class="btn btn-default">Cancelar</button>
				</div>
			</div>
	<?php echo form_close();?>
<?php endforeach;?>