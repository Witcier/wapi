<?php

namespace App\Models\Traits;

Trait QueryBuilderBindable
{
    public function resolveRouteBinging($value)
    {
        $queryClass = property_exists($this, 'queryClass')
            ? $this->queryClass :
            '\\App\\Http\\Queries\\'.class_basename(self::class).'Query';

        if (!class_exists($queryClass)) {
            return parent::resolveRouteBinging($value);
        }

        return (new $queryClass($this))
            ->where($this->getRouteKeyName(), $value)
            ->first();
    }
}
