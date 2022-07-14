<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Form\CategoryForm;
use App\Form\ReservationForm;
use App\Models\Category;
use App\Models\item;
use App\Models\Reservation;
class ReservationController extends Controller
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

    private function getForm(?Reservation $reservation=null,?string $ressource=null)
    {
        $reservation=$reservation?:new Reservation();
        $ressource=$ressource?:'reservations';
        return $this->formBuilder->create(ReservationForm::class,[
            'url'=>$ressource,
            'model'=>$reservation,
        ]);
    }

    public function index(){
        $pages=config('Constant.pagination');
        $reservations = Reservation::latest()->paginate($pages);
        return view('admin.reservations.index',compact('reservations'))
            ->with('i',(request()->input('page',1)-1)*$pages);
    }

    public function show(Reservation $reservation){
        $form = $this->getForm($reservation);
        $form->disableFields();
        $form->remove('submit');
        return view('admin.reservations.form',compact(['form']));
    }
    public function create(){
        $form = $this->getForm(new Reservation());
        return view('admin.reservations.form',compact('form'));
    }

    public function store(Request $request){
        $datas = $this->remove_token_key($request->all());
        Reservation::firstOrcreate($datas);
        return redirect()->route('reservations.index');
    }
    public function edit(Reservation $reservation){
        $form = $this->getForm($reservation);
        return view('admin.reservations.form',compact('form'));
    }
    public function update($id,Request $request){
        $reservation = Reservation::find($id);
        $reservation->update($request->all());
        return redirect()->route('reservations.index');
    }
    public function destroy($id){
        Reservation::destroy($id);
        return redirect()->route('reservatons.index');
       }
}
