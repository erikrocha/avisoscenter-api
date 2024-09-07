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
        ->select('id as bcategory_id', 'name', 'order')
        ->where('status', '=', 1)
        ->orderBy('order')
        ->get();

      return response()->json([
        'count' => $bcategories->count(),
        'items' => $bcategories
      ]);
    }

    public function getAllBusinesses(Request $request)
    {
      $page = $request->input('page', 1);
      $pageSize = request()->input('pageSize', 10);

      $businesses = DB::table('businesses')
        ->select(
          'businesses.id as business_id',
          'bcategories.id as bcategory_id',
          'bcategories.name as bcategory_name', 
          'businesses.name', 
          'businesses.description', 
          'businesses.image as business_image',
          'promotions.status as hasPromotion',
          'businesses.paid as hasPaid',
          )
        ->leftJoin('bcategories', 'bcategories.id', '=', 'businesses.bcategory_id')
        ->leftJoin('promotions', 'promotions.business_id', '=', 'businesses.id')
        ->where('businesses.status', '=', 1)
        ->orderByDesc('businesses.paid')
        ->orderByDesc('businesses.created_at');

      $count = $businesses->count();

      $b = $businesses->skip(($page - 1) * $pageSize)
      ->take($pageSize)
      ->get();

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
          'items' => $b->toArray(),
          'pagination_links' => $paginationLinks
      ]);
    }

    public function getBusinessById($businessId)
    {
      //$business = Business::findOrFail($businessId);
      $business = DB::table('businesses')
        ->join ('bcategories', 'bcategories.id', '=', 'businesses.bcategory_id')
        ->leftJoin('promotions', 'promotions.business_id', '=', 'businesses.id')
        ->select(
          'businesses.id',
          'businesses.bcategory_id',
          'bcategories.name as bcategory_name',
          'businesses.name',
          'businesses.description',
          'businesses.description_long',
          'businesses.address',
          'businesses.latitude',
          'businesses.longitude',
          'businesses.image as business_image',
          'promotions.image as promotion_image',
          'businesses.web',
          'businesses.email',
          'businesses.phone',
          'businesses.whatsapp',
          'businesses.facebook',
          'businesses.tiktok',
          'businesses.paid as hasPaid',
          'businesses.status',
          'businesses.created_at',
          'businesses.updated_at',
        )
        ->where('businesses.status', '=', 1)
        ->where('businesses.id', '=', $businessId)
        ->first();

      return response()->json($business);
    }

    public function getBusinessesByBcategory(Request $request)
    {
      $page = $request->input('page', 1);
      $pageSize = request()->input('pageSize', 10);

      $businesses = DB::table('businesses')
        ->select(
          'businesses.id as business_id',
          'bcategories.id as bcategory_id',
          'bcategories.name as bcategory_name',
          'businesses.name',
          'businesses.description',
          'businesses.image as business_image',
          'promotions.status as hasPromotion',
          'businesses.paid as hasPaid',
        )
        ->leftJoin('bcategories', 'bcategories.id', '=', 'businesses.bcategory_id')
        ->leftJoin('promotions', 'promotions.business_id', '=', 'businesses.id')
        ->where('businesses.status', '=', 1)
        ->where('bcategory_id', '=', $request->input('category_id'))
        ->orderByDesc('businesses.paid')
        ->orderByDesc('businesses.created_at');
        //->get();

      $count = $businesses->count();

      $b = $businesses->skip(($page - 1) * $pageSize)
      ->take($pageSize)
      ->get();

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
          'items' => $b->toArray(),
          'pagination_links' => $paginationLinks
      ]);
    }
}
