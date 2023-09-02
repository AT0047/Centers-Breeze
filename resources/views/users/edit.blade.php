<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit User - {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">Edit User</legend>
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @method('patch')
                            @csrf
                            <div class="grid w-full grid-cols-2 gap-4">
                                <div class="w-full">
                                    <x-input-label>Name</x-input-label>
                                    <x-text-input value="{{ old('name', $user->name) }}" class="w-full"
                                        name='name'></x-text-input>
                                    @error('name')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- ... -->
                                <div class="w-full">
                                    <x-input-label>Email</x-input-label>
                                    <x-text-input value="{{ old('email', $user->email) }}" class="w-full"
                                        name='email' type='email'></x-text-input>
                                    @error('email')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Password</x-input-label>
                                    <x-text-input value="{{ old('password', $user->password) }}" class="w-full"
                                        name='password' type='password'></x-text-input>
                                    @error('password')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>Role</x-input-label>
                                    <select name="type">
                                        <option disabled selected value=" old('type')">Select Role</option>
                                        <option value=" admin ">Admin</option>
                                        <option value=" user ">User</option>
                                        <option value=" instractor ">Instractor</option>
                                        <option value=" student ">Student</option>
                                    </select>
                                    @error('type')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <div class="flex justify-end mt-7">
                                        <x-primary-button type='submit'>Save</x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
