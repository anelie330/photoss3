@extends("app")
@section("content")
<h2>Filtrer :</h2>
<form class="filter" action="/{{ $album->id }}/filter" method="get">
    <label for="tag_id">Tags :</label>
    <select id="tag_id" name="tag_id">
        <option value="">Aucun tag sélectionné</option>
        @foreach($tags as $tag)
            <option value="{{ $tag->id }}" @if(request()->get('tag_id') == $tag->id) selected @endif>
                {{ $tag->nom }}
            </option>
        @endforeach
    </select>

    <label for="trier">Trier par :</label>
    <select id="trier" name="trier">
        <option value="">Aucun</option>
        <option value="titre" @if(request()->get('trier') == 'titre') selected @endif>Titre</option>
        <option value="note" @if(request()->get('trier') == 'note') selected @endif>Note</option>
    </select>

    <label for="search">Titre :</label>
    <input type="text" id="search" name="search" value="{{ request()->get('search') }}" placeholder="Rechercher" />

    <input type="submit" value="Appliquer" />
</form>


<section class="photo-section">
@foreach($photos as $p)
    <div class="photos-album">
        <h3>{{$p->titre}}</h3>
        <img class="photo"
        src="{{ str_starts_with($p->url, 'http') ? $p->url : asset('storage/' . $p->url) }}"
        alt="{{ $p->titre }}">

        <h3>{{$p->tags}}</h3>
        <h3>
        @php
        $note = $p->note ?? 0;
        @endphp

        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $note)
                <span id="etoile-jaune">&#9733;</span>
            @else
                <span id="etoile-grise">&#9733;</span>
            @endif
        @endfor
        </h3>

        <form class="delete-form" action="/photos/{{ $p->id }}" method="POST" style="display:inline;" onsubmit="return confirm('Supprimer cette photo ?')">
            @csrf
            @method('DELETE')
            <button id="delete" type="submit">
                <i class="fa-solid fa-trash-can"></i>
            </button>
        </form>
    </div>
@endforeach
</section>

<button><a href="/ajout">Ajouter des photos</a></button>

<script>
document.querySelectorAll('.photo').forEach(function(img) {
  img.addEventListener('click', function() {

    const overlay = document.createElement('div');
    overlay.classList.add('overlay');

    const zoomedImg = document.createElement('img');
    zoomedImg.src = img.src;
    zoomedImg.alt = img.alt;

    overlay.appendChild(zoomedImg);
    document.body.appendChild(overlay);

    overlay.addEventListener('click', function() {
      overlay.remove();
    });
  });
});
</script>

@endsection