<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CrudController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserController extends CrudController
{
  protected $table = 'users';
  protected $modelClass = User::class;

  public function createOne(Request $request)
  {
    $request->merge(['password' => Hash::make($request->password)]);
    return parent::createOne($request);
  }

  public function afterCreateOne($item, $request)
  {
    $item->syncRoles([$request->role]);
  }

  public function updateOne($id, Request $request)
  {
    if (isset($request->password) && !empty($request->password)) {
      $request->merge(['password' => Hash::make($request->password)]);
    } else {
      $request->request->remove('password');
    }
    $user = Auth::user();
    if($user->update($request->only('name', 'password'))){
      return response()->json([
        'success' => true,
        'data' => ['item' => $user],
        'validated' => $user,
        'message' => __(Str::of($this->table)->replace('_', '-') . '.updated')
      ]);
    }


  }

  public function afterUpdateOne($item, $request)
  {
    $item->syncRoles([$request->role]);
  }
}
