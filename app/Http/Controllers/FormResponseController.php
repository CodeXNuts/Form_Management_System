<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class FormResponseController extends Controller
{
    public function index(Form $form)
    {
        $this->actOnVisibility($form->is_auth_required);
        $formData = $form::with(['formFields'])->find($form->id);
        return view('form-show', ['formData' => $formData]);
    }

    public function store(Form $form, Request $request)
    {
        $this->actOnVisibility($form->is_auth_required);
        $form = $form::with(['formFields'])->find($form->id);

        $validationRules = [];
        foreach ($form->formFields as $formField) {
            $validationRules[$formField->inputElements->type . '.' . ($formField->id) . ''] = ($formField->is_required) ? ['required'] : [];
        }

        $request->validate($validationRules);

        $responseArr = [];
        foreach ($request->all() as $each) {
            if (is_array($each)) {
                foreach ($each as $field => $val) {
                    $question = $form->formFields->filter(
                        fn ($k) =>
                        $k->id == $field
                    )->first()->question;

                    $responseArr[$question] = $val;
                }
            }
        }
        try {
            FormResponse::create([
                'form_id' => $form->id,
                'user_id' => $form->is_auth_required ? auth()->id() : null,
                'responses' => json_encode($responseArr)
            ]);
        } catch (\Throwable $th) {
        }

        if($form->is_auth_required)
        {
            return redirect()->route('home')->with('success','Your response submitted sucessfully.');
        }
       
        print_r('Dear Guest, Thank you for your valuable response!!!');
    }

    private function actOnVisibility($auth_param)
    {
        if ($auth_param) {
            auth()->id()
                ??
                throw new ModelNotFoundException('You are not authorised');
        }
    }
}
