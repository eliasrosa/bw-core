<?php

use BW\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // remove
        Schema::drop('password_resets');

        //
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('status');
            $table->dropColumn('remember_token');
        });

        //
        $admin = new User;
        $admin->name = 'Administrador';
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->rememberToken();
        });

        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
    }
}
