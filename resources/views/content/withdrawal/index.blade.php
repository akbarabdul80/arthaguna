@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Daftar Riwayat Withdrawal</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Invoice</th>
                        <th>Nama Bank</th>
                        <th>Nomor Bank</th>
                        <th>Nama Pemilik Bank</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $no = 1; @endphp
                    @foreach ($withdrawal as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->invoice_number }}</td>
                            <td>{{ $item->withdraw_nama_bank }}</td>
                            <td>{{ $item->withdraw_no_rekening }}</td>
                            <td>{{ $item->withdraw_nama_pemilik }}</td>
                            <td>{{ 'Rp ' . number_format($item->amount, 0, ',', '.') }}</td>
                            @if ($item->status === 'pending')
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">Pending</button>
                                        <ul class="dropdown-menu">
                                            <li class="text-center">
                                                <form action="{{ route('withdrawal.update', $item->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success w-75">Approve</button>
                                                </form>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li class="text-center">
                                                <form action="{{ route('withdrawal.update', $item->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger w-75">Reject</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            @elseif ($item->status == 'approved')
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-success dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">Approved</button>
                                        <ul class="dropdown-menu">
                                            <li class="text-center">
                                                <form action="{{ route('withdrawal.update', $item->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary w-75">Pending</button>
                                                </form>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li class="text-center">
                                                <form action="{{ route('withdrawal.update', $item->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-danger w-75">Reject</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false">Rejected</button>
                                        <ul class="dropdown-menu">
                                            <li class="text-center">
                                                <form action="{{ route('withdrawal.update', $item->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="pending">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary w-75">Pending</button>
                                                </form>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li class="text-center">
                                                <form action="{{ route('withdrawal.update', $item->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success w-75">Approved</button>
                                                </form>
                                            </li>
                                        </ul>
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
