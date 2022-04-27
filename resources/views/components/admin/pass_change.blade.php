<div class="card">
    <div class="card-header">
        <div class="card-title">{{ __('Reset Password') }}</div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.password.change') }}">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="new-password"
                    class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                <div class="col-md-6">
                    <input id="new-password" type="password" class="form-control" name="new_password"
                        required>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
