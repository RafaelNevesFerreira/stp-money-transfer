@extends("layouts.profile.app")
@section('content')
    <!-- Content
                  ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <!-- Left Panel
                        ============================================= -->
                @include('layouts.profile.left-painel')
                <!-- Left Panel End -->

                <!-- Middle Panel
                        ============================================= -->
                <div class="col-lg-9">

                    <!-- Recent Activity
                          =============================== -->
                    <div class="bg-white shadow-sm rounded py-4 mb-4">
                        <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-4">Recent Activity</h3>

                        <!-- Title
                            =============================== -->
                        <div class="transaction-title py-2 px-4">
                            <div class="row fw-00">
                                <div class="col-2 col-sm-1 text-center"><span class="">Date</span></div>
                                <div class="col col-sm-7">Description</div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center">Status</div>
                                <div class="col-3 col-sm-2 text-end">Amount</div>
                            </div>
                        </div>
                        <!-- Title End -->

                        <!-- Transaction List
                            =============================== -->

                        @forelse ($transfers as $transfer)
                            <div class="transaction-list">
                                <div class="transaction-item px-4 py-3" data-bs-toggle="modal"
                                    data-bs-target="#transaction-detail">
                                    <div class="row align-items-center flex-row">
                                        <div class="col-2 col-sm-1 text-center">
                                            <span class="d-block text-4 fw-300">{{$transfer->created_at->format("d")}}</span>
                                            <span class="d-block text-1 fw-300 text-uppercase">{{$transfer->created_at->format("F")}}</span>
                                        </div>
                                        <div class="col col-sm-7">
                                            <span class="d-block text-4">{{$transfer->destinatary_name}}</span>
                                            <span class="text-muted">Withdraw to Bank account</span>
                                        </div>
                                        <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3">
                                            @switch($transfer->status)
                                                @case('sended')
                                                    <span class="text-warning" data-bs-toggle="tooltip" title="In Progress">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </span>
                                                @break

                                                @case('receveid')
                                                    <span class="text-success" data-bs-toggle="tooltip" title="Completed">
                                                        <i class="fas fa-check-circle"></i>
                                                    </span>
                                                @break

                                                @case('returned')
                                                    <span class="text-danger" data-bs-toggle="tooltip" title="Cancelled">
                                                        <i class="fas fa-times-circle"></i>
                                                    </span>
                                                @break
                                            @endswitch

                                        </div>
                                        <div class="col-3 col-sm-2 text-end text-4">
                                            <span class="text-nowrap">{{$transfer->value_sended}}</span>
                                            <span class="text-2 text-uppercase">(USD)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                @empty
                            @endforelse

                        </div>
                        <!-- Transaction List End -->

                        <!-- Transaction Item Details Modal
                                    =========================================== -->
                        <div id="transaction-detail" class="modal fade" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered transaction-details" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row g-0">
                                            <div class="col-sm-5 d-flex justify-content-center bg-primary rounded-start py-4">
                                                <div class="my-auto text-center">
                                                    <div class="text-17 text-white my-3"><i class="fas fa-building"></i></div>
                                                    <h3 class="text-4 text-white fw-400 my-3">Envato Pty Ltd</h3>
                                                    <div class="text-8 fw-500 text-white my-4">$557.20</div>
                                                    <p class="text-white">15 March 2021</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <h5 class="text-5 fw-400 m-3">Transaction Details
                                                    <button type="button" class="btn-close text-2 float-end"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </h5>
                                                <hr>
                                                <div class="px-3">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2">Payment Amount <span
                                                                class="float-end text-3">$562.00</span></li>
                                                        <li class="mb-2">Fee <span
                                                                class="float-end text-3">-$4.80</span></li>
                                                    </ul>
                                                    <hr class="mb-2">
                                                    <p class="d-flex align-items-center fw-500 mb-0">Total Amount <span
                                                            class="text-3 ms-auto">$557.20</span></p>
                                                    <hr class="mb-4 mt-2">
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Paid By:</li>
                                                        <li class="text-muted">Envato Pty Ltd</li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Transaction ID:</li>
                                                        <li class="text-muted">26566689645685976589</li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Description:</li>
                                                        <li class="text-muted">Envato March 2021 Member Payment</li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Status:</li>
                                                        <li class="text-muted">Completed<span
                                                                class="text-success text-3 ms-1"><i
                                                                    class="fas fa-check-circle"></i></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Transaction Item Details Modal End -->

                        <!-- View all Link
                                    =============================== -->
                        <div class="text-center mt-4"><a href="http://demo.harnishdesign.net/html/payyed/transactions.html"
                                class="btn-link text-3">View all<i class="fas fa-chevron-right text-2 ms-2"></i></a></div>
                        <!-- View all Link End -->

                    </div>
                    <!-- Recent Activity End -->
                </div>
                <!-- Middle Panel End -->
            </div>
        </div>
        </div>
        <!-- Content end -->
    @endsection
