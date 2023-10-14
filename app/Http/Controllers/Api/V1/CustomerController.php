<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use Illuminate\Http\Request;
use App\Filters\V1\CustomersFilter;
use App\Http\Requests\V1\DeleteCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new CustomersFilter();
        $filterItems = $filter->transform($request);

        $includeInvoices = $request->query('includeInvoices');

        $customers = Customer::where($filterItems);
        if ($includeInvoices) {
            $customers = $customers->with('invoices');
        }
        // dd('foo');
        return new CustomerCollection($customers->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        // Handle image upload (if an image is present)
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $image = $request->file('image');

            // Generate a unique filename for the image
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Store the image in a specified directory (e.g., 'public/customer_images')
            $path = public_path('customer_images');

            // Add the image path to the request data
            $image->move($path, $imageName);
        }
        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,
            'image' => $imageName,
        ];

        // Create the customer
        $customer = Customer::create($data);

        // Return a response using the CustomerResource
        return new CustomerResource($customer);
    }


    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoices = request()->query('includeInvoices');
        if ($includeInvoices) {
            return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        // dd($request->all());
        $status = $customer->update($request->all());
        if ($status) {
            return response()->json(array('message' => 'updated'));
        } else {
            return response()->json(array('error' => 'Something went wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DeleteCustomerRequest $request, Customer $customer)
    {
        $status = $customer->delete();

        if ($status) {
            return response()->json(array('message' => "Customer deleted successfully"));
        } else {
            return response()->json(array('error' => 'Failed to delete the customer'));
        }
    }
}
