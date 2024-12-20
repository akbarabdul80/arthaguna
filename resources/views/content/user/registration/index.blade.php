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
                            @if ($item->is_verified == '0')
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                        data-bs-toggle="modal" aria-expanded="false"
                                        data-bs-target="#modalTogglePending{{ $item->id }}">Pending</button>

                                    <div class="modal fade" id="modalTogglePending{{ $item->id }}"
                                        aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel">Proses Status Akun
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label class="form-label">Nama Pemilik</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->nama_pemilik }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row g-6 mb-3">
                                                        <div class="col mb-0">
                                                            <label class="form-label">No. Rekening</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->no_rekening }}" readonly>
                                                        </div>
                                                        <div class="col mb-0">
                                                            <label for="dobWithTitle" class="form-label">Nama Bank</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->nama_bank }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label class="form-label">Total Saldo</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ 'Rp ' . number_format($item->total_saldo, 0, ',', '.') }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <img src="{{ asset('storage/ktp_img/' . $item->ktp_image) }}"
                                                                class="img-fluid" alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('user.reg.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="is_verified" value="1">
                                                        <button class="btn btn-success me-3">Approve</button>
                                                    </form>

                                                    <form action="{{ route('user.reg.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="is_verified" value="2">
                                                        <button class="btn btn-danger">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @elseif($item->is_verified == '2')

                                <td>
                                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                        data-bs-toggle="modal" aria-expanded="false"
                                        data-bs-target="#modalToggleReject{{ $item->id }}">Rejected</button>

                                    <div class="modal fade" id="modalToggleReject{{ $item->id }}"
                                        aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel">Proses Status Akun
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label class="form-label">Nama Pemilik</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->nama_pemilik }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row g-6 mb-3">
                                                        <div class="col mb-0">
                                                            <label class="form-label">No. Rekening</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->no_rekening }}" readonly>
                                                        </div>
                                                        <div class="col mb-0">
                                                            <label for="dobWithTitle" class="form-label">Nama Bank</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $item->nama_bank }}" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label class="form-label">Total Saldo</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ 'Rp ' . number_format($item->total_saldo, 0, ',', '.') }}"
                                                                readonly>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <img src="{{ asset('storage/ktp_img/' . $item->ktp_image) }}"
                                                                class="img-fluid" alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('user.reg.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="is_verified" value="1">
                                                        <button class="btn btn-success me-3">Approve</button>
                                                    </form>

                                                    <form action="{{ route('user.reg.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="is_verified" value="0">
                                                        <button class="btn btn-primary">Pending</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            @endif

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->

    <hr class="my-12">
@endsection
