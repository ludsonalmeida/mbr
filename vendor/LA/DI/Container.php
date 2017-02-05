<?php

namespace LA\DI;

use App\Conn;

class Container
{
    public static function getModel($model){
        $class = "\\App\\Models\\".ucfirst($model);
        return new $class(Conn::getDb());
    }

    public static function getCrud($crud){
        $class = "\\LA\\Model\\".ucfirst($crud);
        return new $class(Conn::getDb());
    }
}