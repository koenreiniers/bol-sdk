<?php
namespace Kr\Bol\Enum;

class Enum
{
    /**
     * Return all possible values for an enum
     * @return array
     */
    public static function all()
    {
        $reflection = new \ReflectionClass(static::class);
        $constants = $reflection->getConstants();
        return array_values($constants);
    }
}