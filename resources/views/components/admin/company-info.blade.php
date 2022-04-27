<div class="card mb-3 h-100">
    <div class="card-header"><span class="card-title">Company Info</span></div>
    <div class="card-body">
        <div class="row mb-4">
            <label class="col-md-4 col-form-label  text-md-end">{{ __('Logo') }} </label>
            <div class="col-sm-6">
                <div class="d-flex align-items-center">
                    <label class="" for="logo" style="height: 100%;
                                            max-height: 150px;
                                            width: 150px;">
                        <img id="logoImg" class="img-fluid" src="" style="background-color: #b9b9b9;"
                            onerror="document.getElementById('logoImg').src = '{{ asset('storage/essential/def-img.jpg') }}' "
                            alt="Image Description">
                        <input type="file" name="image_url" onchange="logoChange(this)"
                            class="form-attachment-btn-label" id="logo" hidden>
                    </label>
                </div>
            </div>

        </div>
        <div class="row mb-4">
            <label for="com-name" class="col-sm-4 form-label text-md-end">{{ __('Name') }} </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" id="com-name"
                    value="{{ $info->data ? $info->data->name : '' }}" placeholder="your company name"
                    aria-label="Enter current password">
            </div>

        </div>
        <div class="row mb-4">
            <label for="com-email" class="col-sm-4 form-label text-md-end">{{ __('Email') }} </label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" id="com-email"
                    value="{{ $info->data ? $info->data->email : '' }}" placeholder="example@company.com">
            </div>

        </div>
        <div class="row mb-4">
            <label for="com-phone" class="col-sm-4 form-label text-md-end">{{ __('Phone') }} </label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" name="phone" id="com-phone"
                    value="{{ $info->data ? $info->data->phone : '' }}">
            </div>

        </div>
        <div class="row mb-4">
            <label for="com-address" class="col-sm-4 form-label text-md-end">{{ __('Address') }} </label>
            <div class="col-sm-6">
                <textarea class="form-control" name="address"
                    id="com-address">{{ $info->data ? $info->data->address : '' }}</textarea>
            </div>

        </div>
        <div class="row mb-4">
            <label for="com-opening-hour" class="col-sm-4 form-label text-md-end">{{ __('Opening hours') }} </label>
            <div class="col-sm-6">
                @if ($info->data)
                    <x-framework.opening-hour :myweekdays="str_split($info->data->weekdays)" :officeStartTime="$info->data->office_start_time" :officeEndTime="$info->data->office_end_time" />
                @else
                    <x-framework.opening-hour />
                @endif
            </div>

        </div>

    </div>
    <div class="bg-light p-4">
        Socials
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <label for="linkin" class="col-sm-4 form-label text-md-end">{{ __('LinkIn') }}</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="linkin" id="linkin"
                    value="{{ $info->data ? $info->data->linkin : '' }}">
            </div>

        </div>
        <div class="row mb-4">
            <label for="facebook" class="col-sm-4 form-label text-md-end">{{ __('Facebook') }}</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="facebook" id="facebook"
                    value="{{ $info->data ? $info->data->facebook : '' }}">
            </div>

        </div>
        <div class="row  mb-4">
            <label for="instagram" class="col-sm-4 form-label text-md-end">{{ __('Instagram') }}</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="instagram" id="instagram"
                    value="{{ $info->data ? $info->data->instagram : '' }}">
            </div>

        </div>

    </div>
    <div class="card-footer d-flex justify-content-end">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
</div>
@push('scripts')
    <script type="text/javascript">
        const info = {!! json_encode($info, JSON_HEX_TAG) !!}
        document.addEventListener("DOMContentLoaded", function(event) {
            init();
        });

        function init() {
            if (info.data) {
                $("#logoImg").attr('src', info.data.image_url)
            }
        }

        function logoChange(event) {
            const input = event;
            let base64;
            for (let f of input.files) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    base64 = e.target.result;
                    $("#logoImg").attr('src', base64)

                };
                reader.readAsDataURL(f);
            }

        }
    </script>
@endpush
