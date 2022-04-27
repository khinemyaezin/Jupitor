@extends('layouts.admin')
@section('content')
    <div class="container py-3 py-md-0">
        <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
            <x-framework.forehead-result :title="'Setting'" />
            <div class="my-sm-0 my-3 text-sm-end pt-1">
            </div>
        </div>
    </div>
    <div class="container">
        <x-framework.alert :errors="$errors->all()" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="list-group bd-callout mb-3" id="list-tab">
                    <a class="text-decoration-none list-group-item-action p-3 bd-callout-item border-bottom active"
                        id="company-tab" data-bs-toggle="list" href="#tab-company" role="tab" aria-controls="tab-company">
                        Vital Info

                    </a>
                    <a class="text-decoration-none list-group-item-action p-3 bd-callout-item border-bottom" id="account-tab"
                        data-bs-toggle="list" href="#tab-account" role="tab" aria-controls="tab-account">
                        Account
                    </a>

                </div>
            </div>
            <div class="col-md-8">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-company" role="tabpanel" aria-labelledby="company-tab">
                        @if ($info->data)
                            <form action="{{ route('admin.info.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <x-company-info :info="$info"></x-company-info>
                            </form>
                        @else
                            <form action="{{ route('admin.info.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <x-company-info :info="$info"></x-company-info>
                            </form>
                        @endif
                    </div>
                    <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="account-tab">
                        <div class="row g-3">
                            <div class="col-12">
                                <x-admin.user :data="$account->data" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            if (window.location.hash) {
                let activeTab = new bootstrap.Tab(document.querySelector(window.location.hash));
                activeTab.show();
            }
        });
    </script>
@endpush
