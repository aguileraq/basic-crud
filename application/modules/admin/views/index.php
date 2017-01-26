<div class="container">    
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
				<div class="panel-title">Iniciar Sesión</div>
            </div>     
            <div style="padding-top:30px" class="panel-body">
                <?php $attributes = array('id' => 'login_form','class' => 'form-horizontal','role' => 'form');?>
				<?php echo form_open(base_url("admin"), $attributes);?>
					<div style="margin-bottom: 25px" class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login_username" type="text" class="form-control" name="login_username" value="" placeholder="Correo electrónico">
					</div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						<input id="login_password" name="login_password" type="password" class="form-control" name="password" placeholder="Contraseña">
                    </div>
					<div class="input-group">				
						<button type="submit" name="submit" value="login" class="button btn btn-success btn-large">Iniciar Sesión</button>
					</div>
					<div id="res_msg" class="input group" style="margin-top:10px"></div> 

				<?php echo form_close();?>  
			</div>  
        </div>                     
    </div>  
</div>