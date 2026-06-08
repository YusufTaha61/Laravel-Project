<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div style="text-align: left; margin-bottom: 20px;">
                <a href="{{ route('home') }}" style="text-decoration: none; color: #5d4037; font-weight: 600; font-size: 14px; background: #efebe9; padding: 8px 15px; border-radius: 20px; display: inline-block;">
                    ⬅ Dükkana Dön
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                    
                    <div style="margin-top: 20px;">
                        <a href="{{ route('home') }}" style="padding: 12px 24px; background-color: #795548; color: white; text-decoration: none; border-radius: 8px; font-weight: 600; display: inline-block;">
                            ☕ Ana Sayfaya Dön ve Alışverişe Başla
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>