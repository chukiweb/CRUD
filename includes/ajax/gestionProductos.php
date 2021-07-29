<?php
require_once '../DB.php';
require_once '../Producto.php';
require_once '../funciones.php';

if (isset($_SERVER['REQUEST_METHOD'])) {
    $accion = $_SERVER['REQUEST_METHOD'];

    switch ($accion) {

/////////////////////////////////////////////////////////////////////////////////
//-------------------Añadir productos------------------------------------------//
////////////////////////////////////////////////////////////////////////////////
        /**
         * Añadir un producto nuevo a la BBDD mediante la petición AJAX de tipo POST Añadiendo
         * a la misma todos los datos del nuevo producto.
         */
        case $accion === 'POST':
            if (isset($_POST['nom'])) {

                $error = array();
                $datos = array();

                if (!empty($_POST['nom']) && !is_null($_POST['nom'])) {
                    $nombre = filtrarCampos($_POST['nom']);
                } else {
                    $error ['nombre'] = "El nombre no puede estar vacio,";
                }
                if (!empty($_POST['cod']) && !is_null($_POST['cod'])) {
                    $codigo = filtrarCampos($_POST['cod']);
                } else {
                    $error ['codigo'] = "El codigo no puede estar vacio,";
                }
                if (!empty($_POST['desc']) && !is_null($_POST['desc'])) {
                    $desc = filtrarCampos($_POST['desc']);
                } else {
                    $error ['descripcion'] = "La descripcion del producto no puede estar vacia,";
                }
                if (!empty($_POST['precio']) && !is_null($_POST['precio'])) {
                    $precio = (float) $_POST['precio'];
                } else {
                    $error ['precio'] = "El precio debe ser numerico y mayor que cero,";
                }
                if (!empty($_POST['fam']) && !is_null($_POST['fam'])) {
                    $familia = filtrarCampos($_POST['fam']);
                } else {
                    $error ['familia'] = "El parametro familia tiene que ser valido,";
                }
                if (!empty($_POST['stock']) && !is_null($_POST['stock'])) {
                    $stock = (float) $_POST['stock'];
                } else {
                    $error ['stock'] = "El parametro familia tiene que ser valido,";
                }
//Si no hay ningun error en los datos que nos manda el navegador pasamos a insertar el nuevo producto a la base de datos
                if (empty($error)) {
                    $datos = array(
                        'nombre' => $nombre,
                        'cod' => $codigo,
                        'descripcion' => $desc,
                        'pvp' => $precio,
                        'familia' => $familia,
                        'stock' => $stock);


                    if (DB::insertarProducto($datos)) {
                        ?>

                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>¡Producto <?php echo $codigo; ?> añadido correctamente!</strong>
                        </div>
                    <?php } else {
                        ?>

                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>Se a producido un error, El codigo de producto ya se encuentra en la BBDD </br>intentelo otra vez </strong> 

                        </div>

                        <?php
                    }
                } else {
                    return $error;
                }
            }

            break; //Fin de añadir producto
/////////////////////////////////////////////////////////////////////////////////
//-------------------Actualizar productos--------------------------------------//
////////////////////////////////////////////////////////////////////////////////
        case $accion === 'PUT':

            if (isset($_REQUEST['id'])) {
                $id = $_REQUEST['id'];
                $stock = $_REQUEST['nuevoStock'];

                if (DB::actualizarStock($id, $stock)) {
                    ?>

                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo '<strong>¡El producto ' . $id . ' se ha actualizado correctamente!</strong>'; ?>
                    </div>
                <?php } else {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Se a producido un error, intentalo otra vez</strong> 

                    </div>

                    <?php
                }
            }
            break; //FIn de actualizar el stock
/////////////////////////////////////////////////////////////////////////////////
//-------------------Eliminar productos----------------------------------------//
////////////////////////////////////////////////////////////////////////////////        
//Borrar productos de la Basa De Datos
        case $accion === 'DELETE':
            if (isset($_SERVER['REQUEST_METHOD'])) {
                $id = $_REQUEST['codigo'];
                $ok = false;
                if (DB::eliminarProducto($id)) {
                    $ok = true;
                }
                return $ok;
            }
            break; //Fin de eliminar producto

        default:
            $sql = "SELECT * FROM producto";

            if (isset($_GET['consulta'])) {
                $consulta = $_GET['consulta'];

                $sql = "SELECT * FROM producto WHERE nombre LIKE '%$consulta%'";
            }

            $respuesta = DB::ejecutaConsulta($sql);

            $resultado = $respuesta->fetchAll(PDO::FETCH_ASSOC);

            $fila = count($resultado);

//Si hay resultados recorremos el resultado y vamos guardando cada resultado en un array.
            if ($fila > 0) {

                foreach ($resultado as $valor) {

                    $json [] = array(
                        'codigo' => $valor['cod'],
                        'nombre' => $valor['nombre'],
                        'descripcion' => $valor['descripcion'],
                        'precio' => $valor['PVP'],
                        'familia' => $valor['familia'],
                        'stock' => $valor['stock']
                    );
                }
//Convertimos el array en un objeto json para devolverlo al navegador
                $string = json_encode($json);
                echo $string;
            } else {
                echo "<h2 class='titulo'> 'No hay productos de listar'</h2>";
            }
            break;

        case $accion === 'GET':
            $sql = "SELECT * FROM producto";

            if (isset($_GET['consulta'])) {
                $consulta = $_GET['consulta'];

                $sql = "SELECT * FROM producto WHERE nombre LIKE '%$consulta%'";
            }

            $respuesta = DB::ejecutaConsulta($sql);

            $resultado = $respuesta->fetchAll(PDO::FETCH_ASSOC);

            $fila = count($resultado);

//Si hay resultados recorremos el resultado y vamos guardando cada resultado en un array.
            if ($fila > 0) {

                foreach ($resultado as $valor) {

                    $json [] = array(
                        'codigo' => $valor['cod'],
                        'nombre' => $valor['nombre'],
                        'descripcion' => $valor['descripcion'],
                        'precio' => $valor['PVP'],
                        'familia' => $valor['familia'],
                        'stock' => $valor['stock']
                    );
                }
                //Convertimos el array en un objeto json para devolverlo al navegador
                $string = json_encode($json);
                echo $string;
            } else {
                echo "<h2 class='titulo'> 'No hay productos de listar'</h2>";
            }
    }
}
