<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <h1>{{ __($entry->title)}}</h1>
                <p>投稿日時: {{__($entry->created_at->format('Y年m月d日'))}}, 更新日時: {{__($entry->updated_at->format('Y年m月d日'))}}</p>
                <p>{{ __($entry->user->name)}}</p>
            </div>
            <div>
              {!! $entry->content !!}  
            </div>
            {{-- ログインしているかの判定 --}}
            @if (Auth::check())
            <div>
                @if (\Auth::user()->isFavorited($entry->id))
                    <button><a href="{{ route('unfavorite', $entry->id) }}">お気に入り解除</a></button>
                @else
                    <button><a href="{{ route('favorite', $entry->id) }}">お気に入り登録</a></button>
                @endif
            </div>
            @endif
            {{-- 閲覧しているユーザが投稿者かどうかの判定 --}}
            @if ($entry->user_id === Auth::id())
            <div>
                <button><a href="{{ route('blog_entries.edit', $entry->id)}}">編集</a></button>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
