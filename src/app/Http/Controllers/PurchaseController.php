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

        $address = Address::where('user_id', auth()->id())
            ->where('item_id', $item_id)
            ->latest()
            ->first();

        return view('items.purchase', compact('item', 'address'));
    }

    public function store(PurchaseRequest $request, $item_id)
    {
        DB::transaction(function () use ($request, $item_id) {

            $item = Item::LockForUpdate()->findOrFail($request->item_id);

            // 売り切れチェック
            if ($item->is_sold) {
                abort(403, 'すでに購入されています');
            }
            
            // addressesテーブルからデータを探す
            $addressData = Address::where('user_id', auth()->id())
                ->where('item_id', $item_id)
                ->first();

            // addressesテーブルからデータない場合
            // プロフィールの住所を保存
            if (!$addressData) {
                $addressData = Address::create([
                    'user_id' => auth()->id(),
                    'item_id' => $item_id,
                    'postal_code' => auth()->user()->profile->postal_code,
                    'address' => auth()->user()->profile->addresss,
                    'building' => auth()->user()->profile->building,
                ]);
            }

            Purchase::create([
                'user_id' => auth()->id(),
                'item_id' => $item->id,
                'address_id' => $addressData->id,
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
        Address::updateOrCreate([
            'user_id' => auth()->id(),
            'item_id' => $item_id,
            'postal_code' => $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect()->route('purchase', ['item_id' => $item_id]);
    }
}
