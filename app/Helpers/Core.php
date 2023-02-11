<?php

namespace App\Helpers;

use App\Models\Image;
use App\Repository\Images\ImageRepositoryContract;
use App\Repository\Settings\SettingRepositoryContract;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class Core
{
    protected $settingRepository;
    protected $imageRepository;

    public function __construct()
    {
        $this->settingRepository = app(SettingRepositoryContract::class);
        $this->imageRepository = app(ImageRepositoryContract::class);
    }

    /**
     * @param Carbon $timestamp
     * @param string|null $format
     * @return string
     */
    public function formatTime(Carbon $timestamp, ?string $format = 'j M Y H:i'): string
    {
        $first = Carbon::create(0000, 0, 0, 00, 00, 00);

        if ($timestamp->lte($first)) {
            return '';
        }

        return $timestamp->format($format);
    }

    /**
     * @param string|null $date
     * @param string|null $format
     * @return string
     */
    public function formatDate(?string $date, ?string $format = null): ?string
    {
        if (empty($format)) {
            $format = config('core.base.general.date_format.date');
        }

        if (empty($date)) {
            return $date;
        }

        return $this->formatTime(Carbon::parse($date), $format);
    }

    /**
     * @param string|null $date
     * @param string|null $format
     * @return string
     */
    public function formatDateTime(?string $date, string $format = null): ?string
    {
        if (empty($format)) {
            $format = config('core.base.general.date_format.date_time');
        }

        if (empty($date)) {
            return $date;
        }

        return $this->formatTime(Carbon::parse($date), $format);
    }

    /**
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    public function humanFilesize(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'kB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return number_format($bytes, $precision, ',', '.') . ' ' . $units[$pow];
    }

    /**
     * @param string $file
     * @param bool $convertToArray
     * @return array|bool|mixed|null
     * @throws FileNotFoundException
     */
    public function getFileData(string $file, bool $convertToArray = true)
    {
        $file = File::get($file);
        if (!empty($file)) {
            if ($convertToArray) {
                return json_decode($file, true);
            }

            return $file;
        }

        if (!$convertToArray) {
            return null;
        }

        return [];
    }

    /**
     * @param string $path
     * @param string|array $data
     * @param bool $json
     * @return bool
     */
    public function saveFileData(string $path, $data, bool $json = true): bool
    {
        try {
            if ($json) {
                $data = $this->jsonEncodePrettify($data);
            }

            if (!File::isDirectory(File::dirname($path))) {
                File::makeDirectory(File::dirname($path), 493, true);
            }

            File::put($path, $data);

            return true;
        } catch (Exception $exception) {
            info($exception->getMessage());
            return false;
        }
    }

    /**
     * @param array|string $data
     * @return string
     */
    public function jsonEncodePrettify($data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param string $path
     * @param array $ignoreFiles
     * @return array
     */
    public function scanFolder(string $path, array $ignoreFiles = []): array
    {
        try {
            if (File::isDirectory($path)) {
                $data = array_diff(scandir($path), array_merge(['.', '..', '.DS_Store'], $ignoreFiles));
                natsort($data);
                return $data;
            }

            return [];
        } catch (Exception $exception) {
            return [];
        }
    }


    /**
     * @return string
     */
    public function getRichEditor(): string
    {
        return setting('rich_editor', config('core.base.general.editor.primary'));
    }

    /**
     * @param string|null $url
     * @param string|array $key
     * @return false|string
     */
    public function removeQueryStringVars(?string $url, $key)
    {
        if (!is_array($key)) {
            $key = [$key];
        }

        foreach ($key as $item) {
            $url = preg_replace('/(.*)(?|&)' . $item . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
            $url = substr($url, 0, -1);
        }

        return $url;
    }

    public function getSetting(string $key, $default = null){

       $result = Cache::get("settings")[$key] ?? null;
       if(is_null($result)){
           $setting = $this->settingRepository->where('key', '=', $key)->first();
           if(isset($setting->value))
               return $setting->value;
       }
       return $result;
    }

    public function image($type){
        return $this->imageRepository->where('type', '=', 'logo')->first();
    }
    public function logo(){
        return $this->image('logo')->path;
    }
}
