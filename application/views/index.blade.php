	{{ $this->session->flashdata() }}

    {!! form_open('admin', $attributes) !!}
        
            <div class="form-group">
                <input class="form-control" placeholder="E-mail" name="login_username" type="email" autofocus="">
            </div>
            <div class="form-group">
               	<input class="form-control" placeholder="Password" name="login_password" type="password" value="">
            </div>
            <button type="submit" class="btn btn-lg btn-success btn-block">Iniciar Sesión</button>
        
    {!! form_close() !!}
