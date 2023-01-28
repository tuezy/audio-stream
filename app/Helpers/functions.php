<?php

use Carbon\Carbon;

if (!function_exists('format_time')) {
    /**
     * @param Carbon $timestamp
     * @param string $format
     * @return string
     * @deprecated
     */
    function format_time(Carbon $timestamp, string $format = 'j M Y H:i'): string
    {
        return \App\Facades\Core::formatTime($timestamp, $format);
    }
}

if (!function_exists('date_from_database')) {
    /**
     * @param string $time
     * @param string|null $format
     * @return string
     * @deprecated
     */
    function date_from_database(string $time, string $format = 'Y-m-d'): string
    {
        return \App\Facades\Core::formatDate($time, $format);
    }
}

if (!function_exists('human_file_size')) {
    /**
     * @param float $bytes
     * @param int $precision
     * @return string
     * @deprecated
     */
    function human_file_size(float $bytes, int $precision = 2): string
    {
        return \App\Facades\Core::humanFilesize($bytes, $precision);
    }
}

if (!function_exists('get_file_data')) {
    /**
     * @param string $file
     * @param bool $toArray
     * @return array|bool|mixed|null
     * @deprecated
     */
    function get_file_data(string $file, bool $toArray = true)
    {
        return \App\Facades\Core::getFileData($file, $toArray);
    }
}

if (!function_exists('json_encode_prettify')) {
    /**
     * @param array $data
     * @return string
     * @deprecated
     */
    function json_encode_prettify(array $data): string
    {
        return \App\Facades\Core::jsonEncodePrettify($data);
    }
}

if (!function_exists('save_file_data')) {
    /**
     * @param string $path
     * @param array|string $data
     * @param bool $json
     * @return bool
     * @deprecated
     */
    function save_file_data(string $path, $data, bool $json = true): bool
    {
        return \App\Facades\Core::saveFileData($path, $data, $json);
    }
}

if (!function_exists('scan_folder')) {
    /**
     * @param string $path
     * @param array $ignoreFiles
     * @return array
     * @deprecated
     */
    function scan_folder(string $path, array $ignoreFiles = []): array
    {
        return \App\Facades\Core::scanFolder($path, $ignoreFiles);
    }



}

if (!function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        return $default;
    }
}

if (!function_exists('core')) {
    function core(): \App\Helpers\Core
    {
        return app()->make('core');
    }
}
