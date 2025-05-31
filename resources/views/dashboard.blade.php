<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Total Posts</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ Auth::user()->posts()->count() }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Total Comments</h3>
                        <p class="text-3xl font-bold text-green-600">{{ Auth::user()->comments()->count() }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Account Status</h3>
                        <p class="text-3xl font-bold text-yellow-600">{{ Auth::user()->status ?? 'Active' }}</p>
                    </div>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-2">Member Since</h3>
                        <p class="text-3xl font-bold text-purple-600">{{ Auth::user()->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Profile Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 mb-2">Name: <span class="text-gray-900">{{ Auth::user()->name }}</span></p>
                            <p class="text-gray-600 mb-2">Email: <span class="text-gray-900">{{ Auth::user()->email }}</span></p>
                            <p class="text-gray-600 mb-2">Username: <span class="text-gray-900">{{ Auth::user()->username }}</span></p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-2">Phone: <span class="text-gray-900">{{ Auth::user()->phone ?? 'Not set' }}</span></p>
                            <p class="text-gray-600 mb-2">Country: <span class="text-gray-900">{{ Auth::user()->country ?? 'Not set' }}</span></p>
                            <p class="text-gray-600 mb-2">City: <span class="text-gray-900">{{ Auth::user()->city ?? 'Not set' }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>