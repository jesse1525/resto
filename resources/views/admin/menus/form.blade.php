@extends('layouts.app')

@section('content')
    <div class="panel-header"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header flex-fill">
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{route('menus.index')}}">Liste des menus</a>
                        <a class="btn btn-primary btn-round text-white pull-right" href="{{route('menus.create')}}">Ajouter un menu</a>
                        <div class="col-12 mt-2">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar"></div>
                        <div class="flash-message">
                            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                                @endif
                            @endforeach
                        </div>

                        {!! form($form) !!}
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
@endsection
