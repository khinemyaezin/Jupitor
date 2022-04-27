@extends('layouts.admin')

@section('content')
    <div class="container py-3 py-md-0">
        <div class="forhead d-flex flex-wrap flex-sm-nowrap justify-content-between align-items-center">
            <x-framework.forehead-result :title="'Themes'" />
            <div class="my-sm-0 my-3 text-sm-end pt-1 d-flex justify-content-end w-100 gap-3">
                <x-framework.back-button :href="route('admin.theme.all')" />
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
                @if ($data != null)
                    <form action="{{ route('admin.theme.update', ['themeid' => $data->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-theme :theme="$data"></x-theme>
                    </form>
                @else
                    <form action="{{ route('admin.theme.create') }}" method="POST">
                        @csrf
                        @method('POST')
                        <x-theme :theme="$data"></x-theme>
                    </form>
                @endif
            </div>
        </div>



    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        const data = {!! json_encode($data, JSON_HEX_TAG) !!};
        document.addEventListener("DOMContentLoaded", function(event) {
            let listTab = new bootstrap.Tab(document.getElementById('list-tab'));
            let detailTab = new bootstrap.Tab(document.getElementById('detail-tab'));
            if (data || {!! json_encode($errors->any(), JSON_HEX_TAG) !!}) {
                detailTab.show();
            } else {
                listTab.show();
            }


        });

        function minifyHtml() {
            $('textarea[name=theme_body]').each(function() {
                const mini = $(this).val().replace(/\n|\t/g, ' ');
                $(this).val(mini);
            })
        }

        function prettyHtml() {
            $('textarea[name=theme_body]').each(function() {
                $(this).val(Pretty($(this).val()));
            })
        }


        function updateTheme(e) {
            console.log();
            const body = {
                'body': $('textarea[name=body-' + e + "]").val(),
                'inner_body': null
            }
            Net.put('/admin/theme/' + e, body).then(e => {
                alert(JSON.stringify(e))
            })
        }
    </script>
@endpush
