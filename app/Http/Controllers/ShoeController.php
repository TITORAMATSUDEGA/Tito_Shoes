<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shoe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShoeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shoes = Shoe::all();

        return view('admin', compact('shoes'));
    }

    /**
     * Display order list page in admin panel.
     */
    public function orders()
    {
        $orderCollection = Order::with('items')
            ->latest()
            ->get()
            ->map(function (Order $order) {
                return [
                    'id' => $order->order_code,
                    'channel' => $order->channel,
                    'customer_name' => $order->customer_name,
                    'total' => (int) $order->total,
                    'item_count' => (int) $order->item_count,
                    'created_at' => optional($order->created_at)?->toDateTimeString(),
                    'items' => $order->items->map(function ($item) {
                        return [
                            'name' => $item->product_name,
                            'size' => $item->size,
                            'color' => $item->color,
                            'qty' => (int) $item->qty,
                            'price' => (int) $item->price,
                        ];
                    })->values()->all(),
                ];
            })
            ->values();

        return view('admin.orders', compact('orderCollection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shoes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
        ]);

        $imagePath = $request->file('image')->store('shoes', 'public');

        Shoe::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('shoes.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Shoe $shoe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shoe $shoe)
    {
        return view('shoes.edit', compact('shoe'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Shoe $shoe)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($shoe->image) {
                Storage::disk('public')->delete($shoe->image);
            }
            $imagePath = $request->file('image')->store('shoes', 'public');
            $shoe->image = $imagePath;
        }

        $shoe->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->route('shoes.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shoe $shoe)
    {
        if ($shoe->image) {
            Storage::disk('public')->delete($shoe->image);
        }
        $shoe->delete();

        return redirect()->route('shoes.index')->with('success', 'Produk berhasil dihapus.');
    }
}
