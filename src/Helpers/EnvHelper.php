<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Helpers;

class EnvHelper extends AbstractHelper
{
    public static function isUnitTest(): bool
    {
        return env("APP_ENV") == "testing";
    }

    public static function isLocal(): bool
    {
        return env("APP_ENV") == "development";
    }

    public static function isProduction(): bool
    {
        return env("APP_ENV") == "production";
    }
}
