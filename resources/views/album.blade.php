@extends("app")
@section("content")
<h2>Filtrer :</h2>
<form action="/{{ $album->id }}/filter" method="get">
    <label for="tag_id">Tags :</label>
    <select id="tag_id" name="tag_id">
        <option value="">--Sélectionner un tag--</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @if(request()->get('tag_id') == $tag->id) selected @endif>
                {{ $tag->nom }}
            </option>
        @endforeach
    </select>
    <input type="submit" value="Filtrer" />

    <label for="search">Titre :</label>
    <input type="text" id="search" name="search" value="{{ request()->get('search') }}" placeholder="Rechercher" />

    <input type="submit" value="Filtrer" />
</form>


@foreach($photos as $p)
<div id ="photos">
    <h3>{{$p->titre}}</h3>
    <img class="photo" src ="{{$p->url}}" alt ="{{$p->titre}}" />
    <h3>{{$p->tags}}</h3>

</div>
@endforeach
<script>
    document.querySelectorAll('.photo').forEach(function(img) {
        img.addEventListener('click', function() {
            img.classList.toggle('zoomed');
        });
    });
    </script>
@endsection