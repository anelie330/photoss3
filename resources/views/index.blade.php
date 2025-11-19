
@extends("app")
@section("content")        
@foreach($albums as $a)
<div id ="albums">
    <h3><a href ="/{{$a->id}}">{{$a->titre}} {{$a->creation}}</a></h3>
</div>
@endforeach
@endsection
