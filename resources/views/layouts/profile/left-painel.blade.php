<aside class="col-lg-3">

    <!-- Profile Details
  =============================== -->
    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
        <div class="profile-thumb mt-3 mb-4">
            <img class="rounded-circle img-fluid user-image"
                src="{{ asset('images/profile') . '/' . Auth::user()->avatar }}" alt="user avatar">
            <div class="profile-thumb-edit bg-primary text-white" data-bs-toggle="tooltip" title="Mudar foto">
                <i class="fas fa-camera position-absolute"></i>
                <input type="file" name="file" class="custom-file-input" id="file">
            </div>
        </div>
        <p class="text-3 fw-500 mb-2">Ola, {{ Str::limit(Auth::user()->name, 10, '..') }}</p>
        <p class="mb-2">
            <a href="{{ route('profile.settings') }}" class="text-5 text-light" data-bs-toggle="tooltip" title="Dados">
                <i class="fas fa-edit"></i>
            </a>
        </p>
    </div>
    <!-- Profile Details End -->

    <!-- Need Help?
  =============================== -->
    <div class="bg-white shadow-sm rounded text-center p-3 mb-4">
        <div class="text-17 text-light my-3"><i class="fas fa-comments"></i></div>
        <h3 class="text-5 fw-400 my-4">Precisa de ajuda?</h3>
        <p class="text-muted opacity-8 mb-4">Tem alguma duvida em relação as funcionalidades do site?<br>
            Nosso pessoal está disponível 24/24, não esite em fazer contato!.</p>
        <div class="d-grid"><a href="{{route("contact")}}" class="btn btn-primary">Entre em contato</a></div>
    </div>
    <!-- Need Help? End -->

</aside>
