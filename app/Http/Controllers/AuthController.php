<?php
 
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        $data = array();

    	return view('home')->with('data', $data);
    }

    public function login(){
        $data = array();

    	return view('login')->with('data', $data);
    }

    public function doLogin(Request $request){
        // $validated = $request->validate([
        //     'username' => ['required', 'username'],
        //     'password' => ['required'],
        // ]);

        $credentials = [
            'name' => $request['username'],
            'password' => $request['password']
        ];
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register(){
        $data = array();

    	return view('register')->with('data', $data);
    }

    public function doRegister(Request $request){
        User::create([
            'name' => $request['username'],
            'email' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->intended('login');
    }

    public function logout(Request $request): RedirectResponse {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}