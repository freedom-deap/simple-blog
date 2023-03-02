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
                    <div class="mt-5 block flex flex-row-reverse flex-col justify-end fixed bottom-10 right-20">
                        <button type="button" onclick="submit()" class="btn btn-primary mb-4">記事の更新</button>
                        <label for="img-modal" class="btn btn-primary">画像の編集</lavel>
                    </div>
                </form>

                {{-- 画像編集用のモーダル --}}
                <input type="checkbox" id="img-modal" class="modal-toggle" />
                <label for="img-modal" class="modal cursor-pointer">
                    <label class="modal-box relative" for="">
                        <form id="img-form" action="{{ route('image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($entry->img_path !== null)
                                <h3>現在設定されている画像</h3>
                                <!--<img class="p-4" src="{{ \Storage::disk('s3')->temporaryUrl($entry->img_path, now()->addDay()) }}" />-->
                                <img class="p-4" src="{{ '/storage/'. $entry->img_path }}" />
                                <div class="mx-auto p-4">
                                    <button type="submit" class="btn btn-info" name="update-btn" value="update">画像の更新</button>
                                    <button type="submit" class="btn btn-error" name="delete-btn" value="delete">画像の削除</button>
                                </div>
                            @else
                                <button type="submit" class="btn btn-info" name="add-btn" value="add">画像の追加</button>
                            @endif
                            <!--<label for="img-file">画像のアップロード-->
                                <input class="p-4" type="file" id="img-file" name="img_file" accept="image/png, image/jpeg" />
                            <!--</label>-->
                            <input type="hidden" name="entry_id" value="{{ __($entry->id) }}" />
                            <input type="hidden" name="img_path" value="{{ __($entry->img_path) }}" />
                        </form>
                    </label>
                </label>
            </div>
        </div>
    </div>
</x-app-layout>
