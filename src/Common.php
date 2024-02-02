<?php 

/**
 * Procedural helper functions 
 * 
 * @see https://gist.github.com/juliyvchirkov/8f325f9ac534fe736b504b93a1a8b2ce More PHP polyfills
 */

if( ! function_exists('_pr')) {
    /**
     * Print Recursive
     *
     * Simply wraps a var_export() in pre tags for debugging.
     *
     * @param mixed $var
     * @param bool $exit Exit script after print?
     * @return void
     */
    function _pr($var, bool $exit = false, bool $to_json = false) {
        $data = '';
        if( ! empty($var) && $to_json === false) {
            $data = var_export($var, true);
        }
        ob_start();
        if($to_json) {
            header('Content-Type: application/json');
            echo json_encode($var, JSON_PRETTY_PRINT);
            // echo json_encode($var, true);
        } else {
            echo sprintf("<pre>%s</pre>\r\n", $data);
        }
        ob_end_flush();
        if($exit) exit;
    }
}

if ( ! function_exists('str_contains')) {
    /**
     * PHP 7 or lower polyfill 
     * Determine if a string contains a given substring
     *
     * @see https://gist.github.com/juliyvchirkov/8f325f9ac534fe736b504b93a1a8b2ce
     * @param string $haystack
     * @param string $needle
     * @return boolean
     */
    function str_contains(string $haystack, string $needle):bool {
        return ! empty($needle) && mb_strpos($haystack, $needle) !== false;
    }
}
