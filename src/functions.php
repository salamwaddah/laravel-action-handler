<?php

use Illuminate\Container\Container;

if (! function_exists('handle')) {

    /**
     * Runs a class handle in the current process.
     *
     * @param mixed $class
     *
     * @return mixed
     */
    function handle($class, string $handler = 'handle')
    {
        $app = Container::getInstance();

        $r = new ReflectionMethod(get_class($class), $handler);

        $args = [];

        $params = $r->getParameters();

        foreach ($params as $param) {
            $args[] = $app->make((string) $param->getType());
        }

        return call_user_func([$class, $handler], ...$args);
    }
}
