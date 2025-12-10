@extends("app")
@section("content")        
@foreach($photos as $p)
<link rel="stylesheet" href="../css/style.css" />
<div id ="photos">
    <h3>{{$p->titre}}</h3>
    <img class="photo" src ="{{$p->url}}" alt ="{{$p->titre}}" />
    <h3>{{$p->tags}}</h3>

    <<script>
    document.querySelectorAll('.photo').forEach(function(img) {
        img.addEventListener('click', function() {
            img.classList.toggle('zoomed');
        });
    });
    </script>

</div>
@endforeach
@endsection