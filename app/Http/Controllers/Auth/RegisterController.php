<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['string', 'max:255'],
            'sobrenome' => ['string', 'max:255'],
            'cpf' => ['string', 'min:11', 'unique:users'],
            'cnpj' => ['string', 'min:14', 'unique:users'],
            'url' => ['string', 'max:255'],
            'contato' =>['string', 'min:11' ],
            'seguidores' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255', 'unique:users'],
            'password' => ['string', 'min:8', 'confirmed'],


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        if ($data['tipo_cliente'] == 'influencer' ) {

            return User::create([
                'nome' => $data['name'],
                'sobrenome'=> $data['sobrenome'],
                'cpf'=> $data['cpf'],
                'url'=> $data['url'],
                'seguidores'=> $data['seguidores'],
                'contato'=>$data['contato'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'tipo_cliente'=>$data['tipo_cliente'],
            ]);
        } else if ($data['tipo_cliente'] == 'marca' ) {
            
            return User::create([
                'nome' => $data['name'],
                'cnpj' => $data['cnpj'],
                'contato'=>$data['contato'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'tipo_cliente'=>$data['tipo_cliente'],
            ]);
        }
    }
}
