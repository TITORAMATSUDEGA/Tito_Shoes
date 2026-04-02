<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Shoe;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    // Nomor WhatsApp Tito
    $wa_number = '6285381889313'; 

    $shoes = Shoe::all();

    return view('welcome', compact('shoes', 'wa_number'));
});

Route::get('/cart', function () {
    // Nomor WhatsApp Tito
    $wa_number = '6285381889313';

    return view('cart', compact('wa_number'));
})->name('cart.index');

Route::post('/cart/add', function (Request $request) {
    $validated = $request->validate([
        'shoe_id' => 'required|integer|exists:shoes,id',
        'size' => 'required|string|max:10',
        'color' => 'required|string|max:20',
        'quantity' => 'required|integer|min:1|max:99',
    ]);

    $shoe = Shoe::findOrFail($validated['shoe_id']);
    $cart = session()->get('cart', []);
    if (!is_array($cart)) {
        $cart = [];
    }

    // Keep only valid cart rows to avoid legacy/corrupted session payloads.
    $cart = array_filter($cart, function ($item, $itemKey) {
        return is_string($itemKey)
            && is_array($item)
            && array_key_exists('id', $item)
            && array_key_exists('name', $item)
            && array_key_exists('price', $item)
            && array_key_exists('image', $item)
            && array_key_exists('size', $item)
            && array_key_exists('color', $item)
            && array_key_exists('quantity', $item);
    }, ARRAY_FILTER_USE_BOTH);

    $key = $shoe->id . '|' . $validated['size'] . '|' . $validated['color'];

    if (isset($cart[$key])) {
        $cart[$key]['quantity'] += $validated['quantity'];
    } else {
        $cart[$key] = [
            'id' => $shoe->id,
            'name' => $shoe->name,
            'price' => $shoe->price,
            'image' => $shoe->image,
            'size' => $validated['size'],
            'color' => $validated['color'],
            'quantity' => $validated['quantity'],
        ];
    }

    session(['cart' => $cart]);

    return back()->with('success', 'Produk ditambahkan ke keranjang.');
})->name('cart.add');

Route::post('/cart/update', function (Request $request) {
    $validated = $request->validate([
        'key' => 'required|string',
        'quantity' => 'required|integer|min:1|max:99',
    ]);

    $cart = session()->get('cart', []);
    if (!is_array($cart)) {
        $cart = [];
    }

    if (isset($cart[$validated['key']])) {
        $cart[$validated['key']]['quantity'] = $validated['quantity'];
        session(['cart' => $cart]);
    }

    return back();
})->name('cart.update');

Route::post('/cart/remove', function (Request $request) {
    $validated = $request->validate([
        'key' => 'required|string',
    ]);

    $cart = session()->get('cart', []);
    if (!is_array($cart)) {
        $cart = [];
    }

    if (isset($cart[$validated['key']])) {
        unset($cart[$validated['key']]);
        session(['cart' => $cart]);
    }

    return back();
})->name('cart.remove');

Route::post('/orders/log', function (Request $request) {
    $validated = $request->validate([
        'items' => 'required|array|min:1',
        'items.*.key' => 'nullable|string',
        'items.*.name' => 'required|string|max:150',
        'items.*.size' => 'nullable|string|max:20',
        'items.*.color' => 'nullable|string|max:20',
        'items.*.qty' => 'required|integer|min:1|max:99',
        'items.*.price' => 'required|integer|min:0',
        'total' => 'required|integer|min:0',
    ]);

    $order = DB::transaction(function () use ($validated) {
        do {
            $orderCode = 'ORD-' . strtoupper(Str::random(6));
        } while (Order::where('order_code', $orderCode)->exists());

        $order = Order::create([
            'order_code' => $orderCode,
            'channel' => 'WhatsApp',
            'status' => 'Menunggu Konfirmasi',
            'customer_name' => 'Pelanggan WhatsApp',
            'total' => (int) $validated['total'],
            'item_count' => count($validated['items']),
        ]);

        $order->items()->createMany(
            collect($validated['items'])->map(function ($item) {
                return [
                    'product_name' => $item['name'],
                    'size' => $item['size'] ?? null,
                    'color' => $item['color'] ?? null,
                    'qty' => (int) $item['qty'],
                    'price' => (int) $item['price'],
                ];
            })->values()->all()
        );

        return $order;
    });

    $cart = session()->get('cart', []);
    if (is_array($cart)) {
        $keysToRemove = collect($validated['items'])
            ->pluck('key')
            ->filter(function ($key) {
                return is_string($key) && $key !== '';
            })
            ->unique();

        foreach ($keysToRemove as $cartKey) {
            unset($cart[$cartKey]);
        }

        session(['cart' => $cart]);
    }

    return response()->json([
        'message' => 'Pesanan berhasil dicatat.',
        'order_code' => $order->order_code,
    ]);
})->name('orders.log');

use App\Http\Controllers\ShoeController;

Route::resource('admin/shoes', ShoeController::class)->names([
    'index' => 'shoes.index',
    'create' => 'shoes.create',
    'store' => 'shoes.store',
    'edit' => 'shoes.edit',
    'update' => 'shoes.update',
    'destroy' => 'shoes.destroy',
]);

Route::get('/admin', [ShoeController::class, 'index'])->name('admin');
Route::get('/admin/pemesanan', [ShoeController::class, 'orders'])->name('admin.orders');