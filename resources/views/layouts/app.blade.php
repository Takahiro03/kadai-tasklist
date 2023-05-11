<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Tasklist</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
    </head>

    <body>

        {{-- ナビゲーションバー --}}
        @include('commons.navbar')

                <div class="container mx-auto">
            {{-- エラーメッセージ --}}
            @include('commons.error_messages')
            
            {{-- ログイン状態によって表示するコンテンツを切り替え --}}
            @guest
                {{-- 未ログインの場合はダッシュボードを表示 --}}
                @if (Request::routeIs('home'))
                    @include('dashboard')
                @endif
            @else
                {{-- ログインしている場合は指定のコンテンツを表示 --}}
                @yield('content')
            @endguest
        </div>
        
    </body>
</html>