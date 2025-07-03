@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h5>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama </th>
                            <th>Kategori Pelanggaran</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa->nama }}</td>
                                @php
                                    $kategori = '';
                                    switch ($item->kategori) {
                                        case 1:
                                            $kategori = 'Ringan';
                                            break;
                                        case 2:
                                            $kategori = 'Sedang';
                                            break;
                                        case 3:
                                            $kategori = 'Berat';
                                            break;
                                        default:
                                            break;
                                    }
                                @endphp
                                <td>{{ $kategori }}</td>
                                <td>{{ $item->catatan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#data_table').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                }
            })
        });

        function confirm_delete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        }

        $(".btn-ubah").click(function (e) {
            e.preventDefault();
            let this_id = $(this).data('id');
            let this_siswa = $(this).data('siswa');
            let this_kategori = $(this).data('kategori');
            let this_catatan = $(this).data('catatan');

            $("#id").val(this_id);
            $("#siswa").val(this_siswa).trigger('change');
            $("#kategori").val(this_kategori).trigger('change');
            $("#catatan").val(this_catatan);

            $("#card-name").text("Ubah Siswa Pelanggaran");
        });
    </script>
@endpush
