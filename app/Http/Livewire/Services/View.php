<?php

namespace App\Http\Livewire\Services;
use session;
use App\Service;

use Livewire\Component;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class View extends Component
{

    public $serviceForm = [
        'name' => '',
        'price' => ''
    ];
    public $updateServiceForm = [
        'name' => '',
        'price' => ''
    ];

    public $confirmingID;
    public $updatingService;
    public $showUpdateForm = false;

    public function addService() {
        //validate
        $this->validate([
            'serviceForm.name' => 'required|String',
            'serviceForm.price' => 'required|Integer'
        ]);

        //add to db
            Service::create([
                'name' => $this->serviceForm['name'],
                'price' => $this->serviceForm['price']
            ]);

        //flash messages
        session()->flash('Successfully added');
        session()->flash('alert-class', 'alert-success');

        //redirect to refresh
        return redirect()->route('viewServices');
    }
    
    public function confirmDelete($id){
        //this is used to validate the delete request
        $this->confirmingID = $id;
    }
    
    public function deleteService($service_id){
        Service::destroy($service_id);
        return redirect()->route('viewServices');
    }

    public function updateService($service_id){
        $this->updatingService = Service::where('service_id',$service_id)->first();
        $this->showUpdateForm = true;
        $this->updateServiceForm['name'] = $this->updatingService->name;
        $this->updateServiceForm['price'] = $this->updatingService->price;

        }
        
        public function updateConfirm(){
            //validate
            $this->validate([
                'updateServiceForm.name' => 'required|String',
                'updateServiceForm.price' => 'required|Integer'
            ]);
            //update
            $this->updatingService->name = $this->updateServiceForm['name'];
            $this->updatingService->price = $this->updateServiceForm['price'];

            //save the record
            $this->updatingService->save();

            //reload page
            return redirect()->route('viewServices');
    }
    
    public function hideUpdateForm() {
        $this->showUpdateForm = false;
    }
    
    public function render()
    {
        $services = Service::all();
        return view('livewire.services.view', [
            'services' => $services,
        ]);
    }
}
