@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('message'))
                    <div class="alert alert-success mt-3">
                        {{session('message')}}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">サブスクリプション</div>
                        <div class="card-body">
                            <div class="container py-3">
                                <h3 class="mb-3">ご登録フォーム</h3>
                                
                                {{-- フォーム部分 --}}
                                <form action="{{route('stripe.store')}}" method="post" id="payment-form">
                                    @csrf
                                    
                                    <label for="exampleInputEmail1">お名前</label>
                                    <input type="test" class="form-control col-sm-5" id="card-holder-name" required>
                                
                                    <label for="exampleInputPassword1">カード番号</label>
                                    <div class="form-group MyCardElement col-sm-5" id="card-element"></div>
                                
                                    <div id="card-errors" role="alert" style='color:red'></div>
                                
                                    <button class="btn btn-primary mt-4" id="card-button" data-secret="{{ $intent->client_secret }}">プレミアム会員に登録する</button>
                                
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://js.stripe.com/v3/"></script>
        <script>
            // HTMLの読み込み完了後に実行するようにする
            window.onload = my_init;
            function my_init() 
            {
                // Configに設定したStripeのAPIキーを読み込む  
                const stripe = Stripe("{{ config('services.stripe.pb_key') }}");
                const elements = stripe.elements();
            
                var style = 
                {
                    base: {
                        color: "#32325d",
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: "antialiased",
                        fontSize: "16px","::placeholder": {
                        color: "#aab7c4"
                        }
                    },
                    invalid: {
                        color: "#fa755a",
                        iconColor: "#fa755a"
                    }
                };
                    
                const cardElement = elements.create('card', {style: style, hidePostalCode: true});
                cardElement.mount('#card-element');
        
                const cardHolderName = document.getElementById('card-holder-name');
                const cardButton = document.getElementById('card-button');
                const clientSecret = cardButton.dataset.secret;
        
                cardButton.addEventListener('click', async (e) =>
                {
                    e.preventDefault();
                    const { setupIntent, error } = await stripe.confirmCardSetup(
                        clientSecret, 
                    {
                        payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                        }
                    });
                    
                    if (error) {
                        // エラー処理
                        console.log('error');
                        
                    } else {
                        // 問題なければ、stripePaymentHandlerへ
                        stripePaymentHandler(setupIntent);
                    }
                });
            }
            
            function stripePaymentHandler(setupIntent)
            {
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripePaymentMethod');
                hiddenInput.setAttribute('value', setupIntent.payment_method);
                form.appendChild(hiddenInput);
                // フォームを送信
                form.submit();
            }
        </script>
@endsection


