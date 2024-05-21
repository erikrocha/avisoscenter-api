<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BusinessController extends Controller
{
    public function getAllBads()
    {
      $bads = DB::table('bads')
        //->join('businesses', 'bads.business_id', '=', 'businesses.id')
        ->join('businesses', 'businesses.id', '=', 'bads.business_id')
        ->leftJoin('promotions', 'promotions.business_id', '=', 'businesses.id')
        ->select(
            'bads.id as bad_id', 
            'businesses.id as business_id',
            'businesses.name',
            'businesses.description',
            'businesses.image as business_image',
            'bads.image as bad_image',
            'promotions.image as promotion_image',
            'businesses.phone', 
            'businesses.whatsapp',
            'bads.created_at',
            'bads.expired_at',
            )
        ->where('bads.status', '=', 1)
        ->orderByDesc('bads.created_at')
        ->get();

      return response()->json([
        'count' => $bads->count(),
        'items' => $bads
      ]);
    }

    public function getAllBCategories()
    {
      $bcategories = DB::table('bcategories')
        ->select('id as bcategory_id', 'name')
        ->where('status', '=', 1)
        ->get();

      return response()->json([
        'count' => $bcategories->count(),
        'items' => $bcategories
      ]);
    }

    public function getAllBusinesses()
    {
      $businesses = DB::table('businesses')
        ->leftJoin('promotions', 'promotions.business_id', '=', 'businesses.id')
        ->select(
          'businesses.id as business_id', 
          'businesses.name', 
          'businesses.description', 
          'businesses.image as business_image',
          'promotions.status as hasPromotion',
          )
        ->where('businesses.status', '=', 1)
        ->get();

      return response()->json([
        'count' => $businesses->count(),
        'items' => $businesses
      ]);
    }

    public function getBusinessById($businessId)
    {
      //$business = Business::findOrFail($businessId);
      $business = DB::table('businesses')
        ->leftJoin('promotions', 'promotions.business_id', '=', 'businesses.id')
        ->select(
          'businesses.id',
          'businesses.bcategory_id',
          'businesses.name',
          'businesses.description',
          'businesses.description_long',
          'businesses.address',
          'businesses.image as business_image',
          'promotions.image as promotion_image',
          'businesses.web',
          'businesses.email',
          'businesses.phone',
          'businesses.whatsapp',
          'businesses.tiktok',
          'businesses.status',
          'businesses.created_at',
          'businesses.updated_at',
        )
        ->where('businesses.status', '=', 1)
        ->where('businesses.id', '=', $businessId)
        ->first();

      return response()->json($business);
    }
}
