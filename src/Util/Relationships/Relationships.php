<?php

namespace BW\Util\Relationships;

class Relationships {

    //
    private $data;
    private $models;

    //
    public function __construct()
    {
        $this->data = collect();
        $this->models = [];
    }

    //
    public function register($config_key)
    {
        //
        $config = config($config_key, []);
        foreach ($config as $model => $params) {
            $this->createCollect($model, null, $params['relationships']);

            //
            unset($params['relationships']);

            //
            $this->models[$model] = $params;
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
                'validator' => isset($params['validator']) ? $params['validator'] : $type::$validator,
            ]);

            //
            $this->data->push($data);

            //
            if(isset($params['relationships']) && is_array($params['relationships'])){
                $relationships_child = $params['relationships'];
                $parent_new = $id;

                //
               $this->createCollect($data['type_model'], $parent_new, $relationships_child);
            }
        }
    }

    //
    public function getRelationshipId($model, $name, $type, $parent)
    {
        return md5($model . $name . $type . $parent);
    }

    //
    public function getTypeClass($class)
    {
        return config('bw.relationships.' . $class, false) ?: $class;
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
                        $itens[$k] = new \StdClass();
                        $itens[$k]->href = route('bw.relationships.listing.index', [
                            'relation_id' => $i['id']
                        ]);
                        $itens[$k]->title = $i['title'];
                    });

                $m->itens = $itens;

                //
                $menus[] = $m;
            }
        });

        return $menus;
    }

    //
    public function getModel($model)
    {
        return $this->models[$model];
    }
}
