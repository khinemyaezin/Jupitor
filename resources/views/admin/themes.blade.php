@extends('layouts.admin')

@section('content')
    <div class="container py-3 py-md-0">
        <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center ">
            <x-framework.forehead-result :title="'Themes'" />
            <div class="my-sm-0 my-3 text-sm-end pt-1 d-flex justify-content-end w-100">
                <x-framework.new-button :href="route('admin.theme.index')" />
            </div>
        </div>
    </div>
    <div class="container alert-container">
        <x-framework.alert :errors="$errors->all()" />
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="callout bd-callout-info rounded-0 mb-3">
                    <span class="fs-6">General</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Themes list</div>

                    </div>
                    <div class="card-body px-0">
                        <table class="table table-default align-middle">
                            <thead>
                                <tr>
                                    <th scope="col" style="width: 10%">No</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Parent / Child</th>
                                    <th scope="col">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($result->list->count() == 0)
                                    <tr>
                                        <td colspan="4">No records</td>
                                    </tr>
                                @endif

                                @foreach ($result->list as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            <a class="text-decoration-none"
                                                href="{{ route('admin.theme.getById', ['themeid' => $item->id]) }}">{{ $item->title }}</a>
                                        </td>
                                        <td>
                                            @if ($item->tree == 1)
                                                parent
                                            @else
                                                child
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group mb-2" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-light">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                                <a type="button" class="btn btn-light" data-id="{{ $item->id }}"
                                                    href="{{ route('admin.theme.getById', ['themeid' => $item->id]) }}">
                                                    <i class="bi bi-folder2-open"></i>
                                                </a>

                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end py-3 align-items-center gap-3">
                        <p class="text-muted">Displaying {{ $result->list->count() }} of
                            {{ $result->list->total() }}.</p>
                        <span>{{ $result->list->links() }}</span>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection
