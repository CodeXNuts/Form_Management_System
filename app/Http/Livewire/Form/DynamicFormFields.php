<?php

namespace App\Http\Livewire\Form;

use App\Models\InputElement;
use Livewire\Component;

class DynamicFormFields extends Component
{
    public $createdFieldsArr = [];
    public $availableFieldsType;
    public function mount()
    {
        $this->availableFieldsType = InputElement::get();
        $this->createField();
    }
    public function render()
    {
        return view('livewire.form.dynamic-form-fields');
    }

    public function fetchTemplate($fieldType, $indexVal)
    {
        $desiredNode = $this->availableFieldsType->filter(
            fn ($k) =>
            $k->id == $fieldType
        )->first();

        $this->createdFieldsArr[$indexVal] = [
            'type' => $fieldType,
            'template' => $desiredNode->template,
            'has_options' => $desiredNode->has_options
        ];
    }

    public function createField()
    {
        $this->createdFieldsArr[array_key_last($this->createdFieldsArr)+1] = [
            'type' => $this->availableFieldsType[0]->id,
            'template' => $this->availableFieldsType[0]->template,
            'has_options' => $this->availableFieldsType[0]->has_options
        ];
    }

    public function deleteField($indexVal)
    {
        unset($this->createdFieldsArr[$indexVal]);
        
        array_values($this->createdFieldsArr);
        //dd($this->createdFieldsArr);
    }
}
