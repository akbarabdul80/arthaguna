@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
    <!-- Basic Bootstrap Table -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
    @endif

    <div class="card">
        <h5 class="card-header">Daftar Registrasi User</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemilik</th>
                        <th>No. Rekening</th>
                        <th>Nama Bank</th>
                        <th>Gambar KTP</th>
                        <th>Total Saldo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $no = 1; @endphp
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_pemilik }}</td>
                            <td>{{ $item->no_rekening }}</td>
                            <td>{{ $item->nama_bank }}</td>
                            <td><img src="{{ asset('storage/ktp_img/' . $item->ktp_image) }}" class="img-fluid"
                                    alt="..."></td>
                            <td>{{ 'Rp ' . number_format($item->total_saldo, 0, ',', '.') }}</td>
                            <td><span class="btn btn-sm btn-success me-1">Approved</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <hr class="my-12">
@endsection
