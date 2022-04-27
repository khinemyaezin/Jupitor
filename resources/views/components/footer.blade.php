<footer class="footer text-white px-4 py-lg-4">
    <div class="container ">
        <div class="row g-3">
            <div class="col-sm-12 col-md-6 col-lg-4">
                @if ($info->data)
                    <div class="d-table-cell text-left small">
                        @if ($info->data->name)
                            <h5 class="mb-4 fw-bold">{{ $info->data?->name }}</h5>
                        @endif
                        <ul class="list-unstyled">

                            @if ($info->data->address)
                                <li class="mb-3 d-flex justify-content-start gap-3">
                                    <i class="bi bi-geo-alt-fill"></i>

                                    <div class="ms-2">
                                        <span>{{ $info->data?->address }}</span>
                                    </div>
                                </li>
                            @endif

                            @if ($info->data->phone)
                                <li class="mb-3 d-flex justify-content-start gap-3">
                                    <i class="bi bi-telephone-fill"></i>
                                    <div class="ms-2">
                                        <a href="tel:{{ $info->data?->phone }}"
                                            class="text-decoration-none text-white">{{ $info->data?->phone }}</a>
                                        <span class="d-block text-muted text-small">{{ $info->data?->getOfficeDays()}}</span>
                                        <span class="d-block text-muted text-small">{{ $info->data?->getOfficeHours()}}</span>
                                    </div>
                                </li>
                            @endif

                            @if ($info->data->email)
                                <li class="mb-3 d-flex justify-content-start gap-3">
                                    <i class="bi bi-envelope-fill"></i>
                                    <div class="ms-2">
                                        <a class="text-decoration-none text-white"
                                            href="mailto:{{ $info->data?->email }}">{{ $info->data?->email }}</a>
                                    </div>
                                </li>
                            @endif

                            <li class="mb-3 d-flex justify-content-start gap-3 fs-5 ">
                                @if ($info->data->linkin)
                                    <a class="bi bi-linkedin text-white text-decoration-none"
                                        href="{{ $info->data->linkin }}"></a>
                                @endif
                                @if ($info->data->facebook)
                                    <a class="bi bi-facebook text-white text-decoration-none"
                                        href="{{ $info->data->facebook }}"></a>
                                @endif
                                @if ($info->data->instagram)
                                    <a class="bi bi-instagram text-white text-decoration-none"
                                        href="{{ $info->data->instagram }}"></a>
                                @endif

                            </li>

                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="quick-link">
                    <h6>Quick LInks</h6>
                    <ul class="nav flex-column px-0">
                        <li class="nav-item "><a class="nav-link text-decoration-none small py-1 text-white" href="/">Home</a></li>
                        <li class="nav-item "><a class="nav-link text-decoration-none small py-1 text-white" href="/about">About Us</a></li>
                        @foreach ($services as $item)
                            @if ($item->on_navbar)
                                <li class="nav-item "><a class="nav-link text-decoration-none small py-1 text-white"
                                        href="{{ route('page.groupInfo', ['typeid' => $item->type->code]) }}">{{ $item->title }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li class="nav-item "><a class="nav-link text-decoration-none small py-1 text-white" href="/contact">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="bg-transparent ps-lg-5">
                    <div class="h6 mb-3">Subscribe to our newsletter to receive exclusive offers.</div>
                    <div class="">
                        <input type="text" class="form-control mb-3">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-start">
            <div class="col col-md-auto">
                <small class="text-muted">©2022 All Rights Reserved by <strong><a href="/" class="text-decoration-none text-muted">{{ $info->data?->name }}</a></strong>
                </small>
            </div>
        </div>
    </div>
</footer>
