function submitForm() {
    var vehicleType = document.querySelector('input[name="vehicleType"]:checked');
    if (!vehicleType) {
        alert("Please select a vehicle type!");
        return;
    }

    var selectedOption = document.getElementById('optionsSelect').value;
    if (!selectedOption) {
        alert("Please select an option!");
        return;
    }

    // Prepare data to send
    var data = {
        vehicleType: vehicleType.value,
        option: selectedOption
    };
    sessionStorage.setItem('formData2', JSON.stringify(data));

    // Send data to Laravel controller via AJAX
    fetch('/home/submitSelection', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === "Option already exists") {
            swal("The Vehicle is Already Booked!!!");
        } else {
            swal('Redirecting!');
            setTimeout(() => {
                 window.location.href = '/DateRented';
             }, 1500); // 1 second delay
        }
    })
    .catch(error => {
        console.error('Error submitting data:', error);
    });
}

document.addEventListener("DOMContentLoaded", function() {
    var optionsContainer = document.getElementById('optionsContainer');
    var optionsSelect = document.getElementById('optionsSelect');
    var carTypeDropdown = document.getElementById('carTypeDropdown');

    carTypeDropdown.style.display = 'none'; // Initially hide dropdown
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', async (event) => {
            if (event.target.checked && event.target.value === 'fourWheeler') {
                carTypeDropdown.style.display = 'block';
    
                try {
                    // Fetch car types from the server
                    const response = await fetch('/home/cartypes'); // Adjust the URL to your API endpoint
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    const carTypes = await response.json();
    
                    // Populate dropdown with car types
                    carTypeDropdown.innerHTML = '';
                    carTypes.forEach(type => {
                        const option = document.createElement('option');
                        option.value = type.value; // Adjust property names based on your API response
                        option.textContent = type.label;
                        carTypeDropdown.appendChild(option);
                    });
    
                    optionsSelect.innerHTML = '';
                    optionsContainer.style.display = 'none';
                } catch (error) {
                    console.error('Error fetching car types:', error);
                }
            } else {
                carTypeDropdown.innerHTML = '';
                carTypeDropdown.style.display = 'none';
                optionsSelect.innerHTML = '';
                optionsContainer.style.display = 'none';
            }
        });
    });
    

    carTypeDropdown.addEventListener('change', function() {
        var selectedCarType = carTypeDropdown.value;
        var vehicleType = document.querySelector('input[name="vehicleType"]:checked').value;
        fetchOptions(vehicleType, selectedCarType);
    });

    function fetchOptions(vehicleType, carType) {
        var url = '/home/getVehicles/' + encodeURIComponent(vehicleType);
        if (carType) {
            url += '/' + encodeURIComponent(carType);
        }

        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                optionsSelect.innerHTML = ''; // Clear previous options
                data.forEach(vehicle => {
                    var optionElement = document.createElement('option');
                    optionElement.textContent = vehicle.name;
                    optionElement.value = vehicle.id; // Assuming vehicle.id is unique
                    optionsSelect.appendChild(optionElement);
                });
                optionsContainer.style.display = 'block'; // Show options container
            })
            .catch(error => {
                console.error('Error fetching options:', error);
            });
    }

    // Handle initial selection if any
    document.querySelectorAll('input[name="vehicleType"]').forEach(radioButton => {
        radioButton.addEventListener('change', function() {
            optionsSelect.innerHTML = ''; // Clear previous options
            var vehicleType = radioButton.value;
            fetchOptions(vehicleType, null);
        });
    });
});
