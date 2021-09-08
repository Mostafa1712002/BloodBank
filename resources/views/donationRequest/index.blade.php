@extends('layouts.master')
@section('title')
    طلبات التبرع - بنك الدم
@endsection
@section('main-word')
    المحتويات
@endsection
@section('page-header')
    {{-- Page headerr --}}
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
                    {!! Form::open(['method' => 'get']) !!}


                    <div class="form-group">
                        {!! Form::label('city_name', 'تصفيه بواسطة اسم المدينه') !!}
                        {!! Form::text('city', null, [
    'class' => 'form-control',
    'id' => 'city_name',
    'placeholder' => 'تصفية المدينه',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('governorate_name', 'تصفيه بواسطة اسم المحافظه') !!}
                        {!! Form::text('governorate', null, [
    'class' => 'form-control',
    'id' => 'governorate_name',
    'placeholder' => 'تصفيه المحافظه',
]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('client_name', 'تصفيه بواسطة اسم العميل') !!}
                        {!! Form::text('client', null, [
    'class' => 'form-control',
    'id' => 'client_name',
    'placeholder' => 'تصفية اسم العميل',
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
                        @if (auth()->user()->can('show-more-info-donation-request'))
                            <a href="{{ route('donation-request.show', 0) }}">
                                <i class=" fas fa-arrow-right"></i>
                                <i>رؤية محتوي طلبات التبرع </i>
                            </a>
                        @endif
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
                                    <th>أسم العميل</th>
                                    <th> اسم المدينه</th>
                                    <th> اسم المحافظه</th>
                                    @if (auth()->user()->can('destroy-donation-request'))
                                        <th> حذف</th>
                                    @endif
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($records as $record)
                                    <tr data-row="#row{{ $record->id }}" id="row{{ $record->id }}">
                                        <td>{{ $loop->iteration }}</td>

                                        <td>{{ $record->client->name }}</td>
                                        <td>{{ $record->city->name }}</td>
                                        <td>{{ $record->city->governorate->name }}</td>
                                        @if (auth()->user()->can('destroy-donation-request'))
                                            <td scope="row">
                                                <div class="btn btn-danger destroy btn-sm"
                                                    data-route="{{ route('donation-request.destroy', $record->id) }}"
                                                    data-token="{{ csrf_token() }}">
                                                    <i class="fa fa-sm fa-trash "></i>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $records->links('front.paginate') }}
                    @else
                        <div class="alert alert-danger">
                            لاتوجد بيانات هنا .....😕😕😕😕😕😕😕😕😕😕😕

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
                    content: ' هل انت منأكد انك تريد حدف طلب التبرع!! ',
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
                                            Swal.fire({
                                                text: 'تم حذف طلب التبرع بنجاح',
                                                icon: 'success',
                                                confirmButtonText: 'نعم'
                                            })
                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            text: 'حدث خطأ الرجاء المحاوله مره اخري',
                                            icon: 'error',
                                            confirmButtonText: 'نعم'
                                        })
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
