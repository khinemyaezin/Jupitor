@props(['myweekdays'=>[1,1,1,1,1,1,1], 'officeStartTime'=> '','officeEndTime'=>'18:00' ])

@php
    $weekends = ['sun', 'mon', 'tue', 'wed','thu', 'fri', 'sat'];
@endphp
<caption>Days</caption>
<div class="p-2">
    <div class="row row-cols-lg-3 ">
        @foreach ($weekends as $key => $value)
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox"  name="{{ $weekends[$key] }}" id="{{ $key }}" @if ($myweekdays[$key] == 1 )
                        checked
                    @endif>
                    <label class="form-check-label text-capitalize" for="{{ $key }}">
                        {{ $value }}
                    </label>
                </div>

            </div>
        @endforeach

    </div>
</div>
<caption>Hours</caption>
<div class="d-flex p-2">
    <input type="time" class="form-control" name="office_start_time" required value="{{$officeStartTime}}">
    <span class="px-3 align-self-center"> to </span>
    <input type="time" class="form-control" name="office_end_time" required value="{{$officeEndTime}}">
</div>
