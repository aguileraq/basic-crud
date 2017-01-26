<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
      </div>
      <div class="modal-body">
        <p>Esta a punto de eliminar un registro y no podra recuperarlo.</p>
		    <p>¿Desea eliminar este registro?</p>
      </div>
      <div class="modal-footer">
        <div class="col-md-6">
            <div id="res_msg"></div>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="delete btn btn-danger">Eliminar Registro</button>
        </div>
      </div>
    </div>
  <input type="hidden" id="row_id" value=""/>
  <input type="hidden" id="table_name" value=""/>
</div>
</div>