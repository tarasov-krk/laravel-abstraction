<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class JobAction implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $arguments;

    public function __construct(...$arguments)
    {
        $this->arguments = $arguments;
    }

    public function handle()
    {
        $this->run(...$this->arguments);
    }
}
