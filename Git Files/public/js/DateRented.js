document.getElementById('reservationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the dates
    var startDateInput = document.getElementById('startDate').value;
    var endDateInput = document.getElementById('endDate').value;
    
    var startDate = new Date(startDateInput);
    var endDate = new Date(endDateInput);

    // Validate the dates
    if (!startDateInput || !endDateInput) {
        swal("Please select both start and end dates!");
        return;
    }

    if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) {
        swal("Invalid date format. Please select valid dates.");
        return;
    }
    
    if (startDate > endDate) {
        swal("Start Date should be earlier than End Date");
        return;
    } 

    // Create formData3 object with start and end dates
    const formData3 = {
        startDate: startDateInput,
        endDate: endDateInput
    };

    // Store formData3 in sessionStorage if needed (optional)
    sessionStorage.setItem('formData3', JSON.stringify(formData3));

    // Create an AJAX request using Axios
    axios.post('/store', formData3, {
        headers: {
            'Content-Type': 'application/json', // Indicates that you're sending JSON data
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF token for Laravel security
        }
    })
    .then(response => {
        if (response.data.message === "Option already exists") {
            swal(JSON.stringify("The Vehicle is Already Booked")); // Handle success
        }
        else{
            swal(JSON.stringify("Booked Successfully"),'Redirecting Back to Home Page'); // Handle success
            setTimeout(() => {
                window.location.href = '/Index';
            }, 1500); // 1 second delay
        }
    })
});
