<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Logic\User\UserRepository;
use App\User;

// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Query\Expression;
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
// use Illuminate\Contracts\Auth\Guard;
// use Illuminate\Support\Facades;
// use App\Models\Role;

class ProfilesController extends Controller {


    //use AuthenticatesAndRegistersUsers;
    protected $auth;
    protected $userRepository;

    // RUN VIEW THROUGH AUTH MIDDLWARE
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function show($username)
    {
        try {

            $user = User::with('profile')->wherename($username)->firstOrFail();

            //dd($user->toArray());


        } catch (ModelNotFoundException $e) {

            return view('pages.status')
                ->with('error',\Lang::get('profile.notYourProfile'))
                ->with('error_title',\Lang::get('profile.notYourProfileTitle'));

        }
       return view('profiles.show')->withUser($user);

    }
}