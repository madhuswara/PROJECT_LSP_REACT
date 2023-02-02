<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Mengajar;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guru.index', ['guru' => Guru::all()
        //menampilkan data guru
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //buat nampilin form tambah data user
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ke database
        //validate pengecekan data yang masuk
        $data_guru = $request->validate([
            'nip' => 'required|numeric', //why pake |
            'nama_guru' => 'required', //pake name
            'jk' => 'required',
            'alamat' => 'required',
            'password' => 'required'
        ]);

        Guru::create($data_guru);
        return redirect('/guru/index')->with('success', 'Data guru berhasil ditambah');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //ngedit dan ambil data
        return view ('guru.edit', ['guru' => $guru]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guru $guru)
    {
        //buat ngubah
        $data_guru = $request->validate([
            'nip' => 'required|numeric',
            'nama_guru' => 'required',
            'jk' => 'required',
            'alamat' => 'required',
            'password' => 'required'
        ]);

        $guru->update($data_guru);
        return redirect('/guru/index')->with('success', 'Data guru berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //menghapus data
        $mengajar = Mengajar::where('guru_id', $guru->id)->first();
        
        if($mengajar) {
            return back()->with('error', "$guru->nama_guru masih digunakan di menu mengajar");
        }

        $guru->delete();

        return redirect('/guru/index')->with('success', 'Data berhasil dihapus');
    }
}
