<?php
/**
 * Description of RenderHelpers
 *
 * @author asphyxia
 */
namespace Core;
use Core\Exception as Exception;
use Core\Utils\Logger as Logger;
final class Core {
    public static $errorReporting = E_ALL;
    public static $ROOT = __ROOT__;
    public function __construct(array $options = array()) {
        if (isset($options['errorReporting'])) {
            self::$errorReporting = $options['errorReporting'];
        }
        error_reporting(self::$errorReporting);
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );

        mb_internal_encoding('UTF-8');
        //spl_autoload_register(array(new Autoload(), 'loadClass'));
        
        $e = new Exception();
        set_exception_handler(array($e, 'handleException'));
        set_error_handler(array($e, 'handleError'));
        register_shutdown_function( array( $e, 'captureShutdown' ) );

        if (isset($options['startSession'])) {
            session_start();
        }

        if (isset($_COOKIE['rape']) && $_COOKIE['rape'] == 'misery') {
            Logger::getInstance()->enabled = true;
        }
    }
}
