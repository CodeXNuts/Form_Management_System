<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <button
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <a href="{{ route('form.create') }}">
                            <svg xmlns="http://www.google.com" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Create Form</span>
                        </a>
                    </button>
                    <button
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                            <span>Responses</span>
                        </a>
                    </button>

                    <div class="bg-slate-100 mt-2">
                        <div class="ml-4">
                            <h1 class="font-extrabold  underline">Created Forms</h1>
                            @foreach ($forms as $form)
                                <div class="mb-4 mt-4">
                                    <h1
                                        class="font-bold {{ $form->deleted_at ? 'line-through decoration-red-500' : '' }}">
                                        {{ $form->name }}
                                    </h1>
                                    <h3 class="">Created By: {{ $form->user->name }}</h3>
                                    <p>Created at: {{ $form->created_at->diffForHumans() }}</p>
                                    <p>Total Question: {{ count($form->formFields) }}</p>
                                    @if (count($form->fromResponses))
                                        <p>Total Responses: <a class="text-blue-600 underline"
                                                href="{{ route('form.response.show', [$form]) }}">{{ count($form->fromResponses) }}</a>
                                        </p>
                                    @else
                                        <p>Total Response: {{ count($form->fromResponses) }}</p>
                                    @endif
                                    <p>Visibility:<span
                                            class="{{ $form->deleted_at ? 'line-through decoration-red-500' : '' }}">
                                            {{ $form->is_auth_required ? 'Autheticated Users' : 'Public' }}</span>
                                    </p>
                                    <p>Link: <span
                                            class="{{ $form->deleted_at ? 'line-through decoration-red-500' : '' }}">{{ route('form.show', [$form]) }}</span>
                                    </p>
                                    @if ($form->deleted_at)
                                        <p>Deleted at: {{ $form->deleted_at->diffForHumans() }}</p>

                                        <a href="{{ route('form.restore', [$form->id]) }}">
                                            <x-button type='submit' class=" mt-4 text-xs bg-green-300  text-white">
                                                {{ __('Restore') }}
                                            </x-button>
                                        </a>
                                        <a href="{{ route('form.force.delete', [$form->id]) }}">
                                            <x-button class=" mt-4 text-xs bg-red-500  text-white">
                                                {{ __('Delete Permanently') }}
                                            </x-button>
                                        </a>
                                    @else
                                        <a href="{{ route('form.show', [$form]) }}" target="_blank">
                                            <x-button class=" mt-4 text-xs bg-blue-300  text-white">
                                                {{ __('Preview') }}
                                            </x-button>
                                        </a>
                                        <form class="inline" action="{{ route('form.delete', [$form]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-button type='submit'
                                                class="mt-4 ml-4 text-xs bg-red-500 hover:bg-red-700 text-white">
                                                {{ __('Delete') }}
                                            </x-button>
                                        </form>
                                    @endif

                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>

                    {{ $forms->count() ? $forms->links() : '' }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
