@extends('layouts.dashboard')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> المنتجات</h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                 
                <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary">طباعة</button>
                <a href="{{ url('admin/products/create') }}" class="btn btn-sm btn-outline-secondary">اضافة</a>
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
                    <th scope="col">اسم المنتج</th>
                    <th scope="col">التصنيف</th>
                    <th scope="col">سعر المنتج </th>
                    <th scope="col">الكمية المتوفرة</th>
                    <th scope="col">وصف المنتج </th>
                    <th scope="col">صورة توضيحية</th>
                    <th scope="col">تاريخ الاضافة</th>
                    <th scope="col">تعديل</th>
                    <th scope="col">حذف</th>
                </tr>
            </thead>
            <tbody id="main_show">
                <?php $i = 1; ?>
                @foreach ($products as $product)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->category_name }}</td>
                        <td>{{ $product->product_price }}</td>
                        <td>{{ $product->product_count }}</td>
                        <td>{{ $product->product_details }}</td>
                        <td><img src="/images/products/{{ $product->product_img }}" width="50" alt=""></td>
                        <td>{{ $product->created_at->diffForHumans()  }}</td>
                        <td><a href="{{ url('admin/products/' . $product->id . '/edit') }}" class="btn btn-info">تعديل</a>
                        </td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-info">حذف</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row" style="display: flex">
            <div class="col-7">
                عرض {{ $products->firstItem() }}
            </div>
            <div class="col-5">
                <div class="btn-group float-end" style="float:left">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
 