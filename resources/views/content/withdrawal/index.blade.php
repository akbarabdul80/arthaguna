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
                        <!-- Modal-->
                        {{-- <div class="modal fade" id="modalToggle{{ $item->id }}" aria-labelledby="modalToggleLabel"
                            tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalToggleLabel">Warning!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('withdrawal.update', $item->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <p class="text-body-modal"></p>

                                            <input class="input_status" name="status" type="hidden" value="">

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
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
                                            data-bs-toggle="modal" aria-expanded="false"
                                            data-bs-target="#modalTogglePending{{ $item->id }}">Pending</button>
                                    </div>

                                    <div class="modal fade" id="modalTogglePending{{ $item->id }}"
                                        aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel">Proses Status Withdrawal
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('withdrawal.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">
                                                        <button class="btn btn-success me-3">Approve</button>
                                                    </form>

                                                    <form action="{{ route('withdrawal.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button class="btn btn-danger">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @elseif ($item->status == 'approved')
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-success dropdown-toggle"
                                            data-bs-toggle="modal" aria-expanded="false"
                                            data-bs-target="#modalToggleApproved{{ $item->id }}">Approved</button>
                                    </div>

                                    <div class="modal fade" id="modalToggleApproved{{ $item->id }}"
                                        aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel">Proses Status Withdrawal
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('withdrawal.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="pending">
                                                        <button class="btn btn-primary me-3">Pending</button>
                                                    </form>

                                                    <form action="{{ route('withdrawal.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button class="btn btn-danger">Reject</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @else
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                            data-bs-toggle="modal" aria-expanded="false"
                                            data-bs-target="#modalToggleRejected{{ $item->id }}">Rejected</button>
                                    </div>

                                    <div class="modal fade" id="modalToggleRejected{{ $item->id }}"
                                        aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalToggleLabel">Proses Status Withdrawal
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('withdrawal.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">
                                                        <button class="btn btn-success me-3">Approve</button>
                                                    </form>

                                                    <form action="{{ route('withdrawal.update', $item->id) }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="status" value="pending">
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

{{-- @section('customScripts')
    <script>
        $(document).ready(function() {
            // Event listener untuk tombol dengan data-bs-toggle="modal"
            $('[data-bs-toggle="modal"]').on('click', function() {
                // Ambil nilai data-action dari tombol yang diklik
                const action = $(this).data('action');

                // Update isi modal sesuai dengan tombol yang diklik
                if (action === 'approve') {
                    $('.text-body-modal').text('Are you sure you want to approve this?');
                    $('.input_status').val('approved');
                } else if (action === 'pending') {
                    $('.text-body-modal').text('Are you sure you want to pending this?');
                    $('.input_status').val('pending');
                } else if (action === 'rejected') {
                    $('.text-body-modal').text('Are you sure you want to reject this?');
                    $('.input_status').val('rejected');
                }
            });
        });
    </script>
@endsection --}}
