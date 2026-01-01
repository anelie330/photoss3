@extends("app")
@section("content")     

<h2>Modifier l'album</h2>
<form class="ajout" action="/{{ $album->id }}/editAlbum" method="POST">
    @csrf

    <label for="titre">Titre de l’album :</label>
    <input type="text" id="titre" name="titre" value="{{ $album->titre }}" required>

    <br><br>

    <input type="submit" value="Enregistrer les modifications"/>
</form>
@endsection