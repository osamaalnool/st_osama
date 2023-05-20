@extends('layouts.dashboard')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> إضافة تصنيف جديد</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            @if(session('status'))
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
                <form class="row g-3" method="POST" action="{{url('admin/categories')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-4">
            <label for="category_name" class="form-label">اسم التصنيف</label>
            <input type="text" class="form-control " id="category_name" value="" name="category_name" required>
          </div>
        <div class="col-md-8">
            <div class="form-check">
                <label for="category_img" class="form-label">اختر صورة</label>
              <input type="file" class="form-control form-control-sm" name="category_img" id="category_img" aria-label="مثال على إدخال ملف صغير">
            </div>
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

