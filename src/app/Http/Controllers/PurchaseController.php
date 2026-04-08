<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Address;
// use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;

class PurchaseController extends Controller
{
    public function purchase($item_id)
    {
        $item = Item::findOrfail($item_id);

        return view('items.purchase', compact('item'));
    }

    public function store(PurchaseRequest $request)
    {
        DB::transaction(function () use ($request) {

            $item = Item::LockForUpdate()->findOrFail($request->item_id);

            // 売り切れチェック
            if ($item->is_sold) {
                abort(403, 'すでに購入されています');
            }
            
            // addressesテーブルからデータを探してuserかどうか商品があるか
            $addressData = session('purchase_address');

            // ない場合だけ保存
            // addressテーブルに保存
            $address = Address::create([
                'user_id' => auth()->id(),
                'postal_code' => auth()->user()->profile->postal_code,
                'address' => auth()->user()->profile->addresss,
                'building' => auth()->user()->profile->building,
            ]);

            Purchase::create([
                'user_id' => auth()->id(),
                'item_id' => $item->id,
                'address_id' => $address->id,
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

        return view('items.address', compact('profile', 'item_id'));
    }

    public function update(AddressRequest $request, $item_id)
    {
        session([
            'purchase_address' => [
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'building' => $request->building,
            ]
        ]);

        return redirect()->route('purchase', ['item_id' => $item_id]);
    }
}
