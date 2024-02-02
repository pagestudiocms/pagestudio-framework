<?php 

namespace Ps\Framework\Middleware;

interface MiddlewareInterface
{
    // public static function register($request, $app);

    public static function handle($request, $app);
}