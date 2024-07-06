<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class FullCalenderController extends Controller
{

    // Import the Event model at the top of your controller file.
    public function getEvents(Request $request)
    {
        $filterPriority = $request->input('filterPriority');

        if ($filterPriority) {
            $events = Event::where('priority', $filterPriority)->get();
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
                // Include any other necessary fields
            ];
        });

        return response()->json($eventData);
    }


    public function homepagecal()
    {
        $events = Event::all(); // Fetch events from your database using your Event model
        return view('vendor.admin.operation_cal', compact('events'));
    }

    public function open_cal_operation()
    {
        $events = Event::all(); // Assuming you have an Event model to fetch events from the database
        return view('vendor.admin.operation_cal', compact('events'));
    }

    public function showEvents()
    {
        $events = Event::all(); // Fetch all events from the database.
        return view('form2', compact('events')); // Pass the events to the view.
    }
    public function view_testing(Request $request)
    {
        return view('testing');
    }
    public function admin_cal(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::whereDate('start', '>=', $request->start)
                ->whereDate('end', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('vendor.admin.homepagecalender');
    }




    public function store_events(Request $request)
    {
        // Step 0: Log incoming request data
        Log::info('Incoming request data: ', $request->all());

        try {

            $request->merge(['event_priority' => (int) $request->event_priority]);
            // Step 1: Validate the incoming request
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'start' => 'required|date',
                'end' => 'required|date|after_or_equal:start',
                'event_color_coding' => 'required|string|max:255',
                'event_priority' => 'required|integer',

                'event_start_time' => 'nullable|date_format:H:i',
                'event_end_time' => 'nullable|date_format:H:i',


            ]);

            // Step 2: Create a new event instance
            $event = new Event();
            $event->title = $validatedData['title'];
            $event->start = $validatedData['start'];
            $event->end = $validatedData['end'];
            $event->event_color_coding = $validatedData['event_color_coding'];
            $event->event_priority = $validatedData['event_priority'];
            $event->event_start_time = $validatedData['event_start_time'];
            $event->event_end_time = $validatedData['event_end_time'];

            // Step 3: Save the event to the database
            try {
                // Assuming $request is your request object and contains the event data
                if (!$request->has('event_start_time')) {
                    return response()->json([
                        'message' => 'Failed to save event.',
                        'error' => 'Missing required field: event_start_time'
                    ], 400); // Bad Request
                }

                // Proceed with event creation or update
                // ...

            } catch (ValidationException $e) {
                // Log validation errors
                Log::error('Validation failed: ', $e->errors());

                // Return a response with validation errors
                return response()->json([
                    'message' => 'Validation failed.',
                    'errors' => $e->errors()
                ], 422);
            }
            if (!$event->save()) {
                Log::error('Failed to save the event: Save operation returned false.');
                return response()->json([
                    'message' => 'Failed to save event.',
                    'error' => 'Save operation failed.'
                ], 500);
            }

            // Step 4: Return a response
            return response()->json([
                'message' => 'Event created successfully!',
                'event' => $event
            ], 201);

        } catch (ValidationException $e) {
            // Log validation errors
            Log::error('Validation failed: ', $e->errors());

            // Return a response with validation errors
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log detailed exception information
            Log::error('Error saving event: ', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return response()->json([
                'message' => 'Failed to save event.',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
