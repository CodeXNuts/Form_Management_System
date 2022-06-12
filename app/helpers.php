<?php

use Illuminate\Support\Str;

function renderField($formField)
{

    return call_user_func('create' . Str::ucfirst($formField->inputElements->type) . 'Field', $formField);
}


function createTextField( $formField): string
{

    $field =  "<input type='text' name='text[$formField->id]' class='w-60 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-1' ";
    $field .= $formField->is_required ? "required" : "";
    return $field . " >";
}
function createTextareaField( $formField): string
{
    $field = "<textarea name='textarea[$formField->id]' class='w-full text-sm focus:outline-none focus:ring'  cols='10' rows='2'";
    $field .= $formField->is_required ? "required" : "";
    return $field . "></textarea>";
}
function createCheckboxField( $formField)
{
    if ($formField->inputElements->has_options) {
        $field = '';
        $option_fields = json_decode($formField->option_fields);
        foreach ($option_fields as $option_field) {
            $field .= "<input class='ml-4' type='checkbox' name='checkbox[$formField->id][]' value='$option_field' > $option_field";
        }

        return $field;
    }
}
function createSelectField( $formField)
{
    if ($formField->inputElements->has_options) {
        $field = "<select name='select[$formField->id]' class=' rounded-lg bg-orange-100'";
        $field .= $formField->is_required ? "required" : "";
        $field .= " >";
        $option_fields = json_decode($formField->option_fields);
        foreach ($option_fields as $option_field) {
            $field .= "<option value='$option_field'>$option_field</option>";
        }
        $field .= "</select>";
        return $field;
    }
}
function createRadioField($formField)
{
    if ($formField->inputElements->has_options) {
        $field = '';
        $option_fields = json_decode($formField->option_fields);
        foreach ($option_fields as $option_field) {
            $field .= "<input type='radio' class='ml-2' name='radio[$formField->id]' value='$option_field'>";
            $field .= "<label class='ml-2'>$option_field</label>";
        }

        return $field;
    }
}
