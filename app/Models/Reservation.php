<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id',
      'event_id'
    ];

    public function rules()
  {
    $rules = [
      'user_id'=>'required|integer',
      'event_id'=>'required|integer'
  ];

    return $rules;
}
 public function user(){
    return $this->belongsTo(User::class);
  }
}
