<?php $this->load->view('admin/navigation');?>

    <ol class="breadcrumb">
        <li><a href="#">Admin</a></li>
        <li><a href="<?php echo base_url();?>admin/panel/">Panel</a></li>
        <li class="active">Libros</li>
    </ol>
    <h1>Libros</h1>
<a class="btn btn-success bottom_20" href="<?php echo base_url();?>admin/libros/crear"><i class="glyphicon glyphicon-plus"></i> Agregar Libro</a>

<div id="table_wrapper">
	<table id="table_books" class="table table-striped table-bordered data-table" cellspacing="0" width="100%">
		<thead>
            <tr>
                <th>No</th>
                <th>Titulo</th>
                <th>ISBN</th>
                <th>Portada</th>
                <th>No. Ejemplares</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
		<tbody>
        </tbody>
        <tfoot>
            <tr>
				<th>No</th>
                <th>Titulo</th>
                <th>ISBN</th>
                <th>Portada</th>
                <th>No. Ejemplares</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </tfoot>
    </table>
</div>

<?php $this->load->view('category/delete');?>