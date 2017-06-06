<?php

namespace BW\Traits;

trait MagicMethodTrait
{
    //
    private static $MAGIC_METHOD_NO_RETURN = '__MagicMethodTrait::noReturn__';

    //
    public function __get($key)
    {
        foreach (class_uses_recursive(get_called_class()) as $trait) {
            if (method_exists(get_called_class(), $method = '__get'.class_basename($trait))) {
                $exec = call_user_func_array([get_called_class(), $method], [$key]);

                if($exec != self::$MAGIC_METHOD_NO_RETURN){
                    return $exec;
                }
            }
        }

        return parent::__get($key);
    }

    //
    public function __set($name, $value)
    {
        foreach (class_uses_recursive(get_called_class()) as $trait) {
            if (method_exists(get_called_class(), $method = '__set'.class_basename($trait))) {
                $exec = call_user_func_array([get_called_class(), $method], [$name, $value]);

                if($exec != self::$MAGIC_METHOD_NO_RETURN){
                    return $exec;
                }
            }
        }

        return parent::__set($name, $value);
    }

    //
    public function __call($call, $parameters)
    {
        foreach (class_uses_recursive(get_called_class()) as $trait) {
            if (method_exists(get_called_class(), $method = '__call'.class_basename($trait))) {
                $exec = call_user_func_array([get_called_class(), $method], [$call, $parameters]);

                if($exec != self::$MAGIC_METHOD_NO_RETURN){
                    return $exec;
                }
            }
        }

        return parent::__call($call, $parameters);
    }
}
