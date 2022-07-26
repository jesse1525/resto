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
                    <a class="btn btn-primary btn-round text-white pull-right" href="{{route('menus.create')}}">Ajouter un menu</a>
                    <div class="col-12 mt-2">
                    </div>
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
                            <th>Menu</th>
                            <th>Détails</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Menu</th>
                            <th>Détails</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{$menu->name}}</td>
                                <td class=" flex-lg-row"> 
                                    @foreach($menu->items()->get() as $item)
                                    <div class="btn-group m-1">
                                        <button type="button" class="btn btn-primary">{{$item->title}} </button>
                                        <button type="button" class="btn {{$item->category->id==1?'btn-success':'btn-danger'}}">{{$item->category->name}}</button>
                                    </div>
                                    @endforeach
                                </td>
                                <td class="text-right" style="display:flex">
                                    <a type="button" href="{{route('menus.edit',$menu->id)}}"  class="btn btn-success btn-icon btn-sm ">
                                        Modifier
                                    </a>
                                    <form action="{{route('menus.destroy',$menu->id)}}" method="post" >
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
                {!! $menus->links() !!}
                <!-- end content-->
            </div>
            <!--  end card  -->
        </div>
        <!-- end col-md-12 -->
    </div>
    <!-- end row -->
</div>
@endsection

