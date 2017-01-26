<?php $this->load->view('admin/navigation');?>
    
    <ol class="breadcrumb">
        <li><a href="#">Admin</a></li>
        <li><a href="<?php echo base_url();?>admin/panel/">Panel</a></li>
        <li><a href="<?php echo base_url();?>admin/libros/">Libros</a></li>
        <li class="active">Agregar</li>
    </ol>

<h1>Libros - Agregar nuevo libro.</h1>
	
<?php $attributes = array('id' =>'add_book_form', 'class' => 'form-horizontal', 'role' => 'form');?>
<?php echo form_open_multipart(base_url('admin/libros/crear'), $attributes); ?>
        <div class="col-md-8">
            <div class="form-group">
                <label>Categoría</label>
                <select name="category_name" class="form-control">
                <option selected disabled>Selecciona una Categoría</option>
                	<?php foreach ($categories as $category): ?>
                		<option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
                	<?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Titulo</label>
                <input type="text" name="book_title" class="form-control" value="<?php echo set_value("book_title"); ?>">
            </div>
            <div class="form-group">
                <label>Fotografía</label>
                <input type="file" name="book_picture" >
                <p class="help-block">Sube la foto de la portada del Libro.</p>
            </div>
            <div class="form-group">
                <label>Editorial</label>
                <input type="text" name="book_editorial" class="form-control" value="<?php echo set_value("book_editorial"); ?>">
            </div>
            <div class="form-group">
                <label>Autor</label>
                <input type="text" id="select_author" name="book_author" class="form-control">
                <input type="hidden" id="author_ids" name="author_ids" value="<?php echo set_value("author_ids"); ?>">
                <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ajax_add_author">Nuevo Autor</a>
            </div>
            <div class="form-group">
                <label>ISBN</label>
                <input type="text" name="book_isbn" class="form-control" value="<?php echo set_value("book_isbn");?>">
            </div>
            <div class="form-group">
                <label>Fecha de Publicación</label>
                <input type="date" name="book_publishdate" class="form-control" value="<?php echo set_value("book_publishdate"); ?>">
            </div>
            <div class="form-group">
                <label>No. de Ejemplares</label>
                <input type="number" name="book_qty" class="form-control" value="<?php echo set_value("book_qty"); ?>">
            </div>
			<div class="form-group">
				<label>Estado</label>
				<select name="book_status" class="form-control">
					<option value="1">Publicado</option>
					<option value="0">No Publicado</option>
				</select>
			</div>
            <div class="form-group">
                <div id="res_msg"></div>
            </div>
            <div class="form-group">
                <button type="submit" id="add_book" name="add_book" value="Guardar" class="btn btn-default">Guardar</button>
			     <button type="submit" name="add_cancel" value="cancelar" class="btn btn-default">Cancelar</button>
            </div>
		</div>
<?php echo form_close();?>

<?php $this->load->view('ajax_add_author');?>
