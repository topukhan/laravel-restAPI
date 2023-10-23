<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="pb-5">

    <div class="container">
        <h1>Customers List</h1>
        <a href="{{ url('customers/create') }}" class="btn btn-primary my-2">Create New Customer</a>
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <!-- Data rows will be added dynamically using JavaScript -->
            </tbody>
        </table>
        <div class="pagination">
            <button id="prevPage">Previous Page</button>
            <span id="currentPage" class="px-3">Page 1</span>
            <button id="nextPage">Next Page</button>
        </div>
    </div>


    <div id="error-message" style="color: red;"></div>

    <script>
        const apiUrl = '/api/v1/customers/';
        const errorDiv = document.getElementById('error-message');
        const tableBody = document.querySelector('tbody');
        let currentPage = 1; // Current page

        function fetchAndDisplayData(page) {
            fetch(`${apiUrl}?page=${page}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Clear the table before adding new data
                    tableBody.innerHTML = '';
                    displayCustomerData(data.data);
                })
                .catch(error => {
                    // Display the error message to the user
                    errorDiv.textContent = `Error fetching data: ${error}`;
                    console.error('Error fetching data:', error);
                });
        }

        function displayCustomerData(customerData) {
            customerData.forEach(customer => {
                const row = tableBody.insertRow();
                const cell1 = row.insertCell(0);
                const cell2 = row.insertCell(1);
                const cell3 = row.insertCell(2);
                const cell4 = row.insertCell(3);

                cell1.textContent = customer.id;
                cell2.textContent = customer.name;
                cell3.textContent = customer.email;

                // Create action buttons and set their attributes
                const showButton = document.createElement('button');
                showButton.textContent = 'Show';
                showButton.addEventListener('click', () => {
                    const customerId = customer.id;

                    window.location.href = `/customer/show/${customerId}`;
                });

                const editButton = document.createElement('button');
                editButton.textContent = 'Edit';
                editButton.addEventListener('click', () => {
                    // Navigate to a specific page for editing using the customer's ID
                    window.location.href = `/customer/edit/${customer.id}`;
                });

                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.addEventListener('click', () => {
                    const customerId = customer.id;
                    // Add a confirmation dialog or make an API request to delete the customer
                    if (confirm('Are you sure you want to delete this customer?')) {
                        deleteCustomer(customerId);
                    }
                });

                // Append the action buttons to the cell
                cell4.appendChild(showButton);
                cell4.appendChild(editButton);
                cell4.appendChild(deleteButton);
            });
        }

        function deleteCustomer(customerId) {
            const deleteUrl = `/api/v1/customers/${customerId}`;

            fetch(deleteUrl, {
                    method: 'DELETE',
                })
                .then(response => {
                    if (response.ok) {
                        alert('Customer deleted successfully');
                        // Optionally, redirect to the customer list page
                        window.location.href = '/customers';
                    } else {
                        alert('Failed to delete customer');
                    }
                })
                .catch(error => {
                    console.error('Error deleting customer:', error);
                });
        }

        // Pagination buttons event listeners
        document.getElementById('prevPage').addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                fetchAndDisplayData(currentPage);
                updatePagination();
            }
        });

        document.getElementById('nextPage').addEventListener('click', () => {
            currentPage++;
            fetchAndDisplayData(currentPage);
            updatePagination();
        });

        function updatePagination() {
            const currentPageSpan = document.getElementById('currentPage');
            currentPageSpan.textContent = `Page ${currentPage}`;
        }

        // Initial data load
        fetchAndDisplayData(currentPage);
        updatePagination();
    </script>
</body>

</html>