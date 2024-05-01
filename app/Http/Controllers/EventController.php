<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Str;
class EventController extends Controller
{
  protected $table = 'events';
  protected $modelClass = Event::class;

  public function createOne(Request $request)
    {
        // $file = $request->file('image');
        $uniqueFileName = date('Ymd_His') . '_' . uniqid();
        // $request->file('image')->move(public_path('images'), $uniqueFileName);
        $event = new Event();
        $date = date('Y-m-d H:i:s', strtotime($request->date));
        $event->name=$request->name;
        $event->date=$date;
        $event->location=$request->location;
        $event->description=$request->description;
        $event->max_participants=$request->max_participants;
        $event->image=$request->image;
        $event->user_id=$request->user_id;
        if($event->save()){
          return response()->json([
            'success' => true,
            'data' => ['item' => $event],
            'message' => __(Str::of($this->table)->replace('_', '-') . '.created')
          ]);
        }
    }


    public function readOne($id)
    {
        // Find the event by its ID
        $event = Event::with('user')->findOrFail($id);

        if($event){
          return response()->json([
            'success' => true,
            'data' => ['item' => $event],
            'message' => __(Str::of($this->table)->replace('_', '-') . '.read')
          ]);
        }

    }

    public function readAll()
    {
        // Retrieve all events
        $events = Event::with('user')->with('reservations')->get();
        if($events){
          return response()->json([
            'success' => true,
            'data' => ['items' => $events],
          ]);
        }
    }

    public function updateOne(Request $request, $id)
    {
        // Find the event by its ID
        $event = Event::findOrFail($id);
        $event->name = $request->input('name');
        $event->date = $request->input('date');
        $event->location = $request->input('location');
        $event->description = $request->input('description');
        $event->max_participants = $request->input('max_participants');
        $event->image = $request->input('image');
        $event->user_id=$request->input("user_id");

        if($event->update()){
          return response()->json([
            'success' => true,
            'data' => ['item' => $event],
            'message' => __(Str::of($this->table)->replace('_', '-') . '.update')
          ]);
        }

    }

    public function deleteOne($id)
    {
        // Find the event by its ID and delete it
        $event = Event::findOrFail($id);

        if($event->delete()){
          return response()->json([
            'success' => true,
            'message' => __(Str::of($this->table)->replace('_', '-') . '.deleted')
          ]);
        }
    }

}
