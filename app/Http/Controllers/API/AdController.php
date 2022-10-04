<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\AdPhone;


class AdController extends Controller
{
    public function index()
    {
        $ads = AdCategory::select('*')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->orderByDesc('ads.id')
            ->get();
        
        return response()->json([
            'count' => count($ads),
            'items' => $ads
        ]);
    }

    public function adPhones()
    {
        $adPhones = AdPhone::select('*')
            ->join('ads', 'ads.id', '=', 'ad_phones.ad_id')
            ->join('phones', 'phones.id', '=', 'ad_phones.phone_id')
            // ->orderByDesc('documents.created_at')
            ->get();
        
        return response()->json([
            'count' => count($adPhones),
            'items' => $adPhones
        ]);
    }

    public function searchAdCategories(Request $request)
    {
        $ad_id = $request->input('ad_id');
        $sac = AdCategory::select('*')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            // ->orderByDesc('documents.created_at')
            ->where('ad_id', '=', $ad_id)
            ->get();
        
        return response()->json([
            'count' => count($sac),
            'items' => $sac
        ]);
    }

    public function searchAdPhones(Request $request)
    {
        $ad_id = $request->input('ad_id');
        $sap = AdPhone::select('*')
            ->join('ads', 'ads.id', '=', 'ad_phones.ad_id')
            ->join('phones', 'phones.id', '=', 'ad_phones.phone_id')
            // ->orderByDesc('documents.created_at')
            ->where('ad_id', '=', $ad_id)
            ->get();
        
        return response()->json([
            'count' => count($sap),
            'items' => $sap
        ]);
    }
    
}
