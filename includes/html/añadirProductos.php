
<div id="addProductos" class="modal fade" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" >
        <div class="modal-content">
            <!--Cabecera del modal-->
            <div class="modal-header">
                <h5 class="modal-title">Añadir Productos</h5>
            </div>
            <!-- Cuerpo del modal con el formulario dentro-->
            <div class="modal-body">
                <form  name="add-productos" id="add-productos" data-toggle="validator" role="form" >

                    <!--Codigo del producto-->
                    <div class="form-group">
                        
                        <label for="codigo">Codigo</label>&nbsp;&nbsp;<span class="error" id="codigo-error"></span>
                        <input type="text" name="codigo" id="codigo" size="6"  placeholder="NDS3POR" class="form-control "  required>

                    </div>

                    <!--Nombre del producto-->
                    <div class="form-group">
                       
                        <label for="nombre">Nombre</label>&nbsp;&nbsp;<span class="error" id="nombre-error"></span>
                        <input type="text" name="nombre" id="nombre" size="50"  placeholder="Nombre producto" class="form-control"  required>
                        
                    </div>

                    <!--Familia del producto-->
                    <div class="form-group">
                        <label for="nombre">Familia</label>&nbsp;&nbsp;<span class="error" id="familia-error"></span>
                        <input type="text" name="familia" size="6" placeholder="Tv, Consola" class="form-control" id="familia"  required>
                    </div>

                    <!--Precio del producto-->
                    <div class="form-group">
                        <label for="precio">PVP</label>&nbsp;&nbsp;<span class="error" id="precio-error"></span>
                        <input type="number" step="0.01" min="0.0" name="precio"  placeholder="10.20" class="form-control" id="precio"  required>
                    </div>

                    <!--Descripción del producto-->
                    <div class="form-group">
                        <label for="text-area">Descripción</label>&nbsp;&nbsp;<span class="error" id="text-area-error"></span>
                        <textarea class="form-control" name="text-area" id="text-area" rows="1" placeholder="Descrpción"  required ></textarea>
                    </div>

                    <!--Stock  del producto-->
                    <div class="form-group">
                        <label for="stock">Stock</label>&nbsp;&nbsp;<span class="error" id="stock-error"></span>
                        <input type="number"  name="stock" min="0" placeholder="150" class="form-control" id="stock"  required>
                    </div>
                </form>
            </div>
            <div id="resultados-add"></div><!--Carga de el mensaje del servidor recibido por Ajax-->
            <div class="modal-footer">
                <button type="button" id="cerrar-add" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <input type="submit" name="guardar-add" id="guardar-add" class="btn btn-primary" value="Guardar Cambios">
            </div>

        </div> 
    </div>

</div>
