<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CarType;
use Illuminate\Support\Facades\Log;
use App\Models\Bookings;
use App\Models\FourWheelerType;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function submitForm(Request $request)
    {
        // Retrieve the form data
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');

        session(['firstname' => $firstname, 'lastname' => $lastname]);

        // For demonstration purposes, we're just returning the data
        return response()->json([
            'firstname' => $firstname,
            'lastname' => $lastname
        ]);
       // return $this->submitSelection($request);
    }

     public function submitSelection(Request $request)
    {
        $validated = $request->validate([
            'vehicleType' => 'required|string',
            'option' => 'required|string',
        ]);

        // Process the data (e.g., save to the database, perform calculations)
        // For demonstration, we'll just return the received data
        session([
            'vehicleType' => $validated['vehicleType'],
            'option' => $validated['option'],
        ]);
        
        // Process the data (e.g., save to the database, perform calculations)
        // For demonstration, we'll just return the received data

         //$vehicles = $query->get();
         $existingBooking = Bookings::where('option',  session('option'))->first();
         if ($existingBooking) {
            // return response()->json(['success' => false, 'message' => 'Option already exists']);
             return response()->json([
                'message' => 'Option already exists',
                'vehicleType' => session('vehicleType'),
                'option' => session('option')
            ]);
         }
         else{
            return response()->json([
                'message' => 'Booked',
            ]);
         }
    }

    // API to Fetch Vehicles
    public function getVehicles($type, $carType = null)
    {
        $query = Vehicle::query();

        if ($type == 'twoWheeler') {
            $vehicles =    $query->where('type', 'twoWheeler')->get();
        } elseif ($type == 'fourWheeler') {
            $vehicles = $query->where('type', 'fourWheeler')
            ->where('category', $carType)
            ->get();

        }
        return response()->json($vehicles);
    }

    //Get All Car Types
    public function getCarTypes()
{
    // Fetch car types from the database
    $carTypes = CarType::all();
    
    return response()->json($carTypes);
}


    public function store(Request $request)
    {
        // Retrieve and decode the JSON data from the session
        //echo $formData = session('firstname');
        $validatedData = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate'
        ]);

        $existingBooking = Bookings::where('option',  session('option'))->first();
        if ($existingBooking) {
            return response()->json(['success' => false, 'message' => 'Option already exists']);
        }

        // Create a new Bookings instance
        $data = new Bookings;
        $data->firstname = session('firstname'); 
        $data->lastname = session('lastname');
        $data->vehicle_type = session('vehicleType');
        $data->option = session('option');
        $data->start_date =  $validatedData['startDate'];
        $data->end_date =  $validatedData['endDate'];

        // Save the data
        if ($data->save()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
} 


