<nav x-data="{ open: false }" class="bg-neutral border-b border-gray-100 sticky top-0">
    <!-- Primary Navigation Menu -->
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 w-full justify-center">
            <div class="flex w-2/3">
                <!-- Logo -->
                <div class="shrink-0 flex items-center w-1/5">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                    </a>
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white">Simple Blog</span>
                </div>

            @if (Auth::check())
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('記事一覧') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <x-nav-link :href="route('blog_entries.create')" :active="request()->routeIs('blog_entries.create')">
                        {{ __('新規記事作成') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <x-nav-link :href="route('user.index', Auth::id())" :active="request()->routeIs('user.index')">
                        {{ __('ユーザ詳細') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <form style="margin: auto" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('ログアウト') }}
                    </x-nav-link>
                    </form>
                </div>
            @else
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('記事一覧') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <x-nav-link>
                        {{ __('新規記事作成') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('ユーザ登録') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex w-1/5">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('ログイン') }}
                    </x-nav-link>
                </div>
            @endif
            </div>
        </div>
    </div>
</nav>
