<!DOCTYPE html>
<html>
<head>
    <title>Vehicles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/Home.css') }}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('/js/Home.js') }}"></script>
</head>
<body>
    <center>
    <form id="userForm" action="{{ route('submit.form') }}" method="POST">
            @csrf
            <h1>First, what's your Name?</h1>
            <input type="text" name="firstname" id="firstname" class="name-input" placeholder="First Name" required />
            <label for="firstname" class="input-label">First Name</label><br><br/>
            <input type="text" name="lastname" id="lastname" class="name-input" placeholder="Last Name" required />
            <label for="lastname" class="input-label">Last Name</label><br/><br/>
            <button class="custom-button" type="submit">Submit</button>
        </form>
    </center>
</body>
</html>
