@extends("layouts.profile.app")
@section('content')
    <!-- Content
                  ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">

                @include('layouts.profile.left-painel')

                <!-- Middle Panel
                        ============================================= -->
                <div class="col-lg-9">
                    <h2 class="fw-400 mb-3">Transações</h2>

                    <!-- Filter
                          ============================================= -->
                    <div class="row">
                        <div class="col mb-2">
                            <form id="filterTransactions" method="get" action="{{ route('profile.transactions') }}">
                                <div class="row g-3 mb-3">
                                    <!-- Date Range
                                  ========================= -->
                                    <div class="col-sm-6 col-md-5">
                                        <div class="position-relative">
                                            <input id="dateRange" type="text" class="form-control"
                                                placeholder="Date Range" name="date">
                                            <span class="icon-inside"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                    </div>
                                    <!-- All Filters Link ========================= -->
                                    <div class="col-auto d-flex align-items-center me-auto form-group"
                                        data-bs-toggle="collapse"> <a class="btn-link" data-bs-toggle="collapse"
                                            href="#allFilters" aria-expanded="false" aria-controls="allFilters">Todos
                                            Filtros<i class="fas fa-sliders-h text-3 ms-1"></i></a> </div>

                                    <!-- Statements Link ========================= -->
                                    <div class="col-auto d-flex align-items-center me-auto form-group">
                                        <button type="submit" class="btn-sm btn-primary">
                                            Pesquisar
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>

                                    <!-- All Filters collapse ================================ -->
                                    <div class="col-12 collapse" id="allFilters">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="receveid" name="filter"
                                                value="received">
                                            <label class="form-check-label" for="receveid">Recebido</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="renbolsado" name="filter"
                                                value="reimbursed">
                                            <label class="form-check-label" for="renbolsado">Reembolsado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="plans" name="filter"
                                                value="plan">
                                            <label class="form-check-label" for="plans">Prestações</label>
                                        </div>
                                    </div>
                                    <!-- All Filters collapse End -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Filter End -->

                    <!-- All Transactions
                          ============================================= -->
                    <div class="bg-white shadow-sm rounded py-4 mb-4">
                        <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-4">Todas Transações</h3>
                        <!-- Title     =============================== -->
                        <div class="transaction-title py-2 px-4">
                            <div class="row fw-00">
                                <div class="col-2 col-sm-1 text-center"><span class="">Data</span></div>
                                <div class="col col-sm-7">Destinatario</div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center">Status</div>
                                <div class="col-3 col-sm-2 text-end">Valor</div>
                            </div>
                        </div>
                        <!-- Title End -->



                        <!-- Transaction Item Details Modal
                            =========================================== -->
                        @forelse ($transfers as $transfer)
                            <div class="transaction-list">
                                <div class="transaction-item px-4 py-3 transfer-id" id="{{ $transfer->id }}">
                                    <div class="row align-items-center flex-row">
                                        <div class="col-2 col-sm-1 text-center">
                                            <span
                                                class="d-block text-4 fw-300">{{ $transfer->created_at->format('d') }}</span>
                                            <span
                                                class="d-block text-1 fw-300 text-uppercase">{{ $transfer->created_at->format('F') }}</span>
                                        </div>
                                        <div class="col col-sm-7">
                                            <span class="d-block text-4">{{ $transfer->destinatary_name }}</span>
                                            @switch($transfer->plan)
                                                @case(1)
                                                    <span class="text-muted">Pago em prestações</span>
                                                @break

                                                @case(0)
                                                    <span class="text-muted">Debitado em cartão</span>
                                                @break
                                            @endswitch
                                        </div>
                                        <div class="col-auto col-sm-2 d-none d-sm-block text-center text-3">
                                            @switch($transfer->status)
                                                @case('sended')
                                                    <span class="text-warning" data-bs-toggle="tooltip" title="Em Progresso">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </span>
                                                @break

                                                @case('received')
                                                    <span class="text-success" data-bs-toggle="tooltip" title="Recebido">
                                                        <i class="fas fa-check-circle"></i>
                                                    </span>
                                                @break

                                                @case('reimbursed')
                                                    <span class="text-danger" data-bs-toggle="tooltip" title="Reembolsado">
                                                        <i class="fas fa-times-circle"></i>
                                                    </span>
                                                @break
                                            @endswitch

                                        </div>
                                        <div class="col-3 col-sm-2 text-end text-4">
                                            @switch($transfer->currency)
                                                @case('eur')
                                                    <span class="text-nowrap">€ {{ $transfer->value_sended }}</span>
                                                    <span class="text-2 text-uppercase">(EUR)</span>
                                                @break

                                                @case('usd')
                                                    <span class="text-nowrap">$ {{ $transfer->value_sended }}</span>
                                                    <span class="text-2 text-uppercase">(USD)</span>
                                                @break

                                                @case('gbp')
                                                    <span class="text-nowrap">£ {{ $transfer->value_sended }}</span>
                                                    <span class="text-2 text-uppercase">(GBP)</span>
                                                @break
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div class="row">
                                    <div class="col col-lg-12 text-center mt-3">
                                        <p>Nenhuma Transação Feita</p>
                                    </div>
                                </div>
                            @endforelse

                        </div>
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
                                                    <h3 class="text-4 text-white fw-400 my-3">{{ env('APP_NAME') }}</h3>
                                                    <div class="text-8 fw-500 text-white my-4" id="transfer_value">$557.20</div>
                                                    <p class="text-white" id="transfer_date">15 March 2021</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <h5 class="text-5 fw-400 m-3">Detalhes
                                                    <button type="button" class="btn-close text-2 float-end"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </h5>
                                                <hr>
                                                <div class="px-3">
                                                    <ul class="list-unstyled">
                                                        <li class="mb-2">Valor enviado <span class="float-end text-3"
                                                                id="transfer_valor_sem_taxa"></span></li>
                                                        <li class="mb-2">Taxa <span class="float-end text-3"
                                                                id="transfer_tax"></span></li>
                                                    </ul>
                                                    <hr class="mb-2">
                                                    <p class="d-flex align-items-center fw-500 mb-0">Total Pago <span
                                                            class="text-3 ms-auto" id="transfer_total"></span></p>
                                                    <hr class="mb-4 mt-2">
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Receptor:</li>
                                                        <li class="text-muted" id="transfer_receptor"></li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Codigo Transferência:</li>
                                                        <li class="text-muted" id="transfer_id"></li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Pagamento:</li>
                                                        <li class="text-muted" id="description"></li>
                                                    </ul>
                                                    <ul class="list-unstyled">
                                                        <li class="fw-500">Estado:</li>
                                                        <li class="text-muted" id="transfer_status"><span
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
                        <!-- Pagination   ============================================= -->
                        {{ $transfers->links('pagination::default') }}

                        <!-- Paginations end -->

                    </div>
                    <!-- All Transactions End -->
                </div>
                <!-- Middle End -->
            </div>
        </div>
        </div>
        <!-- Content end -->
    @endsection
