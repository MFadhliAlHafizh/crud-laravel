<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::paginate(5);
        return view('index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|min:3',
            'pengarang' => 'required|min:3',
            'tahun_terbit' => 'required|digits:4'
        ]);
        Buku::create($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::paginate(5);
        $bukuDetail = Buku::findOrFail($id);
        return view('index', compact('buku', 'bukuDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|min:3',
            'pengarang' => 'required|min:3',
            'tahun_terbit' => 'required|digits:4'
        ]);
        Buku::where('id', $id)->update($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bukuDetail = Buku::findOrFail($id);
        $bukuDetail->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function destroyAll()
    {
        Buku::truncate();
        return redirect()->route('buku.index')->with('success', 'Seluruh buku berhasil dihapus!');
    }
}
