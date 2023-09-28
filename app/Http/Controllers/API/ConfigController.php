<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Config;

class ConfigController extends Controller
{
    public function getVersion()
    {
        $version = Config::select('version')->first()->version;
        return response()->json(['version' => $version]);;
    }
}
