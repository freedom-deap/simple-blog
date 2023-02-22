<x-app-layout>
    <x-slot name="header">
        <h2 class="mx-auto w-3/4 flex justify-start font-semibold text-xl text-gray-800 leading-tight">
            {{ __('記事の編集') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-3/4 flex justify-center sm:px-6 lg:px-8">
            <div class="w-full">
                <form method="POST" action="{{ route('blog_entries.update', $entry->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-5 mx-auto w-3/4">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">タイトル</label>
                        <input name="title" value="{{ __($entry->title) }}" class="input input-bordered w-full rounded-lg"></input>
                    </div>
                    <div class="mb-5 mx-auto w-3/4">
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">本文</label>
                        <textarea name="content" class="block p-2.5 w-full h-50 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 textarea textarea-lg" rows="15">{{ __($entry->content) }}</textarea> 
                    </div>
                    <div>
                        <input type="hidden" name="entry_id" value="{{ __($entry->id) }}"></input>
                    </div>
                    <div class="mt-5 block flex justify-end fixed bottom-10 right-20">
                        <button type="button" onclick="submit()" class="btn btn-primary">記事の更新</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
