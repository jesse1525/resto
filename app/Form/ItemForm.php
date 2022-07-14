<?php

namespace App\Form;
use App\Models\Category;
use Kris\LaravelFormBuilder\Form;

class ItemForm extends Form
{
    protected $resource='items';
    
    public function buildForm()
    {
        $category = null;
        $item=null;
        if($this->getModel() && $this->getModel()->id){
            $method='PUT';
            $item = $this->getModel();
            $url=route($this->resource.'.update',$this->getModel()->id);
            $category=$item->category_id;
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
            ->add('title','text',[
                'label'=>'Titre',
                'placeholder'=>'Titre',
                'class'=>'form-control',
                'rules'=>'required|unique:items|min:4|max:255'
            ])
            ->add('description','textarea',[
                'label'=>'Description',
                'placeholder'=>'Description',
                'class'=>'form-control',
                'rules'=>'required|min:4|max:255'
            ])
            ->add('price','number',[
                'label'=>'Prix',
                'placeholder'=>'Prix',
                'class'=>'form-control',
                'rules'=>'required'
            ])
            ->add('category_id', 'entity', [
                'class' => Category::class,
                'property' => 'name',
                'rules' => 'required',
                'label' => 'Categorie',
                'empty_value' =>'=== Selectionner le catégorie de l\'article ===',
                'selected'=>$category
            ])
            ->add('submit','submit',[
                'label'=>$label,
                'class'=>'btn btn-primary'
            ]);
    }
}
