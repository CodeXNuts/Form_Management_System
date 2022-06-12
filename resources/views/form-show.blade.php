<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-card>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('form.submit',[$formData]) }}" method="POST">
                            @csrf
                            <h1 class="text-center underline">{{ $formData->name }}</h1>

                            @foreach ($formData->formFields as $index => $formField)
                                <div class="mt-4">

                                    <label for class="inline w-20 font-medium text-sm text-gray-700">
                                        {{ $formField->question }}{!! $formField->is_required ? '<span class="text-red-500">*</span>' : '' !!} </label>
                                    {!! renderField($formField) !!}

                                </div>
                            @endforeach

                            <x-button type='submit' class="bg-blue-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl mt-6 hover:bg-blue-600">
                                {{ __('Submit') }}
                            </x-button>
                        </form>
                    </x-auth-card>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
