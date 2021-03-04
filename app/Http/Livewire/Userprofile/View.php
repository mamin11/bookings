<?php

namespace App\Http\Livewire\Userprofile;

use App\User;
use App\Address;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class View extends Component
{
    use WithFileUploads;
    public $user;
    public $address;
    public $form = [
        'name' => '',
        'email' => '',
        'newpassword' => '',
        'confirmpassword' => '',
        'date_of_birth' => '',
        'address' => '',
        'city' => '',
        'country' => '',
        'post_code' => ''
    ];
    public $flashMessage = [
        'class' => '',
        'message' => ''
    ];

    public $image;
    public $updated = false;

    //custom validation messages
    private $customMessages = [
        'required' => 'This field must be filled in',
        'unique' => 'This already exists in the database',
        'string' => 'This needs to be a string',
        'integer' => 'This needs to be a number',
        'email' => 'This must be a valid email address',
        'min' => 'You must select at least :min from the checkbox',
        'image' => 'Please select an image',
        'max' => 'This exceeds the maximum size allowed'
    ];

    public function mount() {
        $this->user = User::where('user_id', Auth::user()->user_id)->first();
        $this->address = Address::where('address_id', $this->user->address_id)->first();
    }

    public function update() {
        //rules
        $rules = [
            'form.name' => 'string',
            'form.email' => 'unique:users,email',
            'form.newpassword' => 'min:6|confirmed',
            'form.confirmpassword' => 'min:6',
            'form.date_of_birth' => 'date',
            'form.address' => 'string',
            'form.city' => 'string',
            'form.country' => 'string',
            // 'form.post_code' => 'required',
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        //validate the image if there is an image
        if($this->image) {
            $fileName = time();
            $this->validate([
                'image' => 'image|max:1024', 
            ]);

            //upload the image 
            $this->image->storePubliclyAs('staff', $fileName, 's3');
            $this->user->image = $fileName;
        }
        
        //update address first
        $this->address->address = $this->form['address'] ? $this->form['address'] : $this->address->address;
        $this->address->city = $this->form['city'] ? $this->form['city'] : $this->address->city;
        $this->address->country = $this->form['country'] ? $this->form['country'] : $this->address->country;
        $this->address->post_code = $this->form['post_code'] ? $this->form['post_code'] : $this->address->post_code;

        //update the user details
        $this->user->name = $this->form['name'] ? $this->form['name'] : $this->user->name;
        $this->user->email = $this->form['email'] ? $this->form['email'] : $this->user->email;
        $this->user->date_of_birth = $this->form['date_of_birth'] ? $this->form['date_of_birth'] : $this->user->date_of_birth;
        $this->user->password = $this->form['newpassword'] ? Hash::make($this->form['newpassword']) : $this->user->email; 

        //save address and user
        $this->address->save();
        $this->user->save();

        $this->updated = true;
        if($this->form['name'] || $this->form['email'] || $this->form['newpassword'] || $this->form['confirmpassword'] || $this->form['date_of_birth'] || $this->form['address'] || $this->form['city'] || $this->form['country'] ) {
            $this->flashMessage = [
                'class' => 'success',
                'message' => 'Successfully updated',
            ];
        } else {
            $this->flashMessage = [
                'class' => 'danger',
                'message' => 'Nothing changed',
            ];
        }

        // return redirect()->route('myAccount');
    }

    public function render()
    {
        return view('livewire.userprofile.view');
    }
}
