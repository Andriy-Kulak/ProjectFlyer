<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * defining signedIn and user to be used in confirming who can access flyer and photos features
     * @signedIn
     * @user
     */

    protected $user;

    public function __construct() {

        $this->user = Auth::user();
        view()->share('signedIn', Auth::check());
        view()->share('user', $this->user);
    }

}
