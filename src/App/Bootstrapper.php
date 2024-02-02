<?php 

namespace Ps\Framework\App;

use Ps\Framework\Helpers\PathinfoOption;
use RuntimeException;

class Bootstrapper 
{
    // TODO: Rename map to bind 

    /**
     * @see https://stackoverflow.com/questions/2235173/what-is-the-naming-standard-for-path-components 
     * @var string The tenant application front controller path. 
     */
    private string $tenantAppFrontController;

    public function fetchAppFrontControllerPath(int $pathinfo_flag = PathinfoOption::File):string // fetchAppFrontControllerPath
    {
        try {
            if( ! file_exists($this->tenantAppFrontController)) {
                $errorMessage = 'Unable to bootstrap the application: Unable to locate the tenant application.'; 
                throw new RuntimeException($errorMessage);
            }
                
            if( ! PathinfoOption::isValidValue($pathinfo_flag)) {
                throw new RuntimeException("Invalid front controller path option");
            }
            return pathinfo($this->tenantAppFrontController, $pathinfo_flag);
        } catch(RuntimeException $e) {
            $errorMessage = $e->getMessage();
            // TODO: Log this to the server logs and return header('Location: ./500.html')
            // renderFrameworkExceptionError($errorMessage:string, $httpCode:int = 500); // OR renderExceptionErrorNicely()
        }

        return NULL;
    }
}
