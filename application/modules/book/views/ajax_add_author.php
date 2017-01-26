<div class="modal fade" id="ajax_add_author" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Autor</h4>
      </div>
      <div class="modal-body">
        <?php $attributes = array('id' => 'ajax_add_author_form', 'role' => 'form');?>
        <?php echo form_open(base_url('admin/libros/agregar_autor'), $attributes); ?>
          <div class="form-group">
            <label>Nombre de Autor</label>
            <input type="text" name="author_name" class="form-control" value="<?php echo set_value("author_name"); ?>">
          </div>
          <div class="form-group">
            <label>Estado</label>
            <select name="author_status" class="form-control">
              <option value="1">Publicado</option>
              <option value="0">No Publicado</option>
            </select>
          </div>
          
          <button type="submit" name="add_cancel" value="cancelar" data-dismiss="modal" class="btn btn-danger">Cancelar</button>
          <button type="submit" name="add_ajax_author" value="Guardar" class="btn btn-primary">Guardar</button>

        <?php echo form_close();?>
      </div>
      <div class="modal-footer">
        <div id="the-message"></div>
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->