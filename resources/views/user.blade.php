<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ユーザ詳細') }}
        </h2>
    </x-slot>
    <div>
        <aside>
            ここにユーザ名と自己紹介文
            <p>{{ $user->name }}</p>
            <p>{{ $user->profile_txt }}</p>
            @if (Auth::id() !== $user->id)
            <div>
                @if (\Auth::user()->isFollowed($user->id))
                    <button><a href="{{ route('unfollow', $user->id) }}">お気に入り解除</a></button>
                @else
                    <button><a href="{{ route('follow', $user->id) }}">お気に入り登録</a></button>
                @endif
            </div>
            @endif
        </aside>
        <div>
            <ul class="tabs">
                {{-- 投稿記事一覧タブ --}}
                <li class="tab tab-lifted grow tab-active" onclick="changeActiveTab(event, 'entries')">
                    投稿一覧
                    <div class="badge ml-1"></div>
                </li>
                {{-- お気に入りユーザー一覧タブ --}}
                <li class="tab tab-lifted grow" onclick="changeActiveTab(event, 'followings')">
                    お気に入りユーザ一覧
                    <div class="badge ml-1"></div>
                </li>
                {{-- お気に入り投稿一覧タブ --}}
                <li class="tab tab-lifted grow" onclick="changeActiveTab(event, 'favorites')">
                    お気に入り投稿一覧
                    <div class="badge ml-1"></div>
                </li>
            </ul>
            {{-- それぞれの一覧の内容を切り替えて表示させる --}}
            <div id="entries" class="active">
                @foreach($entries as $entry)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <a href="{{ route('blog_entries.show', $entry->id) }}">{{ __($entry->title) }}</a>
                            <p>{{ __($entry->created_at->format('Y年m月d日')) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="followings" class="hidden">
                @foreach($followings as $followee)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p>{{ __($followee->name) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="favorites" class="hidden">
                @foreach($favorites as $favorite)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <p>{{ __($favorite->user->name) }}</p>
                            <a href="{{ route('blog_entries.show', $favorite->id) }}">{{ __($favorite->title) }}</a>
                            <p>{{ __($favorite->created_at->format('Y年m月d日')) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/userTabChange.js') }}"></script>
</x-app-layout>
