@extends('layouts.master')
@section('main-word')
المحتويات
@endsection
@section('title')
    طلبات التبرع - بنك الدم 
@endsection
@section("page-header")
{{-- Page headerr  --}}
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> قائمة طلبات التبرع</h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- Modal -->
<div class="modal fade" id="clientSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">التصفيه و القائمه</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(["method" => "get"]) !!}

                <div class="form-group">
                    {!! Form::label("patient_name","تصفيه بواسطة اسم المريض") !!}
                    {!! Form::text('patient_name',null,[
                    "class" => "form-control",
                    "id"=> "patient_name",
                    "placeholder" => "تصفيه اسم المريض"
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("patient_age","تصفيه بواسطة عمر المريض") !!}
                    {!! Form::text('patient_age',null,[
                    "class" => "form-control",
                    "id"=> "patient_age",
                    "placeholder" => "تصفيه عمر المريض"
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("patient_phone","تصفيه بواسطة رقم هاتف المريض") !!}
                    {!! Form::text('patient_phone',null,[
                    "class" => "form-control",
                    "id"=> "patient_phone",
                    "placeholder" => "تصفيه رقم هاتف المريض"
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("hospital_name","تصفيه بواسطة اسم المستشفي") !!}
                    {!! Form::text('hospital_name',null,[
                    "class" => "form-control",
                    "id"=> "hospital_name",
                    "placeholder" => "تصفيه اسم المستشفي"
                    ]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("hospital_address","تصفيه بواسطة عنوان المستشفي") !!}
                    {!! Form::text('hospital_address',null,[
                    "class" => "form-control",
                    "id"=> "hospital_address",
                    "placeholder" => "تصفيه عنوان المستشفي"
                    ]) !!}
                </div>



                <button class="btn btn-info mt-3 btn-sm "> حفظ</button>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal -->
<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <!-- .card -->
        <div class="card">
            <div class="card-header ui-sortable-handle">
                <div class="card-tools">
                    <a href="{{ route("donation-request.index" ) }}">
                        <i class=" fas fa-arrow-left"></i>
                    </a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn  " data-toggle="modal" data-target="#clientSearch">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>

                </div>
            </div>
            <!-- /.card-header -->
            <!-- card-body -->
            <div class="card-body table-responsive p-0">
                @include('flash::message')
                @if (count($records))
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th> الترتيب</th>
                            <th>اسم المريض</th>
                            <th>عمر المريض</th>
                            <th> رقم هاتف المريض</th>
                            <th> اسم المستشفي </th>
                            <th> عنوان المستشفي</th>
                            <th> ملاحظات </th>
                            @if (auth()->user()->can("delete-donation-request"))
                            <th> حذف</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($records as $record)
                        <tr data-row="#row{{ $record->id }}" id="row{{ $record->id  }}">
                            <td>{{ $loop->iteration	 }}</td>
                            <td>{{ $record->patient_name	 }}</td>
                            <td>{{ $record->patient_age	 }}</td>
                            <td>{{ $record->patient_phone	 }}</td>
                            <td>{{ $record->hospital_name	 }}</td>
                            <td>{{ $record->hospital_address	 }}</td>
                            <td>
                                {{ $record->notes}}
                            </td>
                            @if (auth()->user()->can("delete-donation-request"))
                            <td scope="row">
                                <div class="btn btn-danger destroy btn-sm" data-route="{{ route("donation-request.destroy",$record->id) }}" data-token="{{ csrf_token() }}">
                                    <i class="fa fa-sm fa-trash "></i>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $records->links("front.paginate") }}
                @else
                <div class="alert alert-danger">
                    لاتوجد بيانات هنا .....😕😕😕😕😕😕😕😕😕😕😕
                </div>
                @endif
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{-- Row for fix smooth --}}
            <div class="row row-sm fix-smooth">
            </div>
        </div>
    </div>
    <!-- row close -->
@endsection

@section('js')
<script>
    $(function() {
        $(document).on('click', '.destroy', function() {

            var route = $(this).data('route');
            var token = $(this).data('token');
            var $row = $(this).parent().parent().data("row");

            $.confirm({
                title: 'تأكيد عملية الحذف'
                , icon: 'fa fa-spinner fa-spin'
                , content: ' هل انت منأكد انك تريد حدف طلب التبرع!! '
                , type: 'red'
                , closeAnimation: 'rotateXR'
                , buttons: {
                    yes: {
                        text: 'نعم'
                        , btnClass: 'btn-blue'
                        , action: function() {
                            $.ajax({
                                url: route
                                , type: 'post'
                                , data: {
                                    _method: 'delete'
                                    , _token: token
                                }
                                , dataType: 'json'
                                , success: function(data) {
                                    if (data.status === 1) {
                                        $($row).remove();
                                        Swal.fire("تم حذف طلب التبرع بنجاح", " ", "success");
                                    }
                                }
                                , error: function() {
                                    Swal.fire("حدث خطأ الرجاء المحاوله مره اخري", "", "error")
                                }
                            });
                        }
                    }
                    , no: {
                        text: 'لا'
                        , btnClass: 'btn-blue'
                    }
                , }
            , });
        });

    })

</script>
@endsection
