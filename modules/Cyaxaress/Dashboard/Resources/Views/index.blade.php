@extends('Dashboard::master')

@section('content')
    @can(\Cyaxaress\RolePermissions\Models\Permission::PERMISSION_TEACH)
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> Current Account Balance </p>
            <p>{{ number_format(auth()->user()->balance) }} Toman</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> Total Course Sales</p>
            <p>{{ number_format($totalSales) }} Toman</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> Deducted Commission </p>
            <p>{{ number_format($totalSiteShare) }} Toman</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> Net Income </p>
            <p>{{ number_format($totalBenefit) }} Toman</p>
        </div>
    </div>
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> Today's Income </p>
            <p>{{ number_format($todayBenefit) }} Toman</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> Income in the Last 30 Days</p>
            <p>{{ number_format($last30DaysBenefit) }} Toman</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> Ongoing Settlements </p>
            <p>0 Toman </p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
            <p> Successful Transactions Today ({{ $todaySuccessPaymentsCount }}) Transactions </p>
            <p>{{ number_format($todaySuccessPaymentsTotal) }} Toman</p>
        </div>
    </div>
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
            <div class="col-12 bg-white padding-30 margin-bottom-20">
                <div id="container"></div>
            </div>
        </div>
        <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

            <p class="title icon-outline-receipt">Settleable Balance </p>
            <p class="amount-show color-444">
                {{ number_format(auth()->user()->balance) }}<span> Toman </span></p>
            <p class="title icon-sync">In Settlement</p>
            <p class="amount-show color-444">0<span> Toman </span></p>
            <a href="/" class=" all-reconcile-text color-2b4a83">All Settlements</a>
        </div>
    </div>
    @endcan
    <div class="row bg-white no-gutters font-size-13">
        <div class="title__row">
            <p>Your Recent Transactions</p>
            <a class="all-reconcile-text margin-left-20 color-2b4a83">View All Transactions</a>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>Payment ID</th>
                    <th>Payer Email</th>
                    <th>Amount (Toman)</th>
                    <th>Your Income</th>
                    <th>Site Income</th>
                    <th>Course Name</th>
                    <th>Date and Time</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr role="row" class="">
                        <td>{{ $payment->invoice_id }}</td>
                        <td>{{ $payment->buyer->email }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->seller_share }}</td>
                        <td>{{ $payment->site_share }}</td>
                        <td>{{ $payment->paymentable->title }}</td>
                        <td>{{ \Morilog\Jalali\Jalalian::fromCarbon($payment->created_at) }}</td>
                        <td class="@if($payment->status == \Cyaxaress\Payment\Models\Payment::STATUS_SUCCESS) text-success @else text-error @endif">@lang($payment->status)</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section("js")
    @include("Payment::chart")
@endsection
