<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class=" flex flex-col sm:justify-center items-center py-4  sm:pt-0">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form action="{{ route('form.create.submit') }}" method="POST">
                            @csrf
                            <div class="mt-4">
                                <x-label for="name" :value="__('Form Name')" />

                                <x-input id="name" class="block mt-1 w-60" type="text" name="form_name" required
                                    autocomplete="Enter form name" />

                            </div>
                            <div class="mt-4 inline">
                                <x-label for="visibility" :value="__('Visibility')" />

                                <select name="visibility" id="visibility" class="w-60">
                                    <option value="1" selected>Authenticated Users</option>
                                    <option value="0">Public</option>
                                </select>

                            </div>
                            @livewire('form.dynamic-form-fields')

                            <x-button type="submit" class=" mt-4 ml-4 text-xs bg-red-400 hover:bg-red-700 text-white">
                                {{ __('Publish Form') }}
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
