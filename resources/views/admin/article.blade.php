@extends('layouts.admin')
@section('content')
<form id="myForm" action="{{ route('admin.article.create',['groupid'=>request('groupid')]) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('POST')
    <div class="container py-3 py-md-0">
        <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center py-3 py-lg-0">
            <x-framework.forehead-result :title="'Headline'" />
            <div class="my-sm-0 my-3 text-sm-end pt-1 w-100">
                <div class="d-flex justify-content-end align-items-center text-nowrap fs-sm gap-2">
                    <x-framework.back-button :href="route('admin.group.all')" />
                  
                    <input type="submit" class="btn btn-primary" name="submit"
                        value="{{ $group->data ? 'Update' : 'Submit' }}">
                </div>
            </div>

        </div>
    </div>
    <div class="container mb-3">
        <x-framework.alert :errors="$errors->all()"/>
    </div>
    <x-headline :group="$group" :type="$type" :article="$article" :sortable="false" :themes="$themes" :groupThemes="$groupThemes" 
    :pageType="'article_new'"/>  
</form>
@endsection
