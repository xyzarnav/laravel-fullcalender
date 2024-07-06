<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event; // Corrected namespace for Event model

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all(); // Assuming you have an Event model to fetch events
        return view('', compact('events')); // Return the view with the events data
    }
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->event_start_time = $request->input('event_start_time');
        $event->event_end_time = $request->input('event_end_time');
        $event->event_color_coding = $request->input('event_color_coding');
        $event->event_priority = $request->has('event_priority') ? 1 : 0; // Correct handling of checkbox
        $event->save();

        return back()->with('success', 'Event updated successfully');
    }


    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        // Assuming 'cal_operation' is the name of the route
        return redirect()->route('cal_operation');
    }
    public function getEvents()
    {
        $events = Event::all();

        // Map events to the required format
        $formattedEvents = $events->map(function ($event) {
            return [
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                // Include other fields as necessary
            ];
        });

        return response()->json($formattedEvents);
    }



    public function filterEvents(Request $request)
    {
        $filterPriority = $request->input('filterPriority');

        if ($filterPriority) {
            $events = Event::where('event_priority', $filterPriority)->get();
        } else {
            $events = Event::all();
        }
        $eventData = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'event_color_coding' => $event->event_color_coding, // Ensure this is included
                'event_start_time' => $event->event_start_time, // Ensure this is included
                'event_end_time' => $event->event_end_time, // Ensure this is included
                // Include any other necessary fields
            ];
        });

        return response()->json($eventData); // Corrected to return $eventData
    }

}
