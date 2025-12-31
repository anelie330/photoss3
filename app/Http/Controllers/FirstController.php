<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FirstController extends Controller
{
    //
    function index() {
        $albums = DB::select("SELECT 
                albums.*,
                (
                    SELECT photos.url
                    FROM photos
                    WHERE photos.album_id = albums.id
                    ORDER BY photos.id ASC
                    LIMIT 1
                ) AS cover
            FROM albums
        ");

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
        $trier = $request->get('trier'); // 'titre' ou 'note'

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

        if ($trier === 'titre') {
            $sql .= " ORDER BY photos.titre ASC";
        } elseif ($trier === 'note') {
            $sql .= " ORDER BY photos.note DESC";
        } else {
            $sql .= " ORDER BY photos.id DESC";
        }

        $photos = DB::select($sql, $params);
        $tags = DB::select("SELECT * FROM tags");

        return view("album", compact("album", "photos", "tags"));
    }

    function filterAlbums(Request $request) {
        $search = $request->get('search');
        $trier = $request->get('trier');
        $sql = "SELECT albums.*,
            (   SELECT photos.url FROM photos
                WHERE photos.album_id = albums.id ORDER BY photos.id ASC
                LIMIT 1
            ) AS cover
        FROM albums
        WHERE 1=1";

        $params = [];

        if (!empty($search)) {
            $sql .= " AND titre LIKE ?";
            $params[] = "%$search%";
        }
        if ($trier === 'titre') {
            $sql .= " ORDER BY titre ASC";
        } elseif ($trier === 'date') {
        $sql .= " ORDER BY creation DESC";
        } else {
            $sql .= " ORDER BY id DESC";
        }
        
        $albums = DB::select($sql, $params);
        return view("index", compact("albums"));
    }

    function ajout() {
        $albums = DB::select("SELECT * FROM albums");
        $tags = DB::select("SELECT * FROM tags");
        $notes = DB::select("SELECT * FROM photos");
        return view("ajout", compact("albums", "tags", "notes"));
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:200',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'album_id' => 'required|integer|exists:albums,id',
            'tag_id' => 'array',
            'tag_id.*' => 'integer|exists:tags,id',
            'note' => 'nullable|integer|min:0|max:5'
        ]);

        $chemin = $request->file('image')->store('photos', 'public');

        DB::insert(
            "INSERT INTO photos (titre, url, album_id, note) VALUES (?, ?, ?, ?)",
            [
                $validated['titre'],
                $chemin,
                $validated['album_id'],
                $validated['note']
            ]
        );

        $photoId = DB::getPdo()->lastInsertId();

        foreach ($validated['tag_id'] ?? [] as $tagId) {
            DB::insert(
                "INSERT INTO possede_tag (photo_id, tag_id) VALUES (?, ?)",
                [$photoId, $tagId]
            );
        }

        return redirect("/{$validated['album_id']}");
    }

    function deletePhoto($id) {
        DB::delete("DELETE FROM possede_tag WHERE photo_id = ?", [$id]);

        DB::delete("DELETE FROM photos WHERE id = ?", [$id]);

        return back();
    }

    function ajoutAlbum() {
        return view("ajoutAlbum");
    }

    function storeAlbum(Request $request) {
        $validated = $request->validate([
            'titre' => 'required|string|max:200'
        ]);

        DB::insert(
            "INSERT INTO albums (titre, creation) VALUES (?, ?)",
            [$request->titre, now()]
        );


        return redirect('/')->with('success', 'Album créé');
    }

    function deleteAlbum($id) {
        DB::delete("DELETE FROM possede_tag WHERE photo_id IN (SELECT id FROM photos WHERE album_id = ?)", [$id]);

        DB::delete("DELETE FROM photos WHERE album_id = ?", [$id]);

        DB::delete("DELETE FROM albums WHERE id = ?", [$id]);

        return back();
    }

    function editAlbum($id) {
        $album = DB::select("SELECT * FROM albums WHERE id = ?", [$id])[0];

        if (request()->isMethod('post')) {
            $validated = request()->validate([
                'titre' => 'required|string|max:200'
            ]);

            DB::update(
                "UPDATE albums SET titre = ? WHERE id = ?",
                [$validated['titre'], $id]
            );

            return redirect("/{$id}")->with('success', 'Album mis à jour');
        }

        return view("editAlbum", compact("album"));
    }
}