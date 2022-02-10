<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\order\StoreRequest;
class OrderController extends Controller
{

    public function placeOrder(StoreRequest $request)
    {

        try {
            DB::beginTransaction();

            foreach ($request->order as $order) {
                Order::create($order);
            }

            DB::commit();
            return response()->json(['message' => 'Order placed successfully'], 200);


        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 204);

        }
    }
}
