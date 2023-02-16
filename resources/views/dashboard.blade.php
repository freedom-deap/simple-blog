<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記事一覧') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($entries as $entry)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <p>{{ __($entry->user->name) }}</p>
                        <p>投稿日: {{ __($entry->created_at->format('Y年m月d日')) }}</p>
                        <a href="{{ route('blog_entries.show', $entry->id) }}">{{ __($entry->title) }}</a>
                        <p>お気に入り数: {{ __($entry->favorited_count) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
