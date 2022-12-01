<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Traits;

trait ClassCallableTrait
{
    public static function run()
    {
        $class = get_called_class();
        $object = app($class);

        throw_if(
            !method_exists($object, "call"),
            new \LogicException("Class \"$class\" must have method \"call\".")
        );

        return $object->call(...func_get_args());
    }
}
