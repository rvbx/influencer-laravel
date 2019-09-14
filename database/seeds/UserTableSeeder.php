<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nome'=> 'juliano',
            'sobrenome'=> 'juliano',
            'email'=> 'juliano@gmail.com',
            'password'=> 'juliano',
            'CPF'=> 'juliano',
            'CNPJ'=> 'juliano',
            'URL'=> 'juliano',
            'estado'=> 'juliano',
            'genero'=> 'juliano',
            'tipo_cliente'=> 1,
            'id_categoria'=> 1
        ]);
    }
}
