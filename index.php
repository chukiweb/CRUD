<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Tienda Web Amazonia</title>
</head>
<body>
    <div class="container wraper wraper">
        <div class="row container encabezado table table-responsive">
            <div class="col-md-4">
                <p id="titulo">Amazonia.com</p>
            </div>
            <div class="col-md-4">
                <button type="button" id="open-modal" class="btn btn-default my-2 my-sm-0" data-toggle="modal" data-target="#addProductos" ><i class="icon-external-link buscar"></i>Agregar nuevo producto</button>
            </div>
            <div class="col-md-4">
                <form class="form-inline my-2 my-lg-0">
                    <input type="text" id="info-busqueda"  class="form-control mr-sm-2 " placeholder="Buscar productos">
                </form>
            </div>
   
        </div>
        <div id="listadoProductos" class="listaProductos">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                           <th>Código</th>
                           <th>Producto</th>
                           <th>Descripción</th>
                           <th>Precio</th>
                           <th>Familia</th>
                           <th>Stock</th>
                           <th></th>
                       </tr>
                    </thead>
                    <tbody id="tbody">
                    </tbody>
                </table>
            </div>
        </div>
        <div id="avisoError"></div><!-- Carga de datos ajax aqui -->
        <?php
        include 'pie.php';
        ?>
    
    <!-- Modal añadri HTML -->
<?php include("includes/html/añadirProductos.php"); ?>
    <!-- Modal de editar HTML -->
    <?php include("includes/html/editarStock.php"); ?>
    <!-- modal eliminar HTML -->
    <?php include("includes/html/borrarProductos.php"); ?>
    <!-- VEntanas emergentes-->
    <?php include("includes/html/emergente.php"); ?>
    <!--Aqui incluimos nuestro archivo de tipo .js-->
         <script src="js/script.js"></script>
     <!--Aqui incluimos nuestro enlace de las alertas de tipo .js-->    
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
         
    </div>
</body>
</html>
