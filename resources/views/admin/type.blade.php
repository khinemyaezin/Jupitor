@extends('layouts.admin')
@section('content')
        <div class="container py-3 py-md-0">
            <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
               <x-framework.forehead-result :title="'Headline'"/>
                <div class="my-sm-0 my-3 text-sm-end pt-1 d-flex justify-content-end w-100">
                    <x-framework.back-button :href="route('admin.type.all')" />
                    @if (request('id'))
                        <x-framework.new-button :href="route('admin.type.index')" />
                    @endif
                </div>
            </div>
        </div>
       
    <div class="container alert-container">
        <x-framework.alert :errors="$errors->all()"/>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
    </div>
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="callout bd-callout-info rounded-0 mb-3">
                    <span class="fs-6">General</span>
                </div>
                <div class="list-group my-3 gap-2 ms-3">
                    @if ($result->list)
                        @foreach ($result->list as $a)
                            <div
                                class="list-group-item list-group-item-action p-0 border-0 rounded-1 @if (request('id') == $a->id) active @endif">
                                <a href="{{ route('admin.type.getById', ['id' => $a->id]) }}"
                                    class="d-block p-2 text-decoration-none d-flex">
                                    <span class="align-self-center">{{ $a->title }}</span>
                                </a>

                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
            <div class="col-md-8">
                @if (request('id'))
                    <form class="detail-form" action="{{ route('admin.type.update', ['id' => $data->id]) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <x-type :type="$data"></x-type>
                    </form>
                @else
                    <form class="detail-form" action="{{ route('admin.type.create') }}" method="POST">
                        @csrf
                        @method('POST')
                        <x-type :type="$data"></x-type>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
