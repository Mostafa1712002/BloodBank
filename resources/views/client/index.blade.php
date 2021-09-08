@extends('layouts.master')
@section('title')
    العملاء - بنك الدم
@endsection
{{-- Page headerr --}}
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">العملاء</h2>
            </div>
        </div>
    </div>
    <!-- /breadcrumb -->
@endsection
@section('content')

    {{-- Start Model search --}}
    <div class="modal fade" id="clientSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">التصفية والقائمة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {!! Form::open([
    'method' => 'get',
]) !!}

                    <div class="form-group">
                        {!! Form::label('client_name', 'تصفية حسب الاسم') !!}
                        {!! Form::text('name', null, [
    'class' => 'form-control',
    'id' => 'client_name',
    'placeholder' => 'تصفية الاسم ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('client_email', 'تصفية حسب البريد الاكتروني') !!}
                        {!! Form::text('email', null, [
    'class' => 'form-control',
    'id' => 'client_email',
    'placeholder' => 'تصفية البريد الاكتروني ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('client_phone', 'تصفية حسب رقم الهاتف ') !!}
                        {!! Form::text('phone', null, [
    'class' => 'form-control',
    'id' => 'client_phone',
    'placeholder' => 'تصفية رقم الهاتف ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('client_d_o_b', 'تصفية حسب تاريخ الميلاد') !!}
                        {{ Form::input('date', 'd_o_b', date('Y-m-d', 00 - 00 - 00), ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {!! Form::label('client_last_donation_date', 'تصفية حسب أخر تاريخ تبرع') !!}
                        {{ Form::input('date', 'last_donation_date', date('Y-m-d', 00 - 00 - 00), ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group">
                        {!! Form::label('client_city', ' تصفية حسب المدينه ') !!}
                        {!! Form::text('city', null, [
    'class' => 'form-control',
    'id' => 'client_city',
    'placeholder' => ' تصفية المدينه ',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('client_blood_type', ' تصفية حسب فصيلة الدم ') !!}
                        {!! Form::text('blood_type', null, [
    'class' => 'form-control',
    'id' => 'client_blood_type',
    'placeholder' => ' تصفية حسب فصيلة الدم ',
]) !!}
                    </div>
                    <div class="form-group">

                        {!! Form::label('تصفيه حسب حالة العميل') !!}
                        {!! Form::select(
    'is_active',
    [
        2 => 'لا شئ',
        1 => 'مفعل',
        0 => 'غير مفعل',
    ],
    2,
    ['class' => 'form-control', 'id' => 'client_is_active'],
) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info mt-3 btn-sm "> حفظ</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
            </div>
        </div>
    </div>
    {{-- End Model search --}}
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <!-- .card -->

            <div class="card">
                <div class="card-header ui-sortable-handle">
                    <h3 class="card-title">قائمة العملاء </h3>
                    <div class="card-tools">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn" data-toggle="modal" data-target="#clientSearch">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- card-body -->
                <div class="card-body table-responsive p-0">
                    @if (count($records))
                        <table class="table table-hover ">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center"> الترتيب</th>
                                    <th class="text-center"> الاسم</th>
                                    <th class="text-center"> رقم الهاتف</th>
                                    <th class="text-center"> البريد الاكتروني</th>
                                    <th class="text-center"> المدينه</th>
                                    <th class="text-center"> تاريخ الميلاد</th>
                                    <th class="text-center"> أخر تاريخ لتبرع</th>
                                    <th class="text-center"> فصيلة الدم</th>
                                    @if (auth()->user()->can('active-client') ||
        auth()->user()->can('de-active-client'))
                                        <th class="text-center"> التفعيل</th>
                                    @endif
                                    @if (auth()->user()->can('destroy-client'))
                                        <th class="text-center"> حذف</th>
                                    @endif

                                </tr>
                            </thead>


                            <tbody>
                                @foreach ($records as $record)
                                    <tr data-row="#row{{ $record->id }}" id="row{{ $record->id }}">
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $record->name }}</td>
                                        <td class="text-center">{{ $record->phone }}</td>
                                        <td class="text-center">{{ $record->email }}</td>
                                        <td class="text-center">{{ $record->city->name }}</td>
                                        <td class="text-center">{{ $record->d_o_b }}</td>
                                        <td class="text-center">{{ $record->last_donation_date }}</td>
                                        <td class="text-center">{{ $record->bloodType->name }}</td>
                                        <td scope="row" class="text-center">

                                            @if ($record->is_active == 0)
                                                {{ Form::open([
    'action' => ['App\Http\Controllers\clientController@active', $record->id],
    'Method' => 'put',
]) }}
                                                @if (auth()->user()->can('active-client'))
                                                    <button class="btn  btn-success btn-sm"> <span class="font-bold">
                                                            تفعيل</span> </button>
                                                @endif
                                                {{ Form::close() }}
                                            @else
                                                {{ Form::open([
    'action' => ['App\Http\Controllers\clientController@deActive', $record->id],
    'Method' => 'put',
]) }}
                                                @if (auth()->user()->can('de-active-client'))

                                                    <button class="btn btn-secondary btn-sm  ">
                                                        <span> الغاء التفعيل</span>
                                                    </button>
                                                @endif

                                                {{ Form::close() }}
                                            @endif

                                        </td>


                                        @if (auth()->user()->can('destroy-client'))
                                            <td scope="row" class="text-center">
                                                <div class="btn btn-danger destroy btn-sm"
                                                    data-route="{{ route('client.destroy', $record->id) }}"
                                                    data-token="{{ csrf_token() }}">
                                                    <i class="fa fa-trash "></i>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $records->links('front.paginate') }}
                    @else
                        <div class="alert alert-danger text-center">
                            لاتوجد بيانات هنا 
                        </div>
                    @endif
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- row close -->
    {{-- Row for fix smooth --}}
    <div class="row row-sm fix-smooth">
    </div>

    </div>
    </div>
    <!-- Container closed -->
@endsection

@section('js')
    <script>
        $(function() {
            $(document).on('click', '.destroy', function() {

                var route = $(this).data('route');
                var token = $(this).data('token');
                var $row = $(this).parent().parent().data("row");

                $.confirm({
                    title: 'تأكيد عملية الحذف',
                    icon: 'fa fa-spinner fa-spin',
                    content: ' هل انت منأكد انك تريد حدف هذا العميل !! ',
                    type: 'red',
                    closeAnimation: 'rotateXR',
                    buttons: {
                        yes: {
                            text: 'نعم',
                            btnClass: 'btn-blue',
                            action: function() {
                                $.ajax({
                                    url: route,
                                    type: 'post',
                                    data: {
                                        _method: 'delete',
                                        _token: token
                                    },
                                    dataType: 'json',
                                    success: function(data) {
                                        if (data.status === 1) {
                                            $($row).remove();
                                            Swal.fire("تم حذف العميل بنجاح", " ",
                                                "success");
                                        }
                                    },
                                    error: function() {
                                        Swal.fire(
                                            "حدث خطأ الرجاء المحاوله مره اخري",
                                            "", "error")
                                    }
                                });
                            }
                        },
                        no: {
                            text: 'لا',
                            btnClass: 'btn-blue'
                        },
                    },
                });
            });

            // For all table without data
            if ($("tbody tr ").html() == undefined) {
                (function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'warning',
                        title: 'لا توجد بيانات هنا '
                    })

                })()
            }

        })
    </script>
@endsection
