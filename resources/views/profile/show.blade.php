<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Profil Saya</h1>

            <div class="flex flex-col md:flex-row gap-8">
                <!-- Bagian Info Profil -->
                <div class="md:w-1/3">
                    <div class="flex items-center space-x-6 mb-8">
                        <div class="relative">
                            <img src="{{ auth()->user()->profile_photo_url ?? asset('images/default-avatar.png') }}"
                                class="w-20 h-20 rounded-full object-cover">
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
                            <p class="text-gray-600">{{ auth()->user()->email }}</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-medium text-gray-500">Member Sejak</h3>
                            <p>{{ auth()->user()->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Bagian Edit Profil -->
                <div class="md:w-2/3">
                    @include('profile.partials.update-profile-information-form')

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="mt-8 border-t border-gray-200 pt-8">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>