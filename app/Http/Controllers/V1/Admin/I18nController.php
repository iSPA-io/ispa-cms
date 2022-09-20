<?php

namespace App\Http\Controllers\V1\Admin;

use JsonException;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class I18nController extends Controller
{
    /**
     * Show language json
     *
     * @param string $version
     * @param string $type
     * @param string $locale
     *
     * @return JsonResponse
     * @throws JsonException
     * @author malayvuong
     * @since 7.0.0 - 2022-09-18, 23:08 ICT
     */
    public function languages(string $version, string $type, string $locale): JsonResponse
    {
        $file = Storage::disk('public')->get("$version/$type/$locale.json");

        if (!is_null($file)) {
            return response()->json(json_decode($file, true, 512, JSON_THROW_ON_ERROR));
        }

        return response()->json([]);
    }
}
