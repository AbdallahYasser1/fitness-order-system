<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Order::orderBy('id', 'desc')->get()], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'email' => 'nullable|email',
            'note' => 'nullable|string',
            'packageId' => 'nullable|integer',
        ]);

        $order = Order::create($validated);

        return response()->json(['data' => $order], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json(['data' => $order], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string',
            'phone' => 'sometimes|string',
            'address' => 'sometimes|string',
            'email' => 'nullable|email',
            'note' => 'nullable|string',
            'packageId' => 'nullable|integer',
        ]);

        $order->update($validated);

        return response()->json(['data' => $order], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], Response::HTTP_NO_CONTENT);
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,shipped,completed',
        ]);

        $order->update(['status' => $validated['status']]);

        return response()->json(['data' => $order], Response::HTTP_OK);
    }
}
