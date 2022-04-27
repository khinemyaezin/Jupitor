@extends('layouts.app')
@section('style')
    <style>
        .header.header-transparent {
            background-color: rgba(22, 28, 45, 0.9);
        }

        .offcanvas {
            will-change: transform, box-shadow;
            transition: transform .4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow .3s ease;
            box-shadow: none;
            visibility: visible !important;
        }

        @media (min-width: 992px) {
            .offcanvas-collapse {
                display: block;
                position: static;
                top: auto !important;
                right: auto !important;
                bottom: auto !important;
                left: auto !important;
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                transform: none !important;
                background-color: transparent;
            }
        }

        .widget ul,
        .widget ol {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .widget-services .widget-link {
            padding-left: 1.25rem;
        }

        .widget-link {
            display: block;
            position: relative;
            padding: 0.25rem 0;
            transition: color .25s ease-in-out;
            color: #5a5b75;
            font-weight: 500;
            text-decoration: none;
        }

        .widget-services .widget-link::before {
            position: absolute;
            top: 0.0625rem;
            left: -0.1875rem;
            transition: transform .25s ease-in-out, opacity .15s ease-in-out;
            font-family: "around-icons";
            font-size: 1.25em;
            opacity: .5;
            content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
            transform-origin: 0.5em 50%;
        }
       
    </style>
@endsection
@section('content')
    <section class="sidebar-enabled">
        <div style="position: relative">
            <div class="jarallax bg-gradient pt-5 pb-6 pt-md-7">
                <img class="jarallax-img" src="{{ asset('storage/essential/contact_us_bgcover.jpg') }}">
                <span class="position-absolute top-0 start-0 w-100 h-100"
                    style="background-image: linear-gradient(to right, #1b2a4e 0%, #1b2a4e 30%, #1b2a4e 100%); opacity:0.8"></span>
                    <x-framework.wave />
                <div class="container position-relative pt-6">
                    <div class="row">
                        <div class="col-lg-9 ">
                            <div class="" >
                                <nav aria-label="breadcrumb">
                                    <ol class="py-1 my-2 breadcrumb text-white">
                                        <li class="breadcrumb-item text-uppercase">
                                            <a href="/" class="text-decoration-none text-white">Home</a>
                                        </li>
                                        <li class="breadcrumb-item "><a
                                                href="{{ route('page.groupInfo', ['typeid' => request('typeid')]) }}"
                                                class=" text-decoration-none text-uppercase text-white">{{ $group->title }}</a></li>
                                        <li class="breadcrumb-item active text-uppercase text-white" aria-current="page">{{ $article->title }}</li>
                                    </ol>
                                </nav>
                                <h1 class="text-white">{{ $article?->detail_title }}</h1>
                            </div>
                        </div>
                        <div class="col-lg-3">
        
                        </div>
                    </div>
                </div>
    
            </div>
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-9 mb-2 mb-sm-0 pb-sm-5 h-100">
                    <div class="md-image">
                        <img class="rounded" src="{{ asset('storage/' . $article->detail_image_url) }}" alt="">
                    </div>
                    
                    <div class="py-3 d-block article-detail bg-white">
                    </div>
                </div>
                <div class="col-lg-3 pt-lg-2 sidebar ">
                    <div class="position-sticky" style="top: 100px;">
                        <div class="offcanvas offcanvas-end offcanvas-collapse border-0" id="blog-sidebar">
                            <div class="offcanvas-body px-4 pt-3 pt-lg-0 pe-lg-0 ps-lg-2 ps-xl-4" data-simplebar="init">
                                <div class="widget widget-services mb-5">
                                    <h5 class="widget-title">{{ $group->title }}</h5>
                                    <ul>
                                        @foreach ($group->articles as $a)
                                            <li>
                                                <a class="widget-link @if (request('articleid') == $a->id) text-primary @endif "
                                                    href="{{ route('page.articleInfo', ['typeid' => $type->code, 'groupid' => $group->id, 'articleid' => $a->id]) }}">{{ $a->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         
        </div>
    </section>
 
@endsection
@push('scripts')
    <script type="text/javascript">
        let group = {!! json_encode($group, JSON_HEX_TAG) !!};
        let article = {!! json_encode($article, JSON_HEX_TAG) !!};
        document.addEventListener("DOMContentLoaded", function(event) {
            $('.article-detail').html(ThemeBuilder.convert(JSON.parse(article.detail)));

        });
    </script>
@endpush
