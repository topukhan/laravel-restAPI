<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Customer Details</title>
</head>

<body>
    <div class="container mt-5">
        <h1>Customer Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title" id="customerName"></h5>
                <p class="card-text" id="customerType"></p>
                <p class="card-text" id="customerEmail"></p>
                <p class="card-text" id="customerAddress"></p>
                <p class="card-text" id="customerCity"></p>
                <p class="card-text" id="customerState"></p>
                <p class="card-text" id="customerPostalCode"></p>
                <img src="" alt="Customer Image" id="customerImage" class="img-fluid h-50 w-50 rounded">
            </div>
        </div>
        <a href="{{ url('customers')}}" class="btn btn-primary mt-3">Back to List</a>
    </div>

    <script>
        // Get the customer ID from the URL
        const customerId = window.location.pathname.split('/').pop();

        console.log(customerId);

        const apiUrl = `/api/v1/customers/${customerId}`;
        const customerName = document.getElementById('customerName');
        const customerType = document.getElementById('customerType');
        const customerEmail = document.getElementById('customerEmail');
        const customerAddress = document.getElementById('customerAddress');
        const customerCity = document.getElementById('customerCity');
        const customerState = document.getElementById('customerState');
        const customerPostalCode = document.getElementById('customerPostalCode');
        const customerImage = document.getElementById('customerImage');

        fetch(apiUrl)
            .then(response => response.json())
            .then(responseData => {
                const data = responseData.data;
                customerName.textContent = `Name: ${data.name}`;
                customerType.textContent = `Type: ${data.type}`;
                customerEmail.textContent = `Email: ${data.email}`;
                customerAddress.textContent = `Address: ${data.address}`;
                customerCity.textContent = `City: ${data.city}`;
                customerState.textContent = `State: ${data.state}`;
                customerPostalCode.textContent = `Postal Code: ${data.postalCode}`;
                if (data.image && isImageFileName(data.image)) {
                    customerImage.src = `${data.image}`;
                } else {
                    // If there is no valid image name, hide the image tag
                    customerImage.style.display = 'none';
                }
                console.log(data);
            })
            .catch(error => {
                console.error('Error fetching customer data:', error);
            });

        function isImageFileName(fileName) {
            // Define a regular expression pattern for common image file extensions
            const imageFilePattern = /\.(jpg|jpeg|png|gif)$/i;

            // Use the pattern to test if the file name matches
            return imageFilePattern.test(fileName);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>