@extends('layout.main')

@section('user', 'active')

@section('content')
<style>
    .card{
        border-radius: 20px;
     }

    .btn{
        border-radius: 5px;
    }
    .table{
        border-radius: 10px;
    }
</style>

<a href="{{ url('/tbhUser') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah User</a>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar User</strong>
            </div>
            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
                            <td>
                                <a href="/edtUser/{{ $item->id_user }}" data-bs-toggle="tooltip" title="Edit" class="btn btn-sm btn-success"><i
                                        class="fa fa-pencil-square-o"></i></a>
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="confirmation(event)" href="{{url('/hpsUser', $item->id_user)}}"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('table')

<script type="text/javascript">
    $(document).ready(function () {
        $('#bootstrap-data-table-export').DataTable();
    });
</script>
@endsection
