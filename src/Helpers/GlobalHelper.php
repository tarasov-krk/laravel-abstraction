<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Helpers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class GlobalHelper extends AbstractHelper
{
    /**
     * Convert array keys to snake case recursively.
     */
    public static function snakeKeys(array $array, string $delimiter = '_'): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::snakeKeys($value, $delimiter);
            }
            $result[Str::snake($key, $delimiter)] = $value;
        }

        return $result;
    }

    /**
     * Convert array keys to camel case recursively.
     */
    public static function camelKeys(array $array): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::camelKeys($value);
            }
            $result[Str::camel($key)] = $value;
        }

        return $result;
    }

    /**
     * Быстрый способ сгенерировать строку
     */
    public static function randomString(
        int $length = 16,
        string $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): bool|string {
        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     * Генерирует уникальную строку
     */
    public static function uniqueString(int $length = 10): string
    {
        return substr(md5(uniqid((string)mt_rand(), true)), 0, $length);
    }

    /**
     * Получить уникальный uuid
     */
    public static function randomUuid(): string
    {
        return Uuid::uuid5(Uuid::uuid4(), microtime())->toString();
    }

    /**
     * Получить массив из данных разного типа
     */
    public static function getArrayableItems(mixed $items): array
    {
        if (is_array($items)) {
            return $items;
        } elseif ($items instanceof Enumerable) {
            return $items->all();
        } elseif ($items instanceof Arrayable) {
            return $items->toArray();
        } elseif ($items instanceof Jsonable) {
            return json_decode($items->toJson(), true);
        } elseif ($items instanceof \JsonSerializable) {
            return (array)$items->jsonSerialize();
        } elseif ($items instanceof \Traversable) {
            return iterator_to_array($items);
        }

        return (array)$items;
    }

    /**
     * Преобразовать строку в число
     */
    public static function stringToInt(mixed $val): int
    {
        if (!is_string($val)) {
            return 0;
        }

        return (int)str_replace(" ", "", $val);
    }

    /**
     * Получить корректное значение с поля "Switch"
     */
    public static function getSwitchValue(mixed $value): int
    {
        return ($value === "on" || (int)$value === 1) ? 1 : 0;
    }

    /**
     * Получить ид для сообщения
     */
    public static function getMessageId(string|null $title = '', string|null $description = ''): string
    {
        return md5($title . $description);
    }

    /**
     * Хэшировать пароль
     */
    public static function hashPassword(string $password): string
    {
        return \Hash::make($password);
    }
}
