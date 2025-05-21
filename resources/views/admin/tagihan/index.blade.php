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
                            <th>Bukti Bayar</th>
                            <th>Status Tagihan</th>
                            <th>Aksi</th>
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
                                <td>{{ $item->total_semua }}</td>
                                <td>
                                    @if ($item->bukti_bayar)
                                        <a href="{{ asset('bukti_bayar/' . $item->bukti_bayar) }}" target="_blank"
                                            class="btn btn-info">Lihat Foto</a>
                                    @endif
                                </td>
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
                                    @if ($item->status == 1)
                                    <form action="{{ route('admin.tagihan.konfirmasi_pembayaran', $item->id) }}" method="POST"
                                        style="display:inline;" id="bayar-form-{{ $item->id }}">
                                        @csrf
                                        <button type="button" class="btn btn-primary btn-sm"
                                            onclick="confirm_bayar({{ $item->id }})">
                                            <i class="fa fa-check mr-2"></i> Konfirmasi Bayar
                                        </button>
                                    </form>
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

        function confirm_bayar(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data pembayaran ini akan dikonfirmasi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Konfirmasi!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#bayar-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
