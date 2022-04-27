@props(['data'])
<div class="card">
    <form action="{{ route('admin.account.update') }}" method="POST" enctype="multipart/form-data"
        id="update-account-form">
        @csrf
        @method('PUT')
        <div class="card-header">
            <div class="card-title">User Info</div>
            @if ($data->google_id)
                <span class="small text-muted">Google verify account</span>
            @endif
        </div>
        <div class="card-body">

            <div class="row mb-4">
                <label class="col-md-4 col-form-label  text-md-end">{{ __('Profile') }} *</label>
                <div class="col-sm-6">
                    <div class="d-flex align-items-center mb-2">
                        <label class="@if ($data->google_id) disabled active @endif " for="profile" style="height: 100%;
                                   max-height: 150px;
                                   width: 150px;">
                            <img id="profileImg" class="img-fluid" src="" style="background-color: #b9b9b9;"
                                onerror="this.src = '{{ asset('storage/essential/def-img.jpg') }}' "
                                alt="Image Description">
                            <input type="file" name="image_url" onchange="profileChange(this)"
                                class="form-attachment-btn-label" id="profile" hidden>
                        </label>
                    </div>
                </div>

            </div>
            <div class="row mb-3">
                <label for="acc-name" class="col-md-4 col-form-label text-md-end">{{ __('User Name') }}</label>

                <div class="col-md-6">
                    <input id="acc-name" type="text" value="{{ $data->name }}"
                        class="form-control @error('name') is-invalid @enderror" name="name" required
                        @if ($data->google_id) disabled @endif>

                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="acc-email" class="col-md-4 col-form-label text-md-end">{{ __('Account Email') }}</label>

                <div class="col-md-6">
                    <input id="acc-email" type="text" class="form-control @error('email') is-invalid @enderror"
                        name="email" required value="{{ $data->email }}"
                        @if ($data->google_id) disabled @endif>
                    @error('email')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


        </div>
        <div class="card-footer d-flex justify-content-end gap-3">


            <a class="btn btn-link text-danger" href="{{ route('admin.account.reset') }}">
                {{ __('Reset Account') }}
            </a>
            @if (!$data->google_id)
                <button type="button" class="btn btn-primary" id="btn-submit">
                    {{ __('Submit') }}
                </button>
            @endif
        </div>
    </form>
</div>
@push('scripts')
    <script type="text/javascript">
        const user = {!! json_encode($data, JSON_HEX_TAG) !!}
        document.addEventListener("DOMContentLoaded", function(event) {
            $('#btn-submit').on('click', function(e) {
                /*Utility.showConfirmModal("Confirm password").then(e => {
                    $('#update-account-form').submit(function(eventObj) {
                        $("<input />")
                            .attr("name", "confirm_password")
                            .attr("value", e)
                            .appendTo("#update-account-form");
                        return true;
                    });
                    $('#update-account-form').submit();
                }).catch(e => {
                    console.log(e);
                })*/
                $('#update-account-form').submit();
            });
            userInit();
        });

        function userInit() {
            if (user) {
                $("#profileImg").attr('src', user.image_url)
            }
        }

        function profileChange(event) {
            const input = event;
            let base64;
            for (let f of input.files) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    base64 = e.target.result;
                    $("#profileImg").attr('src', base64)

                };
                reader.readAsDataURL(f);
            }

        }
    </script>
@endpush
