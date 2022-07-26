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
        $menu = Menu::firstOrcreate(['name'=>$datas['name']]);
        $menu->Items()->attach($request->starter);
        $menu->Items()->attach($request->main);
        $menu->Items()->attach($request->drink);
        return redirect()->route('menus.index');
    }

    public function edit(Menu $menu){
        $form = $this->getForm($menu);
        return view('admin.menus.form',compact('form'));
    }

    public function update($id,Request $request){
        $menu = Menu::find($id);
        $items = array_merge($request->starter,$request->main,$request->drink);
        $menu->Items()->sync($items);
        return redirect()->route('menus.index');
    }
    
    public function destroy($id){
        $menu =Menu::find($id);
        $menu->delete($id);
        return redirect()->route('menus.index');
       }
}
