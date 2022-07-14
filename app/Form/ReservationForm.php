<?php

namespace App\Form;

use Kris\LaravelFormBuilder\Form;

class ReservationForm extends Form
{
    protected $resource='reservations';
    public function buildForm()
    {
        if(!$this->getModel()){
            $method='POST';
            $url=route($this->resource.'.store');
            $label='Book Now';
        }
        parent::buildForm();
        $this->formOptions=[
            'method' => $method,
            'url' => $url
        ];
        $this
            ->add('first_name','text',[
                'label'=>'First name',
                'placeholder'=>'First name',
                'class'=>'form-control',
                'rules'=>'required|min:4|max:255'
            ])
            ->add('last_name','text',[
                'label'=>'Last name',
                'placeholder'=>'Last name',
                'class'=>'form-control',
                'rules'=>'required|min:4|max:255'
            ])
            ->add('email','email',[
                'label'=>'Email',
                'placeholder'=>'Email',
                'class'=>'form-control',
                'rules'=>'required|min:4|max:255'
            ])
            ->add('daty','date',[
                'label'=>'Date',
                'placeholder'=>'Date',
                'class'=>'form-control',
                'rules'=>'required'
            ])
            ->add('ora','time',[
                'label'=>'Time',
                'placeholder'=>'Time',
                'class'=>'form-control',
                'rules'=>'required'
            ])
            ->add('number_person','number',[
                'label'=>'2 Person',
                'placeholder'=>'2 Person',
                'class'=>'form-control',
                'rules'=>'required'
            ])
            ->add('submit','submit',[
                'label'=>$label,
                'class'=>'btn btn-primary'
            ]);
    }
}
