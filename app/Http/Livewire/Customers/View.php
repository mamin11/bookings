<?php

namespace App\Http\Livewire\Customers;

use App\Address;
use App\Customer;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class View extends Component
{
    public $customerForm = [
        'name' => '',
        'email' => '',
        'password' => '',
        'date_of_birth' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'post_code' => ''
    ];
    public $updateCustomerForm = [
        'name' => '',
        'email' => '',
        'password' => '',
        'date_of_birth' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'post_code' => ''
    ];

    public $confirmingID;
    public $updatingCustomer;
    public $updatingCustomerAddress;
    public $newCustomerAddress;
    public $showUpdateForm = false;

    //custom validation messages
    private $customMessages = [
        'required' => 'Please enter a value',
        'unique' => 'This already exists in the database',
        'string' => 'This needs to be a string',
        'integer' => 'This needs to be a number',
        'email' => 'This must be a valid email address'
    ];

    public function addCustomer() {
        //rules
        $rules = [
            'customerForm.name' => 'required',
            'customerForm.email' => 'required|unique:customers,email',
            'customerForm.password' => 'required',
            'customerForm.date_of_birth' => 'required',
            'customerForm.address' => 'required',
            'customerForm.city' => 'required|string',
            'customerForm.country' => 'required|string',
            'customerForm.post_code' => 'required',
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        //add address first
        $address_id = Address::insertGetId([
            'address' => $this->customerForm['address'],
            'city' => $this->customerForm['city'],
            'country' => $this->customerForm['country'],
            'post_code' => $this->customerForm['post_code']
        ]);

        //add customer to db
        $customer = Customer::create([
            'name' => $this->customerForm['name'],
            'email' => $this->customerForm['email'],
            'password' => Hash::make($this->customerForm['password']),
            'address_id' => $address_id,
            'date_of_birth' => $this->customerForm['date_of_birth'], 
        ]);

        //flash messages
        session()->flash('Successfully added');
        session()->flash('alert-class', 'alert-success');

        //redirect to refresh
        return redirect()->route('viewCustomers');
    }
    
    public function confirmDelete($id){
        //this is used to validate the delete request
        $this->confirmingID = $id;
    }
    
    public function deleteCustomer($customer_id){
        $customer = Customer::where('customer_id', $customer_id)->first();

        //delete the customers address 
        Address::destroy($customer->address_id);

        //delete the customers
        Customer::destroy($customer_id);

        //refresh page
        return redirect()->route('viewCustomers');
    }

    public function updateCustomer($customer_id){
        $this->updatingCustomer = Customer::where('customer_id',$customer_id)->first();
        $this->updatingCustomerAddress = Address::where('address_id',$this->updatingCustomer->address_id)->first();
        $this->showUpdateForm = true;

        //update customer fields
        $this->updateCustomerForm['name'] = $this->updatingCustomer->name;
        $this->updateCustomerForm['email'] = $this->updatingCustomer->email;
        $this->updateCustomerForm['date_of_birth'] = $this->updatingCustomer->date_of_birth;
        $this->updateCustomerForm['address'] = $this->updatingCustomerAddress->address;
        $this->updateCustomerForm['city'] = $this->updatingCustomerAddress->city;
        $this->updateCustomerForm['country'] = $this->updatingCustomerAddress->country;
        $this->updateCustomerForm['post_code'] = $this->updatingCustomerAddress->post_code;

        }
        
        public function updateConfirm(){
            //rules
            $rules = [
                'updateCustomerForm.name' => 'required',
                'updateCustomerForm.email' => 'required',
                'updateCustomerForm.date_of_birth' => 'required',
                'updateCustomerForm.address' => 'required',
                'updateCustomerForm.city' => 'required|string',
                'updateCustomerForm.country' => 'required|string',
                'updateCustomerForm.post_code' => 'required',
            ];

            //validate
            $validatedData = $this->validate($rules, $this->customMessages);

            //update the address first
            $this->updatingCustomerAddress->address = $this->updateCustomerForm['address'];
            $this->updatingCustomerAddress->city = $this->updateCustomerForm['city'];
            $this->updatingCustomerAddress->country = $this->updateCustomerForm['country'];
            $this->updatingCustomerAddress->post_code = $this->updateCustomerForm['post_code'];
            
            //update the customer details
            $this->updatingCustomer->name = $this->updateCustomerForm['name'];
            $this->updatingCustomer->email = $this->updateCustomerForm['email'];
            $this->updatingCustomer->date_of_birth = $this->updateCustomerForm['date_of_birth'];

            //save the record
            $this->updatingCustomerAddress->save();
            $this->updatingCustomer->save();

            //reload page
            return redirect()->route('viewCustomers');
    }
    
    public function hideUpdateForm() {
        $this->showUpdateForm = false;
    }

    public function render()
    {
        $customers = Customer::all();
        return view('livewire.customers.view', [
            'customers' => $customers
        ]);
    }
}