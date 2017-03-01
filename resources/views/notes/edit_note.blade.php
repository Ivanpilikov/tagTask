@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Note</div>
                <div class="panel-body">

                        @if(Session::has('message'))
                            <div class="alert alert-info">
                                <strong>{{Session::get('message')}}</strong>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> Something went wrong!<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                    <form class="form-horizontal" role="form" method="POST" action="/note_edit/{{$note->id}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="edit" value="1">
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" id="title" value="{{$note->title}}">
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="text" class="col-md-4 control-label">Text</label>
                            <div class="col-md-6">
                                <textarea style="resize:vertical" class="form-control" name="text" id="text">{{$note->text}}</textarea>
                            </div>
                        </div>




                        <div class="form-group">
                            <label for="image_name" class="col-md-4 control-label">Image</label>

                            <div class="col-md-6">
                                <input  type="file"  accept="image/*" name="image_name"  id="image_name" value="{{$note->image_name}}">
                            </div>
                        </div>

                              

                        @if($note->image_name)
                        
                        <div class="form-group text-center">  
                             <img src="/img/{{$note->image_name}}" width="200"/>    
                        </div>
                        
                        @endif
                        
                        <div class="form-group">
                            <label for="date" class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="created_date" id="date" value="{{$note->created_date}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cat_id" class="col-md-4 control-label">Category</label>
                            <div class="col-md-6">
                                <select name="cat_id" style="height:30px" id="cat_id">
                                    @foreach($category as $cat)
                                        <option @if($cat->id == $note->cat_id) selected @endif value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="published" class="col-md-4 control-label">Published</label>
                            <div class="col-md-6">
                               <input type="checkbox" class="form-control" @if($note->published == 1)  checked   @endif  value="1"  name="published" id="published" style="width:30px; height:30px">
                            </div>
                        </div>
                       
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Edit Note
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
