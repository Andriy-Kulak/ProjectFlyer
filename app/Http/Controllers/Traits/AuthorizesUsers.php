<?php

namespace App\Http\Controllers\Traits;

use App\Flyer;
use Illuminate\Http\Request;


trait AuthorizesUsers {

    /**
     * Check to see if user create the flyer
     *
     * @param Request $request
     * @return mixed
     */
    protected function userCreatedFlyer(Request $request) {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => $this->user->id
        ])->exists();
    }

    /**
     * Unathorized response guard
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|
     * \Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    protected function unathorized(Request $request) {
        if($request->ajax()) {
            return response(['message' => 'No way.'], 403);
        }

        flash('You are not authorized');
        return redirect('/');
    }

}
