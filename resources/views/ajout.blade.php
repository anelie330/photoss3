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
    
    <label for="image">Image :</label>
    <input type="file" id="image" name="image" accept="image/*" required>

    <label for="tags">Tags :</label>
    @foreach($tags as $tag)
        <label>
            <input type="checkbox" name="tag_id[]" value="{{ $tag->id }}">
            {{ $tag->nom }}
        </label>
    @endforeach

    <label for="note">Note :</label>
    <input type="number" id="note" name="note" min="0" max="5" />

<br><br>

    
    <input type="submit" value="Ajouter la photo" />
</form>
@endsection