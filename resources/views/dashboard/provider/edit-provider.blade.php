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
        <p class="text-muted mb-3">{{__('تعديل مزودي الخدمة')}}</p>
        <form class="forms-sample"  method="POST" enctype="multipart/form-data" action="/admin/updateProvider/{{$provider->id}}">
            @csrf

            <div class="row mb-6">
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('اسم مزود الخدمة')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="name" value="{{$provider->name}}"  required/>
                </div>
                <div class="col-md-6">
                    <label class="form-label">{{__('الإيميل')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="email" value="{{$provider->email}}" disabled required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الهاتف')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="mobile" value="{{$provider->mobile}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('العنوان')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="address" value="{{$provider->address}}"  required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('السجل التجاري')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="cr_number" value="{{$provider->cr_number}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الشهادات الدوليه')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="experience_certificate" value="{{$provider->experience_certificate}}"  required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الدورات التدريبية')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="business_license" value="{{$provider->business_license}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('رقم الحساب البنكي')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="bank_account_number" value="{{$provider->bank_account_number}}"  required/>
                </div>
                <div >
                <br>
              </div>
              <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('نوع الاشتراك')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="package_id" value="{{$provider->package_id}}"  required/>
                </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('الباقي من الاشتراك')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="rest_of_package" value="{{$provider->rest_of_package}}"  required/>
                </div>
                <div >
                <br>
              </div>
                <div class="col-md-6">
                    <label for="exampleInputNumber1" class="form-label">{{__('رابط الشركة')}}:</label>
                    <input class="form-control mb-4 mb-md-0" name="company_link" value="{{$provider->company_link}}"  required/>
                </div>
            </div>

            <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
