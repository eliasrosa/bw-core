<?php

namespace BW\Console\Commands;

use Illuminate\Console\Command;

class ListRelationship extends Command
{
    //
    protected $description = 'Lista todos os relacionamentos';

    //
    protected $signature = 'bw:list-relationship
                            {--id= : Filtra os resultados por ID}';

    //
    public function handle()
    {
        //
        $data = [];
        $id = $this->option('id');
        $results = \BWAdmin::get('relationships')->get($id);

        foreach ($results as $i) {
            $properties  = "ID: {$i['id']}\n";
            $properties .= "Type: {$i['type']}\n";
            $properties .= "Parent: {$i['parent']}\n";

            $data[] = [
                $i['model'],
                $i['name'],
                $properties
            ];
        };

        //
        $this->table(['Model', 'Name', 'Properties'], $data);
    }
}
