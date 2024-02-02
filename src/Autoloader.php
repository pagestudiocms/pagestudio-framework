<?php 

namespace Ps\Framework;

/**
 * Autoloader
 *
 * Autoload Base classes with PHP's native autoload.
 *
 * @package			PageStudio
 * @subpackage		Libraries
 * @category		Autoloader
 * @author 			Cosmo Mathieu <cosmo@cosmointeractive.co>
 * @author			Shane Pearson <bubbafoley@gmail.com>
 * @license			http://philsturgeon.co.uk/code/dbad-license
 */
class Autoloader
{
    /**
     * Private static property 
     * @access      private
     * @var         $_instance Store instance of the Autoloader
     */
    private static $_instance = null; 

    public $psr4 = [];

	public $classmap = [];

    protected $legacyNamespace = [];

    public function __construct()
    {
        /**
         * -------------------------------------------------------------------
         * Namespaces
         * -------------------------------------------------------------------
         *
         */
        $psr4 = [];

        /**
         * -------------------------------------------------------------------
         * Classmap
         * -------------------------------------------------------------------
         *
         * e.g. ['App\HealthCheck' => ABSPATH . '/lib/framework/App/HealthCheck.php']
         *
         */
        $classmap = [];
        
        $this->psr4 = array_merge($this->psr4 = $psr4);
        $this->classmap = array_merge($this->classmap = $classmap);
        
        /**
         * -------------------------------------------------------------------
         * Composer Autoloading
         * -------------------------------------------------------------------
         *
         */
        // $composer_autoload = ABSPATH . "vendor/autoload.php";
        // if(file_exists($composer_autoload)) {
		// 	include_once $composer_autoload;
		// }
    }

	// --------------------------------------------------------------------

    /**
     * Creates or grabs an instance of the object 
     * 
     * @return  object 
     */
    public static function getInstance()
    {
        if( ! isset(self::$_instance)) {
            self::$_instance = new Autoloader();
        }
        
        return self::$_instance;
    }

	// --------------------------------------------------------------------

	/**
	 * Autoloader
	 *
	 * Autoload base classes.
	 *
	 * @access public
	 * @param string  the class to load
	 * @return void
	 */
	protected function loadClass($class)
	{
        $classfile = str_replace('\\', '/', $class) . '.php';
        if(class_exists(trim($classfile, '.php'), FALSE)) {
            return;
		}
        
        // First try looking in our mapped namespaces
        if(array_key_exists($class, $this->classmap) && file_exists($this->classmap[$class])) {
            include_once $this->classmap[$class];
            return true;
        }
        
        // No 1-to-1 mapping found, check ps4 namespaces
        foreach ($this->psr4 as $namespace => $directories) {
            // Only run this autoloader if a known namespace prefix exists
            $namespace = str_replace('\\', '/', $namespace);
            if (strpos($classfile, $namespace) === 0) {
    			if (is_string($directories)) {
    				$directories = [$directories];
    			}

                $search = ['./', '../'];
    			foreach ($directories as $directory) {
                    $directory = trim(str_replace($search, '', $directory), '/');
    				if (strpos($classfile, $namespace) === 0) {
                        $filePath = $directory . substr($classfile, strlen($namespace));
                        $filePath = '/' . ltrim($filePath, '/');
                        if (file_exists($filePath)) {
                            include_once $filePath;
                            return true;
                        }
    				}
    			}
            }
		}
        
		// Never found a mapped file
		return false;
	}

    /**
	 * Register
	 *
	 * Register the autoloader function.
	 *
	 * @access public
	 * @param  array  include paths
	 * @return void
	 */
	public function register(array $paths = array())
	{
		$this->psr4 = array_merge($this->psr4, $paths);

        spl_autoload_extensions('.php'); // Only Autoload PHP Files

        spl_autoload_register(array($this, 'loadClass'));
	}
}