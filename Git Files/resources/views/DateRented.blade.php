<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Reservation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/DateRented.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('/js/DateRented.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <form id="reservationForm">
            <h1>Select Reservation Dates</h1>
            
            <label for="startDate">Start Date:</label>
            <input type="date" id="startDate" name="startDate" required>
            
            <label for="endDate">End Date:</label>
            <input type="date" id="endDate" name="endDate" required>
            
            <button class="custom-button" type="submit">Submit</button>                
        </form>
    </div>
</body>
</html>
