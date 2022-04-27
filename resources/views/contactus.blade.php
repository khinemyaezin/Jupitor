@extends('layouts.app')
@section('style')
    <style>
        .header.header-transparent {
            background-color: rgba(22, 28, 45, 0.9);
        }

    </style>
@endsection
@section('content')
    <div style="position: relative">
        <div class="jarallax bg-gradient pt-5 pb-6 pt-md-7">
            <img class="jarallax-img" src="{{ asset('storage/essential/contact_us_bgcover.jpg') }}">
            <span class="position-absolute top-0 start-0 w-100 h-100"
                style="background-image: linear-gradient(to right, #1b2a4e 0%, #1b2a4e 30%, #1b2a4e 100%); opacity:0.8"></span>

            <x-framework.wave />
            <div class="container position-relative pt-6">
                <div class="row justify-content-center pb-6">
                    <div class="col">
                        <h1 class="text-light">Contacts</h1>
                        <p class="text-light">Get in touch with by completing the below form or call us now</p>
                    </div>
                </div>
            </div>

        </div>
        <section class="container position-relative pb-5">
            <div class="row">
                <div class="col-lg-6  pb-2 mb-5" style="margin-top: -160px;">
                    <form action="{{ route('contactus.create') }}" method="POST" id="quotation-form">
                        @csrf
                        @method('POST')
                        <div class="card shadow-lg" data-aos="fade-up" data-aos-duration="2000">
                            <div class="card-header">
                                <h4 class="lh-base">Have a project? Let's make something great together!</h4>
                                <small>Get in touch with us to see how we can help you with your project</small>
                            </div>

                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="name" class="form-label small">YOUR NAME *</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="John ..">
                                    @error('name')
                                        <span class="invalid-feedback  d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="form-label small">YOUR EMAIL*</label>
                                    <input type="email" class="form-control " id="email" name="email"
                                        placeholder="name@company.com">
                                    @error('email')
                                        <span class="invalid-feedback  d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="form-label small">YOUR PHONE</label>
                                    <input type="tel" class="form-control" id="phone" name="phone"
                                        placeholder="+65-XXXX-YYYY">

                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label small">YOUR MESSAGE FOR US</label>
                                <textarea type="text" class="form-control" id="message" name="message" rows="3"></textarea>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <input type="submit" class="btn btn-primary rounded-0 w-100" value="Submit">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6">
                @if ($info->data)
                    <div class="mt-lg-5 ps-lg-5 px-3">
                        <div class="mb-3">
                            <h3>Contact Info</h3>
                            <small>Get in touch with us to see how we can help you with your query</small>
                        </div>
                        <ul class="list-unstyled mb-3">

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
                                            class="text-decoration-none">{{ $info->data?->phone }}</a>
                                            <span class="d-block text-muted text-small">{{ $info->data?->getOfficeDays()}}</span>
                                            <span class="d-block text-muted text-small">{{ $info->data?->getOfficeHours()}}</span>

                                    </div>
                                </li>
                            @endif

                            @if ($info->data->email)
                                <li class="d-flex justify-content-start gap-3">
                                    <i class="bi bi-envelope-fill"></i>
                                    <div class="ms-2">
                                        <a class="text-decoration-none"
                                            href="mailto:{{ $info->data?->email }}">{{ $info->data?->email }}</a>
                                    </div>
                                </li>
                            @endif

                        </ul>
                        <hr>
                        @if ($info->data->linkin || $info->data->facebook || $info->data->instagram)
                            <h6 class="mb-3">Follow us on</h6>
                            <ul class="list-unstyled d-flex gap-4">
                                @if ($info->data->linkin)
                                    <li class="mb-3 d-flex justify-content-start gap-3">
                                        <i class="bi bi-linkedin"></i>
                                        <div class="ms-2">
                                            <a class="text-decoration-none"
                                                href="{{ $info->data->linkin }}">linkin</a>
                                        </div>
                                    </li>
                                @endif
                                @if ($info->data->facebook)
                                    <li class="mb-3 d-flex justify-content-start gap-3">
                                        <i class="bi bi-facebook"></i>
                                        <div class="ms-2">
                                            <a class="text-decoration-none"
                                                href="{{ $info->data->faceboook }}">facebook</a>
                                        </div>
                                    </li>
                                @endif
                                @if ($info->data->instagram)
                                    <li class="mb-3 d-flex justify-content-start gap-3">
                                        <i class="bi bi-instagram"></i>
                                        <div class="ms-2">
                                            <a class="text-decoration-none"
                                                href="{{ $info->data->instagram }}">instagram</a>
                                        </div>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    </section>

</div>
@endsection
@push('scripts')
<script type="text/javascript">
    const result = {!! json_encode(session('result'), JSON_HEX_TAG) !!}
    document.addEventListener("DOMContentLoaded", function(event) {
        if (result) {
            const successModal = Utility.showSuccessModal('You got it!',
                "We've received your message and will get back to you <br> within 24 hours."
            );
            successModal.show();
        }
    })
</script>
@endpush
