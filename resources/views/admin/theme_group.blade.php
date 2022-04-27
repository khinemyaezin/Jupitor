@extends('layouts.admin')
@section('style')
    <style>
        #right .th-child .btn-close {
            display: none;
        }

        .th-child {
            cursor: move;
        }

        .th-child-container {

            padding: 0px;
            border: none;
        }

        .th-child-container:empty {
            padding: 10px;
            border: dashed 1px black;
        }

    </style>
@endsection
@section('content')
        <div class="container py-3 py-md-0">
            <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
                <x-framework.forehead-result :title="'Theme Group'" />
                <div class="my-sm-0 my-3 text-sm-end pt-1 w-100">
                    <div class="d-flex align-items-center justify-content-end text-nowrap fs-sm gap-2">
                        <button class="btn btn-primary" onclick="myexport()">Submit</button>
                    </div>

                </div>
            </div>
        </div>

    <div class="container alert-container">
        <x-framework.alert :errors="$errors->all()" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="fw-bold h5">Parent themes</p>
                <small class="text-muted">click close button to remove child from parent theme</small>
                <div id="left" class="list-group list-group-flush gap-2 col no-push py-3 pe-3 mt-3"
                    style="overflow-y: scroll; height : 70vh">
                    @foreach ($parents->list as $p)
                        <div class="list-group-item filtered rounded th-parent card bg-white"
                            data-parent-id="{{ $p->id }}" draggable="false" style="">
                            <div class="card-header">
                                <a href="{{ route('admin.theme.getById', ['themeid' => $p->id]) }}"
                                    class="card-title text-decoration-none text-dark d-block w-100">
                                    {{ $p->title }}
                                </a>
                            </div>

                            <div class="list-group-item nested-sortable th-child-container card-body" draggable="false"
                                style="">
                                @foreach ($p->children as $c)
                                    <div class="list-group-item bg-light rounded-0 th-child d-flex justify-content-between"
                                        data-child-id="{{ $c->id }}" draggable="false" style="">
                                        <a href="{{ route('admin.theme.getById', ['themeid' => $c->id]) }}"
                                            class="text-decoration-none text-dark">{{ $c->title }}</a>
                                        <button type="button" class="btn-close" aria-label="Close"
                                            onclick="$(this).closest('.th-child').remove();"></button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col ">
                <div>
                    <p class="fw-bold h5">Child themes</p>
                    <small class="text-muted">drag items to parent body</small>
                    <div id="right" class="list-group col gap-2 py-3 pe-3 mt-3" style="overflow-y: scroll; height : 70vh">
                        @foreach ($children->list as $c)
                            <div class="list-group-item bg-light rounded-0 th-child d-flex justify-content-between"
                                data-child-id="{{ $c->id }}" draggable="false" style="">
                                {{ $c->title }}
                                <button type="button" class="btn-close" aria-label="Close"
                                    onclick="$(this).closest('.th-child').remove();"></button>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function(event) {
            let nestedSortables = document.querySelectorAll('.nested-sortable');
            let noPush = document.querySelectorAll('.no-push');
            console.log(Sortable.utils);

            for (let ref of noPush) {
                Sortable.create(ref, {
                    group: {
                        name: 'hey',
                        put: false
                    },
                    filter: '.filtered',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65
                });
            }

            for (var i = 0; i < nestedSortables.length; i++) {
                Sortable.create(nestedSortables[i], {
                    group: {
                        name: 'hey',
                    },
                    filter: '.filtered',
                    animation: 150,
                    fallbackOnBody: true,
                    swapThreshold: 0.65,
                    onAdd: function( /**Event*/ evt) {
                        const id = $(evt.item).attr('data-child-id');
                        const len = $(evt.item.parentNode).find(`[data-child-id='${id}']`).length;
                        if (len > 1) {
                            evt.item.parentNode.removeChild(evt.item);
                        }
                    },
                });
            }
            Sortable.create(document.getElementById('right'), {
                group: {
                    name: 'hey',
                    pull: 'clone',
                    put: false
                },
                animation: 150,
                fallbackOnBody: true,
                swapThreshold: 0.65,

            });
        });

        function myexport() {
            let data = {
                list: {}
            }
            $('.th-parent').each(function(e) {
                const pid = $(this).attr('data-parent-id');
                let child = [];
                $(this).find('.th-child').each(function() {
                    child.push($(this).attr('data-child-id'));
                });
                data.list[pid] = child;
            });
            console.log(data);
            Net.post('/admin/theme-group', data).then(e => {
                if (e.success) {
                    Utility.alert(e.message, document.querySelector('.alert-container'));
                }
            })
        }
    </script>
@endpush
