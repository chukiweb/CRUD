<?php
/*
 * I.E.S Aguadulce Curso 2019/2020.
 * Grado Superior De Desarollo De Aplicaciones Web Modalidad A Distancia.
 * Módulo de Desarrollo Web en Entorno Servidor.
 * Profesor: Marín Navarro, Jesús Manuel.
 * Alumno: Eduardo Nicolás Araoz Demarchi.
 * Email: chukiweb@gmail.com.
 */

/**
 * Clase BD que se encarga de la conexion a la misma y el manejo de todas acciones sobre 
 * la BBDD.
 * Inserción de datos.
 * Eliminación de datos.
 * Modificación de los datos
 * Muestra de los datos almacenados.
 * La verificación de los datos de acceso a la BBDD. 
 *
 * @author Eduardo Nicolás Araoz Demarchi.
 */
class DB {

    //Atributos constantes de la clase BD  
    const SERVIDOR = "mysql:host=localhost;dbname=amazonia";
    const USUARIO = "root";
    const PASSWORD = "";
    const OPC = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");

    //---------------Funciones de la clase----------------//
    /**
     * Funcion para conectar con la BBDD
     * @return \PDO 
     */
    protected static function conexion() {
        try {
            $conexion = new PDO(DB::SERVIDOR, DB::USUARIO, DB::PASSWORD, DB::OPC);
            $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET UTF8");
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
        return $conexion;
    }

    
    /**
     * Funcion para relizar consultas a la base de datos
     * @param type $sql Consulta sql
     * @return type PDOStatement con la información de la consulta.
     */
    public static function ejecutaConsulta($sql) {
        $dwes = self::conexion();
        $resultado = null;
        if (isset($dwes)) {
            $resultado = $dwes->query($sql);
        }
        return $resultado;
    } //Fin de ejecutaConsulta.
    
   
    //----------------------------------------------------------------------//

    /**
     * Funcion para insertar movimientos en la base de datos que recibe como parametro
     * un array con los datos a insertar.
     * @param type $datos array con los datos a insertar en la BBDD.
     * @return boolean
     */
    public static function insertarProducto($datos) {

        //Instanciamos las variables con los datos del array que le pasmos por parametro.
        $nombre = $datos['nombre'];
        $codigo = $datos['cod'];
        $descripcion = $datos['descripcion'];
        $pvp = $datos['pvp'];
        $familia = $datos['familia'];
        $stock = $datos['stock'];

        //COmprobamos que la clave primaria no se encuentre en la base de datos
        $sql = "SELECT * FROM producto WHERE cod = '$codigo'";
        $resultado = self::ejecutaConsulta($sql);
        $row = $resultado->rowCount();
        if ($row == 0) {
            //Creamos la consulta.
            $sql = "INSERT INTO producto (cod,nombre,descripcion,PVP, familia, stock) VALUES (?,?,?,?,?,?)";

            //conectamos con la BBDD
            $insercion = self::conexion();
            //Preparamos la consulta.
            $resultado = $insercion->prepare($sql);

            //Ejecutamos la consulta.
            $resultado->execute(array($codigo, $nombre, $descripcion, $pvp, $familia, $stock));


            if ($resultado) {//true
                $ok = true;
            } else {
                $ok = false;
            }
            $resultado->closeCursor();
        } else {
            $ok = false;
            $resultado->closeCursor();
        }
        return $ok;
    }

    /**
     * Funcion para eliminar los movimientos de la Base de Datos que recibe como
     * parametro el codigo de mivimiento.
     * @param type $codigoMov codigo del movimiento a eliminar
     * @return boolean 
     */
    public function eliminarProducto($codigoMov) {
        $ok = false;
        //Creamos la consulta.
        $sql = "DELETE FROM producto WHERE cod = :codigo";

        $insercion = self::conexion();

        $resultado = $insercion->prepare($sql);
        //Ejecutamos la función ejecutaConsulta
        $borrar = $resultado->execute(array(':codigo'=>$codigoMov));
        //Si todo ha ido bien retornamos true.
        if ($borrar) {
            $ok = true; 
        }
        $borrar=null;
        return $ok;
    }
    
    public function actualizarStock($id, $stock) {
        $ok = false;
        //Creamos la consulta.
        $sql = "UPDATE producto SET  stock = :stock WHERE cod= :id";
        //utilizamos la conexion
        $insercion = self::conexion();
        
        $resultado= $insercion->prepare($sql);
        
        $actualizar = $resultado->execute(array(':stock' => $stock, ':id' => $id));
        if ($actualizar) {
            $ok = true;
         
        } 
        $actualizar=null;//Cerramos cursor.   
        return $ok;
    }
    
    
    

    
}
