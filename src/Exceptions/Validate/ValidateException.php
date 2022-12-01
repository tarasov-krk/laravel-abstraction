<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Exceptions\Validate;

use TarasovKrk\LaravelAbstraction\Exceptions\BaseException;

class ValidateException extends BaseException
{
    protected bool $dontReport = true;
}
