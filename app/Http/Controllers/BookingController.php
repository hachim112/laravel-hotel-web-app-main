<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // Show list of available rooms to users
    public function index()
    {
        $rooms = Room::where('status', 'available')->get();
        return view('rooms.index', compact('rooms'));
    }

    // Show booking form for a specific room
    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room'));
    }

    // Handle booking form submission
    public function book(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Validate user input
        $validator = Validator::make($request->all(), [
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If user is not logged in, redirect to login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must login first.');
        }

        // Create transaction
        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'guests' => $request->guests,
            'status' => 'booked', // or pending if you want confirmation
        ]);

        // Update room status
        $room->status = 'booked';
        $room->save();

        return redirect()->route('rooms.index')->with('success', 'Room booked successfully!');
    }




public function store(Request $request)
{
    $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
        'guests' => 'required|integer|min:1',
    ]);

    Booking::create([
        'room_id' => $request->room_id,
        'user_id' => auth()->id(),
        'check_in' => $request->check_in,
        'check_out' => $request->check_out,
        'guests' => $request->guests,
        'status' => 'pending',
    ]);

    return redirect()->back()->with('success', 'Room booked successfully!');
}




}
