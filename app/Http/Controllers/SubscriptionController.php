<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\PaymentIntent;
use App\Models\User;

class SubscriptionController extends Controller
{
    public function index()
    {
        $user=User::find(Auth::id());
        return view(
            'subscription.index',[
                'intent' => $user->createSetupIntent()
            ]
        );
    }

    public function store(Request $request)
    {
        // ログインユーザーを$userとする
        $user=User::find(Auth::id());
    
        // またStripe顧客でなければ、新規顧客にする
        $stripeCustomer = $user->createOrGetStripeCustomer();

        // フォーム送信の情報から$paymentMethodを作成する
        $paymentMethod=$request->input('stripePaymentMethod');

        // プランはconfigに設定したbasic_plan_idとする
        $plan=config('services.stripe.basic_plan_id');
        
        // 上記のプランと支払方法で、サブスクを新規作成する
        $user->newSubscription('default', $plan)
        ->create($paymentMethod);

        // 処理後に'ルート設定'にページ移行
        return redirect()->route('subscription')->with('message', 'サブスクリプションを購読しました。');
    }

    public function cancelsubscription(Request $request){
        $user=User::find(Auth::id());
        $user->subscription('default')->cancel();
        return redirect()->route('mypage')->with('message', 'サブスクリプションを解約しました。');
    }
}