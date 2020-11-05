<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Prueba usuario 1',
            'email'=>'correo@correo.com',
            'password'=>Hash::make('12345678'),
            'url'=>'www.upv.com',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
        	'name'=>'Beatriz Hdz',
        	'email'=>'correo1@correo.com',
        	'password'=>Hash::make('12345678'),
        	'url'=>'www.upv.com',
        	'created_at'=>date('Y-m-d H:i:s'),
        	'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
        	'name'=>'Mariana',
        	'email'=>'correo2@correo.com',
        	'password'=>Hash::make('12345678'),
        	'url'=>'www.upv.com',
        	'created_at'=>date('Y-m-d H:i:s'),
        	'updated_at'=>date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
        	'name'=>'Humberto',
        	'email'=>'correo3@correo.com',
        	'password'=>Hash::make('12345678'),
        	'url'=>'www.upv.com',
        	'created_at'=>date('Y-m-d H:i:s'),
        	'updated_at'=>date('Y-m-d H:i:s'),
        ]);
    }
}
