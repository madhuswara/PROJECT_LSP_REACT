@extends('main.layout')
@section('content')

<center>
    <br>
    <h2>EDIT DATA MATA PELAJARAN</h2>
    <form action="/mapel/update/{{ $mapel->id }}" method="post">
        @csrf
        <table width="50%">
            <tr>
                <td class="bar">Nama Mata Pelajaran</td>
                <td class="bar">
                    <input type="text" name="nama_mapel" value="{{ $mapel->nama_mapel }}">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <center><button class="button-primary" type="submit">SIMPAN</button></center>
                </td>
            </tr>
        </table>
    </form>
</center>

@endsection