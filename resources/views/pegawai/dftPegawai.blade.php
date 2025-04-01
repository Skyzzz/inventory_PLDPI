@extends('layout.main')

@section('pegawai', 'active')

@section('content')

<style>
    .card {
        border-radius: 20px;
    }

    .btn {
        border-radius: 5px;
    }

    .table {
        border-radius: 10px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //get the URL to redirect to
        console.log(urlToRedirect);
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlToRedirect;
            }
        });
    }
</script>

<a href="{{ url('/tbhPegawai') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-plus"></i> Tambah Pegawai</a>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <strong class="card-title">Daftar Pegawai</strong>
            </div>
            <div class="card-body">
                <table id="data-pegawai" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pegawai</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pegawai as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_pegawai }}</td>
                            <td>{{ $item->nama_pegawai }}</td>
                            <td>{{ $item->jabatan }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <button onclick="handleRole('{{ $item->id_pegawai }}', '{{ $item->nama_pegawai }}', '{{ $item->email }}')" 
                                        class="btn btn-sm btn-warning">
                                    <i class="fa fa-key"></i>
                                </button>
                                <a href="/edtPegawai/{{ $item->id_pegawai }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" data-bs-toggle="tooltip" title="Hapus" onclick="confirmation(event)" href="{{url('/hpsPegawai', $item->id_pegawai)}}"><i
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
function handleRole(id, name, email) {
    Swal.fire({
        title: 'Konfirmasi Hak Akses',
        html: `Yakin ingin memberikan hak akses admin kepada <b>${name}</b>?`,
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya, Jadikan Admin',
        showLoaderOnConfirm: true,
        reverseButtons: true,
        preConfirm: () => {
            return new Promise((resolve) => {
                Swal.fire({
                    title: 'Buat Password',
                    html: `<input type="password" 
                                  id="password" 
                                  class="swal2-input" 
                                  placeholder="Masukkan password"
                                  required>`,
                    focusConfirm: false,
                    preConfirm: () => {
                        const password = Swal.getPopup().querySelector('#password').value
                        if (!password) {
                            Swal.showValidationMessage('Password wajib diisi')
                            return false
                        }
                        return { password: password }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/keyPegawai/' + id,
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id_pegawai: id,
                                nama_pegawai: name,
                                email: email,
                                jabatan: 'Admin',
                                password: result.value.password
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: 'Hak akses admin berhasil diberikan',
                                    icon: 'success'
                                })
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: xhr.responseJSON.message || 'Terjadi kesalahan',
                                    icon: 'error'
                                })
                            }
                        })
                    }
                })
            })
        }
    })
}
</script>

@endsection 