<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('新規記事作成') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('blog_entries.store') }}">
                @csrf
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">タイトル</label>
                    <input name="title"></input>
                </div>
                <div>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">本文</label>
                    <textarea name="content" class="block p-2.5 w-9/12 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea> 
                </div>
                <div>
                    <button type="button" onclick="submit()">作成</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>