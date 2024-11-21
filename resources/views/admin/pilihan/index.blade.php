@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary btn-sm float-right" id="btn_add"><i class="fa fa-plus mr-2"></i> Tambah
                        Data</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Parameter</th>
                            <th>Isi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="data_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal_title" id="modal_title"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i
                            class="fa fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <form id="data_form">
                        @csrf
                        <input type="hidden" id="data_id">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="parameter" class="form-label">Parameter</label>
                            <input type="text" class="form-control" id="parameter" name="parameter" required>
                        </div>
                        <div class="mb-3">
                            <label for="isi" class="form-label">Isi</label>
                            <textarea class="form-control" id="isi" name="isi" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn_save">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $("#data_table").DataTable({
                autoWidth: true,
                responsive: true,
                ajax: "{{ route('admin.pilihan.index') }}",
                columns: [{
                        data: '',
                        render: function(data, type, row, meta) {
                            return meta.row + 1 + meta.settings._iDisplayStart;
                        },
                        orderable: false,
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'parameter',
                        name: 'parameter',
                    },
                    {
                        data: 'isi',
                        name: 'isi',
                    },
                    {
                        data: 'aksi',
                        orderable: false,
                    }
                ],
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                }
            });

            // Add New button
            $('#btn_add').click(function() {
                $('#data_form')[0].reset();
                removeErrors();
                $('#data_id').val('');
                $('#modal_title').text('Tambah Data');
                $('#data_modal').modal('show');
            });

            // Save data
            $('#btn_save').click(function() {
                var formData = $('#data_form').serialize();
                var id = $('#data_id').val();
                if (id) {
                    var url = "{{ route('admin.pilihan.update', ':id') }}";
                    url = url.replace(':id', id);
                    var method = 'PUT';
                } else {
                    var url = "{{ route('admin.pilihan.store') }}"
                    var method = 'POST';
                }

                $.ajax({
                    url: url,
                    method: method,
                    data: formData,
                    success: function(response) {
                        if (response.status) {
                            $('#data_modal').modal('hide');
                            table.ajax.reload();
                            notif_success('Data berhasil disimpan');
                        } else {
                            displayErrors(response.errors);
                        }
                    },
                    error: function(response) {
                        notif_error('Data gagal disimpan');
                    }
                });
            });

            // Edit button
            $('#data_table').on('click', '.btn-edit', function() {
                var id = $(this).data('id');
                let url = "{{ route('admin.pilihan.edit', ':id') }}";
                url = url.replace(':id', id);
                removeErrors();
                $.get(url, function(data) {
                    $('#data_id').val(data.id);
                    $('#parameter').val(data.parameter);
                    $('#nama').val(data.nama);
                    $('#isi').val(data.isi);
                    $('#modal_title').text('Edit Data');
                    $('#data_modal').modal('show');
                });
            });

            // Delete button
            $('#data_table').on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    text: "Anda tidak dapat mengembalikan data ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let url = "{{ route('admin.pilihan.destroy', ':id') }}"
                        url = url.replace(':id', id);
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                id: id,
                            },
                            success: function(response) {
                                notif_success('Berhasil menghapus pilihan');
                                table.ajax.reload(null, false);
                            },
                            error: (response) => {
                                notif_error('Gagal menghapus pilihan');
                            }
                        });
                    }
                })
            });
        });
    </script>
@endpush
