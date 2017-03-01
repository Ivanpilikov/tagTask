@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-10 col-md-offset-1">
                   <div class="text-center">                                   
                       <h1> Are You Sure ?</h1>
                   </div>                   
           <form class="form-horizontal" role="form" method="POST" action="/post_delete/{{$post->id}} "  enctype="multipart/form-data">
                        {{ csrf_field() }}
            <div class="form-group">
              <div class="col-md-8 col-md-offset-5">
               <button type="submit" class="btn btn-danger">
                    Yes
               </button>
                <a href="/posts" class="btn btn-success">
                    No
               </a>
             </div>
            </div>   
           </form>             
        </div>
    </div>
</div>
@endsection