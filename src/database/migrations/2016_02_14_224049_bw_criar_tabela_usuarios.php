<?php

use BW\Models\Usuario;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BwCriarTabelaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('bw_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->boolean('status');
            $table->rememberToken();
            $table->timestamps();
        });

        //
        $admin = new Usuario;
        $admin->nome = 'Administrador';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin');
        $admin->status = true;
        $admin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bw_usuarios');
    }
}
