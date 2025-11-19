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
                $photos = DB::select("SELECT * FROM photos WHERE album_id = ?", [$id]);
                return view("album", compact("photos"));
            }
    function ajout() {
                $albums = DB::select("SELECT * FROM albums");
                return view("ajout", compact("albums"));
            }
    function store(Request $request) {
        $validated = $request->validate([
            'titre' => 'required|string|max:200',
            'url' => 'nullable|url',
            'album_id' => 'integer|exists:albums,id'
            ]);

            DB::insert("INSERT INTO photos (titre, url, album_id) VALUES (?, ?, ?)",
            [
            $validated['titre'],
            $validated['url'] ?? null,
            $validated['album_id']
        ]
        );
            return redirect("/{$validated['album_id']}");
}
}