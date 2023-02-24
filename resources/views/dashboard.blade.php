<x-app-layout>
    <x-slot name="header">
        <h2 class="mx-auto w-3/4 flex justify-start font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記事一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if (Auth::check())
            <a href="{{ route('blog_entries.create') }}"><button class="fixed bottom-10 right-10 btn btn-info btn-lg">新規記事作成</button></a>
        @endif
        <div class="w-2/3 mx-auto sm:px-6 lg:px-8">
            @foreach ($entries as $entry)
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="bg-white p-4 mb-6">
                        <a class="text-lg hover:underline" href="{{ route('user.index', $entry->user->id) }}">{{ __($entry->user->name) }}</a>
                        @if ($entry->created_at == $entry->updated_at)
                            <p class="text-sm">{{ __('投稿日: '. $entry->created_at->format('Y年m月d日')) }}</p>
                        @else
                            <p class="text-sm">{{ __('投稿日: '. $entry->created_at->format('Y年m月d日'). ' 更新日: '. $entry->updated_at->format('Y年m月d日')) }}</p>
                        @endif
                        <a class="text-2xl hover:underline" href="{{ route('blog_entries.show', $entry->id) }}">{{ __($entry->title) }}</a>
                        <p class="text-sm">お気に入り数: {{ __($entry->favorited_count) }}</p>
                        @if (Auth::check())
                            <div class="flex justify-end">
                                <form class="favorite-form" method="POST" action="{{ route('favorite') }}">
                                        @csrf
                                        <input type="hidden" name="entry_id" value="{{ __($entry->id) }}"></input>
                                        <button type="submit" class="flex justify-end">
                                            @if (\Auth::user()->isFavorited($entry->id))
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 favorite-star favorited entry-{{ __($entry->id) }}">
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 favorite-star unfavorited entry-{{ __($entry->id) }}">
                                            @endif
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                            </svg>
                                        </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
            {{ $entries->links() }}
        </div>
    </div>
</x-app-layout>
