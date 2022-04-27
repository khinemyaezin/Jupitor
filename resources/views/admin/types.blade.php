@extends('layouts.admin')

@section('content')
        <div class="container py-3 py-md-0">
            <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
                <x-framework.forehead-result :title="'Headline Types'" />
                <div class="my-sm-0 my-3 text-sm-end pt-1 d-flex justify-content-end w-100">
                    <x-framework.new-button :href="route('admin.type.index')" />
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
                    <span class="fs-6">General</span>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><span class="card-title">Type list</span></div>

                    <div class="card-body px-0">
                        <table class="table table-default align-middle caption-top">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col" style="width: 30%">Title</th>
                                    <th scope="col">ID</th>

                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="tbl-headlines">
                                <!-- NO DATA BLOCK -->
                                @if ($result->list->count() == 0)
                                    <tr>
                                        <td colspan="6"><span class="ms-2">No record</span></td>
                                    </tr>
                                @endif
                                <!-- END NO DATA BLOCK -->

                                <!-- DATA BLOCK -->
                                @foreach ($result->list as $item)
                                    <tr class="article-header">

                                        <td>
                                            <span data-id="{{ $item->id }}"
                                                class="index">{{ $loop->index + $result->list->firstItem() }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.type.getById', ['id' => $item->id]) }}"
                                                class="text-wrap text-decoration-none">{{ $item->title }}</a>
                                        </td>
                                        <td>{{ $item->code }}</td>

                                        <td>
                                            <div class="btn-group" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-light" onclick=" document.getElementById('delete-type-form-{{$item->id}}').submit() ">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                                <form action="{{route('admin.type.delete',['id'=> $item->id ])}}" method="POST" id="delete-type-form-{{$item->id}}">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a type="button" class="btn btn-light"
                                                    href="{{ route('admin.type.getById', ['id' => $item->id]) }}"
                                                    data-id="{{ $item->id }}">
                                                    <i class="bi bi-folder2-open"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- END DATA BLOCK -->
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
