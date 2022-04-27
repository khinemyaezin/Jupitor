@extends('layouts.admin')

@section('style')
    <style>
        .rotate-180 {
            transform: rotate(180deg) !important;
        }

        .right-n8 {
            right: -7.5rem !important;
        }

        .fill-secondary {
            fill: #eaecf3 !important;
        }

        svg {
            vertical-align: middle;
            overflow: hidden;
        }

    </style>
@endsection
@section('content')
    <div class="container py-5">
        <div>
            <?php
            $svgs = ['currency-dollar', 'emoji-smile'];
            ?>
            <div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
                <span class="text-cap">What we do</span>
                <h2>Since 2007, we have helped 25 companies launch over 1k incredible products</h2>
            </div>
            <div class="row justify-content-lg-center">
                @foreach ($svgs as $item)
                    <div class="col-md-6 col-lg-5 mb-3 mb-md-5 mb-lg-7">
                        <div class="d-flex pe-md-5">
                            <div class="flex-shrink-0">
                                <div class="svg-icon text-primary">
                                    <svg class="bi" width='24' height="24" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <use xlink:href="{{ asset('storage/svg/bootstrap-icons.svg') . '#' . $item }}" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-grow-1 ms-3">
                                <h4>Creative minds</h4>
                                <p>We choose our teams carefully. Our people are the secret to great work.</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
    <div style="position: relative">
        <div class="jarallax pt-md-7">
            <img class="jarallax-img" src="{{ asset('storage/essential/contact_us_bgcover.jpg') }}">
            <span class="position-absolute top-0 start-0 w-100 h-100"
                style="background-image: linear-gradient(to right, #1b2a4e 0%, #1b2a4e 30%, #1b2a4e 100%); opacity:0.8"></span>
            <div class="container position-relative py-5">
                <div class="article bg-transparent col-12 shadow-none">
                    <div class="row g-0">
                        <div class="col-sm-12 col-md-6 text-center" data-aos="fade-right">
                            <div class="row mt-4 mt-md-0">
                                <div class="col-7 ps-4 pe-2 mb-3">
                                    <img class="rounded article-image " data-aos="fade-right" data-aos-delay="200"
                                        data-aos-duration="1000" data-aos-easing="ease-in-out"
                                        src="https://wizixo.webestica.com/assets/images/service/02.jpg" alt="">
                                </div>
                                <div class="col-5 align-self-end ps-2 mb-3">
                                    <img class="rounded article-image" data-aos="fade-down" data-aos-delay="200"
                                        data-aos-duration="1000"
                                        src="https://wizixo.webestica.com/assets/images/service/01.jpg" alt="">
                                </div>
                                <div class="col-5 offset-1 px-2 mb-3">
                                    <img class="rounded article-image" data-aos="fade-up" data-aos-delay="300"
                                        data-aos-duration="1500"
                                        src="https://wizixo.webestica.com/assets/images/service/03.jpg" alt="">
                                </div>
                                <div class="col-5 px-2 mb-3">
                                    <img class="rounded article-image" data-aos="fade-left" data-aos-delay="300"
                                        data-aos-duration="1500"
                                        src="https://wizixo.webestica.com/assets/images/service/02.jpg" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm col-md-6 align-self-center aos-init aos-animate" data-aos="fade-left">
                            <div class="theme-content card-body px-sm-0 px-md-3 px-lg-5 text-white lift lift-lg">
                                <h1><strong>About Us</strong></h1>
                                <p><br>We are a local team of dedicated full-time Cable Detection Specialists. Training
                                    and&nbsp;regulatory standards are kept up-to-date with all our associates. Each
                                    specialist is equipped with the knowledge&nbsp;and skill in performing underground cable
                                    detection through set procedures and cable locating techniques with&nbsp;our in-house
                                    training and apprenticeship.<br></p>
                            </div>
                            <div class="px-sm-0 px-md-3 px-lg-5 d-flex"> </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container">
        <!-- Heading -->
        <div class="w-lg-75 text-center mx-lg-auto mb-5">
            <h3>Space features</h3>
            <p class="fs-6">Read how we've helped some great companies brand, design and get to market.</p>
        </div>
        <!-- End Heading -->

        <div class="row mb-5 mb-sm-5">
            <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                <div class="card h-100">
                    <img class="card-img" alt="Image Description">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text"></p>
                        <a class="card-link"> <i class="bi-chevron-right small ms-1"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                <!-- Card -->
                <div class="card h-100 p-2 shadow-sm">
                    <img class="card-img" src="https://htmlstream.com/space/assets/img/600x400/img2.jpg"
                        alt="Image Description">
                    <div class="card-body">
                        <h5 class="card-title">Grow</h5>
                        <p class="card-text">Now that we've aligned the details, it's time to get things mapped out and
                            organized.</p>
                        <a class="card-link" href="blog-article.html">Learn about Grow <i
                                class="bi-chevron-right small ms-1"></i></a>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Col -->

            <div class="col-sm-6 col-lg-4 mb-3 mb-lg-5">
                <!-- Card -->
                <div class="card h-100 p-2 shadow-sm">
                    <img class="card-img" src="https://htmlstream.com/space/assets/img/600x400/img2.jpg"
                        alt="Image Description">
                    <div class="card-body">
                        <h5 class="card-title">Retain</h5>
                        <p class="card-text">We strive to embrace and drive change in our industry which allows us to
                            keep our clients relevant.</p>
                        <a class="card-link" href="blog-article.html">Learn about Retain <i
                                class="bi-chevron-right small ms-1"></i></a>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->

        <!-- Info -->
        <div class="text-center">
            <p class="mb-0">Want to read more?</p>
            <a class="link" href="blog-classic.html">Explore Space news <i
                    class="bi-chevron-right small ms-1"></i></a>
        </div>
        <!-- End Info -->
    </div>
    <section class="headline position-relative">
        <div class="container">
            <div class="row justify-content-center mb-5 aos-init aos-animate" data-aos="fade-up">
                <div class="col-md-8 text-start">
                    <div class="text-muted pb-2 group-content"><strong style="color:#0066cc">STAY AND EAT LIKE A
                            LOCAL</strong>
                        <h2><strong>Our guides</strong></h2>
                    </div>
                </div>
                <div class="d-md-flex align-items-center justify-content-end col-md-4"> </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-5 justify-content-center group-contents">
                <div class="col">
                    <div class="card article rounded mt-6 h-100 pe-md-2 pe-lg-5 aos-init aos-animate" data-aos="zoom-in">
                        <div class="d-block position-relative txt-adj-h-container"><a
                                class="article-title h5 text-decoration-none d-block w-100 pb-2 fw-bold position-absolute"
                                role="button" href="/goto/service/2/3">CABLE DETECTION, SERVICES DETECTION</a> <a
                                class="article-title h5 text-decoration-none d-block w-100 pb-2 fw-bold position-relative invisible"
                                role="button">GROUND PENETRATING RADAR (GPR) SCANNING</a></div>
                        <div class="card-img-top rounded-top-start article-image lift lift-lg"> <img class="lift lift-lg"
                                src="http://127.0.0.1:8000/storage/images/a5RlfMgMzy1I2zCG6prwwdKpTtLXPyx9kuQB8r0l.jpg">
                        </div>
                        <div class="card-body px-0 py-3">
                            <div class="fs-sm theme-content">UCD provides underground cable detection services in Singapore,
                                including cables, pipes detection. Sewer and optical fibre cables tracing.</div><a
                                class="btn btn-light btn-point btn-detail mt-2" href="/goto/service/2/3"> <span>View
                                    More</span> </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card article rounded mt-6 h-100 pe-md-2 pe-lg-5 aos-init aos-animate" data-aos="zoom-in">
                        <div class="d-block position-relative txt-adj-h-container"><a
                                class="article-title h5 text-decoration-none d-block w-100 pb-2 fw-bold position-absolute"
                                role="button" href="/goto/service/2/4">TRIAL TRENCHING</a> <a
                                class="article-title h5 text-decoration-none d-block w-100 pb-2 fw-bold position-relative invisible"
                                role="button">GROUND PENETRATING RADAR (GPR) SCANNING</a></div>
                        <div class="card-img-top rounded-top-start article-image lift lift-lg"> <img class="lift lift-lg"
                                src="http://127.0.0.1:8000/storage/images/5dPhBfQIg7oliLaopiUrH74s3hB3QnasOxANLTP6.webp">
                        </div>
                        <div class="card-body px-0 py-3">
                            <div class="fs-sm theme-content">UCD provides trial trenching, holes, excavation for underground
                                services compliant to Authority standards and regulations with safety as our priority.</div>
                            <a class="btn btn-light btn-point btn-detail mt-2" href="/goto/service/2/4"> <span>View
                                    More</span> </a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card article rounded mt-6 h-100 pe-md-2 pe-lg-5 aos-init aos-animate" data-aos="zoom-in">
                        <div class="d-block position-relative txt-adj-h-container"><a
                                class="article-title h5 text-decoration-none d-block w-100 pb-2 fw-bold position-absolute"
                                role="button" href="/goto/service/2/5">GROUND PENETRATING RADAR (GPR) SCANNING</a> <a
                                class="article-title h5 text-decoration-none d-block w-100 pb-2 fw-bold position-relative invisible"
                                role="button">GROUND PENETRATING RADAR (GPR) SCANNING</a></div>
                        <div class="card-img-top rounded-top-start article-image lift lift-lg"> <img class="lift lift-lg"
                                src="http://127.0.0.1:8000/storage/images/putYGEdtah2bawz3hKsnWUg8ZHIfYK6VblzZymZP.webp">
                        </div>
                        <div class="card-body px-0 py-3">
                            <div class="fs-sm theme-content">Ground Penetrating Radar (GPR) images the subsurface for
                                underground utilities, services, tree roots and cavity or hollow space.</div><a
                                class="btn btn-light btn-point btn-detail mt-2" href="/goto/service/2/5"> <span>View
                                    More</span> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="headline">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <!--left-->
                <div class="col-lg-6 col-md-12">
                    <div class="title text-start pb-0">
                        <span class="pre-title">Why client choose us?</span>
                        <h2>We Provide best of the <span class="text-primary"> best solutions!</span></h2>
                        <p>With years of experience Incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>

                    </div>

                    <div class="mt-3 btn-detail-container">
                        <a class="btn btn-light btn-point me-3 btn-detail" href="#"><span>Explore services!</span></a>
                        <a class="text-decoration-none" href="/contact">Request a quote</a>
                    </div>
                </div>
                <!--right-->
                <div class="col-lg-6 col-md-12">
                    <div class="row mt-4 mt-md-0">
                        <div class="col-7 ps-4 pe-2 mb-3">
                            <img class="rounded article-image" data-aos="fade-right" data-aos-delay="200"
                                data-aos-duration="1000" data-aos-easing="ease-in-out"
                                src="https://wizixo.webestica.com/assets/images/service/02.jpg" alt="">
                        </div>
                        <div class="col-5 align-self-end ps-2 mb-3">
                            <img class="rounded article-image" data-aos="fade-down" data-aos-delay="200"
                                data-aos-duration="1000" src="https://wizixo.webestica.com/assets/images/service/01.jpg"
                                alt="">
                        </div>
                        <div class="col-5 offset-1 px-2 mb-3">
                            <img class="rounded article-image" data-aos="fade-up" data-aos-delay="300"
                                data-aos-duration="1500" src="https://wizixo.webestica.com/assets/images/service/03.jpg"
                                alt="">
                        </div>
                        <div class="col-5 px-2 mb-3">
                            <img class="rounded article-image" data-aos="fade-left" data-aos-delay="300"
                                data-aos-duration="1500" src="https://wizixo.webestica.com/assets/images/service/02.jpg"
                                alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="headline">
        <div class="row">
            <div class="col-lg-6 col-md-12 bg-light px-4 py-5 p-lg-5">
                <div class="h-100">
                    <div class="text-center p-0 group-content"><em>Ok! So why our client trust us?</em>
                        <h2><strong>We Provide best of the best solutions for any of your business needs!</strong></h2><br>
                    </div>
                    <div class="row">
                        <div class="carousel slide carousel-avata" data-bs-ride="carousel">
                            <div class="carousel-inner group-contents">
                                <div class="carousel-item carousel-item-next carousel-item-start" aria-hidden="true"
                                    tabindex="-1">
                                    <div class="carousel-item-content d-flex flex-column gap-3">
                                        <div class="carousel-item-avatar"> <img class="rounded-circle" alt="avatar"
                                                src="http://127.0.0.1:8000/storage/images/S5aVKMbUgVGDoHYhog3OQm1fr4WrXul6EdLYBnNa.jpg">
                                        </div>
                                        <div class="theme-content">Thanks for the super quick support consectetur
                                            adipisicing elit. Numquam aliquid neque voluptates veniam laborum dolore porro
                                            totam iusto ipsam eligendi officia repellat ipsum commodi aspernatur quibusdam,
                                            doloremque nam ullam labore.<br><br><strong>Emma
                                                Watson</strong><br><strong>Human Resource</strong></div>
                                    </div>
                                </div>
                                <div class="carousel-item active carousel-item-start" aria-hidden="true" tabindex="-1">
                                    <div class="carousel-item-content d-flex flex-column gap-3">
                                        <div class="carousel-item-avatar"> <img class="rounded-circle" alt="avatar"
                                                src="http://127.0.0.1:8000/storage/images/n1JNDW7glsfKpBEK7DwkSNjPooEi5Cii3oNfeUjI.jpg">
                                        </div>
                                        <div class="theme-content">Thanks for the super quick support consectetur
                                            adipisicing elit. Numquam aliquid neque voluptates veniam laborum dolore porro
                                            totam iusto ipsam eligendi officia repellat ipsum commodi aspernatur quibusdam,
                                            doloremque nam ullam labore.<br><br><strong>Daniel Matthew</strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block bg-light p-0">
                <div class="md-image">
                    <img class="group-image" alt=""
                        src="http://127.0.0.1:8000/storage/images/y1ojhuXUMCaasuff5KPmHLfD92tpgYKxBtlkt6Up.jpg">
                </div>
            </div>

        </div>
    </section>
    <section class="headline">
        <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-light p-0">
                <div class="md-image"> <img class="group-image" alt=""
                        src="http://127.0.0.1:8000/storage/images/oHOq0dJ6Un1NFxasi2mG44r8kihNeIIXJ5yVhRj4.jpg"> </div>
            </div>
            <div class="col-lg-6 col-md-12 bg-dark px-4 py-5 p-lg-5 text-white">
                <div class="h-100">
                    <div class="text-start p-0 group-content">
                        <h2>Get it done with a Wizixo</h2>Partnering with 500+ Fortune companies and mid-sized firms across
                        enterprises, uniquely customized and&nbsp;scalable workforce solutions.<br>There is nothing that can
                        stop you from achieving what you want, except yourself. If you devote yourself to it you will
                        achieve your goal.<br>
                    </div>
                    <div class="row row-cols-sm-1 row-cols-md-2 mt-3 g-3 group-contents">
                        <div class="col-auto d-flex">
                            <i class="fa fa-check pe-3"></i>
                            <span class="article-title">Maintained Windows Servers</span>
                        </div>
                        <div class="col-auto"> <i class="fa fa-check pe-3"></i> <span
                                class="article-title">Configured backups</span> </div>
                        <div class="col-auto"> <i class="fa fa-check pe-3"></i> <span
                                class="article-title">Supported Windows workstations</span> </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="headline">
        <div class="container">
            <div class="row justify-content-center mb-5 aos-init aos-animate" data-aos="fade-up">
                <div class="col-md-8 text-start">
                    <div class="text-muted pb-2 group-content">
                        <strong style="color:#0066cc">STAY AND EAT LIKE A
                            LOCAL</strong>
                        <h2><strong>Our guides</strong></h2>
                    </div>
                </div>
                <div class="d-md-flex align-items-center justify-content-end col-md-4"> </div>
            </div>
            <div class="carousel-flickity"
                data-flickity='{ "imagesLoaded": true, "percentPosition": false,"autoPlay": true,"wrapAround": true }'>
                <img class="carousel-flickity-item" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg"
                    alt="orange tree" />
                <img class="carousel-flickity-item" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/submerged.jpg"
                    alt="submerged" />
                <img class="carousel-flickity-item" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg"
                    alt="look-out" />
                <img class="carousel-flickity-item"
                    src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" alt="One World Trade" />
                <img class="carousel-flickity-item" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg"
                    alt="drizzle" />
                <img class="carousel-flickity-item" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/cat-nose.jpg"
                    alt="cat nose" />
            </div>
        </div>
    </section>
    <section class="headline">
        <div class="container">
            <div class="bg-dark rounded py-3 text-white">
                <div class="row ">
                    <div class="col-md-12">

                        <h2 class="alt-font p-2 p-sm-5 text-center">"Partnering with 500+ Fortune companies and mid-sized
                            firms across enterprises, experience the best in class, uniquely customized and scalable
                            workforce solutions"</h2>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="headline">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="feature-box h-100 icon-grad">
                        <div class="feature-box-icon">
                            <img src="https://www.onlinepipe.com.au/wp-content/uploads/2018/10/2018-10-19-Online-Pipe-Homepage_34.png"
                                alt="">
                        </div>
                        <h4 class="article-title"></h4>
                        <div class="theme-content">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center mb-md-0 mb-5">
                    <h2>Our team, AKA superheros work for your success </h2>
                    <p>We have built a robust team, which is capable of delivering best quality of services when it comes to
                        website-design, Website development, mobile application, content and digital marketing</p>
                    <h6 class="mb-3">We are hiring! Join our team Creative Agency Specializing in: Video
                        Production, Web Design, Branding, Brand Strategy.</h6>
                    <a class="btn btn-grad" href="careers.html">Apply now!</a>
                </div>
                <div class="col-md-6 align-self-center">
                    <div class="carousel-team"
                        data-flickity='{ "groupCells": true,"autoPlay": true,"wrapAround": true,"prevNextButtons": false,"pageDots": false}'>
                        <div class="carousel-team-cell">
                            <div class="team-item mb-0 text-center">
                                <div class="team-avatar">
                                    <img src="https://wizixo.webestica.com/assets/images/team/03.jpg" />
                                </div>
                                <div class="team-desc">
                                    <h5>Peter Smith</h5>
                                    <span>Web Developer</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="headline bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center mb-5">
                    <h2 class="h1 fw-bold">Our Cable Detection Process</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="shadow-hover h-100 bg-white px-5 pt-2  pb-5 text-center up-on-hover">
                        <span class="text-gray display-2 opacity-25 fst-italic">1</span>
                        <span class="d-block mb-4">
                            <i class="bi bi-chat-right-quote mb-3 display-2 text-grad"></i>

                        </span>
                        <a class="h5 text-decoration-none text-dark" href="#">Consultation & Quotation
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="shadow-hover h-100 bg-white px-5 pt-2  pb-5 text-center up-on-hover">
                        <span class="text-gray display-2 opacity-25 fst-italic">2</span>
                        <span class="d-block mb-4">
                            <i class="bi bi-clipboard-check mb-3 display-2 text-grad"></i>

                        </span>
                        <a class="h5 text-decoration-none text-dark" href="#">Job Confirmation
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="shadow-hover h-100 bg-white px-5 pt-2  pb-5 text-center up-on-hover">
                        <span class="text-gray display-2 opacity-25 fst-italic">3</span>
                        <span class="d-block mb-4">
                            <i class="bi bi-card-checklist mb-3 display-2 text-grad"></i>

                        </span>
                        <a class="h5 text-decoration-none text-dark" href="#">Plan Application

                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 mb-4">
                    <div class="shadow-hover h-100 bg-white px-5 pt-2  pb-5 text-center up-on-hover">
                        <span class="text-gray display-2 opacity-25 fst-italic">4</span>
                        <span class="d-block mb-4">
                            <i class="bi bi-gear mb-3 display-2 text-grad"></i>

                        </span>
                        <a class="h5 text-decoration-none text-dark" href="#">Cable Dection

                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="headline">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-8 mx-auto">
                    <h2 class="h1">Trusted by thousands</h2>
                    <p class="mb-5">Remarkably to continuing in surrounded diminution on. In unfeeling existence
                        objection immediate repulsive on he in. Imprudence comparison uncommonly me he difficulty diminution
                        resolution.</p>
                </div>
            </div>
            <div class="row text-center justify-content-center">
                <div class="col-4 col-md-2 mb-5"><img class="w-75" src="assets/images/clients/01.png" alt="">
                </div>

            </div>
        </div>
    </section>
    <div style="position: relative">
        <div class="jarallax pt-md-7">
            <img class="jarallax-img" src="{{ asset('storage/essential/contact_us_bgcover.jpg') }}">
            {{-- https://wizixo.webestica.com/assets/images/bg/pattern/01-dark.png --}}
            <span class="position-absolute top-0 start-0 w-100 h-100 bg-overlay"></span>
            <div class="container position-relative py-5">
                <div class="">
                    <div class="row justify-content-center group-container">
                        <div class="col-lg-6 col-md-8 col-sm-10 text-center">
                            <div class=" mb-5 pb-2 group-content text-white">
                                <h2>Our Values</h2>
                                <p>We take pride in upholding these values in every project we take on.</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-lg-5 g-sm-1 justify-content-center group-contents">
                        <div class="col-sm-6 col-md-4">
                            <div class="feature-box h-100 icon-grad text-white">
                                <div class="feature-box-icon"> <img
                                        src="http://127.0.0.1:8000/storage/images/u7t3gCuFQWtxOxWgSRiH1OILN5z6HsbaNa1ME6xf.png"
                                        alt="" style="height:100px;width:100px"> </div>
                                <h5 class="article-title">Integrity</h5>
                                <div class="theme-content">
                                    <p>We foster trust with our clients by working with values.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="feature-box h-100 icon-grad text-white">
                                <div class="feature-box-icon"> <img
                                        src="http://127.0.0.1:8000/storage/images/Ag7IdWhSWlqPyL3ER0dVT0YVye75D2IrLWVHuGzk.png"
                                        alt="" style="height:100px;width:100px"> </div>
                                <h5 class="article-title">Responsiveness</h5>
                                <div class="theme-content">
                                    <p>We strive to meet and exceed clients’ expectations and service delivery. We act with
                                        a sense of urgency in all our dealings.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="feature-box h-100 icon-grad text-white">
                                <div class="feature-box-icon"> <img
                                        src="http://127.0.0.1:8000/storage/images/DdCKxSdzpxejE1utJLr6u1furrShv8ld9OhZ6U2m.png"
                                        alt="" style="height:100px;width:100px"> </div>
                                <h5 class="article-title">Expertise</h5>
                                <div class="theme-content">
                                    <p>We provide technical expertise in line with Energy Market Authority(EMA) and Infocomm
                                        Media Development Authority(IMDA) regulatory standards and all relevant authorities.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="feature-box h-100 icon-grad text-white">
                                <div class="feature-box-icon"> <img
                                        src="http://127.0.0.1:8000/storage/images/XnqwbgkweAxsDnMH8czBkH3QED6IASqBM6fPw9Yo.png"
                                        alt="" style="height:100px;width:100px"> </div>
                                <h5 class="article-title">Flexibility</h5>
                                <div class="theme-content">
                                    <p>We keep an open-mind in understanding our clients’ needs. We adapt to the fast-paced
                                        and ever-changing demands of the construction industry in Singapore and embrace
                                        change and continuous learning.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <section class="bg-primary-3 has-divider o-hidden">
        <div class="container layer-2">
            <div class="row justify-content-center pt-lg-5">
                <div class="col-xl-5 col-lg-6 col-md-7 text-center text-lg-left mb-5 mb-lg-0">
                    <h1 class="display-3">Learn how to build better websites.</h1>
                    <div class="my-4">
                        <p class="lead">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
                            accusantium.</p>
                    </div>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <div class="d-flex mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                class="injected-svg icon bg-warning" data-src="assets/img/icons/interface/star.svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
                                    fill="#212529"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                class="injected-svg icon bg-warning" data-src="assets/img/icons/interface/star.svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
                                    fill="#212529"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                class="injected-svg icon bg-warning" data-src="assets/img/icons/interface/star.svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
                                    fill="#212529"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                class="injected-svg icon bg-warning" data-src="assets/img/icons/interface/star.svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
                                    fill="#212529"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                class="injected-svg icon bg-warning" data-src="assets/img/icons/interface/star.svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.3616 17.7407L8.27722 19.888C7.78838 20.145 7.18375 19.957 6.92675 19.4682C6.82441 19.2735 6.7891 19.0505 6.82627 18.8338L7.60632 14.2858L4.30199 11.0648C3.90651 10.6793 3.89841 10.0462 4.28391 9.65073C4.43742 9.49325 4.63856 9.39076 4.8562 9.35913L9.42268 8.69559L11.4649 4.55766C11.7093 4.0624 12.3089 3.85906 12.8042 4.10349C13.0014 4.20082 13.161 4.36044 13.2583 4.55766L15.3005 8.69559L19.867 9.35913C20.4136 9.43855 20.7922 9.94599 20.7128 10.4925C20.6812 10.7102 20.5787 10.9113 20.4212 11.0648L17.1169 14.2858L17.8969 18.8338C17.9903 19.3781 17.6247 19.8951 17.0804 19.9884C16.8636 20.0256 16.6406 19.9903 16.446 19.888L12.3616 17.7407Z"
                                    fill="#212529"></path>
                            </svg>
                        </div>
                        <span>(Average score: 4.9/5)</span>
                    </div>
                </div>
                <div class="col">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-md-10">
                            <form>
                                <div class="form-group">
                                    <label for="course-name-1">Your Name</label>
                                    <input name="course-name" id="course-name-1" type="text"
                                        class="form-control form-control-lg" placeholder="Type your name">
                                </div>
                                <div class="form-group">
                                    <label for="course-email-1">Email Address</label>
                                    <input name="course-email" id="course-email-1" type="email"
                                        class="form-control form-control-lg" placeholder="you@yoursite.com">
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-1">
                                            <label>Skill Level:</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group rounded bg-white p-2 border">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="course-radio-beginner-1" name="course-radio-1"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="course-radio-beginner-1">Beginner</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group rounded bg-white p-2 border">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="course-radio-advanced-1" name="course-radio-1"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="course-radio-advanced-1">Advanced</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn btn-lg btn-primary btn-block mb-2" type="submit">Claim your free
                                        first lesson</button>
                                    <small>You’ll recieve your first lesson via email in less than a minute.</small>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="decoration-wrapper d-none d-sm-block">
            <div data-jarallax-element="0 50"
                style="position: relative; z-index: 0; transform: translate3d(-35.6328px, 0px, 0px);">
                <div class="decoration top middle-y scale-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="183" height="166" viewBox="0 0 183 166" fill="none"
                        class="injected-svg bg-primary-2" data-src="assets/img/decorations/deco-blob-9.svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <path
                            d="M2.34805 65.6701C4.02805 62.9901 5.56905 60.211 7.41605 57.652C10.82 52.939 14.734 48.636 18.627 44.322C21.811 40.794 24.9 37.181 28.08 33.65C30.619 30.831 32.879 27.721 36.068 25.554C39.035 23.539 42.066 21.62 45.039 19.616C46.439 18.674 47.812 17.682 49.123 16.624C51.525 14.687 54.035 12.972 56.996 11.982C57.787 11.717 58.5371 11.285 59.2561 10.847C63.3111 8.36802 67.328 5.82603 71.408 3.38703C73.033 2.41503 74.7361 1.53704 76.4881 0.824045C78.4981 0.00604486 80.615 -0.0229468 82.701 0.670053C84.805 1.36905 86.912 2.05405 88.994 2.81205C90.217 3.25705 91.426 3.55605 92.701 3.15705C94.228 2.67905 95.5971 3.14904 96.9921 3.72804C99.4631 4.75604 101.484 6.48703 103.691 7.92603C104.574 8.50203 105.353 9.24603 106.257 9.77903C107.429 10.469 108.624 11.197 109.905 11.604C112.95 12.57 115.751 13.945 118.466 15.634C124.386 19.315 130.482 22.6901 137.122 24.9461C141.015 26.2681 144.968 27.425 148.802 28.897C153.036 30.522 157.224 32.289 161.009 34.866C162.577 35.934 164.195 36.928 165.802 37.937C171.439 41.473 175.253 46.641 178.368 52.335C180.1 55.5 180.626 59.127 181.403 62.633C182.262 66.502 182.116 70.416 181.868 74.311C181.587 78.733 181.095 83.142 180.665 87.554C180.462 89.618 179.534 91.337 178.192 92.927C175.192 96.484 172.45 100.218 170.514 104.504C169.549 106.642 168.932 108.863 168.332 111.109C167.514 114.168 166.631 117.2 165.352 120.117C163.209 124.994 160.215 129.302 156.885 133.411C156.498 133.89 156.188 134.472 155.996 135.057C155.039 137.993 153.416 140.578 151.975 143.28C149.35 148.2 145.637 152.224 142.088 156.405C141.611 156.967 141.123 157.548 140.539 157.985C136.902 160.704 133.254 163.385 128.863 164.86C126.806 165.552 124.752 165.891 122.634 165.534C120.347 165.149 117.966 164.899 115.843 164.048C113.527 163.117 111.435 161.605 109.294 160.267C107.773 159.316 106.386 158.149 104.851 157.226C101.417 155.162 97.923 153.198 94.464 151.177C93.37 150.539 92.3001 149.863 91.2301 149.187C90.7851 148.904 90.4021 148.509 89.9331 148.281C85.2771 146.008 81.023 143.033 76.49 140.568C71.861 138.051 67.103 135.705 61.888 134.538C61.374 134.423 60.837 134.338 60.361 134.126C54.332 131.453 47.812 130.439 41.547 128.568C37.799 127.449 34.072 126.33 30.547 124.58C26.953 122.795 23.2871 121.148 19.6391 119.475C16.4031 117.991 13.774 115.777 11.504 113.057C9.25404 110.358 7.32204 107.492 6.06804 104.188C4.82404 100.913 3.92305 97.569 3.70305 94.057C3.63705 93.004 3.53704 91.946 3.33804 90.912C2.34204 85.728 1.53504 80.525 0.926042 75.276C0.531042 71.872 1.00605 68.7731 2.34805 65.6701ZM57.891 130.289C57.84 130.228 57.791 130.168 57.741 130.107C57.682 130.158 57.5811 130.203 57.5751 130.257C57.5711 130.312 57.657 130.416 57.714 130.422C57.766 130.429 57.83 130.338 57.891 130.289ZM111.725 160.38C111.678 160.322 111.635 160.227 111.582 160.22C111.531 160.213 111.469 160.302 111.412 160.349C111.459 160.406 111.502 160.502 111.555 160.507C111.608 160.512 111.668 160.426 111.725 160.38ZM141.531 85.2951L141.57 85.501L141.736 85.369L141.531 85.2951Z"
                            fill="black"></path>
                    </svg>
                </div>
                <div id="jarallax-container-0"
                    style="position: absolute; top: 0px; left: 0px; width: 100%; height: 100%; overflow: hidden; z-index: -100;">
                    <div
                        style="pointer-events: none; transform-style: preserve-3d; backface-visibility: hidden; will-change: transform, opacity; position: fixed;">
                    </div>
                </div>
            </div>
        </div>
        <div class="divider">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="96px"
                viewBox="0 0 100 100" version="1.1" preserveAspectRatio="none" class="injected-svg bg-primary-alt"
                data-src="assets/img/dividers/divider-2.svg">
                <path d="M0,0 C16.6666667,66 33.3333333,99 50,99 C66.6666667,99 83.3333333,66 100,0 L100,100 L0,100 L0,0 Z">
                </path>
            </svg>
        </div>
    </section>
    <section class="headline">
        <ul class="step step-sm step-icon-lg step-centered mb-10">
            <li class="step-item">
                <div class="step-content-wrapper align-items-center">
                    <span class="step-icon step-icon-border">
                        <span class="svg-icon text-primary">
                            <img src="http://127.0.0.1:8000/storage/images/u7t3gCuFQWtxOxWgSRiH1OILN5z6HsbaNa1ME6xf.png"
                            alt="" style="height:50px;width:50px">
                        </span>
                    </span>
                    <div class="step-content">
                        <p class="step-title">Submit your documents</p>
                    </div>
                </div>
            </li>
        </ul>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {

        });
    </script>
@endpush
