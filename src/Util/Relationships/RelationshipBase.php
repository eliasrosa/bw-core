<?php

namespace BW\Util\Relationships;

class RelationshipBase
{
    //
    static $model = null;
    static $validator = null;

    //
    static $manager_menu = false;
    static $manager_menu_icon = null;
    static $manager_menu_title = null;
    static $manager_controller = null;

    //
    static function attach($model, $relation = []){}
    static function detach($model, $relation = []){}
    static function addFormField($form, $field){}
}
