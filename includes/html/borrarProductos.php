<div id="borrarProductos" class="modal fade" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" >
            <div class="modal-content">

                <!--Cabecera del modal-->
                <div class="modal-header">
                    <h5 class="modal-title">Elimionar Productos</h5>
                </div>

                <!-- Cuerpo del modal con el fprmulario dentro-->
                <div class="modal-body">
                    <form  name="form-delete" id="form-delete">

                        <!--Codigo del producto-->
                        <div class="form-group">
                            <label for="form-codigo">Codigo</label>
                            <input type="text" name="form-codigo" id="form-codigo" class="form-control"  readonly>
                        </div>

                        <!--Nombre del producto-->
                        <div class="form-group">
                            <label for="form-nombre">Nombre</label>
                            <input type="text" name="form-nombre" id="form-nombre"  class="form-control" readonly>
                        </div>

                        <!--Familia del producto-->
                        <div class="form-group">
                            <label for="form-familia">Familia</label>
                            <input type="text" name="form-familia" id="form-familia" class="form-control"  readonly>
                        </div>

                        <!--Precio del producto-->
                        <div class="form-group">
                            <label for="form-precio">PVP</label>
                            <input type="text" name="form-precio"  id="form-precio" class="form-control"  readonly>
                        </div>

                        <!--Descripción del producto-->
                        <div class="form-group">
                            <label for="form-text-area">Descripción</label>
                            <textarea name="form-text-area" id="form-text-area" class="form-control" rows="3" readonly ></textarea>
                        </div>
                   
                        <div id="resultados-delete"></div><!--Carga de el mensaje del servidor recibido por Ajax-->

                <div class="modal-footer">
                    <input type="button" name="cerrar-delete" id="cerrar-delete" class="btn btn-default" value="Cerrar" data-dismiss="modal">
                    <input type="submit" name="productoEliminar" id="productoEliminar" class="btn btn-danger" value="Eliminar">
                </div>
              </form>
            </div>
            </div> 
    </div>
</div>