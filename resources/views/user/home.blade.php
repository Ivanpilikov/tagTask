@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        <div class = " col-md-12">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"> {{ Auth::user()->username }}</div>
                    <div class="panel-body">
                        <div class='pull-left col-md-6'>
                            @if(!empty(Auth::user()->avatar))
                                 <img src="/avatar/{{ Auth::user()->avatar }} " style="width: 200px; height: 150px">
                            
                            @else
                                <img src="/avatar/photo.jpg " style="width: 200px; height: 150px">
                            
                            @endif
                        </div>
                        <div class='pull-right col-md-6'>
                            <p>{{ Auth::user()->name}}</p>
                            <p>{{ Auth::user()->surname}}</p>
                            <p>{{ Auth::user()->age}}</p>
                            <p>{{ Auth::user()->email}}</p>
                            <p>{{ Auth::user()->phone}}</p>
                        </div>
                    </div>
                     
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection