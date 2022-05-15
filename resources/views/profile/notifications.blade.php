@extends('layouts.profile.app')
@section('content')
    <!-- Content
                              ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <!-- Left Panel  ============================================= -->
                @include('layouts.profile.left-painel')
                <!-- Left Panel End -->

                <!-- Middle Panel ============================================= -->
                <div class="col-lg-9">

                    <!-- Notifications   ============================================= -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="text-5 fw-400">Notificações</h3>
                        @forelse ($notifications as $notification)
                            <hr class="mx-n4">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label text-3"
                                    for="announcements">{{ $notification->title }}</label>
                                <p class="text-muted lh-base mt-2 mb-0">
                                    {{ $notification->content }}</p>
                            </div>
                        @empty
                        @endforelse
                    </div>
                    <!-- Notifications End -->

                </div>
                <!-- Middle Panel End -->
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection
