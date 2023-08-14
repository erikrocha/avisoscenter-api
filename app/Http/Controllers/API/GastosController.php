<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Transaction;
use App\Models\TCategory;
use App\Models\TransactionTCategory;
use DB;

class GastosController extends Controller
{
    // transactions
    public function getTransactions()
    {
        $t = Transaction::with('tcategories', 'user')
            ->orderByDesc('created_at')
            ->get();

        $count = Transaction::has('tcategories')->count();

        $data = $t->map(function($t) {

            $date = $t->created_at;
            $carbonDate = new Carbon($date);
            $formattedDate = $carbonDate->format('Y-m-d H:i:s');
            return [
                'transaction_id' => $t->id,
                'user_id' => $t->user_id,
                'user_name' => $t->user->name,
                'description' => $t->description,
                'amount' => $t->amount,
                'type' => $t->type,
                'date' => $formattedDate,
                'tcategories' => $t->tcategories->map(function($tcategory){
                    return [
                        'tcategory_id' => $tcategory->id,
                        'tc_name' => $tcategory->tc_name
                    ];
                })->toArray()
            ];
        });

        return response()->json([
            'count' => $count,
            'items' => $data
        ]);
    }

    public function postTransaction(Request $request)
    {
        try{
            // add transaction
            $t = Transaction::create([
                'user_id' => $request['user_id'],
                'tcategory_id' => $request['tcategory_id'],
                'description' => $request['description'],
                'amount' => $request['amount'],
                'type' => $request['type'],
            ]);

            // add transaction tcategory
            TransactionTCategory::create([
                'transaction_id' => $t->id,
                'tcategory_id' => $request['tcategory_id']
            ]);

            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }

        return $t->id;
    }

    public function putTransaction(Request $request, $id)
    {
        $t = Transaction::findOrFail($id);
        $t->update([
            // 'user_id'       => $request->input('user_id'),
            'description'   => $request->input('description'),
            'amount'        => $request->input('amount'),
            'type'          => $request->input('type')
        ]);

        return $t;
    }

    public function inputsTransaction()
    {
        $inputs = Transaction::where('type', 'entrada')->sum('amount');
        return $inputs;
    }

    public function outputsTransaction()
    {
        $outputs = Transaction::where('type', 'salida')->sum('amount');
        return $outputs;
    }

    public function balanceTransaction()
    {
        $entradas = Transaction::where('type', 'entrada')->sum('amount');
        $salidas = Transaction::where('type', 'salida')->sum('amount');
        $balance = $entradas + $salidas;

        return $balance;
    }

    // tcategory
    public function getTCategories()
    {
        $tc = TCategory::get();
        return response()->json([
            'count' => count($tc),
            'items' => $tc
        ]);
    }

    public function postTCategory(Request $request)
    {
        $tc = TCategory::create([
            'tc_name' => $request['tc_name'],
        ]);

        return $tc->id;
    }

    public function putTCategory(Request $request, $id)
    {
        $tc = TCategory::findOrFail($id);
        $tc->update([
            'tc_name' => $request->input('tc_name')
        ]);

        return $tc;
    }
}
