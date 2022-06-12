<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = ['name' , 'created_by' , 'is_auth_required'];
    
    public function user()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function formFields()
    {
       return $this->hasMany(FormField::class);
    }

    public function inputElements()
    {
        return $this->hasManyThrough(InputElement::class,FormField::class,'input_element_id','id');
    }

    public function fromResponses()
    {
        return $this->hasMany(FormResponse::class);
    }
}
