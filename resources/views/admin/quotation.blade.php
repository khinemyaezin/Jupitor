@extends('layouts.admin')
@section('content')

    <div class="container py-3 py-md-0">
        <div
            class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center ">
            <x-framework.forehead-result :title="'Quotation Requests'" />
            <div class="my-sm-0 my-3 text-sm-end pt-1 d-flex justify-content-end w-100">

            </div>
        </div>
    </div>
    <div class="container ">
        <x-framework.alert :errors="$errors->all()" />
    </div>
    @if ($result->list)
        <div class="container">
            <div class="card">
                <div class="card-header"><span class="card-title">Request list</span></div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-default">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">#</th>
                                    <th scope="col" class="sortable-col">@sortablelink('name', 'Name')</th>
                                    <th scope="col" class="sortable-col">@sortablelink('email', 'Email')</th>
                                    <th scope="col" class="sortable-col">@sortablelink('phone', 'Phone')</th>
                                    <th scope="col" class="text-nowrap sortable-col">
                                        @sortablelink('created_at', 'Created at')
                                    </th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- filter -->
                                <tr class="table-light">
                                    <td>
                                        <button type="button" class="btn" onclick="myClear()">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="fname" id="search_name"
                                            placeholder="search name">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="femail" id="search_email"
                                            placeholder="search email">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" name="fphone" id="search_phone"
                                            placeholder="search phone">
                                    </td>
                                    <td>
                                        <input type="date" class="form-control" name="fcreated_at" id="search_created_at">
                                    </td>
                                    <td>
                                        <div class="material-radios  d-flex gap-3 justify-content-end" style="width:130px">
                                            <label for="biz_status_all" class="material-icons">
                                                <input type="radio" name="fbiz_status"
                                                    @if (!request('fbiz_status') || request('fbiz_status') == '-1') checked @endif id="biz_status_all"
                                                    value="-1" />
                                                <span>
                                                    <i class="bi bi-filter"></i>

                                                </span>
                                            </label>
                                            <label for="biz_status_confirm" class="material-icons">
                                                <input type="radio" name="fbiz_status"
                                                    @if (request('fbiz_status') == '2') checked @endif id="biz_status_confirm"
                                                    value="2" />
                                                <span>
                                                    <i class="bi bi-check2"></i>
                                                </span>
                                            </label>
                                            <label for="biz_status_pending" class="material-icons">
                                                <input type="radio" name="fbiz_status"
                                                    @if (request('fbiz_status') == '6') checked @endif id="biz_status_pending"
                                                    value="6" />
                                                <span>
                                                    <i class="bi bi-pause"></i>

                                                </span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                <!-- end filter -->
                                @if ($result->list->count() == 0)
                                    <tr>
                                        <td colspan="8"><span class="ms-2">No record</span></td>
                                    </tr>
                                @endif
                                <!-- data body -->
                                @foreach ($result->list as $item)
                                    <tr>
                                        <td class="text-center">
                                            <span data-id="{{ $item->id }}"
                                                class="index">{{ $loop->index + $result->list->firstItem() }}</span>
                                        </td>
                                        <td class="col-fname text-nowrap">{{ $item->name }}</td>
                                        <td class="col-femail text-nowrap">{{ $item->email }}</td>
                                        <td class="col-fphone text-nowrap">
                                            <a href="tel:+{{ $item->phone }}"
                                                class="phone text-decoration-none">{{ $item->phone }}</a>
                                        </td>
                                        <td class="text-nowrap">{{ date('m-d-Y', strtotime($item->created_at)) }}</td>

                                        <td>
                                            <div class="material-radios  d-flex gap-3 justify-content-end">
                                                <label for="biz_status_confirm_{{ $item->id }}" class="material-icons">
                                                    <input type="radio" name="biz_status_{{ $item->id }}"
                                                        id="biz_status_confirm_{{ $item->id }}" value="2"
                                                        onchange="statusChange(this,{{ $item->id }})"
                                                        @if ($item->biz_status == 2) checked @endif />
                                                    <span>
                                                        <i class="bi bi-check2"></i>
                                                    </span>
                                                </label>
                                                <label for="biz_status_pending_{{ $item->id }}" class="material-icons">
                                                    <input type="radio" name="biz_status_{{ $item->id }}"
                                                        id="biz_status_pending_{{ $item->id }}" value="6"
                                                        onchange="statusChange(this,{{ $item->id }})"
                                                        @if ($item->biz_status == 6) checked @endif />
                                                    <span>
                                                        <i class="bi bi-pause"></i>

                                                    </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="btn-group mb-2" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-light"
                                                    onclick="event.preventDefault();document.getElementById('deleteform-{!! $item->id !!}').submit()">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                                <a type="button" class="btn btn-light" data-id="{{ $item->id }}"
                                                    href="{{ route('admin.quotation.getById', ['id' => $item->id]) }}">
                                                    <i class="bi bi-folder2-open"></i>

                                                </a>
                                            </div>
                                            <form action="{{ route('admin.quotation.delete', ['id' => $item->id]) }}"
                                                id="deleteform-{{ $item->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- end data body -->
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="card-footer">
                    <div class="d-flex justify-content-end py-3 align-items-center gap-3">
                        <p>Displaying {{ $result->list->count() }} of {{ $result->list->total() }}.</p>
                        {!! $result->list->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>





        </div>
    @endif
@endsection
@push('scripts')
    <script type="text/javascript">
        let searchParams = new URLSearchParams(window.location.search);
        let sname, semail, sphone, screateAt, sbizStatus;
        document.addEventListener("DOMContentLoaded", function(event) {
            try {
                sname = rxjs.fromEvent(document.getElementById("search_name"), "input");
                semail = rxjs.fromEvent(document.getElementById("search_email"), "input");
                sphone = rxjs.fromEvent(document.getElementById("search_phone"), "input");
                screateAt = rxjs.fromEvent(document.getElementById("search_created_at"), "input");
                sbizStatus = rxjs.fromEvent(document.getElementsByName('fbiz_status'), "input");
                sname.pipe(rxjs.pluck('target', 'value'),
                    rxjs.debounceTime(500),
                    rxjs.distinctUntilChanged()).subscribe(e => {
                    myfilter('fname');

                });
                semail.pipe(rxjs.pluck('target', 'value'),
                    rxjs.debounceTime(700),
                    rxjs.distinctUntilChanged()).subscribe(e => {
                    myfilter('femail');
                })
                screateAt.pipe(rxjs.pluck('target', 'value'),
                    rxjs.debounceTime(700),
                    rxjs.distinctUntilChanged()).subscribe(e => {
                    myfilter('fcreated_at');
                })
                sbizStatus.pipe(rxjs.pluck('target', 'value'),
                    rxjs.debounceTime(700),
                    rxjs.distinctUntilChanged()).subscribe(e => {
                    myfilter('fbiz_status');
                });
                sphone.pipe(rxjs.pluck('target', 'value'),
                    rxjs.debounceTime(700),
                    rxjs.distinctUntilChanged()).subscribe(e => {
                    myfilter('fphone');
                })


                searchParams.forEach(function(value, key) {
                    $(`input[name=${key}][type=text]`).val(value);
                    $(`input[name=${key}][type=date]`).val(value);
                    $(`.col-${key}`).each(function() {
                        const regex = new RegExp(value, "i");
                        const index = $(this).text().search(regex);
                        const orgText = $(this).text().substring(index, index + value.length);
                        console.log(orgText);
                        $(this).html(
                            $(this).text().replace(regex, '<strong class="highlight">' +
                                orgText +
                                '</strong>')
                        );
                    });
                    if (key == 'focus') {
                        $(`input[name=${value}]`).focus();
                    }
                });
            } catch (e) {
                console.log(e);
            }
        });

        function statusChange(event, id) {
            Net.put(`/api/quotation/${id}/status`, {
                biz_status: parseInt($(event).val())
            }).then(e => {
                console.log(e);
            })
        }

        function myfilter(focus) {
            searchParams.set('focus', focus);
            const param = {
                fname: $('input[name=fname]').val().trim(),
                femail: $('input[name=femail]').val().trim(),
                fphone: $('input[name=fphone]').val().trim(),
                fcreated_at: $('input[name=fcreated_at]').val().trim(),
                fbiz_status: $('input[name=fbiz_status]:checked').val()

            }
            let count = 0;
            for (const [key, value] of Object.entries(param)) {
                if (value && value !== "") {
                    searchParams.set(key, value);
                    count++;
                } else {
                    searchParams.delete(key);
                }
            }
            if (count > 0) {
                searchParams.delete('page');
            }
            console.log(param);
            window.location.search = searchParams.toString()
        }

        function myClear() {
            window.location.href = window.location.pathname;
        }
    </script>
@endpush
