
<div id="editProductos" class="modal fade" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog">
            <div class="modal-content">

                <!--Cabecera del modal-->
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Productos</h5> 
                </div>

                <!-- Cuerpo del modal con el fprmulario dentro-->
                <div class="modal-body">
                    <form name="edit_product" id="edit_product">
                        
                        <div class="form-gruop">
                        <label for="codigo-producto">Producto</label>
                        <input type="text" class="form-control" name="codigo-producto" id="codigo-producto" readonly="">
                        </div>
                        
                        <div class="form-gruop">
                        <label for="edit_actual">Stock Actual</label>
                        <input type="text"  class="form-control" name="edit_actual" id="edit_actual" readonly=""><br>
                        </div>
                        
                        <div class="form-group">
                        <label for="nuevo-stock">Nuevo Stock</label>
                        <input type="text" class="form-control" name="nuevo-stock" id="nuevo-stock">
                        </div>
                        
                       <div id="resultados-edit"></div><!--Carga de el mensaje del servidor recibido por Ajax-->
                        
                        <div class="modal-footer">
                            <button type="button" id="cerrar-edit" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" id="actualizarStock">Actualizar Stock</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
</div>

