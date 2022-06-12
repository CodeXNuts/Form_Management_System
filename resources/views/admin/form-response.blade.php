<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Response') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @foreach ($responses as $response)
                        <div class="my-4">
                            <p>Form: <span class="font-bold">{{ $response->form->name }}</span></p>
                            <div>
                                @php
                                    $userResponses = json_decode($response->responses);
                                @endphp
                                @foreach($userResponses as $ques=>$userResponse)
                                    <p>{{ $ques }} : {{ is_array($userResponse) ? implode(',' ,$userResponse) : $userResponse }}</p>
                                @endforeach
                            </div>
                            <p class="font-bold">Submitted By: {{ $response->user->name??'Anonymous' }}</p>
                        </div>
                        <hr>
                    @endforeach
                      
                    {{ $responses->count() ? $responses->links() : '' }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
