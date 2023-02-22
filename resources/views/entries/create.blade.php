<x-app-layout>
    <x-slot name="header">
        <h2 class="mx-auto w-3/4 flex justify-start font-semibold text-xl text-gray-800 leading-tight">
            {{ __('新規記事作成') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto w-3/4 flex justify-center smsm:px-6 lg:px-8">
            <form method="POST" action="{{ route('blog_entries.store') }}" class="w-full">
                @csrf
                <div class="mb-5 mx-auto w-3/4">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">タイトル</label>
                    <input name="title" required="required" class="input w-full rounded-lg border border-gray-300"></input>
                </div>
                <div class="mb-5 mx-auto w-3/4">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">本文</label>
                    <textarea name="content" required="required" class="block p-2.5 w-full h-50 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 textarea textarea-lg" rows="15" placeholder="記入例: <h2>見出し</h2>"></textarea> 
                </div>
                <div class="mt-5 block flex justify-end fixed bottom-10 right-20">
                    <button type="button" class="btn btn-primary" onclick="submit()">新規記事作成</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
