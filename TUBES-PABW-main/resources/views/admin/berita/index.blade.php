@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Daftar Berita</h1>

    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary mb-3">
        Buat Berita
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($beritas as $berita)
                <tr>
                    <td>{{ $berita->judul }}</td>
                    <td>{{ Str::limit($berita->deskripsi, 50) }}</td>
                    <td>
                        @if ($berita->gambar)
                            <img src="{{ asset('storage/'.$berita->gambar) }}" width="100">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.berita.edit', $berita->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.berita.destroy', $berita->id) }}"
                              method="POST"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Hapus berita?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada berita</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $beritas->links() }}
</div>
@endsection
