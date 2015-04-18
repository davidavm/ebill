<?php
/**
* Class Archivo.
*
* Implementation of the class Usuario.
*
* PHP version >= 5.1
*
* @category     FrameworkPunkuPHP
* @package      Model
* @author       Juan Carlos Torrico Rios
* @copyright    2015 Juan Carlos Torrico Rios
* @license      http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version      1.0
* @link         None
* @see          None
* @since        Available from the version  0.1 01-01-2015
* @deprecated   No
*/

/**
* Class Archivo
*
* Implementation of class Usuario.
*
* @category   EBIL
* @package    Model
* @author     Luis Juan Carlos Torrico Rios
* @copyright  2015 Juan Carlos Torrico Rios
* @license    http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  0.1 01-01-2015
* @deprecated No
*/
    class Archivo {
     // {{{ Constants

    /**
     * Constant for represent all registers.
     *
     * @access private
     */
     const ALL = -1;
     const VALUE = 1;
     const NONE = 0;
     // Operations
     const INSERT = "INSERT TABLE ARCHIVO";
     const UPDATE = "UPDATE TABLE ARCHIVO";
     const DELETE = "DELETE TABLE ARCHIVO";
     const SELECT = "SELECT TABLE ARCHIVO";

     const ROLE_ADMINISTRATOR_DEFAULT = "Administrador"; // Rol Administrator
     const ROLE_ROOT_DEFAULT = "SuperUsuario"; // Rol Super Usuario
     const ROLE_OPERATOR_DEFAULT = "Operador"; // Rol Reportes

     // Upload files
     const SIZE_UPLOAD_FILE = 3000000; // Tamaño Max. del archivo subido
     private $TYPE_UPLOAD_IMAGE_FILE = array("img1"=>"image/jpg", "img2"=>"image/jpeg", "img3"=>"image/gif", "img4"=>"image/png"); // tipos de imagen permitidos
     private $TYPE_UPLOAD_PDF_FILE = array("pdf1"=>"application/pdf"); //pdf
     private $TYPE_UPLOAD_CSV_FILE = array("csv1"=>"text/csv"); //csv
     private $TYPE_UPLOAD_EXCEL_FILE = array("excel1"=>"application/vnd.ms-excel"); //excel
     private $TYPE_UPLOAD_TEXT_FILE = array("txt1"=>"text/plain"); //texto    
    // }}}

    // {{{ atributos

    /**
     * Variable instance Data Base.
     *
     * @var DataBase
     * @access private
     */
        private  $instanceDataBase;
    // }}}

    // {{{ constructores

    /**
     * This is construct base of the class.
     *
     * A public constructor; initializes the variable $instanceDataBase.
     *
     */
        public function __construct( $instanceDataBase ) {
            $this->instanceDataBase = $instanceDataBase;
        }
    // }}}

    // {{{ metodos


    /**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function getList($idArchivo = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = " 	
                         select 
                                `pk_id_archivo` ,
                                `nombre` ,
                                `extension` ,
                                `bytes` ,
                                `ruta` ,
                                `ruta2` ,
                                `fk_id_tipo_archivo` ,
                                date_format(`fecha_transaccion`,'%Y-%m-%d %H:%i-%s')  as fecha_transaccion,                                     
                                `usuario_transaccion` ,
                                `estado_registro`,
                                `transaccion_creacion` ,
                                `transaccion_modificacion` ,
                                `fk_id_empresa`
                                from archivo
                                where `estado_registro`='A'
                                ";

                if( $idArchivo != self::ALL){
                $query = $query." and a.pk_id_archivo = ?";
                $result = DataBase::getArrayListQuery($query, array($idArchivo), $this->instanceDataBase);
                }
                else{
                $result = DataBase::getArrayListQuery($query,array(), $this->instanceDataBase);
                }
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }

        
        /**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function isExist( $dato ){
            $result = false;
            $query = NULL;
            $aux = NULL;
            try{
                $query = "select count(1) existe
                          from archivo
                          where estado_registro = 'A' 
                          and ( nombre = ?  )";

                $resultAux = DataBase::getArrayListQuery($query, $dato, $this->instanceDataBase);
                $aux = $resultAux[0];
                $result = $aux["existe"]==0 ? false : true;
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }
        
        
    /**
     * The implementation method for insert data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function insert($datos){
          
            try{
                $id=-1;        
        
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call archivo_alta(?,?,?,?,?,?,?,?,?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(9, $datos[8], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(10, $datos[9], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(11, $datos[10], PDO::PARAM_STR, 4000); 
                
                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                 $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0)
                   $id = $result[0]['resultado'];
                return $id;
            }
            catch(PDOException $e){
                throw $e;
            }           
        }

     /**
     * The implementation method for delete data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function delete($datos){
        
            try{
              $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call archivo_baja(?,?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000);  
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                  $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0)
                   $id = $result[0]['resultado'];
                return $id;
            }
            catch(PDOException $e){
                throw $e;
            }              
        }

     /**
     * The implementation method for update data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function update($datos){
           
            try{
                $id=-1;                       
         
                $gbd=$this->instanceDataBase;
                  
                $sentencia = $gbd->prepare("call archivo_modif(?,?,?,?,?,?,?,?,?,?,?,@resultado); ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(9, $datos[8], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(10, $datos[9], PDO::PARAM_STR, 4000);
                $sentencia->bindParam(11, $datos[10], PDO::PARAM_STR, 4000);
               
                // llamar al procedimiento almacenado
                $sentencia->execute();
               
                  $query = "select @resultado as resultado";
                $result = DataBase::getArrayListQuery($query, array(),$this->instanceDataBase);                                 
                
                if(count($result)>0)
                   $id = $result[0]['resultado'];
                
                return $id;
            }
            catch(PDOException $e){
                throw $e;
            }              
        }

     /**
     * The implementation method for update data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function uploadImage($ufile, $uroute, $uNameColumn, $uTransaction, $uUser, $uCompany , $usize = self::SIZE_UPLOAD_FILE, $uType = 452 ) {
        $resultado = -1;
        try {
            //comprobamos si ha ocurrido un error.
            if ($ufile[$uNameColumn]["error"] > 0) {
                throw new Exception("Ha ocurrido un error al querer subir el archivo.");
            } else {
                // verificar que el archivo no exceda el tamaño de usize y los archivos subidos sean permitidos
                if (in_array($ufile[$uNameColumn]['type'], $this->TYPE_UPLOAD_IMAGE_FILE) && $ufile[$uNameColumn]['size'] <= $usize ) {
                    //esta es la ruta donde copiaremos los archivos
                    $tmpName = $this->randomNameFile();
                    $rutaNombre = $uroute . $tmpName;
                        //aqui movemos el archivo desde la ruta temporal a nuestra ruta
                        //usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
                        //almacenara true o false
                        $resultadoUpload = @move_uploaded_file($ufile[$uNameColumn]["tmp_name"], $rutaNombre);
                        if ($resultadoUpload) {
                            // Ingresar a la BD
                            $nombre = $ufile[$uNameColumn]['name'];
                            $mime = $ufile[$uNameColumn]['type'];
                            $extensionAux = explode('image/', $mime);
                            $extension = $extensionAux[1];
                            $tamanio = $ufile[$uNameColumn]['size'];
                            $datos = array($nombre, $extension, $tamanio, $mime, $uroute, $rutaNombre, $uType, $uUser, $uTransaction, $uTransaction, $uCompany);
                            $idImage = $this->insert($datos);
                            if($idImage > 0 ){
                            // Se renombra el archivo con el ID_ARCHIVO + ID_EMPRESA
                            $nameFileEnd = $uCompany."_".$idImage.".".$extension;
                            rename($rutaNombre, $uroute.$nameFileEnd);
                            $resultado = $idImage;                            
                            } else{
                              throw new Exception("Ha ocurrido un error al ingresar el dato de archivo a la Base de Datos.");
                            }                            
                        } else {
                            throw new Exception( "Ocurrio un error al mover el archivo. Codigo: ".$ufile[$uNameColumn]['error']);
                        }

                } else {
                    throw new Exception("Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $usize bytes.");
                }
            }
        } catch (PDOException $e) {
            throw $e;
        }
        return $resultado;    
    }

     /**
     * The implementation method for update data to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function randomNameFile() {
            $resultado = "";
            try {
                $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                for ($i = 0; $i < 16; $i++) {
                    $resultado = $resultado . substr($str, rand(0, 62), 1);
                }
            } catch (PDOException $e) {
                throw $e;
            }
            return $resultado;
        }

        /**
     * The implementation method for query to the instance data Base.
     *
     * @throws None.
     *
     * @access     public
     * @static     No.
     * @see        None.
     * @since      Available from the version  1.0 01-01-2015.
     * @deprecated No.
     */
        public function getIdFile($Archivo){
            $result = null;
            $query = null;
           
            try{
                $query = " 	
                         select 
                                `pk_id_archivo` ,
                                `nombre` ,
                                `extension` ,
                                `bytes` ,
                                `ruta` ,
                                `ruta2` ,
                                `fk_id_tipo_archivo` ,
                                date_format(`fecha_transaccion`,'%Y-%m-%d %H:%i-%s')  as fecha_transaccion,                                     
                                `usuario_transaccion` ,
                                `estado_registro`,
                                `transaccion_creacion` ,
                                `transaccion_modificacion` ,
                                `fk_id_empresa`
                                from archivo
                                where `estado_registro`='A'
                                ";

                if( $Archivo != self::ALL){
                $query = $query." and concat(ruta,'/',nombre) = ? ";
                $result = DataBase::getArrayListQuery($query, array($Archivo), $this->instanceDataBase);
                }
                else{
                $result = DataBase::getArrayListQuery($query,array(), $this->instanceDataBase);
                }
                return $result;
            }
            catch(PDOException $e){
                throw $e;
            }            
        }
        
    // }}}
    }
?>


