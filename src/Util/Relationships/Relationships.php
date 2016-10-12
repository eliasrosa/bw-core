<?php

namespace BW\Util\Relationships;

class Relationships {

    //
    private $data;

    //
    public function __construct()
    {
        $this->data = collect();
    }

    //
    public function register($config_key)
    {
        //
        $config = config($config_key, []);
        foreach ($config as $model => $relationships) {
           $this->createCollect($model, null, $relationships);
        }
    }

    //
    public function createCollect($model, $parent, $relationships)
    {

        foreach ($relationships as $name => $params) {

            $type = $this->getTypeClass($params['type']);
            $id = $this->getRelationshipId($model, $name, $type, $parent);

            $data = array_merge($params, [
                'id' => $id,
                'model' => $model,
                'name' => $name,
                'type' => $type,
                'type_model' => $type::$model,
                'parent' => $parent,
                'title' => isset($params['title']) ? $params['title'] : ucfirst($name),
                'validator' => isset($params['validator']) ? $params['validator'] : null,
            ]);

            //
            $this->data->push($data);

            //
            if(isset($params['relationships']) && is_array($params['relationships'])){
                $relationships_child = $params['relationships'];

                if(is_null($parent)){
                    $parent_new = $data['model'] . '::' . $data['name'];
                }else{
                    $parent_new = $parent . '.' . $name;
                }

                //
               $this->createCollect($data['type'], $parent_new, $relationships_child);
            }
        }
    }

    //
    public function getRelationshipId($model, $name, $type, $parent)
    {
        return md5($model . $name . $type . $parent);
    }

    //
    public function getTypeClass($type)
    {

        if(strpos($type, "\\") !== false){
            return $type;
        }else{
            return 'BW\Util\Relationships\\' . $type . '\\' . $type . 'Relationship';
        }
    }

    //
    public function get($filter_id = null)
    {
        if($filter_id){
            return $this->data->where('id', $filter_id);
        }

        return $this->data;
    }

    //
    public function createMenu($model, $parent = null)
    {
        $types = $this->data
                     ->where('model', $model)
                     ->where('parent', $parent)
                     ->groupBy('type');

        $menus = [];
        $types->each(function($relationships, $type) use(&$menus){

            if($type::$manager_menu){
                $m = new \StdClass();
                $m->title = $type::$manager_menu_title;
                $m->icon = $type::$manager_menu_icon;
                $itens = [];

                $relationships->sortBy('title')
                    ->each(function($i,  $k) use(&$itens){
                        $id = $i['id'];
                        $name = $i['name'];

                        $itens[$k] = new \StdClass();
                        $itens[$k]->href = route("bw.relationships.{$id}.index");
                        $itens[$k]->title = $i['title'];
                    });

                $m->itens = $itens;

                //
                $menus[] = $m;
            }
        });

        return $menus;
    }
}
