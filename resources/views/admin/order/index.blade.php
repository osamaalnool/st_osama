@extends('layouts.dashboard')
@section('content')
<style>
    .w-5{
        display: none;
    }
</style>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> الطلبات </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            
            <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary">طباعة</button>
        </div>
        </div>
    </div>
    @if (session('status'))
        <div class='alert-success'>
            {{ session('status') }}
        </div>
    @endif
    <div class="show">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم المستخدم</th>
                    <th scope="col">العنوان</th>
                    <th scope="col">رقم الجوال </th>
                    <th scope="col">المنتج </th>
                    <th scope="col">صورة المنتج </th>
                    <th scope="col">السعر </th>
                    <th scope="col">الكمية </th>
                    <th scope="col">اجمالي السعر </th>
                    <th scope="col">حالة الطلب</th>
                    <th scope="col">تعديل</th>
                    <th scope="col">حذف</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($orders as $order)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $order->order_user }}</td>
                        <td>{{ $order->order_address }}</td>
                        <td>{{ $order->order_phone }}</td>
                        <td>{{ $order->product->product_name }}</td>
                        <td><img src="images/products/{{ $order->product->product_img }}" width="50" alt="">
                        </td>
                        <td>{{ $order->product->product_price }}</td>
                        <td>{{ $order->product_count }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>
                            <form action="{{ route('orders.update', $order->id) }}" method="post">
                                @csrf
                                @method('patch')
                                <select class="custom-select" id="payment_status" name="payment_status" required="">
                                    <option selected="" disabled="" value="{{ $order->payment_status }}">
                                        {{ $order->payment_status }}</option>
                                    <option value="تحت المعالجة">تحت المعالجة</option>
                                    <option value="مكتمل">مكتمل</option>
                                </select>
                        </td>
                        <td><button class="btn btn-info" style="float:none !important;margin-top:0 !important"
                                type="submit">تعديل</button></td>
                        </form>
                        <td>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">حذف</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row" style="display: flex">
            <div class="col-7">
                عرض {{$orders->firstItem()}}
            </div>
            <div class="col-5">
                <div class="btn-group float-end" style="float:left">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
 