<?php
/**
* Class Grupo.
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
* Class Usuario
*
* Implementation of class Usuario.
*
* @category   EBIL
* @package    Model
* @author     Juan Carlos Torrico Rios
* @copyright  2015 Juan Carlos Torrico Rios
* @license    http://creativecommons.org/licenses/by/3.0/legalcode  Creative Commons License Attribution 3.0 Unported
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  0.1 01-01-2015
* @deprecated No
*/
    class Grupo {
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
     const INSERT = "INSERT TABLE GRUPO";
     const UPDATE = "UPDATE TABLE GRUPO";
     const DELETE = "DELETE TABLE GRUPO";
     const SELECT = "SELECT TABLE GRUPO";

     const ROLE_ADMINISTRATOR_DEFAULT = "Administrador"; // Rol Administrator
     const ROLE_ROOT_DEFAULT = "SuperUsuario"; // Rol Super Usuario
     const ROLE_OPERATOR_DEFAULT = "Operador"; // Rol Reportes

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
        public function getList($idGrupo = self::ALL, $idEmpresa = self::ALL, $notInGrupo = self::ALL){
            $result = null;
            $query = null;
            try{
                $query = "	select    pk_id_grupo ,
                                            fk_id_grupo_padre ,
                                            (select gp.grupo
                                                 from grupo gp
                                                 where gp.pk_id_grupo=a.fk_id_grupo_padre
                                                 and gp.estado_registro='A') as grupo_padre,
                                            grupo ,
                                            descripcion ,
                                            fk_id_tipo_grupo ,
                                            (select c.descripcion
                                                 from catalogo c
                                                 where  c.pk_id_catalogo=a.fk_id_tipo_grupo
                                                 and c.catalogo = 'tipo_grupo'
                                                 and c.estado_registro='A') as tipo_grupo,
                                            date_format(fecha_transaccion,'%Y-%m-%d %H:%i-%s')  as fecha_transaccion,
                                            usuario_transaccion ,
                                            estado_registro ,
                                            transaccion_creacion ,
                                            transaccion_modificacion ,
                                            fk_id_empresa 
                                         from grupo a
                                         where estado_registro='A' ";
                
                if( $idGrupo != self::ALL){
                    if( $idEmpresa != self::ALL){
                        if( $notInGrupo != self::ALL){
                        $query = $query." and a.pk_id_grupo = ? and a.fk_id_empresa = ? and a.pk_id_grupo != ? ";
                        $result = DataBase::getArrayListQuery($query, array($idGrupo, $idEmpresa, $notInGrupo), $this->instanceDataBase);
                        } else{
                        $query = $query." and a.pk_id_grupo = ? and a.fk_id_empresa = ? ";
                        $result = DataBase::getArrayListQuery($query, array($idGrupo, $idEmpresa), $this->instanceDataBase);                            
                        }
                    } else{
                        if( $notInGrupo != self::ALL){
                        $query = $query." and a.pk_id_grupo = ? and a.pk_id_grupo != ? ";
                        $result = DataBase::getArrayListQuery($query, array($idGrupo, $notInGrupo), $this->instanceDataBase);                            
                        }else{
                        $query = $query." and a.pk_id_grupo = ?";
                        $result = DataBase::getArrayListQuery($query, array($idGrupo), $this->instanceDataBase);
                        }
                    }                
                } else{
                        if( $idEmpresa != self::ALL){
                            if($notInGrupo != self::ALL){
                            $query = $query." and a.fk_id_empresa = ? and a.pk_id_grupo != ? ";
                            $result = DataBase::getArrayListQuery($query, array($idEmpresa, $notInGrupo), $this->instanceDataBase);
                            } else{
                            $query = $query." and a.fk_id_empresa = ?";
                            $result = DataBase::getArrayListQuery($query, array($idEmpresa), $this->instanceDataBase);
                            }
                        } else{
                            if($notInGrupo != self::ALL){
                            $query = $query." and a.pk_id_grupo != ? ";
                            $result = DataBase::getArrayListQuery($query, array($notInGrupo), $this->instanceDataBase);                                                            
                            }else{
                            $result = DataBase::getArrayListQuery($query,array(), $this->instanceDataBase);
                            }
                        }
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
                          from grupo
                          where estado_registro = 'A' 
                          and ( grupo = ?  )";

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
                  
                $sentencia = $gbd->prepare("call grupo_alta(?,?,?,?,?,?,?,?,@resultado);  ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 

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
                  
                $sentencia = $gbd->prepare("call grupo_baja(?,?,?,?,@resultado);  ");
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
                  
                $sentencia = $gbd->prepare("call grupo_modif(?,?,?,?,?,?,?,?,@resultado); ");
                $sentencia->bindParam(1, $datos[0], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(2, $datos[1], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(3, $datos[2], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(4, $datos[3], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(5, $datos[4], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(6, $datos[5], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(7, $datos[6], PDO::PARAM_STR, 4000); 
                $sentencia->bindParam(8, $datos[7], PDO::PARAM_STR, 4000); 
                        
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
     // }}}
    }
?>
