@extends('layouts.profile.app')
@section('content')
    <!-- Content
          ============================================= -->
    <div id="content" class="py-4">
        <div class="container">
            <div class="row">
                <!-- Left Panel        ============================================= -->
                @include('layouts.profile.left-painel')
                <!-- Left Panel End -->

                <!-- Middle Panel
                ============================================= -->
                <div class="col-lg-9">

                    <!-- Notifications
                  ============================================= -->
                    <div class="bg-white shadow-sm rounded p-4 mb-4">
                        <h3 class="text-5 fw-400">Notifications</h3>
                        <p class="text-muted">Select subscriptions to be delivered to <span
                                class="text-body">smithrhodes1982@gmail.com</span></p>
                        <hr class="mx-n4">
                        <form id="notifications" method="post">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label text-3" for="announcements">Announcements</label>
                                <p class="text-muted lh-base mt-2 mb-0">Be the first to know about new features and other
                                    news.</p>
                            </div>
                            <hr class="mx-n4">
                            <button class="btn btn-primary mt-1" type="submit">Save Changes</button>
                        </form>
                    </div>
                    <!-- Notifications End -->

                </div>
                <!-- Middle Panel End -->
            </div>
        </div>
    </div>
    <!-- Content end -->
@endsection
