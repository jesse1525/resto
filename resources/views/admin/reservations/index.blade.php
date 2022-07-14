@extends('layouts.app')

@section('content')
<div class="panel-header">
    <div class="header text-center">
        <h2 class="title">Menus</h2>
        
    </div>
</div>
<div class="content m-lg-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>Liste des reservations</span>
                </div>
                <div class="card-body">
                    <div class="toolbar">
                        @if(Session::has('msg'))
                            <div class="alert alert-info">
                                <a class="close" data-dismiss="alert">×</a>
                                <strong>Heads Up!</strong> {!!Session::get('msg')!!}
                            </div>
                        @endif
                        </div>
                    <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>first name</th>
                            <th>last name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Nombre de personne</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>first name</th>
                            <th>last name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Nombre de personne</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>{{$reservation->first_name}}</td>
                                <td>{{$reservation->last_name}}</td>
                                <td>{{$reservation->email}}</td>
                                <td>{{$reservation->phone}}</td>
                                <td>{{$reservation->daty}}</td>
                                <td>{{$reservation->ora}}</td>
                                <td>{{$reservation->number_person}}</td>
                                <td class="text-right" style="display:flex">
                                    <a type="button" href="{{route('reservations.edit',$reservations->id)}}"  class="btn btn-success btn-icon btn-sm ">
                                        Modifier
                                    </a>
                                    <form action="{{route('reservations.destroy',$reservation->id)}}" method="post" >
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-icon btn-sm">
                                            Supprimer
                                        </button>
                                    </form>
                                    
                                   
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                   
                </div>
                {!! $reservations->links() !!}
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection

