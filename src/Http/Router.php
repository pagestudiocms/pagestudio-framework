<?php 

namespace Ps\Framework\Http;

use Bramus\Router\Router as BramusRouter;

class Router extends BramusRouter
{
    /**
     * Shorthand for a route accessed using any method.
     *
     * @param string          $pattern A route pattern such as /about/system
     * @param object|callable $fn      The handling function to be executed
     */
    public function all($pattern, $fn)
    {
        if(is_array($pattern)) {
            foreach($pattern as $target) {
                $this->match('GET|POST|PUT|DELETE|OPTIONS|PATCH|HEAD', $target, $fn);
            }
        } else {
            $this->match('GET|POST|PUT|DELETE|OPTIONS|PATCH|HEAD', $pattern, $fn);
        }
    }
}
