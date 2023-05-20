@extends('layouts.dashboard')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> إضافة منتج جديد</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @if (session('status'))
                <div class='alert-success'>
                    {{ session('status') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ url('admin/products') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-4">
                            <label for="product_name" class="form-label">اسم المنتج</label>
                            <input type="text" class="form-control " id="product_name" value="" name="product_name"
                                required>
                        </div>
                        <div class="col-md-8">
                            <label for="product_details" class="form-label">وصف المنتج</label>
                            <input type="text" class="form-control " id="product_details" name="product_details"
                                required="">
                        </div>
                        <div class="col-md-3">
                            <label for="category" class="form-label"> التصنيف</label>
                            <div class="input-group has-validation">
                                <select class="custom-select " name="category" id="">
                                    <option selected="" disabled="" value="">اختر...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="product_price" class="form-label">سعر المنتج</label>
                            <input type="number" class="form-control" id="product_price" name="product_price"
                                required="">
                        </div>
                        <div class="col-3">
                            <div class="form-check">
                                <label for="product_img" class="form-label">اختر صورة</label>
                                <input type="file" class="form-control form-control-sm" name="product_img"
                                    id="product_img" aria-label="مثال على إدخال ملف صغير">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="product_price" class="form-label">الكمية المتوفرة</label>
                            <input type="number" class="form-control" id="product_count" name="product_count"
                                required="">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">إرسال النموذج</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
