<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\AdCategory;
use App\Models\AdPhone;


class AdController extends Controller
{
    public function index()
    {
        $ads = AdCategory::select('*', 'ads.created_at as ads_created_at')
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
    
    public function searchMapFromAd(Request $request)
    {
        $map = Ad::select('*')
            ->where('id', '=', $request->input('ad_id'))
            ->whereNotNull('latitude')
            ->get();
        
        return response()->json([
            'count' => count($map),
            'items' => $map,
        ]);
    }

    public function getRents(Request $request)
    {
        $rents = AdCategory::select('*')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            // ->orderByDesc('documents.created_at')
            ->where('category_id', '=', $request->input('category_id'))
            ->get();
        
        return response()->json([
            'count' => count($rents),
            'items' => $rents
        ]);
    }

    public function getRentsWithLocation(Request $request)
    {
        $rentsWithLocation = AdCategory::select('*', 'ads.created_at as date')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->whereNotNull('latitude')
            ->where('category_id', '=', $request->input('category_id'))
            ->get();
        
        return response()->json([
            'count' => count($rentsWithLocation),
            'items' => $rentsWithLocation
        ]);
    }

    public function getAdsFromCategory(Request $request)
    {
        $needs = AdCategory::select('*', 'ads.created_at as date')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->where('category_id', '=', $request->input('category_id'))
            ->get();

            return response()->json([
                'count' => count($needs),
                'items' => $needs
            ]);
    }
}
