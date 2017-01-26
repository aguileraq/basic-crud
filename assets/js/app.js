(function($){
	var arr = new Array();
	if( $("#author_ids").length && $("#author_ids").val().length )
	{
        value = $("#author_ids").val();
        arr = value.split(',');
    }
    var $data = $('#authorlist').data('authors');
    //var $ids = jQuery.parseJSON($data);
   
	$("#select_author").tokenInput("http://localhost/proyectos/codeigniter/admin/libros/autores/",{
		preventDuplicates: true,
 		theme: "facebook",
 		hintText: "Escribe el nombre de un autor.",
        noResultsText: "No hay resultados.",
        searchingText: "Buscando...",
        onAdd: function (item){
        	arr.push(item.id);
        	$("#author_ids").val(arr);
        },
        onDelete: function (item) {
        	var i = arr.indexOf(item.id);
        	if(i != -1)
        	{
				arr.splice(i,1);
			}
			//arr.splice(arr.indexOf(item.id),1);
        	$("#author_ids").val(arr);
        },
        prePopulate: $data
        /*prePopulate: [
			{id: 6, name: "Charlie Sac"}
        ]*/
    });
	
	$('#ajax_add_author_form').on('submit',function(e)
	{
		e.preventDefault();
		var $form = $(this);
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: $form.serialize(),
			dataType: 'json',
			cache: false,
			success: function (data, status)
			{
				if (data.sts)
				{
					$("#the-message").html(data.msg);
				}
				else
				{
					$("#the-message").html(data.msg);
				}
			},
				error: function (xhr, exception)
				{
					console.log(xhr);
				}
		});
		return false;
	});
	//Login Form
	$('#login_form').on('submit',function(e)
	{
		e.preventDefault();
		var $form = $(this);
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: $form.serialize(),
			success: function (data)
			{
				var json = JSON.parse(data);
				$('#res_msg').html('');
				
				if (json.res == 'error')
				{
					if(json.username)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.username+'</div>');
					}
					if(json.password)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.password+'</div>');
					}
				}
				if (json.res == 'login_error')
				{
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.message+'</div>');
					}
				}
				if (json.res == 'success')
				{
					$('#res_msg').html('');
					if(json.redirect)
					{
						document.location.href = json.redirect;
					}
				}
			},
			error: function (xhr, exception)
			{

			}
		});
		return false;
	});
	//Add Category Form
	$('#add_category').click(function(e)
	{
		e.preventDefault();
		var $form = $("#add_category_form");
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: $form.serialize(),
			success: function (data)
			{
				var json = JSON.parse(data);
				$('#res_msg').html('');
				if (json.res == 'error')
				{
					if(json.category_name)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.category_name+'</div>');
					}
				}
				if (json.res == 'create_error')
				{
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.message+'</div>');
					}
				}
				if (json.res == 'success')
				{
					$('#res_msg').html('');
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span> '+json.message+'</div>');
						var delay = 1000;
						setTimeout(function(){ document.location.href = json.redirect }, delay);
					}
				}
			},
			error: function (xhr, exception)
			{

			}
		});
		return false;
	});
	//Edit Category Form
	$('#edit_category').click(function(e)
	{
		e.preventDefault();
		var $form = $("#edit_category_form");
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: $form.serialize(),
			success: function (data)
			{
				var json = JSON.parse(data);
				$('#res_msg').html('');
				
				if (json.res == 'error')
				{
					if(json.category_name)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.category_name+'</div>');
					}
				}
				if (json.res == 'update_error')
				{
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.message+'</div>');
					}
				}
				if (json.res == 'success')
				{
					$('#res_msg').html('');
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span> '+json.message+'</div>');
						var delay = 1000;
						setTimeout(function(){ document.location.href = json.redirect }, delay);
					}
				}
			},
			error: function (xhr, exception)
			{

			}
		});
		return false;
	});
	//Add Author Form
	$('#add_author').click(function(e)
	{
		e.preventDefault();
		var $form = $("#add_author_form");
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: $form.serialize(),
			success: function (data)
			{
				var json = JSON.parse(data);
				$('#res_msg').html('');
				if (json.res == 'error')
				{
					if(json.author_name)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.author_name+'</div>');
					}
				}
				if (json.res == 'create_error')
				{
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.message+'</div>');
					}
				}
				if (json.res == 'success')
				{
					$('#res_msg').html('');
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span> '+json.message+'</div>');
						var delay = 1000;
						setTimeout(function(){ document.location.href = json.redirect }, delay);
					}
				}
			},
			error: function (xhr, exception)
			{

			}
		});
		return false;
	});
	//Edit Author Form
	$('#edit_author').click(function(e)
	{
		e.preventDefault();
		var $form = $("#edit_author_form");
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: $form.serialize(),
			success: function (data)
			{
				var json = JSON.parse(data);
				$('#res_msg').html('');
				
				if (json.res == 'error')
				{
					if(json.author_name)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.author_name+'</div>');
					}
				}
				if (json.res == 'update_error')
				{
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.message+'</div>');
					}
				}
				if (json.res == 'success')
				{
					$('#res_msg').html('');
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span> '+json.message+'</div>');
						var delay = 1000;
						setTimeout(function(){ document.location.href = json.redirect }, delay);
					}
				}
			},
			error: function (xhr, exception)
			{

			}
		});
		return false;
	});
	//Add Book Form
	$('#add_book').click(function(e)
	{
		e.preventDefault();
		var $form = $("#add_book_form");
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: new FormData($($form)[0]),
			processData: false,
		  	contentType: false,
			success: function (data)
			{
				var json = JSON.parse(data);
				$('#res_msg').html('');
				if (json.res == 'error')
				{
					$.each(json.response, function(i, item) 
					{
						if ( json.response[i].trim() )
						{
							$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.response[i]+'</div>');
						}
					})
				}
				if (json.res == 'create_error')
				{
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.message+'</div>');
					}
				}
				if (json.res == 'success')
				{
					$('#res_msg').html('');
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span> '+json.message+'</div>');
						var delay = 1000;
						setTimeout(function(){ document.location.href = json.redirect }, delay);
					}
				}
			},
			error: function (xhr, exception)
			{

			}
		});
		return false;
	});
	//Edit Author Form
	$('#edit_book').click(function(e)
	{
		e.preventDefault();
		var $form = $("#edit_book_form");
		$.ajax({
			type: "POST",
			url: $form.attr("action"),
			data: new FormData($($form)[0]),
			processData: false,
		  	contentType: false,
			success: function (data)
			{
				var json = JSON.parse(data);
				$('#res_msg').html('');
				
				if (json.res == 'error')
				{
					$.each(json.response, function(i, item) 
					{
						if ( json.response[i].trim() )
						{
							$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.response[i]+'</div>');
						}
					})
				}
				if (json.res == 'update_error')
				{
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-warning" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Warning:</span> '+json.message+'</div>');
					}
				}
				if (json.res == 'success')
				{
					$('#res_msg').html('');
					if(json.message)
					{
						$('#res_msg').append('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Success:</span> '+json.message+'</div>');
						var delay = 1000;
						setTimeout(function(){ document.location.href = json.redirect }, delay);
					}
				}
			},
			error: function (xhr, exception)
			{
				console.log(xhr);
			}
		});
		return false;
	});
})(jQuery);