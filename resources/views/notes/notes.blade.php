@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if(count($notes) == 0)
            <div class="col-md-10 col-md-offset-1">
                <div class="text-center">                  
                    <h1> There Are Not Any Notes Yet </h1>
                </div>                   
            </div>
        @endif
        <div class="col-md-12">
            <div class="container">
                <div id="preview"></div>
                <table class="table table-striped">
                <thead>
                      <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Text</th>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Preview</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                @foreach($notes as $note)
                        
                
                         <tr><td>{{ $note->title }}</td>
                         <td>
                            <img src="img/{{$note->image_name}}" width="200" height="200" class="img-responsive" /> 
                         </td>
                         <td>{{$note->text}}</td>
                        <td>{{$note->created_date}}</td>
                        @if(isset($note->category->name))
                            <td>{{$note->category->name}}</td>
                        @endif    
                        <td><button type="button" class="btn btn-info preview" id="{{$note->id}}">Preview</button></td>
                         </tr>            
                                    
                    
                @endforeach
                </tbody>
                </table>
                {{ $notes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection