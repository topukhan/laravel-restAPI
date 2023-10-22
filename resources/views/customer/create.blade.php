<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Create</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="pb-5">

    <div class="container">
        <h1>Create Customer</h1>
        <form id="customer-form">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="type">Type (I/B):</label>
                <input type="text" id="type" name="type" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div>
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div>
                <label for="state">State:</label>
                <input type="text" id="state" name="state" required>
            </div>
            <div>
                <label for="postalCode">Postal Code:</label>
                <input type="text" id="postalCode" name="postalCode" required>
            </div>
            <div>
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required>
            </div>
            <div>
                <button type="submit" class="btn btn-primary my-2">Create Customer</button>
                <a href="{{ url('customers') }}" class="btn btn-danger my-2">Cancel</a>
            </div>
        </form>
    </div>

    <div id="error-message" style="color: red;"></div>

    <script>
        const apiUrl = '/api/v1/customers'; // Replace with your API endpoint
        const errorDiv = document.getElementById('error-message');

        document.getElementById('customer-form').addEventListener('submit', (event) => {
            event.preventDefault(); // Prevent the default form submission behavior

            const name = document.getElementById('name').value;
            const type = document.getElementById('type').value;
            const email = document.getElementById('email').value;
            const address = document.getElementById('address').value;
            const city = document.getElementById('city').value;
            const state = document.getElementById('state').value;
            const postalCode = document.getElementById('postalCode').value;
            const image = document.getElementById('image').files[0];

            const formData = new FormData();
            formData.append('name', name);
            formData.append('type', type);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('city', city);
            formData.append('state', state);
            formData.append('postal_code', postalCode);
            formData.append('image', image);

            fetch(apiUrl, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => {
                    if (response.ok) {
                        // Handle success (e.g., show a success message)
                        console.log('Customer created successfully.');
                    } else {
                        // Handle errors (e.g., show an error message)
                        console.error('Failed to create customer.');
                    }
                })
                .catch(error => {
                    // Handle network errors
                    console.error('Network error:', error);
                });
        });
    </script>
</body>

</html>