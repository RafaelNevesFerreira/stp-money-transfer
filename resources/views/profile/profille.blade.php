@extends('layouts.profile.app')
@section('content')
    <!-- Conte ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <!-- Left Pane ============================================= -->
                @include('layouts.profile.left-painel')
                <!-- Left Panel End -->

                <!-- Middle Pane ============================================= -->
                <div class="col-lg-9">

                    <!-- Recent Activity =============================== -->
                    <div class="bg-white shadow-sm rounded py-4 mb-4">
                        <h3 class="text-5 fw-400 d-flex align-items-center px-4 mb-4">Atividades Recentes</h3>

                        <!-- Title ============================== -->
                        <div class="transaction-title py-2 px-4">
                            <div class="row fw-00">
                                <div class="col-2 col-sm-1 text-center"><span class="">Data</span></div>
                                <div class="col col-sm-7">Destinatario</div>
                                <div class="col-auto col-sm-2 d-none d-sm-block text-center">Status</div>
                                <div class="col-3 col-sm-2 text-end">Valor</div>
                            </div>
                        </div>
                        <!-- Title End -->

                        <!-- Transaction List         =============================== -->

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
                        <!-- Transaction List End -->

                        <!-- View all Link
                                                                                                                                                                                            =============================== -->
                        <div class="text-center mt-4"><a href="{{ route('profile.transactions') }}"
                                class="btn-link text-3">Ver
                                Todas<i class="fas fa-chevron-right text-2 ms-2"></i></a></div>
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
