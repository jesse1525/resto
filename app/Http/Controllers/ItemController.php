<?php

namespace App\Http\Controllers;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;
use App\Form\ItemForm;
use App\Models\Category;
use App\Models\item;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class ItemController extends Controller
{
    /**
     * @var FormBuilder
     */
    private $formBuilder;
    public function __construct (FormBuilder $formBuilder)
    {
        $this->middleware('auth');
        $this->formBuilder = $formBuilder;
    }

    private function getForm(?Item $item=null,?string $ressource=null)
    {
        $item=$item?:new Item();
        $ressource=$ressource?:'categories';
        return $this->formBuilder->create(ItemForm::class,[
            'url'=>$ressource,
            'model'=>$item,
        ]);
    }

    public function index(){
        $action=Route::getCurrentRoute()->getName();
        $pages=config('Constant.pagination');
        $articles = Item::latest()->paginate($pages);
        return view('admin.items.index',compact('articles'))
            ->with('i',(request()->input('page',1)-1)*$pages);
    }

    public function show(Item $item){
        $action=Route::getCurrentRoute()->getName();
        $form = $this->getForm($item);
        $form->disableFields();
        $form->remove('submit');
        return view('admin.items.form',compact(['form']));
    }
    public function create(){
        $form = $this->getForm(new Item());
        return view('admin.items.form',compact('form'));
    }

    public function store(Request $request){
        $datas = $this->remove_token_key($request->all());
        Item::firstOrcreate($datas);
        return redirect()->route('items.index');
    }
    public function edit(Item $item){
        $form = $this->getForm($item);
        return view('admin.items.form',compact('form'));
    }
    public function update($id,Request $request){
        $item = Item::find($id);
        $item->update($request->all());
        return redirect()->route('items.index');
    }
    public function destroy($id){
        $item=Item::find($id);
        /*$post = item::where('category_id','=',$item->id)->get();

        $message = 'Suppression reussi!';
        $type = 'success';
        $titre = 'Felicitation';
        if(count($post)>0){
            $message ='impossible de supprimer, des articles sont associés à cette catégorie';
            $type = 'error';
            $titre = 'Attention';
        }else{
            Category::destroy($id);
        }
        return redirect()->route('categories.index');*/
       }
}
