
@extends("app")
@section("content")
<h2>Filtrer / Trier :</h2>
<form action="/filter" method="get">
    <label for="search">Rechercher un titre :</label>
    <input type="text" id="search" name="search" value="{{ request()->get('search') }}" placeholder="Titre de l'album">

    <label for="trier">Trier par :</label>
    <select id="trier" name="trier">
        <option value="">--Sélectionner--</option>
        <option value="titre" @if(request()->get('trier') == 'titre') selected @endif>Titre</option>
        <option value="date" @if(request()->get('trier') == 'date') selected @endif>Date de création</option>
    </select>

    <input type="submit" value="Appliquer">
</form>        
@foreach($albums as $a)
<div id ="albums">
    @if($a->cover)
    <a href ="/{{$a->id}}"><img class="album-cover"
     src="{{ str_starts_with($a->cover, 'http') ? $a->cover : asset('storage/' . $a->cover) }}"
     alt="{{ $a->titre }}">
    <h3>{{$a->titre}}</h3>
    <h4>Créé le {{$a->creation}}</h4></a>
    @else
    <p>Aucune photo dans cet album.</p>
    <h3><a href ="/{{$a->id}}">{{$a->titre}} {{$a->creation}}</a></h3>
    @endif
</div>
@endforeach

<button><a href="/ajoutAlbum">Ajouter un album</a></button>
@endsection
