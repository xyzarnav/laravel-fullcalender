<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

use App\Models\Event;
use Illuminate\Support\Facades\Log;

class FullCalenderController extends Controller
{
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
        return view('vendor.admin.full-calender');
    }

    public function action(Request $request)
    {
        if ($request->ajax()) {
            if ($request->type == 'add') {
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'event_color_coding' => $request->event_color_coding,
                    'event_priority' => $request->event_priority,

                ]);

                return response()->json($event);
            }

            if ($request->type == 'update') {
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end,
                    'event_color_coding' => $request->event_color_coding,
                    'event_priority' => $request->event_priority
                ]);

                return response()->json($event);
            }

            if ($request->type == 'delete') {
                $event = Event::find($request->id)->delete();

                return response()->json($event);
            }
        }
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
                'event_priority' => 'required|integer'
            ]);

            // Step 2: Create a new event instance
            $event = new Event();
            $event->title = $validatedData['title'];
            $event->start = $validatedData['start'];
            $event->end = $validatedData['end'];
            $event->event_color_coding = $validatedData['event_color_coding'];
            $event->event_priority = $validatedData['event_priority'];

            // Step 3: Save the event to the database
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
