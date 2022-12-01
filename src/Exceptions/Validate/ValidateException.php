<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Validate;

class ValidateException extends BaseException
{
    protected bool $dontReport = true;
}
