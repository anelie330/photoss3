<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FirstController extends Controller
{
    //
    function index() {
                $albums = DB::select("SELECT * FROM albums");
                return view("index", compact("albums"));
            }
    function album($id) {
    $album = DB::select("SELECT * FROM albums WHERE id = ?", [$id])[0];

    $photos = DB::select("
        SELECT photos.*, GROUP_CONCAT(tags.nom SEPARATOR ', ') AS tags
        FROM photos
        LEFT JOIN possede_tag ON possede_tag.photo_id = photos.id
        LEFT JOIN tags ON tags.id = possede_tag.tag_id
        WHERE photos.album_id = ?
        GROUP BY photos.id
    ", [$id]);

    $tags = DB::select("SELECT * FROM tags");

    return view("album", compact("album", "photos", "tags"));
}

function filterPhotos(Request $request, $album_id) {

    $album = DB::select("SELECT * FROM albums WHERE id = ?", [$album_id])[0];

    $tagId = $request->get('tag_id');
    $search = $request->get('search');

    $sql = "
        SELECT photos.*, GROUP_CONCAT(tags.nom SEPARATOR ', ') AS tags
        FROM photos
        LEFT JOIN possede_tag ON possede_tag.photo_id = photos.id
        LEFT JOIN tags ON tags.id = possede_tag.tag_id
        WHERE photos.album_id = ?
    ";
    $params = [$album_id];

    if (!empty($tagId)) {
        $sql .= " AND photos.id IN (
            SELECT photo_id
            FROM possede_tag
            WHERE tag_id = ?
        )";
        $params[] = $tagId;
    }

    if (!empty($search)) {
        $sql .= " AND photos.titre LIKE ?";
        $params[] = "%$search%";
    }

    $sql .= " GROUP BY photos.id";

    $photos = DB::select($sql, $params);
    $tags = DB::select("SELECT * FROM tags");

    return view("album", compact("album", "photos", "tags"));
}


    function ajout() {
        $albums = DB::select("SELECT * FROM albums");
        $tags = DB::select("SELECT * FROM tags");
        return view("ajout", compact("albums", "tags"));
    }

    function store(Request $request) {
            $validated = $request->validate([
            'titre' => 'required|string|max:200',
            'url' => 'nullable|url',
            'album_id' => 'integer|exists:albums,id',
            'tag_id' => 'array',
            'tag_id.*' => 'integer|exists:tags,id'
        ]);

            DB::insert("INSERT INTO photos (titre, url, album_id) VALUES (?, ?, ?)",
            [
            $validated['titre'],
            $validated['url'] ?? null,
            $validated['album_id']
        ]
        );
        
        $photo_id = DB::getPdo()->lastInsertId();

        foreach ($validated['tag_id'] as $tag) {
        DB::insert(
            "INSERT INTO possede_tag (photo_id, tag_id) VALUES (?, ?)",
            [$photo_id, $tag]
        );
        }

        return redirect("/{$validated['album_id']}");
        }

}