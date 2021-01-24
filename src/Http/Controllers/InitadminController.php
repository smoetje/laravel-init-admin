<?php

namespace Smoetje\LaravelInitAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InitadminController extends Controller
{
    public function create()
    {
        if(\App\Models\User::where('is_admin', true)->first()) {
            abort(404);
        }

        $errors = null;

        return view('laravelinitadmin::admin.register', [
            'init_application' => true,
            'checksum' => Hash::make(substr(env("APP_KEY"), -10)),
            'errors' => $errors
        ]);
    }

    public function store(Request $request)
    {
        if(Hash::check(substr(env("APP_KEY"), -10), $request->get('checksum'))) {
            $user = new \App\Actions\Fortify\CreateNewAdmin();
            $userModel = $user->create($request->toArray());
            $userModel->is_admin = true;
            $userModel->save();

            if(\Illuminate\Support\Facades\Auth::attempt($request->only('email', 'password'))){
                return redirect()->route('dashboard');
            }
            return redirect()->route('home');
        }

        abort(404);
    }
}
