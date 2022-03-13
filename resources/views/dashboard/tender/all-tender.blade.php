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
        <h6 class="card-title">{{__('tenders')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>{{__('اسم المناقص')}}</th>
                <th>{{__('المناقصة')}}</th>
                <th>{{__('المساحه')}}</th>
                <th>{{__('الموقع')}}</th>
                <th>{{__('الوقت')}}</th>
                <th>{{__('السعر')}}</th>
                <th>{{__('نوع العمل')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                @foreach($tender_details as $details)
                <tr>
                    <td>{{$details['user']->name}}</td>
                    <td>{{$details['tender']->text}}</td>
                    <td>{{$details['tender']->space}}</td>
                    <td>{{$details['tender']->location}}</td>
                    <td>{{$details['tender']->time}}</td>
                    <td>{{$details['tender']->price}}</td>
                    <td>{{$details['type_work']->type_of_work}}</td>
                    <td class="action"> 
                        <a  title="{{__('مزيد من التفاصيل')}}" href="/admin/tenderRooms/{{$details['tender']->id}}"> <i data-feather="eye"></i></i></a>
                        <a  title="{{__('تعديل')}}" href="/admin/editTender/{{$details['tender']->id}}"><i data-feather="edit"></i></i></a>
                        <a  title="{{__('حذف')}}" href="/admin/deleteTender/{{$details['tender']->id}}"><i data-feather="trash"></i></i></a>
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