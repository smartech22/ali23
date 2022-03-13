@extends('dashboard.layout.master')
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/prismjs/prism.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
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
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">{{__('المستخدمين')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('الاسم')}}</th>
                <th>{{__('الايميل')}}</th>
                <th>{{__('الهاتف')}}</th>
                <th>{{__('العنوان')}}</th>
                <th>{{__('السجل التجاري')}}</th>
                <th>{{__('الشهادات')}}</th>
                <th>{{__('رقم الحساب البنكي')}}</th>
                <th>{{__('نوع الباقة')}}</th>
                <th>{{__('تاريخ الانضمام')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($provider_details as $provider)
                <tr>
                    <td>{{$provider['provider']->name}}</td>
                    <td>{{$provider['provider']->email}}</td>
                    <td>{{$provider['provider']->mobile}}</td>
                    <td>{{$provider['provider']->address}}</td>
                    <td>{{$provider['provider']->cr_number}}</td>
                    <td>{{$provider['provider']->experience_certificate}}</td>
                    <td>{{$provider['provider']->bank_account_number}}</td>
                    <td>{{$provider['package']->name}}</td>
                    <td>{{$provider['provider']->created_at}}</td>
                    <td class="action"> 
                    <a type="button"  title="{{__('قبول')}}" href="/admin/acceptProvider/{{$provider['provider']->id}}"  > <i data-feather="check-square"></i></i></a>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush