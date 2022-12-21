<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Cmd;

/**
 * Class AbstractCmd
 *
 * @package App\Cmd
 */
abstract class AbstractCmd
{
    /**
     * Запустить консольную команду в отдельном (фоновом) процессе php
     *
     * @param string $cmd
     */
    protected function execute(string $cmd): void
    {
        logs()->info(__METHOD__ . ": Run command [$cmd]");

        if (str_starts_with(php_uname(), "Windows")) {
            @pclose(popen("start /B " . $cmd, "r"));
        } else {
            @exec($cmd . " > /dev/null &");
        }

        logs()->debug(__METHOD__ . ": Command is finished [$cmd]");
    }
}
