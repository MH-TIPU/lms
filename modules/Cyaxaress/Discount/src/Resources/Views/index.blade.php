@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('discounts.index') }}" title="Discounts">Discounts</a></li>
@endsection
@section("content")
    <div class="main-content padding-0 discounts">
        <div class="row no-gutters">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title">Discounts</p>
                <div class="table__box">
                    <div class="table-box">
                        <table class="table">
                            <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>Discount Code</th>
                                <th>Percent</th>
                                <th>Time Limit</th>
                                <th>Description</th>
                                <th>Used</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="">
                                @foreach($discounts as $discount)
                                <td><a href="">{{ $discount->code ?? "-" }}</a></td>
                                <td><a href="">{{ $discount->percent }}%</a> for @lang($discount->type)</td>
                                <td>{{ $discount->expire_at ? createFromCarbon($discount->expire_at) : "No Expiration Date" }}</td>
                                <td>{{ $discount->description }}</td>
                                <td>{{ $discount->uses }} people</td>
                                <td>
                                    <a href="" onclick="deleteItem(event, '{{ route('discounts.destroy', $discount->id) }}')" class="item-delete mlg-15" title="Delete"></a>
                                    <a href="{{ route("discounts.edit", $discount->id) }}" class="item-edit" title="Edit"></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">Create New Discount</p>
                <form action="{{ route("discounts.store") }}" method="post" class="padding-30">
                    @csrf
                    <x-input type="text" placeholder="Discount Code" name="code"/>
                    <x-input type="number" placeholder="Discount Percent" name="percent" required />
                    <x-input type="number" placeholder="Usage Limitation" name="usage_limitation" />
                    <x-input type="text" id="expire_at" placeholder="Time Limit in Hours" name="expire_at" />
                    <p class="box__title">This Discount is for</p>
                    <x-validation-error field='type'/>
                    <div class="notificationGroup">
                        <input id="discounts-field-1" class="discounts-field-pn" name="type" value="all" type="radio"/>
                        <label for="discounts-field-1">All Courses</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="discounts-field-2" class="discounts-field-pn" name="type" value="special" type="radio"/>
                        <label for="discounts-field-2">Specific Course</label>
                    </div>
                    <div id="selectCourseContainer" class="d-none">
                        <select name="courses[]" class="mySelect2" placeholder="Select one or more courses" multiple>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input type="text" name="link" placeholder="More Information Link" />
                    <x-input type="text" name="description" placeholder="Description" class="margin-bottom-15" />

                    <button type="submit" class="btn btn-webamooz_net">Add</button>
                </form>
            </div>
        </div>
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
