<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/Vehicle.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('/js/Vehicle.js') }}"></script>
    <title>Select Vehicles</title>
</head>
<body>
    <div class="container">
        <form id="vehicleForm">
            <h1>Please Select a Vehicle Type</h1>
            <div class="input-container">
                <input type="radio" id="twoWheeler" name="vehicleType" value="twoWheeler">
                <label for="twoWheeler">Two Wheeler</label>
                <input type="radio" id="fourWheeler" name="vehicleType" value="fourWheeler">
                <label for="fourWheeler">Four Wheeler</label>
            </div>
            <div id="optionsContainer" style="display: none;">
                <h2>Select Option:</h2>
                <select id="carTypeDropdown">
                    <!-- Dropdown options will be populated dynamically -->
                </select>
                <br/>
                <select id="optionsSelect" name="options">
                    <!-- Options will be populated dynamically using JavaScript -->
                </select>
            </div>
            <br>
            <button class="custom-button" type="button" onclick="submitForm()">Next</button>
        </form>
    </div>
</body>
</html>
