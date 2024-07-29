document.addEventListener('DOMContentLoaded', function() {
    // Get the CSRF token from the meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Get the form action URL from the form element
    const form = document.getElementById('userForm');
    const formActionUrl = form.getAttribute('action');

    // Add event listener to the form
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);

        fetch(formActionUrl, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
           // console.log('Success:', data);
           swal('Redirecting!');
           setTimeout(() => {
                sessionStorage.setItem('formData1', JSON.stringify(data));
                window.location.href = '/Vehicles';
            }, 1500); // 1 second delay
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});
