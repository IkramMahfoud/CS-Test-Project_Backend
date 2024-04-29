<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
  protected $table = 'reservations';
  protected $modelClass = Reservation::class;

  public function createOne(Request $request)
    {
      $reservation = new Reservation();
      $reservation->user_id = $request->user_id;
      $reservation->event_id = $request->event_id;

      if($reservation->save()){
        return response()->json([
          'success' => true,
          'data' => ['item' => $reservation],
          'message' => __(Str::of($this->table)->replace('_', '-') . '.created')
        ]);
      }



    }

    public function readOne($id)
    {
        $reservation=  Reservation::findOrFail($id);

        if($reservation){
          return response()->json([
            'success' => true,
            'data' => ['item' => $reservation],
            'message' => __(Str::of($this->table)->replace('_', '-') . '.read')
          ]);
        }
    }

    public function readAll()
    {
        $reservations = Reservation::all();
        if($reservations){
          return response()->json([
            'success' => true,
            'data' => ['items' => $reservations],
            'message' => __(Str::of($this->table)->replace('_', '-') . '.readAll')
          ]);
        }
    }

    public function updateOne(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->user_id=$request->user_id;
        $reservation->event_id=$request->event_id;
        if($reservation->update()){
          return response()->json([
            'success' => true,
            'data' => ['item' => $reservation],
            'message' => __(Str::of($this->table)->replace('_', '-') . '.updated')
          ]);
        }

    }

    public function deleteOne($id)
    {
      $reservation = Reservation::findOrFail($id);
      if($reservation->delete()){
        return response()->json([
          'success' => true,
          'message' => __(Str::of($this->table)->replace('_', '-') . '.deleted')
        ]);
      }
    }
}
