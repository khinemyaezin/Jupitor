@extends('layouts.admin')
@section('content')
    <div class="container py-3 py-md-0">
        <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
            <x-framework.forehead-result :title="'Quotation Request'" />
            <div class="my-sm-0 my-3 text-sm-end pt-1 d-flex justify-content-end w-100">
                <x-framework.back-button :href="route('admin.quotation.index')" />
            </div>
        </div>
    </div>

    <div class="container">
        <x-framework.alert :errors="$errors->all()" />
    </div>
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="callout bd-callout-info rounded-0 mb-3">
                    <span class="fs-6">General Info</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fw-bold"><span class="card-title">{{ $data->name }}</span></div>
                    <div class="card-body">

                        <div class="row border-bottom">
                            <label for="" class="col-sm-4 col-form-label bg-light py-3">Email</label>
                            <div class="col-sm-8 d-table ">
                                <div class="d-table-cell align-middle py-3">
                                    <a href="mailto:{{ $data->email }}">{{ $data->email }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <label for="" class="col-sm-4 col-form-label bg-light py-3">Phone</label>
                            <div class="col-sm-8 d-table ">
                                <div class="d-table-cell align-middle py-3">
                                    <a href="tel:{{ $data->phone }}">{{ $data->phone }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <label for="" class="col-sm-4 col-form-label bg-light py-3">Message</label>
                            <div class="col-sm-8 d-table ">
                                <div class="d-table-cell align-middle py-3">
                                    {{ $data->message ? $data->message : '-' }}
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <label for="" class="col-sm-4 col-form-label bg-light py-3">Status</label>
                            <div class="col-sm-8 d-table ">
                                <div class="d-table-cell align-middle py-3">
                                    <div class="material-radios  d-flex gap-3 justify-content-start">
                                        <label for="biz_status_confirm_{{ $data->id }}" class="material-icons"
                                            style="width:35px; height:35px">
                                            <input type="radio" name="biz_status_{{ $data->id }}"
                                                id="biz_status_confirm_{{ $data->id }}" value="2"
                                                onchange="statusChange(this,{{ $data->id }})"
                                                @if ($data->biz_status == 2) checked @endif />
                                            <span class="rounded-circle d-block d-table w-100 text-center">
                                                <i class="bi bi-check2 fs-6 d-table-cell"></i>
                                            </span>
                                        </label>
                                        <label for="biz_status_pending_{{ $data->id }}" class="material-icons"
                                            style="width:35px; height:35px">
                                            <input type="radio" name="biz_status_{{ $data->id }}"
                                                id="biz_status_pending_{{ $data->id }}" value="6"
                                                onchange="statusChange(this,{{ $data->id }})"
                                                @if ($data->biz_status == 6) checked @endif />
                                            <span class="rounded-circle d-block d-table w-100 text-center">
                                                <i class="bi bi-pause fs-6 d-table-cell"></i>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <small class="d-block">
                            Submitted at <time>{{ date('m-d-Y', strtotime($data->created_at)) }}</time>
                        </small>
                        <small class="d-block text-end">
                            <time>{{ $data->updated_at->diffForHumans() }}</time>
                        </small>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        function statusChange(event, id) {
            Net.put(`/api/quotation/${id}/status`, {
                biz_status: parseInt($(event).val())
            }).then(e => {
                console.log(e);
            })
        }
    </script>
@endpush
