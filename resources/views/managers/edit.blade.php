<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{__('translate.Edit Manager')}} - {{ $manager->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">{{__('translate.Edit Manager')}}</legend>
                        <form method="POST" action="{{ route('managers.update', $manager->id) }}">
                            @method('patch')
                            @csrf
                            <div class="grid w-full grid-cols-2 gap-4">
                                <div class="w-full">
                                    <x-input-label>{{__('translate.Name')}}</x-input-label>
                                    <x-text-input value="{{ old('name', $manager->name) }}" class="w-full"
                                        name='name'></x-text-input>
                                    @error('name')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- ... -->
                                <div class="w-full">
                                    <x-input-label>{{__('translate.mobile')}}</x-input-label>
                                    <x-text-input value="{{ old('mobile', $manager->mobile) }}" class="w-full"
                                        name='mobile'></x-text-input>
                                    @error('mobile')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                            <x-input-label>{{__('translate.company_name')}}</x-input-label>
                            <select name="company_id">
                                <option disabled selected>{{__('translate.Select Company name')}}</option>
                                @foreach (App\Models\Company::all() as $key => $company)
                                <option value="{{$company->id}}" {{$company->id == $manager->company_id ? 'selected' : ''}}>{{$company->name}}</option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <div class="font-bold text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                                <div>
                                    <div class="flex justify-end mt-7">
                                        <x-primary-button type='submit'>{{__('translate.Save')}}</x-primary-button>
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
