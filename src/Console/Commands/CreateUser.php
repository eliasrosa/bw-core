<?php

namespace BW\Console\Commands;

use Illuminate\Console\Command;
use BW\Models\User;
use BW\Models\UserGroup;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bw:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um usuário \'Super Administrador\'';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $this->comment('Entre com os dados do usuário');

        //
        $name = $this->ask('Nome', 'Administrador');
        $email = $this->ask('E-mail', 'admin@admin.com');
        $password = $this->ask('Senha', 'admin');

        //
        $group = UserGroup::where('name', 'Super Administrador')->first();
        if(!$group){
            $group = new UserGroup;
        }

        $group->name = 'Super Administrador';
        $group->description = 'Usuários com permissão total no sistema';
        $group->status = true;
        $group->super_administrator = true;
        $group->save();

        $admin = User::where('email', $email)->first();
        if(!$admin){
            $admin = new User;
        }

        $admin->name = $name;
        $admin->email = $email;
        $admin->password = bcrypt($password);
        $admin->status = true;
        $admin->group_id = $group->id;
        $admin->save();

        //
        $this->table(['Nome', 'E-mail', 'Senha', 'Grupo'], [[
            $admin->name, $admin->email, $password, $group->name
        ]]);

        //
        $this->info('Usuário criado com sucesso!');
    }
}
