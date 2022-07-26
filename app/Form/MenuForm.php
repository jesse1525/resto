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
        $starter = Item::with('category')->where('category_id',1)->get()->pluck('title','id')->toArray();
        $mains = Item::with('category')->where('category_id',2)->get()->pluck('title','id')->toArray();
        $pastries = Item::with('category')->where('category_id',3)->get()->pluck('title','id')->toArray();
        $drinks = Item::with('category')->where('category_id',4)->get()->pluck('title','id')->toArray();
        $starterSelected='';
        $mainsSelected='';
        $pastriesSelected='';
        $drinksSelected='';
        
        if($this->getModel() && $this->getModel()->id){
            $method='PUT';
            $url=route($this->resource.'.update',$this->getModel()->id);
            $label='Mettre à jour';
            $model = Menu::find($this->getModel()->id);
            $starterSelected=$model->items()->where('category_id',1)->pluck('id')->toArray();
            $mainsSelected=$model->items()->where('category_id',2)->pluck('id')->toArray();
            $pastriesSelected=$model->items()->where('category_id',3)->pluck('id')->toArray();
            $drinksSelected=$model->items()->where('category_id',4)->pluck('id')->toArray();
        }else{
            $method='POST';
            $url=route($this->resource.'.store');
            $label='Enregistrer';
        }
        $cats = Category::all();
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
                'selected'=>$starterSelected,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('main', 'select', [
                'label' => 'Main',
                'choices' => $mains,
                'selected'=>$mainsSelected,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('pastries', 'select', [
                'label' => 'Pastries',
                'choices' => $pastries,
                'selected'=>$pastriesSelected,
                'attr' => [
                    'class' => 'form-control select2',
                    'multiple' => 'multiple'
                ]
            ])
            ->add('drink', 'select', [
                'label' => 'Dinks',
                'choices' => $drinks,
                'selected'=> $drinksSelected,
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
