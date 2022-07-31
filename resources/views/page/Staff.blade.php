@extends('layout.Base')
@section('title')
    Data Staff
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="table-tab" data-toggle="tab" href="#table" role="tab"
                                aria-controls="table" aria-selected="true">Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="form-tab" data-toggle="tab" href="#form" role="tab"
                                aria-controls="form" aria-selected="false">Formulir</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="table" role="tabpanel" aria-labelledby="table-tab">
                            <div class="card-body">
                                <h5 class="card-title">Tabel Data Staff</h5>
                                <p class="card-text">Tabel ini mungkin memiliki relasi, harap berhati-hati saat menghapus
                                    data.
                                </p>
                                <table id="table-staff" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>NAMA</th>
                                            <th>JABATAN</th>
                                            <th style="width: 90px;">OPSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @foreach ($data as $d)
                                            <tr class="text-uppercase">
                                                <td>{{ $no++ }}.</td>
                                                <td>{{ $d->nama }}</td>
                                                <td>{{ $d->jabatan }}</td>
                                                <td>
                                                    <button data-id="{{ $d->id }}" id="btn-ubah" type="button"
                                                        class="btn btn-sm mb-2 btn-secondary"><span
                                                            class="fe fe-edit-3 fe-16"></span></button>
                                                    <button data-id="{{ $d->id }}" id="btn-hapus" type="button"
                                                        class=" ml-1 btn btn-sm mb-2 btn-danger"><span
                                                            class="fe fe-trash fe-16"></span></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="form" role="tabpanel" aria-labelledby="form-tab">
                            <div class="card-pad">
                                <form id="form-simpan">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">NAMA</label>
                                        <div class="col-sm-9">
                                            <input name="nama" type="text" class="form-control"
                                                placeholder="Nama Lengkap">
                                            <small id="nama-alert" class="mini-alert"></small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jabatan" class="col-sm-3 col-form-label">JABATAN</label>
                                        <div class="col-sm-9">
                                            <select name="jabatan" class="form-control">
                                                <option selected disabled>--Pilih--</option>
                                                <option value="kepala bidang">Kepala Bidang</option>
                                                <option value="staff">Staff</option>
                                            </select>
                                            <small id="jabatan-alert" class="mini-alert"></small>
                                            <div class="form-group mt-4">
                                                <button id="btn-simpan" type="button" class="btn btn-primary"><i
                                                        class="fe fe-14 fe-check-square mr-2"></i> Sign in</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#table-staff').DataTable();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).on('click', '#btn-simpan', function() {
            let url = `{{ config('app.url') }}/staff`
            let data = $('#form-simpan').serialize();
            Swal.showLoading();

            $.ajax({
                url: url,
                type: "POST",
                data: data,
                success: (result) => {
                    Swal.hideLoading();
                    Swal.fire({
                        title: result.response.title,
                        text: result.response.message,
                        icon: result.response.icon,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: (err) => {
                    Swal.hideLoading();
                    let data = err.responseJSON
                    let errorRes = data.errors
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    });
                    if (errorRes.length >= 1) {
                        $('.miniAlert').html('');
                        $.each(errorRes.data, function(i, value) {
                            $(`#${i}-alert`).html(value);
                        });
                    }
                }
            });
        });

        $(document).on('click', '#btn-ubah', function() {
            let _id = $(this).data('id');
            let url = `{{ config('app.url') }}/staff/${_id}`;

            $('.modal-title').html('Ubah Data');
            $.get(url, function(result) {
                $('#form-ubah').html(`
                    <div class="card-pad">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">NAMA</label>
                            <div class="col-sm-9">
                                <input name="nama" type="text" class="form-control" id="nama"
                                    placeholder="Nama Lengkap" value="${result.data.nama}">
                                <small id="nama-alert2" class="mini-alert"></small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jabatan" class="col-sm-3 col-form-label">JABATAN</label>
                            <div class="col-sm-9">
                                <select name="jabatan" class="form-control" id="jabatan">
                                    <option selected disabled>--Pilih--</option>
                                    <option value="kepala bidang">Kepala Bidang</option>
                                    <option value="staff">Staff</option>
                                </select>
                                <small id="jabatan-alert2" class="mini-alert"></small>
                            </div>
                        </div>
                    </div>
                `);
                $('.modal-footer').html(`
                    <button data-id="${result.data.id}" id="btn-kirim" type="button" class="btn btn-primary">Kirim</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                `);
                $('#jabatan').val(result.data.jabatan);
                $('#myModal').modal('show');
            });
        });

        $(document).on('click', '#btn-kirim', function() {
            let _id = $(this).data('id');
            let url = `{{ config('app.url') }}/staff/${_id}`;
            let data = $('#form-ubah').serialize();
            Swal.showLoading();
            $('#myModal').modal('hide');
            $.ajax({
                url: url,
                method: "PATCH",
                data: data,
                success: function(result) {
                    Swal.hideLoading();
                    Swal.fire({
                        title: result.response.title,
                        text: result.response.message,
                        icon: result.response.icon,
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Oke'
                    }).then((result) => {
                        location.reload();
                    });
                },
                error: function(result) {
                    Swal.hideLoading();
                    let data = result.responseJSON
                    let errorRes = data.errors
                    Swal.fire({
                        icon: data.response.icon,
                        title: data.response.title,
                        text: data.response.message,
                    }).then(() => {
                        $('#myModal').modal('show');
                        if (errorRes.length >= 1) {
                            $('.miniAlert').html('');
                            $.each(errorRes.data, function(i, value) {
                                $(`#${i}-alert2`).html(value);
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
