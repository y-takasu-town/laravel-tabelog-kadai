<x-mail::message>

    {{-- 挨拶 --}}
    @if (!empty($greeting))
        # {{ $greeting }}
    @else
        @if ($level === 'error')
            # @lang('おっと！')
        @else
            # @lang('こんにちは！')
        @endif
    @endif

    {{-- 紹介行 --}}
    @foreach ($introLines as $line)
        {{ $line }}
        
    @endforeach

    {{-- アクションボタン --}}
    @isset($actionText)
        <?php
            $color = match ($level) {
                'success', 'error' => $level,
                default => 'primary',
            };
        ?>
        <x-mail::button :url="$actionUrl" :color="$color">
            {{ $actionText }}
        </x-mail::button>
    @endisset

    {{-- 結びの言葉 --}}
    @foreach ($outroLines as $line)
        {{ $line }}
        
    @endforeach

    {{-- 敬具 --}}
    @if (!empty($salutation))
        {{ $salutation }}
    @else
        @lang('よろしくお願いします。')<br>
        {{ config('app.name') }}
    @endif

    {{-- サブコピー --}}
    @isset($actionText)
        <x-slot:subcopy>
            @lang(
                ":actionText ボタンが利用できない場合は、以下のURLをコピー＆ペーストしてブラウザから直接アクセスしてください。\n",
                [
                    'actionText' => $actionText,
                ]
            ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
        </x-slot:subcopy>
    @endisset

</x-mail::message>
