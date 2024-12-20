@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Daftar Riwayat Deposit</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Invoice</th>
                        <th>ID Transaksi Midtrans</th>
                        <th>Nama Pemilik</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @php $no = 1; @endphp
                    @foreach ($deposits as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->invoice_number }}</td>
                            <td>{{ $item->midtrans_transaction_id }}</td>
                            <td>{{ $item->user->nama_pemilik }}</td>
                            <td>{{ 'Rp ' . number_format($item->amount, 0, ',', '.') }}</td>
                            @if ($item->status === 'pending')
                                <td><span class="btn btn-sm btn-primary me-1">Pending</span></td>
                            @elseif ($item->status == 'approved')
                                <td><span class="btn btn-sm btn-success me-1">Approved</span></td>
                            @else
                                <td><span class="btn btn-sm btn-danger me-1">Rejected</span></td>
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
