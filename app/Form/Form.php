<?php
Namespace App\Form;
use GuzzleHttp\Psr7\UploadedFile;
class Form extends \Kris\LaravelFormBuilder\Form{
    /**
     * @var string
     */
    private $resource='';
    public function __construct(string $resource)
    {
        $this->resource=$resource;
    }
   public function buildForm ()
    {
        if($this->getModel() && $this->getModel()->id){
            $method='PUT';
        }else{
            $method='POST';
        }
        $this->formOptions=[
            'method'=>$method
        ];

        parent::buildForm();
    }

    public function redirectIfNotValid ($destination = null)
    {
        $values= $this->getFieldValues();
        $values=array_filter($values, function($value){
            return !is_null($value) && (!$value instanceof UploadedFile);
        });
        foreach ($values as $name=>$value){
            $this->getModel()->$name=$value;
        }
        parent::redirectIfNotValid($destination);
    }
}