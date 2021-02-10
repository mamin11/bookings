<?php

namespace App\Http\Livewire\Staff;

use App\Role;
use App\User;
use App\Address;
use App\Service;
use App\User_role;
use Livewire\Component;
use App\User_speciality;
use Illuminate\Support\Facades\Hash;

class View extends Component
{
    //holds data when adding staff
    public $staffForm = [
        'name' => '',
        'email' => '',
        'password' => '',
        'role' => '',
        'services' => [],
        'date_of_birth' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'post_code' => ''
    ];
    
    //holds data about updating staff
    public $updateStaffForm = [
        'name' => '',
        'email' => '',
        'password' => '',
        'role' => '',
        'services' => [],
        'date_of_birth' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'post_code' => ''
    ];

    public $confirmingID;
    public $updatingStaff;
    public $updatingStaffAddress;
    public $updatingStaffServices;
    public $updatingStaffRole;
    public $newStaffAddress;

    public $staffServices = [];

    public $showUpdateForm = false;

    //two variables to toggle between staff details and staff services
    public $showDetails = false;
    public $showServices = false;

    //to toggle staff details and speciality tabs when adding staff
    public $addStaffDetails = true;
    public $addStaffServices = false;

    //custom validation messages
    private $customMessages = [
        'required' => 'Stop playing man. Fill in the form',
        'unique' => 'This already exists in the database',
        'string' => 'This needs to be a string',
        'integer' => 'This needs to be a number',
        'email' => 'This must be a valid email address'
    ];

    public function addStaffDetails() {
        $this->addStaffDetails = true;
        $this->addStaffServices = false;
    }
    
    public function addStaffServices() {
        $this->addStaffServices = true;
        $this->addStaffDetails = false;

    }

    public function addStaff() {
        //rules
        $rules = [
            'staffForm.name' => 'required',
            'staffForm.email' => 'required|unique:customers,email',
            'staffForm.password' => 'required',
            'staffForm.role' => 'required|integer',
            'staffForm.services' => 'required',
            'staffForm.date_of_birth' => 'required',
            'staffForm.address' => 'required',
            'staffForm.city' => 'required|string',
            'staffForm.country' => 'required|string',
            'staffForm.post_code' => 'required',
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        //add address first
        $address_id = Address::insertGetId([
            'address' => $this->staffForm['address'],
            'city' => $this->staffForm['city'],
            'country' => $this->staffForm['country'],
            'post_code' => $this->staffForm['post_code']
        ]);
        
        //add staff to db
        $staff = User::create([
            'name' => $this->staffForm['name'],
            'email' => $this->staffForm['email'],
            'password' => Hash::make($this->staffForm['password']),
            'address_id' => $address_id,
            'date_of_birth' => $this->staffForm['date_of_birth'], 
        ]);

        //add role
            User_role::create([
                'role_id' => $this->staffForm['role'],
                'user_id' => $staff->user_id
            ]);

        //add specialities (services)
        //loop the user services and create
        User_speciality::create([

        ]);

        //flash messages
        session()->flash('Successfully added');
        session()->flash('alert-class', 'alert-success');

        //redirect to refresh
        return redirect()->route('viewStaff');
    }
    
    public function confirmDelete($id){
        //this is used to validate the delete request
        $this->confirmingID = $id;
    }
    
    public function deleteStaff($user_id){
        $staff = User::where('user_id', $user_id)->first();

        //delete the staff address 
        Address::destroy($staff->address_id);

        //delete the staff
        User::destroy($user_id);

        //refresh page
        return redirect()->route('viewStaff');
    }

    public function updateStaff($user_id){
        //set booleans to automatically open staff details tab whenever edit is clicked
        //this ensures tabs such as services list to be closed when a different user is clicked. Because user data has 
        //to be fetched first before displaying related data.
        $this->showUpdateForm = true;
        $this->showDetails = false;
        $this->showServices = false;

        $this->updatingStaff = User::where('user_id',$user_id)->first();
        $this->updatingStaffAddress = Address::where('address_id',$this->updatingStaff->address_id)->first();
        $this->updatingStaffRole = User_role::where('user_id',$this->updatingStaff->user_id)->first();
        $this->updatingStaffServices = User_speciality::where('user_id', $this->updatingStaff->user_id)->get();

        //update staff fields
        $this->updateStaffForm['name'] = $this->updatingStaff->name;
        $this->updateStaffForm['email'] = $this->updatingStaff->email;
        $this->updateStaffForm['role'] = $this->updatingStaffRole ? $this->updatingStaffRole->role_id : '';
        $this->updateStaffForm['city'] = $this->updatingStaffAddress ? $this->updatingStaffAddress->city : '';
        $this->updateStaffForm['address'] = $this->updatingStaffAddress ? $this->updatingStaffAddress->address : '';
        $this->updateStaffForm['city'] = $this->updatingStaffAddress ? $this->updatingStaffAddress->city : '';
        $this->updateStaffForm['country'] = $this->updatingStaffAddress ? $this->updatingStaffAddress->country : '';
        $this->updateStaffForm['post_code'] = $this->updatingStaffAddress ? $this->updatingStaffAddress->post_code : '';

        }
        
        public function updateConfirm(){
            //rules
            $rules = [
                'updateStaffForm.name' => 'required',
                'updateStaffForm.email' => 'required',
                'updateStaffForm.date_of_birth' => 'required',
                'updateStaffForm.address' => 'required',
                'updateStaffForm.city' => 'required|string',
                'updateStaffForm.country' => 'required|string',
                'updateStaffForm.post_code' => 'required',
            ];

            //validate
            $validatedData = $this->validate($rules, $this->customMessages);

            //update the address first
            $this->updatingStaffAddress->address = $this->updateStaffForm['address'];
            $this->updatingStaffAddress->city = $this->updateStaffForm['city'];
            $this->updatingStaffAddress->country = $this->updateStaffForm['country'];
            $this->updatingStaffAddress->post_code = $this->updateStaffForm['post_code'];

            //update the role
            $this->updatingStaffRole->role_id =  $this->updateStaffForm['role'];

            //update the specialities/services *********************************
            
            //update the staff details
            $this->updatingStaff->name = $this->updateStaffForm['name'];
            $this->updatingStaff->email = $this->updateStaffForm['email'];
            $this->updatingStaff->date_of_birth = $this->updateStaffForm['date_of_birth'];

            //save the record
            $this->updatingStaffAddress->save();
            $this->updatingStaffRole->save();
            //save the specialities ************************************

            $this->updatingStaff->save();

            //reload page
            return redirect()->route('viewStaff');
    }
    
    public function hideUpdateForm() {
        $this->showUpdateForm = false;
    }
    
    public function showDetails() {
        $this->showDetails = true;
        $this->showServices = false;
    }
    
        public function showServices() {
            $this->showServices = true;
            $this->showDetails = false;
        }

    public function render()
    {
        $staff = User::all();
        $services = Service::all();
        $roles = Role::all();
        return view('livewire.staff.view', [
            'staff' => $staff,
            'services' => $services,
            'roles' => $roles,
            'updatingStaffServices' => $this->updatingStaffServices
        ]);
    }
}
