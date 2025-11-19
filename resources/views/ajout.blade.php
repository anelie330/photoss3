@extends("app")
@section("content")        

<form action="/ajout" method="post" enctype="multipart/form-data">
    @csrf
    <label for="titre">Titre de la photo :</label>
    <input type="text" id="titre" name="titre" required /><br/><br/>
    
    <label for="album_id">Album :</label>
    <select id="album_id" name="album_id" required>
        @foreach($albums as $a)
            <option value="{{$a->id}}">{{$a->titre}}</option>
        @endforeach
    </select><br/><br/>
    
    <label for="url">Image (optionnel) :</label>
    <input id="url" type="text" name="url"><br>
    
    <input type="submit" value="Ajouter la photo" />
</form>
@endsection