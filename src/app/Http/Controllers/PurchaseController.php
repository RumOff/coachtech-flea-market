<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Redirect;

class PurchaseController extends Controller
{
    public function purchase($item_id)
    {
        $item = Item::findOrfail($item_id);

        return view('purchase.purchase', compact('item'));
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {

            $item = Item::LockForUpdate()->findOrFail($request->item_id);

            // 売り切れチェック
            if ($item->is_sold) {
                abort(403, 'すでに購入されています');
            }

            Purchase::create([
                'user_id' => auth()->id(),
                'item_id' => $item->id,
                'payment' => $request->payment,
                'price' => $item->price,
            ]);

            $item->update([
                'is_sold' => true
            ]);

        });

        return redirect()->route('mypage.index');
    }

    public function address($item_id)
    {
        $profile = auth()->user()->profile;

        return view('purchase.address', compact('profile', 'item_id'));
    }

    public function update(Request $request, $item_id)
    {
        
        $user = auth()->user();

        $user->profile->update([
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase', ['item_id' => $item_id]);
    }
}
