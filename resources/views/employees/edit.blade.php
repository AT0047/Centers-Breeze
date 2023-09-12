<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{__('translate.Edit Employee')}} - {{ $employee->user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <fieldset class="p-5 border rounded-xl">
                        <legend class="p-2 text-lg font-bold">{{__('translate.Edit Employee')}}</legend>
                        <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                            @method('patch')
                            @csrf
                            <div class="grid w-full grid-cols-2 gap-4">
                                <div class="w-full">
                                    <x-input-label>{{__('translate.Salary')}}</x-input-label>
                                    <x-text-input type="number" value="{{ old('salary', $employee->salary)}}" class="w-full"
                                        name='salary'></x-text-input>
                                    @error('salary')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- ... -->
                                <div class="w-full">
                                    <x-input-label>{{__('translate.Job Title')}}</x-input-label>
                                    <x-text-input value="{{ old('job_title', $employee->job_title) }}" class="w-full"
                                        name='job_title'></x-text-input>
                                    @error('job_title')
                                        <div class="font-bold text-red-600">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="w-full">
                                    <x-input-label>{{__('translate.Hire Date')}}</x-input-label>
                                    <x-text-input type="date" value="{{ old('hire_date', $employee->hire_date) }}" class="w-full"
                                        name='hire_date'></x-text-input>
                                    @error('hire_date')
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
