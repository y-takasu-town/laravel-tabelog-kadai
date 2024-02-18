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
        try {
            // ログインユーザーを$userとする
            $user = User::find(Auth::id());

            // またStripe顧客でなければ、新規顧客にする
            $stripeCustomer = $user->createOrGetStripeCustomer();

            // フォーム送信の情報から$paymentMethodを作成する
            $paymentMethod = $request->input('stripePaymentMethod');

            // プランはconfigに設定したbasic_plan_idとする
            $plan = config('services.stripe.basic_plan_id');
            
            // 上記のプランと支払方法で、サブスクを新規作成する
            $user->newSubscription('default', $plan)
                ->create($paymentMethod);

            // 処理後に'ルート設定'にページ移行
            return redirect()->route('subscription')->with('message', 'サブスクリプションを購読しました。');
        } catch (\Exception $e) {
            // 例外が発生した場合の処理
            return redirect()->back()->with('error', 'サブスクリプションの作成中にエラーが発生しました。');
        }
    }


    public function cancelsubscription(Request $request){
        $user=User::find(Auth::id());
        $user->subscription('default')->cancel();
        return redirect()->route('mypage')->with('message', 'サブスクリプションを解約しました。');
    }

    public function edit()
    {
        $user=User::find(Auth::id());
        return view(
            'subscription.edit_card',[
                'intent' => $user->createSetupIntent()
            ]
        );
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());
    
        // フォーム送信の情報から$paymentMethodを取得する
        $paymentMethod = $request->input('stripePaymentMethod');
    
        // ユーザーのデフォルトの支払い方法を更新する
        $user->updateDefaultPaymentMethod($paymentMethod);
    
        // 処理後に適切なページにリダイレクトする
        return redirect()->route('mypage')->with('message', '支払い方法が更新されました。');
    }

}