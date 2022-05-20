<aside class="col-lg-4 col-xl-3">

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
