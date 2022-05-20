<aside class="col-lg-4 col-xl-3">
    <!-- Search      =============================== -->
    <div class="input-group shadow-sm mb-4">

        <span class="input-group-text bg-white border-0 p-0">
            <button class="btn text-muted shadow-none px-3 border-0" type="button"><i class="fa fa-search"></i></button>
        </span>

    </div>

    <!-- Categories      =============================== -->
    <div class="bg-white shadow-sm rounded p-3 mb-4">
        <h4 class="text-5 fw-400">Categorias</h4>
        <hr class="mx-n3">
        <ul class="list-item">
            @forelse ($tags as $tag)
            <li><a href="{{route("tag",$tag->slug)}}">{{$tag->name}}<span>({{ $tag->posts->count() }})</span></a></li>
            @empty
            @endforelse
        </ul>
    </div>
</aside>
