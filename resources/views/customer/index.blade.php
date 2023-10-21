<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    h1 {
        color: #333;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    table,
    th,
    td {
        border: 1px solid #ccc;
    }

    th,
    td {
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<body>
    <h1>Customers List</h1>
    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- Data rows will be added dynamically using JavaScript -->
        </tbody>
    </table>
    <div id="error-message" style="color: red;"></div>

    <script>
        const apiUrl = '/api/v1/customers/';
        const errorDiv = document.getElementById('error-message');

        fetch(apiUrl)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Process the data as before
                displayCustomerData(data.data);
            })
            .catch(error => {
                // Display the error message to the user
                errorDiv.textContent = `Error fetching data: ${error}`;
                console.error('Error fetching data:', error);
            });

        function displayCustomerData(customerData) {
            const tableBody = document.querySelector('tbody');

            customerData.forEach(customer => {
                const row = tableBody.insertRow();
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                const cell3 = row.insertCell(2);

                cell1.textContent = customer.id;
                cell2.textContent = customer.name;
                cell3.textContent = customer.email;

                // You can add more cells and populate them with other data as needed
            });
        }
    </script>
</body>

</html>