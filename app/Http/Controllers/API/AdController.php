<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Ad;
use App\Models\Phone;
use App\Models\Image;
use App\Models\AdCategory;
use App\Models\AdPhone;
use App\Models\AdImage;
use App\Models\Brand;
use App\Models\Model;
use App\Models\Popup;
use DB;

class AdController extends Controller
{
    /* frm_all */
    public function getAllAds(Request $request)
    {
        $page = $request->input('page', 1);
        $pageSize = $request->input('pageSize', 2);

        $ads = AdCategory::select('*', 
                'categories.name as category_name', 
                'types.name as type_name', 
                'ads.created_at as date',
                'ads.status as ad_status'
            )
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'ads.type_id', '=', 'types.id')
            ->where('ads.status', '=', 1)
            ->orderByDesc('ads.condition')
            ->orderByDesc('ads.created_at');
            
        $count = $ads->count();

        $data = $ads->skip(($page - 1) * $pageSize)
                        ->take($pageSize)
                        ->get();

            $lastPage = ceil($count / $pageSize);

        $previousPage = $page > 1 ? $page - 1 : null;
        $nextPage = $page < $lastPage ? $page + 1 : null;

        $paginationLinks = [
            'first_page' => 1,
            'last_page' => $lastPage,
            'previous_page' => $previousPage,
            'next_page' => $nextPage,
        ];
        
        return response()->json([
            'count' => $count,
            'items' => $data->toArray(),
            'pagination_links' => $paginationLinks
        ]);
    }

    public function getAllAdsWithoutStatus()
    {
        $ads = AdCategory::select('*', 
                'categories.name as category_name', 
                'types.name as type_name', 
                'ads.created_at as date',
                'ads.status as ad_status',
                'ads.updated_at as updated'
            )
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'ads.type_id', '=', 'types.id')
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
        // $ads = Ad::select('*', 
        //         'ads.id as ad_id',
        //         'ads.created_at as date',
        //         'types.name as type_name')
        //     ->leftJoin('types', 'ads.type_id', '=', 'types.id')
        //     ->where('ads.status', '=', 1)
        //     ->where('ads.id', '=', $request->input('ad_id'))
        //     ->orderByDesc('ads.created_at')
        //     ->first();

        $ads = AdCategory::select(
                '*',
                'categories.name as category_name',
                'cities.name as city_name',
                'brands.name as brand_name',
                'models.name as model_name',
                'types.slug as type_slug',
                'types.name as type_name',
                'ads.created_at as date',
                'ads.status as ad_status'
            )
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'types.id', '=', 'ads.type_id')
            ->leftjoin('cities', 'cities.id', '=', 'ads.city_id')
            ->leftjoin('brands', 'brands.id', '=', 'ads.brand_id')
            ->leftjoin('models', 'models.id', '=', 'ads.model_id')
            // ->where('ads.status', '=', 1)
            ->where('ad_id', '=', $request->input('ad_id'))
            ->first();
        
        $count = ($ads !== null) ? 1 : 0;
        return $ads;
    }

    public function getAdFromIdV2(Request $request)
    {
        $ad = Ad::with('categories', 'images', 'phones', 'city', 'type', 'brand', 'model')
                ->where('id', '=', $request->input('ad_id'))
                ->first();
        
        // $data = $ad->map(function ($ad) {
        //     return [
        //         'ad_id' => $ad->id
        //     ];
        // });

        if ($ad) {
            $data = [
                'ad_id'         => $ad->id,
                'city_id'       => $ad->city ? $ad->city->id : null,
                'city_name'     => $ad->city ? $ad->city->name : null,
                'brand_id'      => $ad->brand ? $ad->brand->id : null,
                'brand_name'    => $ad->brand ? $ad->brand->name : null,
                'model_id'      => $ad->model ? $ad->model->id : null,
                'model_name'    => $ad->model ? $ad->model->name : null,
                'body'          => $ad->body,
                'address'       => $ad->address,
                'body'          => $ad->body,
                'price'         => $ad->price,
                'latitude'      => $ad->latitude,
                'longitude'     => $ad->longitude,
                'condition'     => $ad->condition,
                'type_id'       => $ad->type ? $ad->type->id : null,
                'type_name'     => $ad->type ? $ad->type->name : null,
                'type_slug'     => $ad->type ? $ad->type->slug : null,
                'isIA'          => $ad->isIA,
                'condition'     => $ad->condition,
                'bath'          => $ad->bath,
                'pets'          => $ad->pets,
                'wifi'          => $ad->wifi,
                'cable'         => $ad->cable,
                'parking_moto'  => $ad->parking_moto,
                'parking_car'   => $ad->parking_car,
                'thermal'       => $ad->thermal,
                'laundry'       => $ad->laundry,
                'silent'        => $ad->silent,
                'cook'          => $ad->cook,
                'currency'      => $ad->currency,
                'year'          => $ad->year,
                'mileage'       => $ad->mileage,
                'engine'        => $ad->engine,
                'fuel'          => $ad->fuel,
                'transmission'  => $ad->transmission,
                'color'         => $ad->color,
                'date'          => $ad->created_at,
                'ad_status'     => $ad->status,

                'categories' => $ad->categories->map(function ($category) {
                    return [
                        'category_id' => $category->id,
                        'name' => $category->name
                    ];
                })->toArray(),    
                'images' => $ad->images->map(function ($image) {
                    return [
                        'image_id' => $image->id,
                        'url' => $image->url
                    ];
                })->toArray(), 
                'phones' => $ad->phones->map(function ($phone) {
                    return [
                        'phone_id' => $phone->id,
                        'number' => $phone->number
                    ];
                })->toArray(), 
            ];
        } else {
            $data = [];
        }

        return $data;
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
                'ads.created_at as date',
                'ads.status as ad_status'
            )
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'types.id', '=', 'ads.type_id')
            ->whereNotNull('latitude')
            ->where('ads.status', '=', 1)
            ->where('categories.name', '=', 'ALQUILO')
            ->get();
        
        return response()->json([
            'count' => count($rentsWithLocation),
            'items' => $rentsWithLocation
        ]);
    }

    public function getLandsWithLocation(Request $request)
    {
        $count = Ad::has('categories')
            ->where('status', '=', 1)
            ->where('latitude', '<>', '')
            ->whereHas('categories', function($query){
                $query->where('type_id', 9);
            })
            ->count();

        $ads = Ad::with('categories', 'city', 'type')
            ->where('status', '=', 1)
            ->where('latitude', '<>', '')
            ->whereHas('categories', function($query){
                $query->where('type_id', 9);
            })
            ->get();

        $data = $ads->map(function($ad)
        {
            $date = $ad->created_at;
            $carbonDate = new Carbon($date);
            $formattedDate = $carbonDate->format('Y-m-d H:i:s');

            return [
                'ad_id' => $ad->id,
                'city_id' => $ad->city ? $ad->city->id : null,
                'city_name' => $ad->city ? $ad->city->name : null,
                'body' => $ad->body,
                'address' => $ad->address,
                'price' => $ad->price,
                'currency' => $ad->currency,
                'latitude' => $ad->latitude,
                'longitude' => $ad->longitude,
                'condition' => $ad->condition,
                'type_id' => $ad->type ? $ad->type->id : null,
                'type_name' => $ad->type ? $ad->type->name : null,
                'type_slug' => $ad->type ? $ad->type->slug : null,
                'date' => $formattedDate,
                'ad_status' => $ad->status,
                'categories' => $ad->categories->map(function ($category) {
                    return [
                        'category_id' => $category->id,
                        'name' => $category->name
                    ];
                })->toArray(),
            ];
        });

        return response()->json([
            'count' => $count,
            'items' => $data
        ]);
    }
    
    /* frm_ads_from_category */
    public function getAdsFromCategory(Request $request)
    {
        $page = $request->input('page', 1); // Obtener el número de página del request, por defecto es 1
        $pageSize = $request->input('pageSize', 10); // Obtener el tamaño de página del request, por defecto es 10

        $needs = AdCategory::select(
                '*', 
                'categories.name as category_name',
                'types.name as type_name',
                'ads.created_at as date'
            )
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->leftJoin('types', 'types.id', '=', 'ads.type_id')
            ->where('category_id', '=', $request->input('category_id'))
            ->where('ads.status', '=', 1)
            ->orderByDesc('ads.condition')
            ->orderByDesc('ads.created_at');

            $count = $needs->count(); // Obtener el número total de registros sin paginación

            $ads = $needs->skip(($page - 1) * $pageSize)
                          ->take($pageSize)
                          ->get(); // Obtener los registros de la página actual

        $lastPage = ceil($count / $pageSize); // Calcular el número de la última página

        $previousPage = $page > 1 ? $page - 1 : null; // Calcular la página anterior
        $nextPage = $page < $lastPage ? $page + 1 : null; // Calcular la página siguiente

        $paginationLinks = [
            'first_page' => 1,
            'last_page' => $lastPage,
            'previous_page' => $previousPage,
            'next_page' => $nextPage,
        ];

        return response()->json([
            'count' => $count,
            'items' => $ads->toArray(),
            'pagination_links' => $paginationLinks
        ]);
    }

    public function getAdsFromVehiclesV2(Request $request)
    {
        $page = request()->input('page', 1);
        $pageSize = request()->input('pageSize', 10);

        // count
        $count = Ad::has('categories')->whereHas('categories', function($query){
            $query->where('type_id', 8);
        })
        ->where('status', 1)
        ->count();

        // Obtiene los anuncios con sus categorías e imágenes paginados de acuerdo a los parámetros recibidos.
        $ads = Ad::with('type', 'brand', 'model', 'city', 'categories', 'images')
            ->whereHas('categories', function($query){
                $query->where('type_id', 8);
            })
            ->whereHas('categories', function($query){
                $query->where('type_id', 8);
            })
            ->where('status', '=', 1)
            ->orderByDesc('condition')
            ->orderByDesc('created_at')
            ->paginate($pageSize, ['*'], 'page', $page);

        $data = $ads->map(function ($ad) {
            // Obtenemos fecha
            $date = $ad->created_at;
            // Convertimos la fecha a objeto Carbon
            $carbonDate = new Carbon($date);
            // Cambiamos el formato de la fecha
            $formattedDate = $carbonDate->format('Y-m-d H:i:s');

            return [
                'ad_id' => $ad->id,
                'body' => $ad->body,
                'address' => $ad->address,
                'city_id' => $ad->city ? $ad->city->id : null,
                'city_name' => $ad->city ? $ad->city->name : null,
                'brand_id' => $ad->brand ? $ad->brand->id : null,
                'brand_name' => $ad->brand ? $ad->brand->name : null,
                'model_id' => $ad->model ? $ad->model->id : null,
                'model_name' => $ad->model ? $ad->model->name : null,
                'price' => $ad->price,
                'latitude' => $ad->latitude,
                'longitude' => $ad->longitude,
                'condition' => $ad->condition,
                'type_id' => $ad->type ? $ad->type->id : null,
                'type_name' => $ad->type ? $ad->type->name : null,
                'type_slug' => $ad->type ? $ad->type->slug : null,
                'currency' => $ad->currency,
                'year' => $ad->year,
                'mileage' => $ad->mileage,
                'engine' => $ad->engine,
                'fuel' => $ad->fuel,
                'transmission' => $ad->transmission,
                'color' => $ad->color,
                'date' => $formattedDate,
                'ad_status' => $ad->status,
                'categories' => $ad->categories->map(function ($category) {
                    return [
                        'category_id' => $category->id,
                        'name' => $category->name
                    ];
                })->toArray(),
                'images' => $ad->images->map(function ($image) {
                    return [
                        'id' => $image->id,
                        'url' => $image->url
                    ];
                })->toArray(),
            ];
        });

        // Genera los enlaces de paginación.
        $paginationLinks = [
            'first_page' => 1,
            'last_page' => $ads->lastPage(),
            'previous_page' => $ads->previousPageUrl(),
            'next_page' => $ads->nextPageUrl(),
        ];

        return response()->json([
            'count' => $count,
            'items' => $data,
            'pagination_links' => $paginationLinks,
        ]);
    }
    
    public function getAdsFromVehicles(Request $request)
    {
        $page = $request->input('page', 1); // Obtener el número de página del request, por defecto es 1
        $pageSize = $request->input('pageSize', 10); // Obtener el tamaño de página del request, por defecto es 10

        $needs = AdCategory::select(
                '*', 
                'categories.name as category_name',
                'cities.name as city_name',
                'brands.name as brand_name',
                'models.name as model_name',
                'types.slug as type_slug',
                'types.name as type_name',
                'ads.created_at as date',
                'ads.status as ad_status'
            )
            ->join('ads', 'ads.id', '=', 'ad_categories.ad_id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->join('types', 'types.id', '=', 'ads.type_id')
            ->join('cities', 'cities.id', '=', 'ads.city_id')
            ->join('brands', 'brands.id', '=', 'ads.brand_id')
            ->join('models', 'models.id', '=', 'ads.model_id')
            ->where('types.slug', '=', 'vehicle')
            ->where('ads.status', '=', 1)
            ->orderByDesc('ads.condition')
            ->orderByDesc('ads.created_at');

            $count = $needs->count(); // Obtener el número total de registros sin paginación

            $ads = $needs->skip(($page - 1) * $pageSize)
                          ->take($pageSize)
                          ->get(); // Obtener los registros de la página actual

        $lastPage = ceil($count / $pageSize); // Calcular el número de la última página

        $previousPage = $page > 1 ? $page - 1 : null; // Calcular la página anterior
        $nextPage = $page < $lastPage ? $page + 1 : null; // Calcular la página siguiente

        $paginationLinks = [
            'first_page' => 1,
            'last_page' => $lastPage,
            'previous_page' => $previousPage,
            'next_page' => $nextPage,
        ];

        return response()->json([
            'count' => $count,
            'items' => $ads->toArray(),
            'pagination_links' => $paginationLinks
        ]);
    }

    public function getAdsFromPhone(Request $request)
    {
        $ads = AdPhone::select('*', 
                'categories.name as category_name',
                'ads.created_at as date'
            )
            ->join('phones', 'phones.id', '=', 'ad_phones.phone_id')
            ->join('ads', 'ads.id', '=', 'ad_phones.ad_id')
            ->join('ad_categories', 'ad_categories.ad_id', '=', 'ads.id')
            ->join('categories', 'categories.id', '=', 'ad_categories.category_id')
            ->where('phones.number', 'LIKE', '%' . $request->input('number') . '%')
            ->get();
        
        return response()->json([
            'count' => count($ads),
            'items' => $ads
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
    public function getPhonesFromId(Request $request)
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
                'city_id' => $request['city_id'], 
                'brand_id' => $request['brand_id'], 
                'model_id' => $request['model_id'],
                'body' => $request['body'],
                'address' => $request['address'],
                'price' => $request['price'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
                'condition' => $request['condition'],
                'type_id' => $request['type_id'],
                'isIA' => $request['isIA'],
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
                'created_at' => $request['datetime'],
                'expired_at' => $request['expired_at'],
                'currency' => $request['currency'],
                'year' => $request['year'],
                'mileage' => $request['mileage'],
                'engine' => $request['engine'],
                'fuel' => $request['fuel'],
                'transmission' => $request['transmission'],
                'color' => $request['color'],
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
            // return $e;
            DB::rollback();
        }

        return $ad->id;
        // return $request->all();
    }

    public function update(Request $request, $id)
    {
        $ad = Ad::findOrFail($id);
        $ad->update([
            'city_id'       => $request->input('city_id'),
            'brand_id'      => $request->input('brand_id'),
            'model_id'      => $request->input('model_id'),
            'type_id'       => $request->input('type_id'),
            'body'          => $request->input('body'),
            'address'       => $request->input('address'),
            'latitude'      => $request->input('latitude'),
            'longitude'     => $request->input('longitude'),
            'condition'     => $request->input('condition'),
            'isIA'          => $request->input('isIA'),
            'price'         => $request->input('price'),
            'bath'          => $request->input('bath'),
            'wifi'          => $request->input('wifi'),
            'cable'         => $request->input('cable'),
            'parking_moto'  => $request->input('parking_moto'),
            'parking_car'   => $request->input('parking_car'),
            'thermal'       => $request->input('thermal'),
            'laundry'       => $request->input('laundry'),
            'silent'        => $request->input('silent'),
            'pets'          => $request->input('pets'),
            'status'        => $request->input('status'),
            'currency'      => $request->input('currency'),
            'year'          => $request->input('year'),
            'mileage'       => $request->input('mileage'),
            'engine'        => $request->input('engine'),
            'fuel'          => $request->input('fuel'),
            'transmission'  => $request->input('transmission'),
            'color'         => $request->input('color')
        ]);

        return $ad;
    }

    /* brands */
    public function getAllBrands()
    {
        $brands = Brand::select('*')->get();

        return response()->json([
            'count' => count($brands),
            'items' => $brands,
        ]);
    }

    public function brandPost(Request $request)
    {
        $brand = Brand::create([
            'name' => $request['name']
        ]);

        return $brand;
    }

    public function brandUpdate(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update([
            'name'      => $request->input('name'),
            'status'    => $request->input('status')
        ]);

        return $brand;
    }

    /* models */
    public function getAllModels()
    {
        $models = Model::select(
            'models.id AS model_id',
            'brands.name AS name_brand',
            'models.name AS name_model',
            'models.status AS model_status'
        )
            ->join('brands', 'brands.id', '=', 'models.brand_id')
            ->get();

        return response()->json([
            'count' => count($models),
            'items' => $models,
        ]);
    }

    public function getModelsByBrandId(Request $request)
    {
        $models = Model::select(
            'models.id AS model_id',
            'brands.name AS name_brand',
            'models.name AS name_model',
            'models.status AS model_status'
        )
            ->join('brands', 'brands.id', '=', 'models.brand_id')
            ->where('brand_id', '=', $request->input('brand_id'))->get();

        return response()->json([
            'count' => count($models),
            'items' => $models,
        ]);
    }

    public function modelPost(Request $request)
    {
        $model = Model::create([
            'brand_id'  => $request['brand_id'],
            'name'      => $request['name'],
        ]);

        return $model;
    }

    public function modelUpdate(Request $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->update([
            'brand_id'  => $request->input('brand_id'),
            'name'      => $request->input('name'),
            'status'    => $request->input('status')
        ]);

        return $model;
    }

    public function getPopups()
    {
        $popups = Popup::select('*')
        ->where('status', '=', 1)
        ->get();
    
        return response()->json([
            'count' => count($popups),
            'items' => $popups
        ]);
    }
}
