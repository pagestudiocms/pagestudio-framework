<?php 

namespace Ps\Framework\Boot;

use Exception;
use Ps\Framework\Autoloader;
use Ps\Framework\Exception\RuntimeException;
use Ps\Framework\Http\Router;
use Ps\Framework\Helpers\PathinfoOption;

/** 
 * 
 */
class Kernel
{
    private static $instance; 

    /** @var object Instance of Router */
    private $router; 

    private $frontControllerPath; 

    public function __construct()
    {
        $this->router = new Router();
    }

    /** 
     * Pre-flight checks - and instanciation of the Kernel class 
     */ 
    public static function bootstrap()
    {
        if( ! isset(self::$instance)) {
            self::$instance = new Kernel();
        }
        return self::$instance;
    }

    /**
     * Set default routes and 404 handler 
     * @return void
     */
    private function boot()
    {
        $this->router->set404(function() {
            header('HTTP/1.1 404 Not Found');
            _pr('No default routes found. Not sure which application to run.', 1);
            // $this->show404('No default routes found. Not sure which application to run.');
            // Framework\App\Views\View::render($viewName, $data);
            // Framework\Views\View::showErrorMessage($errorMessage, $httpCode);
        });
    }

    /**
     * Register PSR-0 autoloader
     */
    public static function registerAutoloader(array $map = [])
    {
        require_once dirname(__DIR__, 1) . "/bootstrap.php";

        $autoloader = Autoloader::getInstance();
        $autoloader->register(array_merge([
            'CodeIgniter' => ABSPATH . 'vendor/codeigniter4/framework/system/',
            'Framework' => FRAMEWORK_BASEPATH,
            'Ps\Framework' => FRAMEWORK_BASEPATH,
        ], $map));
    }
    
    public function before($methods, $pattern, $fn)
    {
        $this->router->before($methods, $pattern, $fn);
    }

    public function map($pattern, $fn)
    {
        $this->router->all($pattern, $fn);
    }

    public function run()
    {
        $this->boot();
        $this->router->run();
    }

    public function getFrontControllerPath(int $pathOption = PathinfoOption::File) 
    {
        switch($pathOption) {
            case PathinfoOption::File:
                return $this->frontControllerPath;
            break;
            default:
                return pathinfo($this->frontControllerPath, $pathOption);
        }
    } // Replaces ::getIndex()

    public function setFrontControllerPath(string $path) 
    { 
        try {
            if( ! file_exists($path)) 
                throw new RuntimeException(sprintf("Front controller %s does not exist.", $path));

            $this->frontControllerPath = $path;
        } catch(RuntimeException $e) {
            _pr($e->getMessage(), 1);
        } catch(Exception $e) {
            _pr($e->getMessage(), 1);
        }
    } // Replaces ::setIndex()
}