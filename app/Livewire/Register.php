<?php

namespace App\Livewire;

use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $phone;
    public $birthdate;
    public $address;
    public function render()
    {
        return view('livewire.register');
    }

    public function updated($field){
        $this->validateOnly($field,[
            'name' => 'required|min:2|max:10',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:5|max:15',
            'phone' => 'required|digits:11',
            'birthdate' => 'required',
            'address' => 'required|min:8|max:50',
        ]); 
    }
}
