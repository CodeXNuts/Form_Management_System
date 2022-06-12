<div>
    <x-button class="mt-4" wire:click.prevent='createField'>
        {{ __('Add Field') }}
    </x-button>
    @foreach ($createdFieldsArr as $index=>$createdField)
        
        <div class="mt-6" > 
            <select name="fieldTypes[{{ $index }}]" wire:click.prevent="fetchTemplate($event.target.value, {{ $index }})" id="" class="w-60">
                @foreach ($availableFieldsType as $availableField)
                    <option value="{{ $availableField->id }}"
                        {{ $createdField['type'] ==  $availableField->id ? 'selected' : ''}}
                        >
                        {{ Str::ucfirst($availableField->name) }}
                    </option>
                @endforeach
            </select>

            <label class=" inline w-20 font-medium text-sm text-gray-700" for="question[{{ $index }}]">
                Your Question
            </label>
            <input class=" inline rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1 w-60"  type="text" name="questions[{{ $index }}]" required="required" placeholder="Enter your question" >
            @if ($createdField['has_options'])
            <input class="w-60 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1"
            type="text" placeholder="options with comma" name="options[{{ $index }}]">
            @endif
                
            <input type="checkbox" name="is_required[{{ $index }}]" class="ml-2"> Required 
            <x-button class=" mt-4 ml-4 text-xs bg-red-400 hover:bg-red-700 text-white" wire:click.prevent='deleteField({{ $index }})'>
                {{ __('Delete') }}
            </x-button>
            
        </div>
    @endforeach
</div>
