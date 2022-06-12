<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    use HasFactory;

    protected $fillable =['form_id'];

    protected $with = ['inputElements'];
    
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function inputElements()
    {
        return $this->hasOne(InputElement::class,'id','input_element_id');
    }
}
