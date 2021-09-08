@extends('layouts.master')
@section('main-word')
    المحتويات
@endsection
@section('title')
    المقالات - بنك الدم
@endsection
@section('page-header')
    {{-- Page headerr --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> قائمة المقالات</h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <!-- .card -->
            <div class="card ">
                <div class="card-header ui-sortable-handle">

                    <div class="card-tools">
                        @if (auth()->user()->can('more-info-post'))
                            <a href="{{ route('post.show', 0) }}">
                                <i class="fa fa-arrow-right "></i>
                                معلومات أكثر عن المقال
                            </a>
                        @endif
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @if (auth()->user()->can('create-post'))
                        <a class="btn btn-info mt-3 mb-1 ml-1 btn-sm" href="{{ route('post.create') }}"> <i
                                class="fa fa-plus"></i>أنشاء مقال جديد</a>
                    @endif
                    @include('flash::message')
                    @if (count($records))
                        <table class="table  table-hover ">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">الترتيب</th>
                                    <th scope="col" class="text-center">العنوان</th>
                                    <th scope="col" class="text-center">الصوره</th>
                                    <th scope="col" class="text-center"> اسم القسم </th>
                                    <th scope="col" class="text-center"> عرض المقال </th>

                                    @if (auth()->user()->can('update-post'))

                                        <th scope="col" class="text-center">تعديل</th>
                                    @endif
                                    @if (auth()->user()->can('destroy-post'))
                                        <th scope="col" class="text-center">حذف</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $record)
                                    <tr data-row="#row{{ $record->id }}" id="row{{ $record->id }}">
                                        <td scope="row" class="text-center">{{ $loop->iteration }}</td>
                                        <td scope="row" class="text-center">{{ $record->title }}</td>
                                        <td scope="row" class="text-center"><img src="{{ asset("$record->image") }}"
                                                style=" width:4pc ; height:4pc;"></td>
                                        <td scope="row" class="text-center">{{ $record->category->name }}</td>
                                        <td scope="row" class="text-center">
                                            <a href="{{ route('post.show', $record->id) }} " class="btn btn-info btn-sm">
                                                عرض المقال
                                            </a>
                                        </td>

                                        @if (auth()->user()->can('update-post'))
                                            <td scope="row" class="text-center"> <a class=" btn btn-success btn-sm"
                                                    href="{{ route('post.edit', $record->id) }}"> <i
                                                        class="fa fa-edit"></i> </a>
                                            </td>
                                        @endif

                                        @if (auth()->user()->can('destroy-post'))
                                            <td scope="row" class="text-center">
                                                <div class="btn btn-danger destroy btn-sm"
                                                    data-route="{{ route('post.destroy', $record->id) }}"
                                                    data-token="{{ csrf_token() }}">
                                                    <i class="fa fa-trash fa-sm"> </i>
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
                            لاتوجد بيانات هنا
                    @endif

                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- row close -->
    </div>
    </div>
    </div>

    {{-- Row for fix smooth --}}
    <div class="fix-smooth">
    </div>

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
                        content: ' هل انت منأكد انك تريد حدف   هذا المقال!! ',
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
                                                    text: 'تم حذف هذا المقال بنجاح',
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
