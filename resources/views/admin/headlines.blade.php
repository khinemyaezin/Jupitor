@extends('layouts.admin')
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="container py-3 py-md-0">
        <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
            <x-framework.forehead-result :title="'Headline'" />
            <div class="d-flex justify-content-end my-sm-0 my-3 text-sm-end pt-1 w-100">
                <x-framework.new-button :href="route('admin.group.index')" />
            </div>
        </div>
    </div>
    <div class="container alert-container">
        <x-framework.alert :errors="$errors->all()" />
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <span class="card-title">List of headlines</span>
            </div>
            <div class="card-body">
                <div class="{{ $result->list->count() == 0 ? 'disabled' : '' }}">
                    <button type="button" class="btn btn-secondary btn-sm" id="save-sorting">
                        Save Order <i class="bi bi-arrows-move"></i>
                    </button>

                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-default align-middle caption-top">
                    <thead>
                        <tr>
                            <th scope="col" class="sorting text-nowrap"></th>
                            <th scope="col">#</th>
                            <th scope="col" class=" text-nowrap" style="width: 30%">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col" class="text-nowrap">Created at</th>
                            <th scope="col" class="text-nowrap">Last updated at</th>
                            <th scope="col" class="text-nowrap">On home</th>
                            <th scope="col" class="text-nowrap">Status</th>
                            <th scope="col" class="text-nowrap"></th>
                        </tr>
                    </thead>
                    <tbody class="tbl-headlines">
                        @if ($result->list->count() == 0)
                            <tr>
                                <td colspan="8"><span class="ms-2">No record</span></td>
                            </tr>
                        @endif

                        @foreach ($result->list as $item)
                            <tr class="article-header">
                                <th scope="row" class="sorting" role="button" style="width:10px">
                                    <button class="btn">
                                        <i class="bi bi-arrows-move"></i>
                                    </button>
                                </th>
                                <td>
                                    <span data-id="{{ $item->id }}"
                                        class="index">{{ $loop->index + 1 }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.group.getById', ['groupid' => $item->id]) }}"
                                        class="text-wrap text-decoration-none">{{ $item->title }}</a>
                                </td>
                                <td class="text-nowrap">{{ $item->type?->title }}</td>
                                <td class="text-nowrap">
                                    {{ $item->created_at->diffForHumans() }}
                                </td>
                                <td class="text-nowrap">
                                    {{ $item->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" name="on_home"
                                            data-id="{{ $item->id }}" id="{{ 'onhome-' . $item->id }}"
                                            @if ($item->on_home) {{ 'checked' }} @endif)>
                                        <label class="form-check-label" for="{{ 'onhome-' . $item->id }}">

                                        </label>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" name="status"
                                            data-id="{{ $item->id }}" id="{{ 'status-' . $item->id }}"
                                            @if ($item->isActive()) {{ 'checked' }} @endif)>
                                        <label class="form-check-label" for="{{ 'status-' . $item->id }}">
                                            {{ $item->status() }}
                                        </label>

                                    </div>
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="First group">
                                        <button type="button" class="btn btn-light "
                                            onclick="deleteGroup({{ $item->id }},this)">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                        <a type="button" class="btn btn-light" data-id="{{ $item->id }}"
                                            href="{{ route('admin.group.getById', ['groupid' => $item->id]) }}">
                                            <i class="bi bi-folder2-open"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        let viewResult = {!! json_encode($result, JSON_UNESCAPED_SLASHES) !!};
        document.addEventListener("DOMContentLoaded", function(event) {

            $('input[name=status]').change(function(event) {
                $(`label[for='${this.id}']`).text(this.checked ? 'active' : 'draf');
                submitStatusChange('biz_status', 'num', this.checked, $(this).attr('data-id'));
            });
            $('input[name=on_home]').change(function(event) {
                submitStatusChange('on_home', 'bol', this.checked, $(this).attr('data-id'));
            });

            $('input[name=sorting]').change(function() {
                if (this.checked) {
                    $('.sorting').removeClass('d-none');
                    $('.ctrl-sorting .sorting-checkbox').addClass('d-none');
                    $('.ctrl-sorting .sorting-btn').removeClass('d-none');
                } else {

                }
            });

            $('#save-sorting').click(saveSorting);

            Sortable.create(document.querySelector('.tbl-headlines'), {
                handle: '.sorting',
                animation: 150,
                onEnd: function( /**Event*/ evt) {
                    orderIndex()
                },
            });
        });

        function submitStatusChange(key, type, isChecked, id) {
            Net.put(`/api/group/${id}/status`, {
                'col_key': key,
                'action': type == 'num' ? (isChecked ? 2 : 6) : isChecked
            }).then(e => {
                // console.log(e);
                // Utility.showReturnMessage(e.message, e.success, document.querySelector('.result-container'));
            });
        }

        function orderIndex() {
            document.querySelectorAll('.tbl-headlines .article-header').forEach((element, index) => {
                $(element).find('.index').text(index + 1)
            })
        }

        function saveSorting() {
            $('.ctrl-sorting .sorting-checkbox').removeClass('d-none');
            $('.ctrl-sorting .sorting-btn').addClass('d-none');
            $('input[name=sorting]').prop('checked', false);
            //$('.sorting').addClass('d-none');
            let data = {
                list: {}
            }
            $('.index').each(function(e) {
                const index = e + 1;
                const id = $(this).attr('data-id');
                data.list[id] = index;

            });
            Net.post('/admin/headlines/sorting', data).then(e => {
                Utility.alert(e.message, document.querySelector('.alert-container'));
            })
        }

        function deleteGroup(id, event) {
            Net.delete(`/api/group/${id}`).then(e => {
                $(event).closest('tr').remove();
            })
        }
    </script>
@endpush
