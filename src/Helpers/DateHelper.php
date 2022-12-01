<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Helpers;

use Carbon\Carbon;

class DateHelper extends AbstractHelper
{
    const FORMAT_DEFAULT = 'Y-m-d H:i:s';
    const FORMAT_RUSSIAN = 'd.m.Y H:i:s';
    const FORMAT_DATE = 'd.m.Y';

    /**
     * Получить текущую дату в отформатированной строке
     */
    public static function nowString(
        \DateTimeZone|string|null $tz = null,
        string $format = self::FORMAT_DEFAULT
    ): string {
        return Carbon::now($tz)->format($format);
    }

    /**
     * Вывести дату в заданном формате
     */
    public static function format(
        string|int|\DateTimeInterface|null $date,
        string $format = self::FORMAT_DEFAULT
    ): string {
        return $date ? Carbon::parse($date)->format($format) : "";
    }
}
