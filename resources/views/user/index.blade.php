@extends('layouts.master')
@section('main-word')
    توزيعات المستخدمين
@endsection
@section('title')
    المستخدمين - بنك الدم
@endsection
@section('page-header')
    {{-- Page headerr --}}
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <div>
                <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> عرض المستخدمين</h2>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12 col-md-12 col-lg-12">
            <!-- .card -->
            <div class="card">
                <div class="card-body">
                    @if (auth()->user()->can('create-user'))
                        <a class="btn btn-info mt-3 mb-1 ml-1 btn-sm" href="{{ route('user.create') }}"> <i
                                class="fa fa-plus"></i>إنشاء مستخدم جديده</a>
                    @endif
                    @include('flash::message')
                    @if (count($users))

                        <table class="table  table-hover m-1">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="text-center">الترتيب</th>
                                    <th scope="col" class="text-center">الاسم</th>
                                    <th scope="col" class="text-center">البريد الإلكتروني</th>
                                    <th scope="col" class="text-center"> رتب المستخدم</th>
                                    @if (auth()->user()->can('update-user'))
                                        <th scope="col" class="text-center">تعديل</th>
                                    @endif
                                    @if (auth()->user()->can('destroy-user'))
                                        <th scope="col" class="text-center">حذف</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                    <th scope="row" class="text-center">{{ $user->name }}</th>
                                    <th scope="row" class="text-center">{{ $user->email }}</th>
                                    <th scope="row" class="text-center">
                                        @foreach ($user->roles as $role)
                                            <label class="bg-info p-1 rounded-right"> {{ $role->display_name }}</label>
                                        @endforeach
                                    </th>
                                    @if (auth()->user()->can('update-user'))
                                        <th scope="row" class="text-center"> <a class=" btn btn-success btn-sm"
                                                href="{{ route('user.edit', $user->id) }}"> <i class="fa fa-edit"></i>
                                            </a>
                                        </th>
                                    @endif
                                    @if (auth()->user()->can('destroy-user'))
                                        <th scope="row" class="text-center">
                                            <div class="btn btn-danger destroy btn-sm"
                                                data-route="{{ route('user.destroy', $user->id) }}"
                                                data-token="{{ csrf_token() }}">
                                                <i class="fa fa-trash"></i>
                                            </div>
                                        </th>
                                    @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $users->links('front.paginate') }}
                    @else
                        <div class="alert alert-danger">
                            لاتوجد بيانات هنا .....😕😕😕😕😕😕😕😕😕😕😕

                        </div>
                    @endif

                </div>

                <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
                    content: ' هل انت منأكد انك تريد حدف رتبه المستخدم هذه!! ',
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
                                            Swal.fire("تم حذف  المستخدم بنجاح", " ",
                                                "success");

                                            Swal.fire({
                                                text: 'تم حذف  المستخدم بنجاح',
                                                icon: 'success',
                                                confirmButtonText: 'نعم'
                                            })

                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            text: 'حدث خطأ الرجاء المحاوله مره اخري ',
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
