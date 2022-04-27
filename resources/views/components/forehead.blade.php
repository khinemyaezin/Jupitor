@props(['forehead'])

@if ($forehead->data)
    <div id="main-slider" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($forehead->data->carousels as $item)
                <button type="button" data-bs-target="#main-slider" data-bs-slide-to="{{ $loop->index }}"
                    class="active" aria-current="true" aria-label="Slide {{ $loop->index + 1 }}"></button>
            @endforeach

        </div>
        <div class="carousel-inner ">
            @foreach ($forehead->data->carousels as $item)
                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                    <img src="{{ asset('storage/' . $item->image_url) }}" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block text-end">
                        <h5 class="text-white"><a class="text-reset" href="#">{{ $item->title }}</a></h5>
                        <p>{{ $item->body }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-md-block company-label text-white text-start w-100 container">
            <div class="w-md-75 w-sm-auto">
                <div class="d-table w-100">
                    <div class="d-table-cell text-left">

                        <h1 class="fw-bold mb-3 display-4" data-aos="fade-up" data-aos-duration="1000">
                            {{ $forehead->data->title }}</h1>
                        <h3 class="mb-4  text-wrap" data-aos="fade-up" data-aos-duration="2000">
                            <span class="typewrite-v2 blinker anim-typewriter text-wrap"></span>
                        </h3>
                        <a href="{{ route('contactus.index') }}" class="btn btn-light btn-lg  btn-point"
                            data-aos="fade-up" data-aos-duration="3000">
                            <span>Contact us</span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
@else
    <div class="bg-dark space-empty">
        <i class="bi bi-balloon"></i>
    </div>
@endif
