<x-app-layout>
    <x-slot name="header">
        <h2 class="mx-auto w-3/4 flex justify-start font-semibold text-xl text-gray-800 leading-tight">{{ __($entry->title)}}</h2>
        <p class="mx-auto w-3/4 flex justify-start text-sm">投稿日時: {{__($entry->created_at->format('Y年m月d日'))}}, 更新日時: {{__($entry->updated_at->format('Y年m月d日'))}}</p>
        <a class="mx-auto w-3/4 flex justify-start text-xs hover:underline" href="{{ route('user.index', $entry->user->id) }}">{{ __($entry->user->name) }}</a>

    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-3/4 flex justify-center sm:px-6 lg:px-8">
            <div class="w-full">
                <div id="entry-text" class="bg-white w-3/4 mx-auto p-8">
                  {!! $entry->content !!}
                </div>
                <div class="mt-5 flex flex-row-reverse flex-col fixed bottom-10 right-20">
                    {{-- ログインしているかの判定 --}}
                    @if (Auth::check())
                    <div class="block mb-4">
                        <form class="favorite-btn" method="POST" action="{{ route('favorite') }}">
                            @csrf
                            <input type="hidden" name="entry_id" value="{{ __($entry->id) }}"></input>
                            @if (\Auth::user()->isFavorited($entry->id))
                                <button class="btn btn-error favorite-btn">お気に入り解除</button>
                            @else
                                <button class="btn btn-info favorite-btn">お気に入り登録</button>
                            @endif
                        </form>
                    </div>
                    @endif
                    {{-- 閲覧しているユーザが投稿者かどうかの判定 --}}
                    @if ($entry->user_id === Auth::id())
                        <div class="block">
                            <button class="btn btn-primary"><a href="{{ route('blog_entries.edit', $entry->id)}}">記事の編集</a></button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/decorateEntryText.js') }}"></script>
</x-app-layout>
