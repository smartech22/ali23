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
        <h6 class="card-title">{{__('packages')}}</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table">
          <a type="button"  class="btn btn-primary me-2" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"> {{__('add')}}</a>
            <thead>
              <tr>
                <td>#</td>
                <th>{{__('نوع العمل')}}</th>
                <th class="action">{{__('خيارات')}}</th>
              </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                @foreach($types as $type)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$type->type_of_work}}</td>
                    <td class="action"> 
                        <a  title="{{__('حذف')}}" href="/admin/deleteTypeWork/{{$type->id}}"><i data-feather="slash"></i></i></a>
                        <a type="button"  href="#" data-bs-toggle="modal" data-bs-target="#exampleModal-{{$type->id}}"> <i data-feather="edit"></i></a>
                    </td>
                </tr>
                <?php $i+1 ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('أضف نسبة الربح من المزود')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data" action="/admin/storeWorkType">
                @csrf
                <div class="mb-3">
                    <label for="recipient-name" class="form-label">{{__('نوع العمل انكليزي')}} :</label>
                    <input type="text" class="form-control" name="type_of_work_en" id="exampleInputNumber1"  required>
                </div>
                <div class="mb-3">
                    <label for="recipient-name" class="form-label">{{__('نوع العمل الماني')}} :</label>
                    <input type="text" class="form-control" name="type_of_work_gr"  id="exampleInputNumber1" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
                </div>
                </form>
            </div>
                
            </div>
        </div>
    </div>
    @foreach($types as $type)
      <div class="modal fade" id="exampleModal-{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('تعديل نوع العمل')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="/admin/updateWorkType/{{$type->id}}">
                    @csrf
                    <div class="mb-3">
                        <label for="recipient-name" class="form-label">{{__('نوع العمل انكليزي')}} :</label>
                        <input type="text" class="form-control" name="type_of_work_en"  id="exampleInputNumber1"  required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="form-label">{{__('نوع العمل الماني')}} :</label>
                        <input type="text" class="form-control" name="type_of_work_gr"  id="exampleInputNumber1" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary me-2">{{__('حفظ')}}</button>
                    </div>
                    </form>
                </div>
                    
                </div>
            </div>
      </div>
  @endforeach
@endsection
@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
@endpush