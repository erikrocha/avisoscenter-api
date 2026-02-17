<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Supply;

class SupplyController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $supplies = Supply::all();
    return response()->json($supplies);
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
          'user_id' => 'required|exists:users,id',
          'number' => [
              'required',
              'string',
              'max:255',
              Rule::unique('supplies')->where(function ($query) use ($request) {
                  return $query->where('user_id', $request->user_id);
              }),
          ],
          'status' => 'required|boolean',
      ]);

      $supply = Supply::create($request->all());

      return response()->json($supply, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $supply = Supply::find($id);

      if (!$supply) {
          return response()->json(['message' => 'Supply not found'], 404);
      }

      return response()->json($supply);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $supply = Supply::find($id);

      if (!$supply) {
          return response()->json(['message' => 'Supply not found'], 404);
      }

      $request->validate([
          'user_id' => 'exists:users,id',
            'number' => 'string|max:255',
            'status' => 'boolean',
      ]);

      $supply->update($request->all());

      return response()->json($supply);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $supply = Supply::find($id);

      if (!$supply) {
          return response()->json(['message' => 'Supply not found'], 404);
      }

      $supply->delete();

      return response()->json(['message' => 'Supply deleted successfully']);
    }
}
