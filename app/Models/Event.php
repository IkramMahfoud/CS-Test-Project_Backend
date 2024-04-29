<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'date',
      'location',
      'description',
      'max_participants',
      'image',
      'user_id'
    ];

    public function rules()
  {
    $rules = [
      'name' => 'required|string',
      'date' => 'required|date',
      'location' => 'required|string',
      'description' => 'required|string',
      'max_participants' => 'nullable|integer',
      'image' => 'nullable|string',
      'user_id'=>'required|integer'
  ];
    return $rules;
  }


  public function user(){
    return $this->belongsTo(User::class);
  }



}
