@extends("app")
@section("content")

<h2>Créer un nouvel album</h2>

<form action="/ajoutAlbum" method="POST">
    @csrf

    <label for="titre">Titre de l’album :</label>
    <input type="text" id="titre" name="titre" required>

    <br><br>

    <button type="submit">Créer</button>
</form>

@endsection