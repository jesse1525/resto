<?php

namespace App\Form;

use App\Models\Category;
use Kris\LaravelFormBuilder\Form;
use App\Models\Item;
class MenuForm extends Form
{
    protected $resource='menus';
    public function buildForm()
    {
        $starter=null;
        $main=null;
        $pastries=null;
        $drink=null;
        if($this->getModel() && $this->getModel()->id){
            $method='PUT';
            $url=route($this->resource.'.update',$this->getModel()->id);
            $label='Mettre à jour';
        }else{
            $method='POST';
            $url=route($this->resource.'.store');
            $label='Enregistrer';
        }
        $cats = Category::all();
        $starter = Item::with('category')->where('category_id',1)->get()->pluck('title','id')->toArray();
        $mains = Item::with('category')->where('category_id',2)->get()->pluck('title','id')->toArray();
        $pastries = Item::with('category')->where('category_id',3)->get()->pluck('title','id')->toArray();
        $drinks = Item::with('category')->where('category_id',4)->get()->pluck('title','id')->toArray();
        
        //dd($starter);
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
                'rules'=>'required|unique:menus|min:4|max:255'
            ])
            ->add('starter', 'select', [
                'label' => 'Starter',
                'choices' => $starter,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('main', 'select', [
                'label' => 'Main',
                'choices' => $mains,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('pastries', 'select', [
                'label' => 'Pastries',
                'choices' => $pastries,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('drink', 'select', [
                'label' => 'Dinks',
                'choices' => $drinks,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('submit','submit',[
                'label'=>$label,
                'class'=>'btn btn-primary'
            ]);

    }
}
