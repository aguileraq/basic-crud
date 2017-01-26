<?php $this->load->view('admin/navigation');?>

	<ol class="breadcrumb">
        <li><a href="#">Admin</a></li>
        <li><a href="<?php echo base_url();?>admin/panel/">Panel</a></li>
        <li><a href="<?php echo base_url();?>admin/libros/">Libros</a></li>
        <li class="active">Editar</li>
    </ol>
<h1>Libros - Editar</h1>

<?php $attributes = array('id'=> 'edit_book_form', 'class' => 'form-horizontal', 'role' => 'form');?>
<?php foreach ($book as $item): ?>
	<?php echo form_open(base_url('admin/libros/editar/'.$item->id), $attributes); ?>
			<div class="col-md-8">
				<div class="form-group">
                	<label>Categoría</label>
	                <select name="category_name" class="form-control">
	                	<?php foreach ($categories as $category): ?>
	                		<option value="<?php echo $category->id;?>" <?php echo ($category->id == $item->category_id ? 'selected' : '');?>><?php echo $category->name;?></option>
	                	<?php endforeach; ?>
	                </select>
            	</div>
				<div class="form-group">
					<label>Nombre</label>
					<input type="text" name="book_title" class="form-control" value="<?php echo $item->title; ?>">
				</div>
				<div class="form-group">
					<label>Portada</label>
					<div class="media">
					  <div class="media-left">
					  <?php if( empty($item->picture) ) :?>
					  	<p>Imagen no disponible</p>
					  <?php else: ?>
					    <img class="media-object" src="<?php echo base_url().'uploads/images/'.$item->picture;?>" alt="Portada de libro:<?php echo $item->title;?>" width="80">
					  <?php endif;?>
					  </div>
					  <div class="media-body">
					    <input type="file" name="book_picture" />
                		<p class="help-block">Si desea actualizar la portada del libro, debes subir una nueva.</p>
					  </div>
					</div>
				</div>
				<div class="form-group">
	                <label>Editorial</label>
	                <input type="text" name="book_editorial" class="form-control" value="<?php echo $item->editorial; ?>">
            	</div>
            	<div class="form-group">
	                <label>Autor</label>
	                <input type="text" id="select_author" name="book_author" class="form-control" value="<?php echo set_value("book_author");?>"/>
	                <?php 
	                	$author_id= array(); 
	                	foreach($author as $term):
	                		$author_id[] = $term->id_author;
	            	 	endforeach;
	            	 	$author_ids = implode(",",$author_id);
	            	?>
	            	<input type="hidden" id="authorlist" data-authors='<?php echo json_encode($arr_author);?>' />
	            	<input type="hidden" id="author_ids" name="author_ids" value="<?php echo $author_ids; ?>"/>

	                <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ajax_add_author">Nuevo Autor</a>
            	</div>
            	<div class="form-group">
	                <label>ISBN</label>
	                <input type="text" name="book_isbn" class="form-control" value="<?php echo $item->isbn;?>">
            	</div>
	            <div class="form-group">
	                <label>Fecha de Publicación</label>
	                <input type="date" name="book_publishdate" class="form-control" value="<?php echo $item->publish_date; ?>">
	            </div>
	            <div class="form-group">
	                <label>No. de Ejemplares</label>
	                <input type="number" name="book_qty" class="form-control" value="<?php echo $item->qty; ?>">
            	</div>
				<div class="form-group">
					<label>Estado</label>
					<select name="book_status" class="form-control">
						<option value="1" <?php echo ($item->active == 1 ? 'selected' : '');?>>Publicado</option>
						<option value="0" <?php echo ($item->active == 0 ? 'selected' : '');?>>No Publicado</option>
					</select>
				</div>
				<div class="form-group">
                	<div id="res_msg"></div>
            	</div>
				<div class="form-group">
					<button type="submit" id="edit_book" name="edit_book" value="Artualizar" class="btn btn-default">Actualizar</button>
					<button type="submit" name="edit_cancel" value="Cancelar" class="btn btn-default">Cancelar</button>
				</div>
			</div>
	<?php echo form_close();?>
<?php endforeach;?>
<?php $this->load->view('ajax_add_author');?>