<?php

/**
 * Redirect helper function.
 */
if ( ! function_exists('redirect')) {
    function redirect(string $target = '/')
    {
        header("Location: $target");
        die;
    }
}