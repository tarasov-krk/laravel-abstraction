<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Cmd;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

/**
 * Запустить Artisan команду
 */
class ArtisanCmd extends AbstractCmd
{
    /**
     * @param \Illuminate\Console\Command $command
     * @param bool                        $newProcess (Запуск в новом фоновом процессе PHP)
     * @return void
     */
    public function run(Command $command, bool $newProcess = true): void
    {
        $cmd = $command->getName();
        $options = $command->getDefinition()->getOptions();
        foreach ($options as $option) {
            $optionName = $option->getName();
            if (property_exists($command, $optionName)) {
                $cmd .= " --{$option->getName()}={$command->$optionName}";
            }
        }

        if (!$cmd || !is_string($cmd)) {
            logs()->error(__METHOD__ . ": Incorrect Artisan Command [$cmd]");

            return;
        }

        if ($newProcess) {
            $this->execute("php " . base_path("artisan") . " $cmd");
        } else {
            Artisan::call($cmd);
        }
    }
}
