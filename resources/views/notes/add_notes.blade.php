@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add Notes</div>
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
                        
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/add_notes') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="text" class="col-md-4 control-label">Text</label>
                        	<div class="col-md-6">
                                    <textarea class="form-control" name="text" id="text" >{{ old('text') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image_name" class="col-md-4 control-label">Image</label>
                            <div class="col-md-6">
                                <input  type="file"  accept="image/*" name="image_name" id='image_name' value="{{ old('image_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="created_date" class="col-md-4 control-label">Date</label>
                            <div class="col-md-6">
                                <input type="date" class="form-control" name="created_date" id="created_date" value="{{ old('created_date') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cat_id" class="col-md-4 control-label">Category</label>
                            <div class="col-md-6">
                                <select name="cat_id" style="height:30px" id="cat_id" value="{{ old('cat_id') }}">
                                    @foreach($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="published" class="col-md-4 control-label">Published</label>
                            <div class="col-md-6">
                               <input type="checkbox" class="form-control" value="1" name="published" id="published" style="width:30px; height:30px">
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Add Note
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
