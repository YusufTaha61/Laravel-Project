<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div style="max-width: 1200px; margin: 20px auto; padding: 0 20px; text-align: left;">
        <a href="{{ url('/dashboard') }}" style="text-decoration: none; color: #374151; font-weight: 600; font-size: 14px; background-color: #f3f4f6; padding: 8px 16px; border-radius: 20px; border: 1px solid #d1d5db; transition: all 0.2s ease; display: inline-block;" onmouseover="this.style.backgroundColor='#e5e7eb'" onmouseout="this.style.backgroundColor='#f3f4f6'">
            ⬅ Hesabıma Dön
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
