<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\FormField;
use App\Models\FormResponse;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        $forms = Form::withTrashed()->with(['user', 'formFields', 'fromResponses'])->orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.form', ['forms' => $forms]);
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'form_name' => ['required'],
            'visibility' => ['required'],
            'fieldTypes.*' => ['required'],
            'questions.*' => ['required'],
            'options.*' => ['required']
        ]);

        try {
            $form = Form::create([
                'name' => $request->form_name,
                'created_by' => auth()->id(),
                'is_auth_required' => !empty($request->visibility) ? true : false,

            ]);

            foreach ($request->fieldTypes as $index => $fieldType) {
                $formField = new FormField();
                $formField->form_id = $form->id;
                $formField->input_element_id = $fieldType;
                $formField->question = $request->questions[$index];
                $formField->option_fields = !empty($request->options[$index]) ? json_encode(explode(',', $request->options[$index])) : null;
                $formField->is_required = !empty($request->is_required[$index]) ? true : false;
                $formField->save();
            }

            $status = 'success';
            $msg = 'Form: ' . $request->form_name . ' has been published!!';
        } catch (\Throwable $th) {
            $status = 'fail';
            $msg = 'Form: ' . $request->form_name . ' could not be published!!';
        }

        return redirect()->route('form')->with($status, $msg);
    }

    public function destroy(Form $form)
    {
        $form->delete();

        return back()->with('success', 'Form deleted successfully');
    }

    public function restore($id)
    {
        Form::withTrashed()->find($id)->restore();
        return back()->with('success', 'Form restored successfully');
    }

    public function destroyPermanently($id)
    {
        Form::withTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Form deleted permanently!!');
    }

    public function showResponses(Form $form)
    {
        $responses = FormResponse::with(['form', 'user'])->where('form_id', $form->id)->orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.form-response', ['responses' => $responses]);
    }
}
