@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "gr";
  }
?>
  @if($lang == 'en')
  <link href="{{ asset('assets/massageltr.css') }}" rel="stylesheet" />
  @else
  <link href="{{ asset('assets/massage.css') }}" rel="stylesheet" />
  @endif
@endpush
@section('content')



<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"></h6>
        <p class="text-muted mb-3">{{__('تعديل المستخدمين')}}</p>
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateUser/{{$user->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم المستخدم')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="name" value="{{$user->name}}"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الإيميل')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$user->email}}" disabled required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الهاتف')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="mobile" value="{{$user->mobile}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('العنوان')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="address" value="{{$user->address}}"  required/>
                </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
