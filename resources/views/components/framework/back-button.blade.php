@props(['href', 'name'=>'Back To List', 'class' => '' ])

<a href="{{$href}}" class="btn btn-light border {{$class}}">
    <i class="bi bi-chevron-double-left"></i>
    {{ $name }}
</a>
