<?php

namespace App\Http\Livewire\Sms;

use App\Sms_template;
use Livewire\Component;

class Templates extends Component
{
    public $templates;

    public $templateForm = [
        'heading' => '',
        'message' => '',
        'active' => '',
    ];
    public $updatingTemplate;
    public $viewingTemplate;
    public $showUpdateTemButton = false;
    public $templateConfirmingID;
    
    //custom validation messages
    private $customMessages = [
        'required' => 'Please enter a value',
        'string' => 'This needs to be a string',
    ];


    public function mount() {
        $this->templates = Sms_template::all();
    }

    public function updateTemplateConfirm() {
        //rules
        if($this->templateForm['heading'] !== $this->updatingTemplate->heading ) {
            $rules = [
                'templateForm.heading' => 'required|String'
            ];
        } else if ($this->templateForm['message']) {
            $rules = [
                'templateForm.message' => 'required|String'
            ];
        }else {
            $rules = [
                'templateForm.heading' => 'required|String',
                'templateForm.message' => 'required|String'
            ];
        }
        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        $this->updatingTemplate->heading = $this->templateForm['heading'];
        $this->updatingTemplate->message = $this->templateForm['message'];

        //if current is set to active, deactivate previious

        $this->updatingTemplate->active = $this->templateForm['active'] == 1 ? $this->templateForm['active'] : 0;

        $this->updatingTemplate->save();
        return redirect()->route('sms');
    }

    public function updateTemplate($id) {
        $this->updatingTemplate = Sms_template::where('id', $id)->first();
        $this->templateForm['heading'] = $this->updatingTemplate->heading;
        $this->templateForm['message'] = $this->updatingTemplate->message;
        $this->templateForm['active'] = $this->updatingTemplate->active ? $this->updatingTemplate->active : '';
        $this->showUpdateTemButton = true;
    }

    public  function addTemplate() {
        //rules
        $rules = [
            'templateForm.heading' => 'required|String',
            'templateForm.message' => 'required|String'
        ];

        //validate
        $validatedData = $this->validate($rules, $this->customMessages);

        Sms_template::create([
            'heading' => $this->templateForm['heading'],
            'message' =>  $this->templateForm['message'],
            'active' =>  $this->templateForm['active']
        ]);

        //redirect to refresh
        return redirect()->route('sms');
    }
    
    public function deleteTemplate($id) {
        Sms_template::destroy($id);
        return redirect()->route('sms');
    }

    public function confirmDelete($id) {
        $this->templateConfirmingID = $id;
    }

    public function viewTemplate($id) {
        $this->viewingTemplate = Sms_template::where('id', $id)->first();
    }

    public function render()
    {
        return view('livewire.sms.templates');
    }
}
