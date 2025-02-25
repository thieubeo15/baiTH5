<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Update Profile Information Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">{{ __('Profile Information') }}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>

                    <!-- Form to update profile information -->
                    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"
                        enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- Name Input -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <!-- Bio Input -->
                        <div>
                            <x-input-label for="bio" :value="__('Bio')" />
                            <x-text-input id="bio" name="bio" type="text" class="mt-1 block w-full"
                                :value="old('bio', $user->bio)" required autofocus autocomplete="bio" />
                            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                        </div>

                        <!-- Avatar Image Upload -->
                        <div id="imageDisplay" style="margin-top: 20px;">
                            <x-input-label for="avatar" :value="__('Avatar')" />
                            <!-- Hiển thị ảnh mặc định -->
                            <img id="imagePreview" src="{{ $user->avatar_url }}" alt="Change Avatar"
                                class="rounded-full w-32 h-32 object-cover mx-auto" style="display: block;">
                            <input type="file" id="imageInput" name="image" accept="image/*"
                                class="block w-full text-sm text-gray-700 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>

                        <!-- Email Input -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                                :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Password Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Form -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to preview image -->
    <script>
        document.getElementById("imageInput").addEventListener("change", function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();

                // Đọc file và hiển thị ảnh
                reader.onload = function(e) {
                    const imageElement = document.getElementById("imagePreview");
                    imageElement.src = e.target.result;
                    imageElement.style.display = "block"; // Hiển thị ảnh
                };

                reader.readAsDataURL(file); // Đọc file dưới dạng URL dữ liệu
            }
        });
    </script>
</x-app-layout>
