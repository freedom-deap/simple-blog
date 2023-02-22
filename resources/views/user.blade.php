<x-app-layout>
    <x-slot name="header">
        <h2 class="mx-auto w-3/4 flex justify-start font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ユーザ詳細') }}
        </h2>
    </x-slot>
    <div class="max-h-full">
        <div class="flex w-2/3 justify-center mx-auto">
            <div class="w-1/3">
                <div class="mx-auto w-3/4">
                    <div class="mt-2">
                        <img class="w-3/4 rounded mx-auto" src="{{ Gravatar::get($user->email) }}" alt="" />
                    </div>
                    <div class="w-full bg-white p-4 text-gray-900 mb-2 mt-2 sm:rounded-lg">
                        @if (Auth::id() === $user->id)
                            <form method="POST" action="{{ route('user.update') }}">
                                @csrf
                                <input name="name" class="input w-full rounded-lg border border-gray-300 mb-4" required="required" value="{{ $user->name }}">
                                <textarea
                                    name="profile_txt"
                                    required="required"
                                    class="block p-2.5 w-full h-50 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 textarea textarea-lg mb-4"
                                    rows="8">{{ $user->profile_txt }}</textarea>
                                <input type="hidden" name="user_id" value="{{ __($user->id) }}"></input>
                                <button class="btn btn-info" type="submit">ユーザ情報更新</button>
                            </form>
                        @else
                            <p>{{ $user->name }}</p>
                            <p id="user-name">{{ $user->profile_txt }}</p>
                        @endif
                    </div>
                    @if (Auth::id() !== $user->id)
                    <div class="flex content-center">
                        @if (\Auth::user()->isFollowed($user->id))
                            <form method="POST" action="{{ route('unfollow') }}">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="user_id" value="{{ __($user->id) }}"></input>
                                <button class="btn btn-error">お気に入り解除</a></button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('follow') }}">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ __($user->id) }}"></input>
                                <button class="btn btn-info">お気に入り登録</a></button>
                            </form>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="w-2/3 mx-auto mt-2">
                <ul class="tabs">
                    {{-- 投稿記事一覧タブ --}}
                    <li class="tab tab-lifted grow-0 tab-active w-1/3" onclick="changeActiveTab(event, 'entries')">
                        投稿一覧
                        <div class="badge ml-1">{{ $user->blog_entries_count }}</div>
                    </li>
                    {{-- お気に入りユーザー一覧タブ --}}
                    <li class="tab tab-lifted grow-0 w-1/3" onclick="changeActiveTab(event, 'followings')">
                        お気に入りユーザ一覧
                        <div class="badge ml-1">{{ $user->followings_count }}</div>
                    </li>
                    {{-- お気に入り投稿一覧タブ --}}
                    <li class="tab tab-lifted grow-0 w-1/3" onclick="changeActiveTab(event, 'favorites')">
                        お気に入り投稿一覧
                        <div class="badge ml-1">{{ $user->favorites_count }}</div>
                    </li>
                </ul>
                {{-- それぞれの一覧の内容を切り替えて表示させる --}}
                <div class="max-h-[32rem] overflow-y-scroll">
                    <div id="entries" class="active w-full">
                        @foreach($entries as $entry)
                            <div class="overflow-hidden shadow-sm">
                                <div class="bg-white p-4 text-gray-900 mb-2 mt-2 sm:rounded-lg">
                                    <a class="text-xl hover:underline" href="{{ route('blog_entries.show', $entry->id) }}">{{ __($entry->title) }}</a>
                                    @if ($entry->created_at == $entry->updated_at)
                                        <p class="text-sm">{{ __('投稿日: '. $entry->created_at->format('Y年m月d日')) }}</p>
                                    @else
                                        <p class="text-sm">{{ __('投稿日: '. $entry->created_at->format('Y年m月d日'). ' 更新日: '. $entry->updated_at->format('Y年m月d日')) }}</p>
                                    @endif
                                    {{-- 自身のユーザ詳細を表示している場合は投稿の削除が可能 --}}
                                    @if (Auth::id() === $user->id)
                                        <form method="POST" action="{{ route('blog_entries.destroy', $entry->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="submit()" class="btn btn-error btn-sm">削除</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        {{ $entries->links() }}
                    </div>
                    <div id="followings" class="hidden w-full">
                        @foreach($followings as $followee)
                            <div class="overflow-hidden shadow-sm">
                                <div class="bg-white p-4 text-gray-900 mb-2 mt-2 sm:rounded-lg">
                                    <a class="text-lg hover:underline" href="{{ route('user.index', $followee->id) }}">{{ __($followee->name) }}</a>
                                </div>
                            </div>
                        @endforeach
                        {{ $followings->links() }}
                    </div>
                    <div id="favorites" class="hidden w-full">
                        @foreach($favorites as $favorite)
                            <div class="overflow-hidden shadow-sm">
                                <div class="bg-white p-4 text-gray-900 mb-2 mt-2 sm:rounded-lg">
                                    <a class="text-base hover:underline" href="{{ route('user.index', $favorite->user->id) }}">{{ __($favorite->user->name) }}</a>
                                    @if ($favorite->created_at == $favorite->updated_at)
                                        <p class="text-sm">{{ __('投稿日時: '. $favorite->created_at->format('Y年m月d日')) }}</p>
                                    @else
                                        <p class="text-sm">{{ __('投稿日: '. $favorite->created_at->format('Y年m月d日'). ' 更新日: '. $favorite->updated_at->format('Y年m月d日')) }}</p>
                                    @endif
                                    
                                    <a class="text-xl hover:underline" href="{{ route('blog_entries.show', $favorite->id) }}">{{ __($favorite->title) }}</a>
                                </div>
                            </div>
                        @endforeach
                        {{ $favorites->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/user.js') }}"></script>
</x-app-layout>
