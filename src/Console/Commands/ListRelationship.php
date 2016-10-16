<?php

namespace BW\Console\Commands;

use Illuminate\Console\Command;

class ListRelationship extends Command
{
    //
    protected $description = 'Lista todos os relacionamentos';

    //
    protected $signature = 'bw:list-relationship
                            {--id= : Busca por um determinado ID}';

    //
    public function handle()
    {
        //
        $data = [];
        $id = $this->option('id');
        $results = \BWAdmin::get('relationships')->get($id);

        foreach ($results as $params) {

            //
            unset($params['relationships']);

            //
            $properties = '';
            foreach ($params as $key => $value) {
               $properties .= "{$key}: {$value}\n";
            }

            $data[] = [
                $params['model'],
                $params['name'],
                $properties
            ];
        };

        //
        $this->table(['Model', 'Name', 'All Properties'], $data);
    }
}
