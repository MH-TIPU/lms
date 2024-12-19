@extends('Front::layout.master')

@section('content')
    <main id="single">
        <div class="container">
            <article class="article">
                @include('Front::layout.header-ads')
                <div class="h-t">
                    <h1 class="title"> {{ $course->title }}</h1>
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="/" title="Home">Home</a></li>
                            @if($course->category->parentCategory)
                                <li><a href="{{ $course->category->parentCategory->path() }}"
                                       title="{{ $course->category->parentCategory->title }}">
                                        {{ $course->category->parentCategory->title }}</a>
                                </li>
                            @endif
                            <li><a href="{{ $course->category->path() }}"
                                   title="{{ $course->category->title }}">{{ $course->category->title }}</a></li>
                        </ul>
                    </div>
                </div>
            </article>
        </div>
        <div class="main-row container">
            <div class="sidebar-right">
                <div class="sidebar-sticky">
                    <div class="product-info-box">
                        <div class="discountBadge d-none">
                            <p>45%</p>
                            Discount
                        </div>
                        @auth
                            @if(auth()->id() == $course->teacher_id)
                                <p class="mycourse ">You are the instructor of this course</p>
                            @elseif(auth()->user()->can("download", $course))
                                <p class="mycourse">You have purchased this course</p>
                            @else
                                <div class="sell_course">
                                    <strong>Price :</strong>
                                    @if($course->getDiscount())
                                        <del class="discount-Price">{{ $course->getFormattedPrice() }}</del>
                                    @endif
                                    <p class="price">
                        <span class="woocommerce-Price-amount amount">{{ $course->getFormattedFinalPrice() }}
                            <span class="woocommerce-Price-currencySymbol">Toman</span>
                        </span>
                                    </p>
                                </div>
                                <button class="btn buy btn-buy">Buy Course</button>
                            @endif
                        @else
                            <div class="sell_course ">
                                <strong>Price :</strong>
                                @if($course->getDiscount())
                                    <del class="discount-Price">{{ $course->getFormattedPrice() }}</del>
                                @endif
                                <p class="price">
                        <span class="woocommerce-Price-amount amount">{{ $course->getFormattedPrice() }}
                            <span class="woocommerce-Price-currencySymbol">Toman</span>
                        </span>
                                </p>
                            </div>
                            <p>To purchase the course, please log in first.</p>
                            <a href="{{ route('login')}}" class="btn text-white w-100">Login</a>
                        @endauth
                        <div class="rating-star">
                            <div class="rating">
                                <div class="star">
                                    <span class="rate" data-rate="1" data-w="100%" data-title="Excellent"></span>
                                    <span class="rate" data-rate="2" data-w="80%" data-title="Good"></span>
                                    <span class="rate" data-rate="3" data-w="60%" data-title="Average"></span>
                                    <span class="rate" data-rate="4" data-w="40%" data-title="Poor"></span>
                                    <span class="rate" data-rate="5" data-w="20%" data-title="Bad"></span>
                                </div>
                                <div class="fstar" style="width: 0">
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                    <span class="frate"></span>
                                </div>
                            </div>
                            <div class="schema-stars">
                                <span class="value-rate text-message"> 4 </span>
                                <span class="title-rate"> out of </span>
                                <span class="value-rate"> 555 </span>
                                <span class="title-rate">votes</span>
                            </div>
                        </div>
                    </div>
                    <div class="product-info-box">
                        <div class="product-meta-info-list">
                            <div class="total_sales">
                                Number of students: <span>{{ count($course->students) }}</span>
                            </div>
                            <div class="meta-info-unit one">
                                <span class="title">Number of published sessions:  </span>
                                <span class="vlaue">{{ $course->lessonsCount() }}</span>
                            </div>
                            <div class="meta-info-unit two">
                                <span class="title">Course duration so far: </span>
                                <span class="vlaue">{{ $course->formattedDuration() }}</span>
                            </div>
                            <div class="meta-info-unit three">
                                <span class="title">Total course duration: </span>
                                <span class="vlaue">-</span>
                            </div>
                            <div class="meta-info-unit four">
                                <span class="title">Course instructor: </span>
                                <span class="vlaue">{{ $course->teacher->name }}</span>
                            </div>
                            <div class="meta-info-unit five">
                                <span class="title">Course status: </span>
                                <span class="vlaue">@lang($course->status)</span>
                            </div>
                            <div class="meta-info-unit six">
                                <span class="title">Support: </span>
                                <span class="vlaue">Available</span>
                            </div>
                        </div>
                    </div>
                    <div class="course-teacher-details">
                        <div class="top-part">
                            <a href="{{ route('singleTutor', $course->teacher->username) }}">
                                <img alt="{{ $course->teacher->name }}" class="img-fluid lazyloaded"
                                     src="{{ $course->teacher->thumb }}" loading="lazy">
                                <noscript>
                                    <img class="img-fluid" src="{{ $course->teacher->thumb }}"
                                         alt="{{ $course->teacher->name }}">
                                </noscript>
                            </a>
                            <div class="name">
                                <a href="{{ route('singleTutor', $course->teacher->username) }}" class="btn-link">
                                    <h6>{{ $course->teacher->name }}</h6>
                                </a>
                                <span class="job-title">{{ $course->teacher->headline }}</span>
                            </div>
                        </div>
                        <div class="job-content">
                            {{--                            <p>{{ $course->teacher->bio }}</p>--}}
                        </div>
                    </div>
                    <div class="short-link">
                        <div class="">
                            <span>Short link</span>
                            <input class="short--link" value="{{ $course->shortUrl() }}">
                            <a href="{{ $course->shortUrl() }}" class="short-link-a"
                               data-link="{{ $course->shortUrl() }}"></a>
                        </div>
                    </div>
                    @include('Front::layout.sidebar-banners')

                </div>
            </div>
            <div class="content-left">
                @if($lesson)
                    @if($lesson->media->type == "video")
                        <div class="preview">
                            <video width="100%" controls>
                                <source src="{{ $lesson->downloadLink() }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                    <a href="{{ $lesson->downloadLink() }}" class="episode-download">Download this episode
                        (Episode {{ $lesson->number }})</a>
                @endif
                <div class="course-description">
                    <div class="course-description-title">Course Description</div>
                    <div>
                        {!! $course->body !!}
                    </div>
                    <div class="tags">
                        <ul>
                            <li><a href="">React</a></li>
                            <li><a href="">reactjs</a></li>
                            <li><a href="">JavaScript</a></li>
                            <li><a href="">javascript</a></li>
                            <li><a href="">What is reactjs</a></li>
                        </ul>
                    </div>
                </div>
                @include('Front::layout.episodes-list')
            </div>
        </div>
        <div id="Modal-buy" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <p>Enter discount code</p>
                    <div class="close">&times;</div>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route("courses.buy", $course->id) }}">
                        @csrf
                        <div>
                            <input type="text" name="code" id="code" class="txt" placeholder="Enter discount code">
                            <p id="response"></p>
                        </div>
                        <button type="button" class="btn i-t " onclick="checkDiscountCode()">Apply
                            <img src="/img/loading.gif" alt="" id="loading" class="loading d-none">
                        </button>

                        <table class="table text-center table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>Total course price</th>
                                <td> {{ $course->getFormattedPrice() }} Toman</td>
                            </tr>
                            <tr>
                                <th>Discount percentage</th>
                                <td><span id="discountPercent" data-value="{{ $course->getDiscountPercent()  }}">{{ $course->getDiscountPercent() }}</span>%</td>
                            </tr>
                            <tr>
                                <th> Discount amount</th>
                                <td class="text-red"><span
                                        id="discountAmount" data-value="{{ $course->getDiscountAmount()  }}"> {{ $course->getDiscountAmount() }}</span> Toman
                                </td>
                            </tr>
                            <tr>
                                <th> Payable amount</th>
                                <td class="text-blue"><span
                                        id="payableAmount" data-value="{{ $course->getFinalPrice()  }}">{{ $course->getFormattedFinalPrice() }}</span> Toman
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn i-t ">Online Payment</button>
                    </form>
                </div>
            </div>
        </div>
        @include("Front::comments.index", ["commentable" => $course])
    </main>
@endsection

@section('js')
    <script src="/js/modal.js"></script>
    <script>
        function checkDiscountCode() {
            $("#loading").removeClass("d-none")
            const code = $("#code").val();
            const url = "{{ route("discounts.check", ["code", $course->id]) }}";
            $("#loading").addClass("d-none")
            $("#response").text("")
            $.get(url.replace("code", code))
                .done(function (data) {
                    $("#discountPercent").text( parseInt($("#discountPercent").attr("data-value")) +  data.discountPercent)
                    $("#discountAmount").text(parseInt($("#discountAmount").attr("data-value")) + data.discountAmount)
                    $("#payableAmount").text(parseInt($("#payableAmount").attr("data-value")) - data.discountAmount)
                    $("#response").text("Discount code applied successfully.").removeClass("text-error").addClass("text-success")
                })
                .fail(function (data) {
                    $("#response").text("The entered code is not valid for this course.").removeClass("text-success").addClass("text-error")
                })
                .always(function () {
                    $("#loading").addClass("d-none")
                })
        }
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/modal.css">
@endsection
