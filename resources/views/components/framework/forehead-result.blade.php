@props(['title'])

<div class="d-flex align-items-center w-100">
    <h4 class="m-0">{{ $title }}</h4>
    <div class="ps-3 alert-container">
        @if (session('result'))
            <span class="resultbox d-flex align-items-center bg-success px-3 rounded-pill py-2">
                <span class="text-white me-2">
                    {{ session('result')->message }}
                </span>
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                    @if (session('result')->success)
                        <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                    @else
                        <path class="checkmark_check" fill="none" d="M14.1 14.1l23.8 23.8 m0,-23.8 l-23.8,23.8" />
                    @endif

                </svg>
                <script>
                    setTimeout(() => {
                        $('.resultbox').remove();
                    }, 3000);
                </script>
            </span>
        @endif
        {{-- <span class="resultbox d-flex align-items-center bg-success px-3 rounded-pill py-2 flex-nowrap" >
            <span class="text-white me-2 text-nowrap">
                Save Successfully 
            </span>
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
        </span> --}}
    </div>
</div>
