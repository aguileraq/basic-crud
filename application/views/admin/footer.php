	</div>
</div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.tokeninput.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/buttons.bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jszip.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/pdfmake.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/vfs_fonts.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/buttons.html5.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/buttons.print.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/buttons.colVis.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/app.js"></script>
	<script type="text/javascript">
	//var table;
	$(document).ready(function() {
		//datatables
		table = $('#table_categories').DataTable({ 
			lengthChange: true,
			dom: 'Bfrtip',
			buttons: [
            {
                extend: 'excelHtml5',
				title: 'lib_categorias',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'csvHtml5',
				title: 'lib_categorias',
                exportOptions: {
                    columns: [ 0, 1, 2 ]
                }
            },
            
			],
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			initComplete : function () {
				table.buttons().container()
					   .appendTo( $('#table_wrapper .col-sm-6:eq(0)'));
			},
			"order": [], //Initial no order.
	 
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo base_url().'admin/categorias/ajax_list'; ?>",
				"type": "POST",
				"cache": false,
			},
	 
			//Set column definition initialisation properties.
			"columnDefs": [
				{ 
				"targets": [0],
				"orderable": false, //set not orderable
				},
			],
			"language": {
				"emptyTable":     "No hay datos disponibles.",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ registros.",
				"infoEmpty":      "Mostando 0 a 0 de 0 registros.",
				"infoFiltered":   "(filtered from _MAX_ total entries)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Mostrar _MENU_ registros.",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search":         "Buscar:",
				"zeroRecords":    "No se encontraron registros.",
				"paginate": {
					"first":      "Primero",
					"last":       "Ultimo",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
		// Datatable for authors
		table = $('#table_authors').DataTable({ 
			lengthChange: true,
			dom: 'Bfrtip',
			buttons: [
            {
                extend: 'excelHtml5',
				title: 'lib_autores',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            {
                extend: 'csvHtml5',
				title: 'lib_autores',
                exportOptions: {
                    columns: [0,1,2]
                }
            },
            
			],
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			initComplete : function () {
				table.buttons().container()
					   .appendTo( $('#table_wrapper .col-sm-6:eq(0)'));
			},
			"order": [], //Initial no order.
	 
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo base_url().'admin/autores/ajax_list'; ?>",
				"type": "POST"
			},
	 
			//Set column definition initialisation properties.
			"columnDefs": [
				{ 
				"targets": [0],
				"orderable": false, //set not orderable
				},
			],
			"language": {
				"emptyTable":     "No hay datos disponibles.",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ registros.",
				"infoEmpty":      "Mostando 0 a 0 de 0 registros.",
				"infoFiltered":   "(filtered from _MAX_ total entries)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Mostrar _MENU_ registros.",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search":         "Buscar:",
				"zeroRecords":    "No se encontraron registros.",
				"paginate": {
					"first":      "Primero",
					"last":       "Ultimo",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});
		//Datatable for books
		table = $('#table_books').DataTable({
			lengthChange: true,
			dom: 'Bfrtip',
			buttons: [
            {
                extend: 'excelHtml5',
				title: 'lib_libros',
                exportOptions: {
                    columns: [0,1,2,4,5]
                }
            },
            {
                extend: 'csvHtml5',
				title: 'lib_libros',
                exportOptions: {
                    columns: [0,1,2,4,5]
                }
            },
            
			],
			"processing": true, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			initComplete : function () {
				table.buttons().container().appendTo( $('#table_wrapper .col-sm-6:eq(0)'));
			},
			"order": [], //Initial no order.
	 
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": "<?php echo base_url().'admin/libros/ajax_list'; ?>",
				"type": "POST"
			},
	 
			//Set column definition initialisation properties.
			"columnDefs": [
				{ 
				"targets": [0],
				"orderable": false, //set not orderable
				},
			],
			"language": {
				"emptyTable":     "No hay datos disponibles.",
				"info":           "Mostrando _START_ a _END_ de _TOTAL_ registros.",
				"infoEmpty":      "Mostando 0 a 0 de 0 registros.",
				"infoFiltered":   "(filtered from _MAX_ total entries)",
				"infoPostFix":    "",
				"thousands":      ",",
				"lengthMenu":     "Mostrar _MENU_ registros.",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search":         "Buscar:",
				"zeroRecords":    "No se encontraron registros.",
				"paginate": {
					"first":      "Primero",
					"last":       "Ultimo",
					"next":       "Siguiente",
					"previous":   "Anterior"
				},
			}
		});

		$('.data-table tbody').on('click', 'a.show_del', function()
		{
			var id = $(this).data("id");
			$('#row_id').val(id);
			var tablename = $(this).data("table");
			$('#table_name').val(tablename);
		});
		
		$('button.delete').click(function(e) 
		{
			e.preventDefault();
			var id = $('#row_id').val();
			var tablename = $('#table_name').val();
			$.ajax({
				url : "<?php echo base_url().'category/ajax_delete/';?>",
				type: "POST",
				cache: false,
				data: {id:id,table:tablename},
				success: function(data)
				{
					console.log(data);
					$("#res_msg").html("");
					var json = JSON.parse(data);
					if( json.res === true)
					{
						$("#res_msg").append('<p class="text-success text-left" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Success:</span> El registro se ha eliminado.</p>');
						$('#table_'+tablename).DataTable().ajax.reload();
						var delay = 2000;
						setTimeout(function(){ $('#deleteModal').modal('hide') }, delay);
					}
					
				},
				errorfunction (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});
		});
	
	});
</script>

  </body>
</html>
<?php $this->output->enable_profiler(TRUE);?>