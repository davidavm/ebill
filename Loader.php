<?php
/**
 * Archivo maestro de inclusion de archivos.
 * Se aprovecha de una funcion nueva del PHP que se llama
 * spl_autoload_register. Eso permite hacer una funcion que cargue
 * automaticamente las clases cuando se necesiten. Creo una clase
 * cargadora que tiene metodos a los que le pasan el nombre
 * de la clase que necesito, y el metodo se las arregla para
 * encontrar el archivo e incluirlo. Si no encuentra el archivo,
 * hay que devolver false. Por ultimo, registro esa clase y los
 * metodos como cargadores. Asi, no hace falta hardcodear
 * el path completo del archivo que tengo que incluir, solamente
 * el nombre del directorio donde iria guardado, dependiendo
 * si es parte del modelo o la presentacion.
 *
 * @package rsend
 */

/**
 * Carga de clases de los paquetes
 */
class Loader {
	/**
	 * Carga una clase en un determinado direcotrio.
	 *
	 * @param $folder String directorio de donde cargar clases
	 * @param $class String nombre de la clase a cargar
	 * @return Boolean true si carga clase, false si fallo
	 */
	private static function autoload($folder, $class) {
            if ($class == 'PHPMailer') {
                $filename = 'class.phpmailer' . '.' . EXT_PHP;
            } else {
                $filename = $class . '.' . EXT_PHP;
            }
            $file = $folder . $filename;
            if (file_exists($file) == false) {
                return false;
            }
            include $file;
            return true;
	}

	/**
	 * Cargador del paquete Dominio/Modelo
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function model($class) {
		return Loader::autoload(MODEL_PATH, $class);
	}

	/**
	 * Cargador del paquete Presentacion
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function view($class) {
		return Loader::autoload(VIEW_PATH, $class);
	}

	/**
	 * Cargador del paquete de librerias
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function lib($class) {
		return Loader::autoload(LIBRARY_PATH, $class);
	}

        /**
	 * Cargador del paquete de libreria punkudb
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function libPunkuDb($class) {
		return Loader::autoload(LIBRARY_PUNKUDB, $class);
	}

        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function libPunkuPattern($class) {            
		return Loader::autoload(LIBRARY_PUNKUPATTERN, $class);
	}

        /**
	 * Cargador del paquete de libreria punkumail
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function libPunkuMail($class) {            
		return Loader::autoload(LIBRARY_PUNKUMAIL, $class);
	}        
        
        /**
	 * Cargador del paquete de libreria PHPMailer
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function vendorPhpMailer($class) {            
		return Loader::autoload(VENDOR_PHPMAILER_PATH, $class);
        }
        
        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplication($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION, $class);
	}
     
        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationWarehouse($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_WAREHOUSE, $class);
	}
        
        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationBanks($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_BANKS, $class);
	}
        
        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationClient($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_CLIENT, $class);
	}
        
        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationBuy($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_BUY, $class);
	}
        
        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationConfiguration($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_CONFIGURATION, $class);
	}

        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationBilling($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_BILLING, $class);
	}

         /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationReport($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_REPORT, $class);
	}
        
        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationRRHH($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_RRHH, $class);
	}

        /**
	 * Cargador del paquete de libreria punkupattern
	 *
	 * @param String $class nombre de la clase a cargar
	 * @return Boolean true si puedo cargar la clase. False de lo contrario.
	 */
	public static function modelApplicationSecurity($class) {
		return Loader::autoload(PATH_MODEL_APPLICATION_SECURITY, $class);
	}        
}

?>
