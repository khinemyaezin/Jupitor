@extends('layouts.admin')
@section('content')
    <form id="myForm" action="{{ route('admin.group.update', ['groupid' => request('groupid')]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="container py-3 py-md-0">
            <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
                <x-framework.forehead-result :title="'Headline'" />
                <div class="my-sm-0 my-3 text-sm-end pt-1 w-100">
                    <div class="d-flex justify-content-end align-items-center text-nowrap fs-sm gap-3">
                        <x-framework.back-button :href="route('admin.group.all')" />
                        <input type="submit" class="btn btn-primary" name="submit" value="Update">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <x-framework.alert :errors="$errors->all()" />
        </div>
        <x-headline :group="$group" :type="$type" :article="$article" :sortable="false" :themes="$themes"
            :groupThemes="$groupThemes" :pageType="'group_detail'" />

    </form>
@endsection
