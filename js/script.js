
$(document).ready(function () {

    listarProductos();
    

/////////////////////////////////////////////////////////////////////////////////////////////
//--------------------Funcion para listar todos los productos------------------------------//
/////////////////////////////////////////////////////////////////////////////////////////////

    function listarProductos(consulta) {
        $.ajax({
            url: 'includes/ajax/gestionProductos.php',
            type: 'GET',
            data: {consulta: consulta},
            

            success: function (response) {
              if(response){  
               var producto = JSON.parse(response);
               
               var objetosJson = '';
               var descripcion = '';
               producto.forEach(producto =>{
                 objetosJson += `
                 <tr>
                    <td id="codigo-listado">${producto.codigo}</td>
                        <td id="producto-listado">${producto.nombre}</td>`;
                        var desc = producto.descripcion;
                        if ( desc.length > 70 ) {
                            descripcion = '<div class="descripcion-padre">\n\
                                                <div>'+desc.substr(0,70)+'</div>\n\
                                                <div>\n\
                                                    <button type="button" id="open-descripcion" class="btn btn-default my-2 my-sm-0" data-toggle="modal" data-target="#contenidoDescripcion" data-contenido="'+producto.descripcion+'" >VerMas</button>\n\
                                                </div>\n\
                                            </div>';
                        }else{
                            descripcion = producto.descripcion;
                        }   
                    objetosJson += `<td id="precio-listado">${descripcion}</td>
                                    <td id="precio-listado">${producto.precio}€ </td>
                                    <td id="familia-listado">${producto.familia}</td>
                                    <td id="stock-listado">${producto.stock}</td>
                                    <td> 
                            <div class="col-sm-6">
                                <a href="#" id="editar" data-target="#editProductos" role="button"  class="btn btn-default" data-toggle="modal"  data-code="${producto.codigo}" data-stock="${producto.stock}"><i class="icon-pencil" data-toggle="tooltip" title="Editar" ></i></a>
                             </div>
                            <div class="col-sm-6">
                            <a href="#" id="borrar" data-target="#borrarProductos" role="button"  class="btn btn-default" data-toggle="modal"  data-id="${producto.codigo}" data-nombre="${producto.nombre}" data-descripcion="${producto.descripcion}" data-precio="${producto.precio}" data-familia="${producto.familia}"><i class="icon-trash-o" data-toggle="tooltip" title="Eliminar"></i></a>
                            </div>
                        </td>
                            </tr>`;
                          });
                        $('#tbody').html(objetosJson);
                }else{
                    let avisoError = '';
                    $('#listadoProductos').hide();
                     avisoError +=` 
                        <div class="alert alert-danger aviso" role="alert">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>No hay productos que listar, Añada el primero</strong> 
                        </div>`;
                    $('#avisoError').html(avisoError);
                }
            
        }
        })
    }//Fin de listar productos
    
    


/////////////////////////////////////////////////////////////////////////////////////////////
//-----------------------------Funcion para la busqueda de productos-----------------------//
////////////////////////////////////////////////////////////////////////////////////////////


    $('#info-busqueda').keydown(function (e) {

//Capturamos lo que el usuario escribe en el cuadro de busqueda
        var consulta = $('#info-busqueda').val();
//si hay consulta la pasamos como parametro
        if (consulta !== '') {
            listarProductos(consulta);
        } else {
            listarProductos();
        }
    });



////////////////////////////////////////////////////////////////////////////////////////////               
//------------------------------Funcion para el boton de ver mas---------------------------//
////////////////////////////////////////////////////////////////////////////////////////////

    $('#contenidoDescripcion').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var contenido = button.data('contenido');
        $('#contenido-modal').val(contenido);
    });

////////////////////////////////////////////////////////////////////////////////////////////////
//--------------------Función para introducir productos nuevos-------------------------------//
///////////////////////////////////////////////////////////////////////////////////////////////


    $('#guardar-add').click(function (e) {

        var nombre = document.getElementById('nombre').value;
        var cod = document.getElementById('codigo').value;
        var familia = document.getElementById('familia').value;
        var desc = document.getElementById('text-area').value;
        var precio = document.getElementById('precio').value;
        var stock = document.getElementById('stock').value;
        var ok = true;
        
        //Validacion de los datos del formulario antes de mandarlo al servidor
        //input del codigo
            if ( !cod  ||  cod === null || cod.length > 6 ) {
            if (cod.length > 6) {
                $('#codigo-error').html('El codigo no puede tener mas de 6 caracters');
                ok = false;
            } else {
                $('#codigo-error').html('Debes ingresar un codigo valido');
                ok = false;
            }
        }else{
            $('#codigo-error').html('');
            ok = true;
        }

        //input del nombre
        if (!nombre || nombre === null || nombre.length > 50){

            if (nombre.length > 50) {
                $('#nombre-error').html('El nombre no puede tener mas de 50 caracters');
                ok = false;
            } else {
                $('#nombre-error').html('Debes ingresar un nombre valido');
                ok = false;
            }
        }else{
            $('#nombre-error').html('');
            ok = true;
        }

        //input de la familia
        if (!familia || familia === null || familia.length > 10) {

            if (familia.length > 10) {
                $('#familia-error').html('La familia no puede tener mas de 10 caracters');
                ok = false;
            } else {
                $('#familia-error').html('Debes ingresar un familia valida');
                ok = false;
            }
        }else{
            $('#familia-error').html('');
            ok = true;
        }

        //input de la descripcion del producto
        if (!desc  || desc === null) {

            $('#text-area-error').html('El producto necesita una descripción');
            ok = false;
        }else{
            $('#text-area-error').html('');
            ok = true;
        }

        //input del stock de productos
        if ( !stock || stock === null) {

            $('#stock-error').html('El stock no puede estar en cero al añadir un producto nuevo');
            ok = false;
        }else{
             $('#stock-error').html('');
             ok = true;
        }

        //input del precio
        if ( !precio || precio === null) {

            $('#precio-error').html('Debes ingresar un precio valido con dos decimales');
            ok = false;
        }else{
            $('#precio-error').html('');
            ok= true;
        }
        
        //Si todo ha ido bien mandamos los datos
        if (ok) {
            
        //Guardamos todos los datos en una variable
        var datos = "nom=" + nombre + "&cod=" + cod + "&fam=" + familia + "&desc=" + desc + "&precio=" + precio + "&stock=" + stock;
        //Hacemos la peticion al servidor con Ajax
        $.ajax({
            url: 'includes/ajax/gestionProductos.php',
            type: 'POST',
            data: datos
        })
                //Si todo ha ido bien mostramos el mensaje del servidor en su contenedor.
                .done(function (res) {
                    $('#resultados-add').html(res).fadeIn(2000);
                    //Limpiamos el formulario para nueva insercion
                    $('#add-productos').trigger('reset');
                    //Cargamos la lista de productos 
                    listarProductos();
                });
        //desactivamos las funciones del formulario
        e.preventDefault();

        }});

//////////////////////////////////////////////////////////////////////////////////////////////
//----------------------------Actualizar los productos---------------------------------------//
//////////////////////////////////////////////////////////////////////////////////////////////

    //Funcion para rrelenar el formulario de editar
    $('#editProductos').on('show.bs.modal', function (event) {
        // capturamos los atributos data que vienen del modal 
        var button = $(event.relatedTarget);
        //Le asignamos ese valor a los input del formulario
        var codigo = button.data('code');
        //Mostramos ese valor por pantalla
        $('#codigo-producto').val(codigo);
        var stock = button.data('stock');
        $('#edit_actual').val(stock);
    });

///////////////////////////////////////////////////////////////////////////////////////////////
//--------------Función para Actualizar el stock de productos en la base de datos.------------//
////////////////////////////////////////////////////////////////////////////////////////////////

    $("#actualizarStock").click(function () {
        var codigo = document.getElementById('codigo-producto').value;
        var nuevoStock = document.getElementById('nuevo-stock').value;
        var datos = "id=" + codigo + "&nuevoStock=" + nuevoStock;

        $.ajax({
            url: 'includes/ajax/gestionProductos.php?id='+codigo+'&nuevoStock='+nuevoStock,
            type: 'PUT',
            data: datos
        })

                //Si todo ha ido bien mostramos el mensaje del servidor
                .done(function (res) {
                    $('#resultados-edit').html(res).fadeIn(2000);

                    //recargamos la lista de productos
                    listarProductos();
                });
    });

/////////////////////////////////////////////////////////////////////////////////////////
//------------funcion para eliminar los productos de la base de datos------------------//
////////////////////////////////////////////////////////////////////////////////////////

    $("#productoEliminar").click(function (e) {

        Swal.fire({
            title: "!Aviso!",
            icon: 'warnig',
            text: "Esta accion no se puede deshacer",
            confirmButtonText: 'Eliminar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                var codigo = document.getElementById('form-codigo').value;
                var datos = {'id' : codigo} ;
                //Realizamos la peticion Ajax
                $.ajax({
                    url: 'includes/ajax/gestionProductos.php?codigo='+codigo,
                    type: 'DELETE',
                    data: datos})

                        //Si todo ha ido bien mostramos el mensaje del servidor
                        .done(function (res) {
                            //recargamos la lista de productos
                            listarProductos();
                            Swal.fire(
                                    'Eliminado!',
                                    'Su producto ha sido eliminado.',
                                    'success'
                                    );
                            $("#borrarProductos").modal('hide');
                        });
            }


        })
        e.preventDefault();
    });

//--------------funcion para rellenar el formulario para borrar producto------------------------//
    $('#borrarProductos').on('show.bs.modal', function (event) {
        //variable para capturar los datos que pasamos con el atributo data desde el enlace
        var button = $(event.relatedTarget);
        //bloque de variables en donde le asignamos el valor de los atributo data desde el enlace
        var codigo = button.data('id');
        var nombre = button.data('nombre');
        var familia = button.data('familia');
        var precio = button.data('precio');
        var desc = button.data('descripcion');
        //bloque en donde asignamos el valor a los input del formulario
        $('#form-codigo').val(codigo);
        $('#form-nombre').val(nombre);
        $('#form-familia').val(familia);
        $('#form-precio').val(precio);
        $('#form-text-area').val(desc);

    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//-------------------Funcion para limpiar los input del formulario editar Stock-------------------------//
/////////////////////////////////////////////////////////////////////////////////////////////////////////

    $('#cerrar-edit').click(function () {
        $('#nuevo-stock').val('');
        $('#resultados-edit').html('');
    });

////////////////////////////////////////////////////////////////////////////////////////////////////////
//-------------------Funcion para limpiar los input del formulario para añadir productos--------------//
///////////////////////////////////////////////////////////////////////////////////////////////////////

    $('#cerrar-add').click(function () {
        $('#codigo').val('');
        $('#codigo-error').html('');
        $('#nombre').val('');
         $('#nombre-error').html('');
        $('#familia').val('');
         $('#familia-error').html('');
        $('#precio').val('');
         $('#precio-error').html('');
        $('#text-area').val('');
         $('#text-area-error').html('');
        $('#stock').val('');
        $('#stock-error').html('');
        $('#resultados-add').html('');
    });
    



//////////////////////////////////////////////////////////////////////////////////////////////////////////
//-------------------Funcion para limpiar el formulario de eliminar productos-------------------------//
/////////////////////////////////////////////////////////////////////////////////////////////////////////

    $('#cerrar-delete').click(function () {
        
        $('#resultados-delete').html('');
    });
  
  //---------------------------------------------------------------------------------------------------//
});//Fin del document.ready                