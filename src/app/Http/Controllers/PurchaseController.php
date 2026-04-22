<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Address;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function purchase($item_id)
    {
        $item = Item::findOrfail($item_id);
        $user = auth()->user();
        $profile = $user->profile;

        $address = Address::where('user_id', auth()->id())
            ->where('item_id', $item_id)
            ->latest()
            ->first();

        $useAddress = $address ?? $profile;

        return view('items.purchase', compact('item', 'useAddress'));
    }

    public function store(PurchaseRequest $request, $item_id)
    {
        $item = Item::LockForUpdate()->findOrFail($request->item_id);
        $user = auth()->user();

        // 売り切れチェック
        if ($item->is_sold) {
            abort(403, 'すでに購入されています');
        }

        // 住所取得（Address優先）
        $address = Address::where('user_id', $user->id)
            ->where('item_id', $item_id)
            ->first();

        $profile = $user->profile;

        // 両方なければNG
        if (
            (!$address || !$address->address) &&
            (!$profile || !$profile->address)
        ) {
            return redirect()
                ->route('purchase', ['item_id' => $item_id])
                ->with('error', '住所を登録してください');
        }

        // 使用する住所
        $useAddress = $address ?? $profile;

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.success', ['item_id' => $item->id]),
            'cancel_url' => route('purchase.cancel'),
        ]);

        return redirect($session->url);
    }

    // 購入成功したらDB更新
    public function success(Request $request)
    {
        DB::transaction(function () use ($request) {

            $item = Item::lockForUpdate()->findOrFail($request->item_id);

            // addressesテーブルからデータを探す
            $addressData = Address::where('user_id', auth()->id())
                ->where('item_id', $item->id)
                ->first();

            // addressesテーブルからデータない場合
            // プロフィールの住所を保存
            if (!$addressData) {
                $addressData = Address::create([
                    'user_id' => auth()->id(),
                    'item_id' => $item->id,
                    'postal_code' => auth()->user()->profile->postal_code,
                    'address' => auth()->user()->profile->address,
                    'building' => auth()->user()->profile->building,
                ]);
            }

            Purchase::create([
                'user_id' => auth()->id(),
                'item_id' => $item->id,
                'address_id' => $addressData->id,
                'payment' => 'card',
                'price' => $item->price,
            ]);

            $item->update([
                'is_sold' => true
            ]);
        });

        return redirect()->route('mypage.index');

    }

    // キャンセルしたとき
    public function cancel()
    {
        return view('purchase.cancel');
    }


    // 住所変更画面
    public function address($item_id)
    {
        $profile = auth()->user()->profile;

        return view('items.address', compact('profile', 'item_id'));
    }

    // 住所更新
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
