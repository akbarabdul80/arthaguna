@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Analytics')

@section('vendor-style')
    @vite('resources/assets/vendor/libs/apex-charts/apex-charts.scss')
@endsection

@section('vendor-script')
    @vite('resources/assets/vendor/libs/apex-charts/apexcharts.js')
@endsection

@section('page-script')
    @vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-8 col-lg-12 col-xxl-12 order-0 order-md-0">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xxl-4 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/people.png') }}" alt="total users" class="rounded">
                                </div>
                            </div>
                            <p class="mb-1">Total User</p>
                            <h1 class="card-title mb-3">{{ $users }}</span></h1>
                            {{-- <span style="color: rgb(122, 121, 121)"></span> --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xxl-4 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/deposit.png') }}" alt="Total Deposit"
                                        class="rounded">
                                </div>
                            </div>
                            <p class="mb-1">Total Deposit</p>
                            <h3 class="card-title mb-3">{{ 'Rp ' . number_format($total_deposit, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xxl-4 mb-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/withdraw.png') }}" alt="Total Withdraw"
                                        class="rounded">
                                </div>
                            </div>
                            <p class="mb-1">Total Withdrawal</p>
                            <h3 class="card-title mb-3">{{ 'Rp ' . number_format($total_withdraw, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-12 col-xxl-12 mb-6 order-1">
            <div class="card">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Congratulations John! 🎉</h5>
                            <p class="mb-6">You have done 72% more sales today.<br>Check your new badge in your profile.
                            </p>

                            <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-6">
                            <img src="{{ asset('assets/img/illustrations/man-with-laptop.png') }}" height="175"
                                class="scaleX-n1-rtl" alt="View Badge User">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
