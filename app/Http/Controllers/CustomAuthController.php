<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
      
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('boutique')
                        ->withSuccess('Signed in');
        }
  
        return redirect("/")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }
      
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("boutique")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    
    public function indexAccess()
    {
        if(Auth::check()){
            return view('products.index');
        }
  
        return redirect("/")->withSuccess('You are not allowed to access');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return redirect('/');
    }
}