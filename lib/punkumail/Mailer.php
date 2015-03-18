<?php
/**
* Code class Mailer for the framework "PUNKUPHP".
*
* Code base for the Mailer implementation on the framework "PUNTOPHP".
*
* PHP version >= 5.1
*
* @category     FrameworkPUNKUPHP
* @package      Mailer
* @author       Luis Fernando Almendras Aruzamen
* @copyright    2007 Luis Fernando Almendras Aruzamen
* @license      http://www.php.net/license/3_0.txt  PHP License 3.0
* @version      1.0
* @link         None
* @see          None
* @since        Available from the version  1.0 20-09-2007
* @deprecated   No
*/

/**
* Class Mailer
*
* Implementation of class Mailer.
*
* @category   FrameworkPUNKUPHP
* @package    Mailer
* @author     Luis Fernando Almendras Aruzamen
* @copyright  2007 Luis Fernando Almendras Aruzamen
* @license    http://www.php.net/license/3_0.txt  PHP License 3.0
* @version    1.0
* @link       None
* @see        None
* @since      Available from the version  1.0 20-09-2007
* @deprecated No
*/

    Class Mailer {
     // {{{ Constants

    /**
     * Constant for represent all registers.
     *
     * @access protected
     */
     //const ALL = -1;
    // }}}
    
    // {{{ atributos

    /**
     * Variable configuration.
     *
     * @var Registry
     * @access private
     */
     private $port;
     private $host;
     private $userName;
     private $password;
     private $from;
     private $fromName;
          
     // }}}

    // {{{ constructores

    /**
     * This is construct base of the class.
     *
     * This constructor initiality variable $registry.
     *
     */
    public function __construct( $data ) {
            $this->port = $data['port'];
            $this->host = $data['host'];
            $this->userName = $data['userName'];
            $this->password = $data['password'];
            $this->from = $data['from'];
            $this->fromName = $data['fromName'];

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
     * @since      Available from the version  1.0 01-01-2013.
     * @deprecated No.
     */
        public function sendMailHtml($contentMail, $subjectMail, $toMail = array(), $toMailCC = array(), $toMailBCC = array()){
            $result = null;
            try {
            $mail = new PHPMailer(true); //New instance, with exceptions enabled

            $body             = $contentMail;            
            $body             = preg_replace('/\\\\/','', $body); //Strip backslashes             
            $mail->IsSMTP();                           // tell the class to use SMTP
            $mail->SMTPAuth   = true;                  // enable SMTP authentication
            $mail->Port       = $this->port;                    // set the SMTP server port
            $mail->Host       = $this->host; // SMTP server
            $mail->Username   = $this->userName;     // SMTP server username
            $mail->Password   = $this->password;            // SMTP server password	

            $mail->AddReplyTo($this->from,$this->fromName);

            $mail->From       = $this->from;
            $mail->FromName   = $this->fromName;
            
            // Mail destination.
            foreach($toMail as $mailDestination){
            $mail->AddAddress($mailDestination);
            }

            // Mail destination CC.
            foreach($toMailCC as $mailDestination){
            $mail->AddCC($mailDestination);
            }
            
            // Mail destination BCC.
            foreach($toMailBCC as $mailDestination){
            $mail->AddBCC($mailDestination);
            }
            
            $mail->Subject  = $subjectMail;

            $mail->AltBody    = "Para ver el mensaje correctamente favor usar un visor de correo electronico compatible con HTML"; // optional, comment out and test
            $mail->WordWrap   = 80; // set word wrap
            $mail->MsgHTML($body);
            $mail->IsHTML(true); // send as HTML
            $mail->Send();
            
            return true;

            }
            catch(phpmailerException $e){
                echo 'Error JF-Mail-0011: '.$e->errorMessage();
                return false;
            }
            
        }
    // }}}

    }
?>
