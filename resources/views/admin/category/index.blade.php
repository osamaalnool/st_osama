@extends('layouts.dashboard')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> التصنيفات</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary">طباعة</button>
            <a href="{{url('admin/categories/create')}}" class="btn btn-sm btn-outline-secondary">اضافة</a>
          </div>
        </div>
      </div>
       @if(session('status'))
                 <div class='alert-success'>
                {{ session('status') }}
                </div>
      @endif
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم التصنيف</th>
      <th scope="col">صورة </th>
      <th scope="col">تاريخ الاضافة</th>
      <th scope="col">تعديل</th>
      <th scope="col">حذف</th>
    </tr>
  </thead>
  <tbody>
      <?php   $i=1; ?>
      @foreach ($categories as $category)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$category->category_name}}</td>
      <td><img src="/images/categories/{{$category->category_img}}" width="50" alt=""></td>
      <td>{{$category->created_at->diffForHumans()}}</td>
      <td><a href="{{route('categories.edit',$category->id)}}" class="btn btn-info">تعديل</a></td>
      <td>
        <form action="{{route('categories.destroy',$category->id)}}" method="POST">
          @csrf
          @method('DELETE')
        <button class="btn btn-info" >حذف</button>
        </form>
      </tr>
    @endforeach
    </tbody>
</table>
  <div class="row" style="display: flex">
            <div class="col-7">
                عرض {{$categories->firstItem()}}
            </div>
            <div class="col-5">
                <div class="btn-group float-end" style="float:left">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
@endsection

