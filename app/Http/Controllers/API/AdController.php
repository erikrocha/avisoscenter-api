<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Phone;
use App\Models\Image;
use App\Models\AdCategory;
use App\Models\AdPhone;
use App\Models\AdImage;
use DB;


class AdController extends Controller
{
    /* frm_all */
    public function getAllAds()
    {
        $ads = AdCategory::select('*', 'categories.name as category_name', 'types.name as type_name', 'ads.created_at as date', )
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'ads.type_id', '=', 'types.id')
            ->where('ads.status', '=', 1)
            ->orderByDesc('ads.condition')
            ->orderByDesc('ads.created_at')
            ->get();
        
        return response()->json([
            'count' => count($ads),
            'items' => $ads
        ]);
    }

    /* frm_ad_details */
    public function getAdFromId(Request $request)
    {
        $ads = Ad::select('*', 
                'ads.id as ad_id',
                'ads.created_at as date',
                'types.name as type_name')
            ->leftJoin('types', 'ads.type_id', '=', 'types.id')
            ->where('ads.status', '=', 1)
            ->where('ads.id', '=', $request->input('ad_id'))
            ->orderByDesc('ads.created_at')
            ->first();
        
        $count = ($ads !== null) ? 1 : 0;            
        return $ads;
    }

    /* frm_rents : show in lsv_ads */    
    public function getRents()
    {
        $rents = AdCategory::select(
                '*', 
                'categories.name as category_name',
                'types.name as type_name',
                'ads.created_at as date')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'types.id', '=', 'ads.type_id')
            ->where('ads.status', '=', 1)
            ->where('category_id', '=', 2)
            ->orderByDesc('ads.condition')
            ->orderByDesc('ads.created_at')
            ->get();
        
        return response()->json([
            'count' => count($rents),
            'items' => $rents
        ]);
    }
    
    /* frm_rents : show in mav_map*/
    public function getRentsWithLocation()
    {
        $rentsWithLocation = AdCategory::select(
                '*', 
                'categories.name as category_name',
                'types.name as type_name',
                'ads.created_at as date')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'types.id', '=', 'ads.type_id')
            ->whereNotNull('latitude')
            ->where('categories.name', '=', 'ALQUILO')
            ->get();
        
        return response()->json([
            'count' => count($rentsWithLocation),
            'items' => $rentsWithLocation
        ]);
    }
    
    /* frm_ads_from_category */
    public function getAdsFromCategory(Request $request)
    {
        $needs = AdCategory::select(
                '*', 
                'categories.name as category_name',
                'types.name as type_name',
                'ads.created_at as date')
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'types.id', '=', 'ads.type_id')
            ->where('category_id', '=', $request->input('category_id'))
            ->where('ads.status', '=', 1)
            ->orderByDesc('ads.condition')
            ->orderByDesc('ads.created_at')
            ->get();

            return response()->json([
                'count' => count($needs),
                'items' => $needs
            ]);
    }


    // public function adPhones()
    // {
    //     $adPhones = AdPhone::select('*')
    //         ->join('ads', 'ads.id', '=', 'ad_phones.ad_id')
    //         ->join('phones', 'phones.id', '=', 'ad_phones.phone_id')
    //         // ->orderByDesc('documents.created_at')
    //         ->get();
        
    //     return response()->json([
    //         'count' => count($adPhones),
    //         'items' => $adPhones
    //     ]);
    // }

    /* search a ad from ad_id */
    // public function getAdCategories(Request $request)
    // {
    //     $sac = AdCategory::select('*',  'ads.created_at as date')
    //         ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
    //         ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
    //         ->where('ad_id', '=', $request->input('ad_id'))
    //         ->get();
        
    //     return response()->json([
    //         'count' => count($sac),
    //         'items' => $sac
    //     ]);
    // }

    /* search a phone from ad_id */
    public function getAdPhones(Request $request)
    {
        $sap = AdPhone::select('*')
            ->join('ads', 'ads.id', '=', 'ad_phones.ad_id')
            ->join('phones', 'phones.id', '=', 'ad_phones.phone_id')
            ->where('ad_id', '=', $request->input('ad_id'))
            ->get();
        
        return response()->json([
            'count' => count($sap),
            'items' => $sap
        ]);
    }
    
    public function getMapFromId(Request $request)
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
   
    public function postAd(Request $request)
    {
        try
        {
            DB::beginTransaction();

            // ads
            $ad = Ad::create([
                'body' => $request['body'],
                'address' => $request['address'],
                'price' => $request['price'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'condition' => $request['condition'],
                'type_id' => $request['type_id'],
                'bath' => $request['bath'],
                'pets' => $request['pets'],
                'wifi' => $request['wifi'],
                'cable' => $request['cable'],
                'parking_moto' => $request['parking_moto'],
                'parking_car' => $request['parking_car'],
                'thermal' => $request['thermal'],
                'laundry' => $request['laundry'],
                'silent' => $request['silent'],
                'status' => $request['status'],
                'created_at' => $request['datetime']
            ]);
    
            AdCategory::create([
                'ad_id' => $ad->id,
                'category_id' => $request['category_id']
            ]);
    
            // phones
            // $phone = Phone::select('*')
            //     ->where('number', '=', $request->input('phone'))
            //     ->get();
            
            // if (count($phone) == 0){
            //     $p = Phone::create([
            //         'number' => $request->input('phone')
            //     ]);            
    
            //     AdPhone::create([
            //         'ad_id' => $ad->id,
            //         'phone_id' => $p->id
            //     ]);
            // } else {
            //     $phone_id = Phone::where('number', $request->input('phone'))->first()->id;
            //     AdPhone::create([
            //         'ad_id' => $ad->id,
            //         'phone_id' => $phone_id
            //     ]);
            // }

            // phones
            $phones = $request->input('phones');
            foreach($phones as $item){
                $phone = Phone::select('*')
                    ->where('number', '=', $item['phone'])
                    ->first();
                
                if (!$phone){
                    $phone = Phone::create([
                        'number' => $item['phone']
                    ]);            
                }

                AdPhone::create([
                    'ad_id' => $ad->id,
                    'phone_id' => $phone->id
                ]);
            }

            // images
            $images = $request->input('images');
            foreach ($images as $item){
                $image = Image::select('*')
                    ->where('url', '=', $item['url'])
                    ->get();

                if(count($image) == 0)
                {
                    $img = Image::create([
                        'url' => $item['url']
                    ]);

                    AdImage::create([
                        'ad_id' => $ad->id,
                        'image_id' => $img->id
                    ]);
                } else {
                    $image_id = Image::where('url', $item['url'])->first()->id;
                    AdImage::create([
                        'ad_id' => $ad->id,
                        'image_id' => $image_id
                    ]);
                }
            }
            DB::commit();
        }
        catch(\Exception $e)
        {
            DB::rollback();
        }

        // return $ad->id;
        // return $request->all();
    }
}
