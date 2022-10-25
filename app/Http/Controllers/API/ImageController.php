<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdImage;

class ImageController extends Controller
{
    public function searchImagesFromAd(Request $request)
    {
        $ad_id = $request->input('ad_id');
        $images = AdImage::select('*')
            ->join('ads', 'ads.id', '=', 'ad_images.ad_id')
            ->join('images', 'images.id', '=', 'ad_images.image_id')
            ->where('ad_id', '=', $ad_id)
            ->get();
        
        return response()->json([
            'count' => count($images),
            'items' => $images
        ]);
    }
}
