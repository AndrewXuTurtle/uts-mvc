@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail User</h1>
        <div>
            <a href="{{ route('users.edit', $user->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-warning shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
            <a href="{{ route('users.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi User</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th style="width: 200px;">ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <td>
                                        <strong>{{ $user->name }}</strong>
                                        @if($user->id === auth()->id())
                                        <span class="badge badge-info ml-2">You</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Dibuat Pada</th>
                                    <td>{{ $user->created_at->format('d M Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diupdate</th>
                                    <td>{{ $user->updated_at->format('d M Y H:i:s') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit User
                            </a>
                        </div>
                        @if($user->id !== auth()->id())
                        <div>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Hapus User
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
