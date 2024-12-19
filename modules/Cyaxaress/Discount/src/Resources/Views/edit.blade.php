@extends("Dashboard::master")

@section("content")
    <div class="col-4 bg-white">
        <p class="box__title">Edit Discount Code</p>
        <form action="{{ route("discounts.update", $discount->id) }}" method="post" class="padding-30">
            @csrf
            @method("patch")
            <x-input type="text" placeholder="Discount Code" name="code" value="{{ $discount->code }}"/>
            <x-input type="number" placeholder="Discount Percentage" name="percent" required value="{{ $discount->percent }}" />
            <x-input type="number" placeholder="Usage Limitation" name="usage_limitation" value="{{ $discount->usage_limitation }}" />
            <x-input type="text" id="expire_at" placeholder="Time Limitation in Hours" name="expire_at"
                     value="{{ $discount->expire_at ? \Morilog\Jalali\Jalalian::fromCarbon($discount->expire_at)->format('Y/m/d H:i') : '' }}" />
            <p class="box__title">This Discount is for</p>
            <x-validation-error field='type'/>
            <div class="notificationGroup">
                <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all" type="radio" {{ $discount->type == \Cyaxaress\Discount\Models\Discount::TYPE_ALL ? "checked" : "" }}/>
                <label for="discounts-field-1">All Courses</label>
            </div>
            <div class="notificationGroup">
                <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special" type="radio" {{ $discount->type == \Cyaxaress\Discount\Models\Discount::TYPE_SPECIAL ? "checked" : "" }}/>
                <label for="discounts-field-2">Specific Course</label>
            </div>
            <div id="selectCourseContainer" class="{{ $discount->type == \Cyaxaress\Discount\Models\Discount::TYPE_ALL ? "d-none" : "" }}">
                <select name="courses[]" class="mySelect2" placeholder="Select one or more courses" multiple>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ $discount->courses->contains($course->id) ? "selected" : "" }}>{{ $course->title }}</option>
                    @endforeach
                </select>
            </div>
            <x-input type="text" name="link" placeholder="More Information Link" value="{{ $discount->link }}" />
            <x-input type="text" name="description" placeholder="Description" class="margin-bottom-15" value="{{ $discount->description }}"/>

            <button type="submit" class="btn btn-webamooz_net">Update</button>
        </form>
    </div>
@endsection

@section("js")
    <script src="/assets/persianDatePicker/js/persianDatepicker.min.js"></script>
    <script src="/js/select2.min.js"></script>
    <script>
        $("#expire_at").persianDatepicker({
            formatDate: "YYYY/0M/0D hh:mm",
        });

        $('.mySelect2').select2({
            placeholder: "Select one or more courses..."
        });
    </script>

@endsection

@section("css")
    <link rel="stylesheet" href="/assets/persianDatePicker/css/persianDatepicker-default.css">
    <link href="/css/select2.min.css" rel="stylesheet" />
@endsection
