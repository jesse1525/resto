<?php

namespace App\Form;

use Kris\LaravelFormBuilder\Form;

class CategoryForm extends Form
{
    protected $resource='categories';
    public function buildForm()
    {
        if($this->getModel() && $this->getModel()->id){
            $method='PUT';
            $url=route($this->resource.'.update',$this->getModel()->id);
            $label='Mettre à jour';
        }else{
            $method='POST';
            $url=route($this->resource.'.store');
            $label='Enregistrer';
        }
        parent::buildForm();
        $this->formOptions=[
            'method' => $method,
            'url' => $url
        ];
        $this
            ->add('name','text',[
                'label'=>'Libellé',
                'placeholder'=>'Libellé',
                'class'=>'form-control',
                'rules'=>'required|unique:categories|min:4|max:255'
            ])
            ->add('submit','submit',[
                'label'=>$label,
                'class'=>'btn btn-primary'
            ]);
    }
}
