<?php

namespace App\Http\Controllers;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;
use App\Form\CategoryForm;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
class CategoryController extends Controller
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

    private function getForm(?Category $category=null,?string $ressource=null)
    {
        $category=$category?:new Category();
        $ressource=$ressource?:'categories';
        return $this->formBuilder->create(CategoryForm::class,[
            'url'=>$ressource,
            'model'=>$category,
        ]);
    }

    public function index(){
        $action=Route::getCurrentRoute()->getName();
        $pages=config('Constant.pagination');
        $categories = Category::latest()->paginate($pages);
        return view('admin.categories.index',compact('categories'))
            ->with('i',(request()->input('page',1)-1)*$pages);
    }

    public function show(Category $category){
        $action=Route::getCurrentRoute()->getName();
        $form = $this->getForm($category);
        $form->disableFields();
        $form->remove('submit');
        return view('admin.categories.form',compact(['form']));
    }
    public function create(){
        $form = $this->getForm(new Category());
        return view('admin.categories.form',compact('form'));
    }

    public function store(Request $request){
        $datas = $this->remove_token_key($request->all());
        Category::firstOrcreate($datas);
        return redirect()->route('items.index');
    }
    public function edit(Category $category){
        $form = $this->getForm($category);
        return view('admin.categories.form',compact('form'));
    }
    public function update($id,Request $request){
        $category = Category::find($id);
        $category->update($request->all());
        return redirect()->route('categories.index');
    }
    public function destroy($id){
        $category=Category::find($id);
        $post = item::where('category_id','=',$category->id)->get();

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
        return redirect()->route('categories.index');
       }
}
