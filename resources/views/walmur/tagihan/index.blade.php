@extends('template.admin')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="m-0 font-weight-bold text-primary">Daftar Data {{ $title }}</h6>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="data_table" class="table table-striped mt-4 w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Iuran</th>
                            {{-- <th class="d-none">Jatuh Tempo</th> --}}
                            <th>Tagihan</th>
                            <th>Status Tagihan</th>
                            <th>Aksi <br><small class="text-danger">Jika tagihan sudah dibayar tetapi nominal tagihan Rp0/Gratis maka kolom aksi ini akan kosong</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->siswa ? $item->siswa->nama : '-' }} <br>
                                    <span class="badge badge-info">
                                        NIS: {{ $item->siswa ? $item->siswa->nis : '-' }}
                                    </span>
                                </td>
                                <td>{{ $item->iuran->nama }}</td>
                                {{-- <td class="d-none">{{ $item->jatuh_tempo }}</td> --}}
                                <td>Rp{{ format_currency($item->total_semua) }}
                                    {{ $item->total_semua == 0 ? '(Gratis)' : '' }}</td>
                                <td>
                                    @if ($item->status == 1)
                                        <span class="badge badge-warning">Sudah Bayar</span>
                                    @elseif ($item->status == 2)
                                        <span class="badge badge-success">Dikonfirmasi Admin</span>
                                    @else
                                        <span class="badge badge-danger">Belum Bayar</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 0)
                                        <a href="{{ route('walmur.tagihan.bayar', $item->id) }}"
                                            class="btn btn-primary">Bayar</a>
                                    @else
                                        @if ($item->bukti_bayar)
                                            <a href="{{ asset('bukti_bayar/' . $item->bukti_bayar) }}" target="_blank"
                                                class="btn btn-info">Lihat Foto</a>
                                        @else
                                            -
                                        @endif
                                    @endif
                                </td>
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
    </script>
@endpush
