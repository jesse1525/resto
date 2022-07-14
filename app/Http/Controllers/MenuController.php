<?php

namespace App\Http\Controllers;
use Kris\LaravelFormBuilder\FormBuilder;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Item;
use App\Form\MenuForm;
class MenuController extends Controller
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

    private function getForm(?Menu $menu=null,?string $ressource=null)
    {
        $menu=$menu?:new Menu();
        $ressource=$ressource?:'menus';
        return $this->formBuilder->create(MenuForm::class,[
            'url'=>$ressource,
            'model'=>$menu,
        ]);
    }

    public function index(){
        $pages=config('Constant.pagination');
        $menus = Menu::latest()->paginate($pages);
        return view('admin.menus.index',compact('menus'))
            ->with('i',(request()->input('page',1)-1)*$pages);
    }

    public function show(Menu $category){
        $form = $this->getForm($category);
        $form->disableFields();
        $form->remove('submit');
        return view('admin.menus.form',compact(['form']));
    }
    public function create(){
        $form = $this->getForm(new Menu());
        return view('admin.menus.form',compact('form'));
    }

    public function store(Request $request){
        $datas = $this->remove_token_key($request->all());
        $menu = Menu::firstOrcreate(['name'=>$request->name]);
        $menu->Items()->attach($request->starter);
        $menu->Items()->attach($request->main);
        $menu->Items()->attach($request->drinks);
        return redirect()->route('menus.index');
    }
    public function edit(Menu $menu){
        $form = $this->getForm($menu);
        return view('admin.menus.form',compact('form'));
    }
    public function update($id,Request $request){
        $menu = Menu::find($id);
        $menu->update($request->all());
        return redirect()->route('menu.index');
    }
    public function destroy($id){
        $menu=menu::find($id);
        $post = Item::where('category_id','=',$menu->id)->get();

        $message = 'Suppression reussi!';
        $type = 'success';
        $titre = 'Felicitation';
        if(count($post)>0){
            $message ='impossible de supprimer, des articles sont associés à cette catégorie';
            $type = 'error';
            $titre = 'Attention';
        }else{
            Menu::destroy($id);
        }
        return redirect()->route('menus.index');
       }
}
