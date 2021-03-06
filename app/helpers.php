<?php

/**
 * global function to help organize flash messages with the help of sweetalert
 * @param $message
 * @return mixed
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');

    if(func_num_args() == 0) {
        return $flash;
    }
    return $flash->info($title, $message);
}
