<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response as HttpResponse;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class BaseException extends Exception implements HttpExceptionInterface
{
    protected bool $dontReport = false;
    protected string $attribute = "";
    protected array $detailing;
    protected string $defaultMessage = "";

    public function __construct(
        $message = "",
        $code = HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
        \Throwable $previous = null
    ) {
        $message = $message != "" ? $message : $this->defaultMessage;

        parent::__construct($message, $code, $previous);
    }

    public function getAttribute(): string
    {
        return $this->attribute ?? "";
    }

    public function getDetailing(): array
    {
        return $this->detailing ?? [];
    }

    public function getStatusCode(): int
    {
        return $this->code;
    }

    public function getHeaders(): array
    {
        return [];
    }

    public function report()
    {
        return $this->dontReport;
    }
}
