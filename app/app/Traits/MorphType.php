<?php

namespace App\Traits;

trait MorphType
{
    protected static function bootMorphType()
    {
        static::creating(function ($model) {
            $class = class_basename(static::class);
            if ($class !== "Personne") {
                $model->type = $class;
            }else{
                $model->type = "Responsable";
            }
        });
    }
}
