@props(['href', 'name'=>'Create new','class' => ''])

<a href="{{$href}}" class="btn btn-light border {{$class}}">
    
    <i class="bi bi-plus-lg"></i>
    {{ $name }}
</a>
