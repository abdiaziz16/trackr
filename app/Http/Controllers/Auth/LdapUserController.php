<?php


namespace App\Http\Controllers\Auth;

use APP\Ldap\User;

use App\Http\Controllers\Controller;

class LdapUserController extends Controller
{
    public function index()
    {
        $users = User::get();

        var_dump('here');die();
        return view('ldap.users.index', ['users' => $users]);
    }
}
