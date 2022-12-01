<?php declare(strict_types=1);

namespace TarasovKrk\LaravelAbstraction\Helpers;

class UrlHelper extends AbstractHelper
{
    public static function link(string|null $url, mixed $title = '', array|string $attributes = ''): string
    {
        if (!$url) {
            return '';
        }

        if (!$title) {
            $title = $url;
        }

        if ($attributes) {
            $attributes = self::parseAttributes($attributes);
        }

        return '<a href="' . $url . '"' . $attributes . '>' . $title . '</a>';
    }

    private static function parseAttributes(array|string $attributes, bool $javascript = false): string
    {
        if (is_string($attributes)) {
            return ($attributes != '') ? ' ' . $attributes : '';
        }

        $att = '';
        foreach ($attributes as $key => $val) {
            if ($javascript) {
                $att .= $key . '=' . $val . ',';
            } else {
                $att .= ' ' . $key . '="' . $val . '"';
            }
        }

        if ($javascript && $att != '') {
            $att = substr($att, 0, -1);
        }

        return $att;
    }
}
