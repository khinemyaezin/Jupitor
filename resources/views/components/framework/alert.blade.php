@props(['errors'])

@if ($errors)
    <div class="alert alert-warning">
        <ol class="m-0">
            @foreach ($errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif
@if (session('result') && !session('result')->success)
    <div class="alert alert-warning mt-3">
        {{ session('result')->errorMessage }}
        @if (config('app.debug') && !session('result')->success)
            {{ session('result')->error }}
        @endif
    </div>
@endif
