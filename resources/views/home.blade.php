@extends('layouts.app')
@section('content')
    @inject('util', 'App\Services\Utility')
    <x-forehead :forehead="$forehead"/>
    <div class="headlines"></div>
@endsection
@push('scripts')
    <script type="text/javascript">
        let groups = {!! json_encode($groups, JSON_HEX_TAG) !!};
        let forehead = {!! json_encode($forehead, JSON_HEX_TAG) !!};
        document.addEventListener("DOMContentLoaded", function(event) {
            for (let g of groups.list) {
                $('.headlines').append(ThemeBuilder.export(new Theme(g, g.type, g.group_theme, g.articles)))
            }
            Utility.textTypeV2(document.querySelector(".typewrite-v2"), [forehead.data.body]);

           
        });
    </script>
@endpush
