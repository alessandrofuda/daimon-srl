<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>

                <div class="p-6 text-gray-900">
                    Token: {{ $token ?? 'no token found' }}
                    @if($token)
                        <div>(Per praticità passo il token via Url, normalmente viene storato nel client in localStorage. Il Token viene poi passato alla chiamata API nell'header Authorization)</div>
                    @endif
                </div>

                <div class="p-6 text-gray-900">
                    <a href="breweries?token={{$token}}" class="border p-2">Show List using token above</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
