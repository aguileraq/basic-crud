<?php $this->load->view('admin/navigation');?>
    <ol class="breadcrumb">
        <li><a href="#">Admin</a></li>
        <li><a href="<?php echo base_url();?>admin/panel/">Panel</a></li>
        <li class="active">Categorías</li>
    </ol>
    <h1>Categorías</h1>
<a class="btn btn-success bottom_20" href="<?php echo base_url();?>admin/categorias/crear"><i class="glyphicon glyphicon-plus"></i> Agregar nueva categoría</a>

<div id="table_wrapper">
	<table id="table_categories" class="table table-striped table-bordered data-table" cellspacing="0" width="100%">
		<thead>
            <tr>
                <th>No</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
		<tbody>
        </tbody>
        <tfoot>
            <tr>
				<th>No</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </tfoot>
    </table>
</div>

<?php $this->load->view('delete');?>