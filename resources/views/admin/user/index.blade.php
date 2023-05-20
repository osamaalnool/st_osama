@extends('layouts.dashboard')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> المستخدمين  </h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary">طباعة</button>
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
      <th scope="col">اسم المستخدم</th>
      <th scope="col">الايميل </th>
      <th scope="col">حذف</th>
    </tr>
  </thead>
  <tbody>
      <?php   $i=1; ?>
      @foreach ($users as $user)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>
        <form action="{{route('users.destroy',$user->id)}}" method="POST">
          @csrf
          @method('DELETE')
        <button class="btn btn-danger" >حذف</button>
        </form>
      </tr>
    @endforeach
    </tbody>
</table>
<div class="row" style="display: flex">
            <div class="col-7">
                عرض {{$users->firstItem()}}
            </div>
            <div class="col-5">
                <div class="btn-group float-end" style="float:left">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
@endsection

