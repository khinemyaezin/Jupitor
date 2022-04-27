@extends('layouts.admin')
@section('content')
    <form id="myForm"
        action="{{ route('admin.article_header.update', ['groupid' => request('groupid'), 'articleid' => request('articleid')]) }}"
        method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')
        <div class="container py-3 py-md-0">
            <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center py-3 py-lg-0">
                <x-framework.forehead-result :title="'Headline'" />
                <div class="my-sm-0 my-3 text-sm-end pt-1 w-100">
                    <div class="d-flex justify-content-end align-items-center text-nowrap fs-sm gap-2">
                        <x-framework.back-button :href="route('admin.group.all')" />
                        <button type="button" class="btn btn-danger"
                            onclick="document.getElementById('delete-article').submit()">Delete</button>
                        <input type="submit" class="btn btn-primary" name="submit"
                            value="{{ $group->data ? 'Update' : 'Submit' }}">
                    </div>
                </div>

            </div>
        </div>
        <div class="container">
            <x-framework.alert :errors="$errors->all()" />
        </div>
        <x-headline :group="$group" :type="$type" :article="$article" :sortable="true" :themes="$themes"
            :groupThemes="$groupThemes" :pageType="'article_detail'" />
    </form>
    <form
        action="{{ route('admin.article_header.update', ['groupid' => request('groupid'), 'articleid' => request('articleid')]) }}"
        id="delete-article" method="POST">
        @csrf
        @method('DELETE')
    </form>
@endsection
