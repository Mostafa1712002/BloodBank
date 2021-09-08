@extends('layouts.master')
@section('main-word')
المحتويات
@endsection
@section('title')
    الأقسام - بنك الدم
@endsection
{{-- Page headerr  --}}
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> قائمة الآقسام</h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                @if (auth()->user()->can("create-category"))
                <a class="btn btn-info mt-3 mb-1 ml-1 btn-sm" href="{{ route("category.create") }}"> <i class="fa fa-plus"></i> إنشاء قسم جديد</a>
                @endif
                @include('flash::message')
                @if (count($records))
                <table class="table  table-hover m-1">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">الترتيب</th>
                            <th scope="col" class="text-center">الأسم</th>
                            @if (auth()->user()->can("update-category"))

                            <th scope="col" class="text-center">تعديل</th>
                            @endif

                            @if (auth()->user()->can("destroy-category"))
                            <th scope="col" class="text-center">حذف</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                        <tr data-row="#row{{ $record->id }}" id="row{{ $record->id  }}">
                            <td scope="row" class="text-center">{{ $loop->iteration	 }}</td>
                            <td scope="row" class="text-center">{{ $record->name	 }}</td>
                            @if (auth()->user()->can("update-category"))

                            <td scope="row" class="text-center"> <a class=" btn btn-success btn-sm" href="{{ route("category.edit",$record->id)}}"> <i class="fa fa-edit"></i> </a>
                            </td>
                            @endif
                            @if (auth()->user()->can("destroy-category"))
                            <td scope="row" class="text-center">
                                <div class="btn btn-danger destroy btn-sm" data-route="{{ route("category.destroy",$record->id) }}" data-token="{{ csrf_token() }}">
                                    <i class="fa fa-trash"></i>
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
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- row close -->
</div>
</div>

{{-- Row for fix smooth --}}

<div class="row row-sm fix-smooth">
</div>

@endsection


@section('js')
<script>
    $(function() {
        // For all table without data
        if ($("tbody tr ").html() == undefined) {
            (function() {
                const Toast = Swal.mixin({
                    toast: true
                    , position: 'top-end'
                    , showConfirmButton: false
                    , timer: 3000
                    , timerProgressBar: true
                    , didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'warning'
                    , title: 'لا توجد بيانات هنا '
                })

            })()
        }

        $(document).on('click', '.destroy', function() {

            var route = $(this).data('route');
            var token = $(this).data('token');
            var $row = $(this).parent().parent().data("row");

            $.confirm({
                title: 'تأكيد عملية الحذف'
                , icon: 'fa fa-spinner fa-spin'
                , content: ' هل انت منأكد انك تريد حدف   هذا القسم!! '
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

                                        Swal.fire({
                                            text: 'تم حذف هذا القسم بنجاح'
                                            , icon: 'success'
                                            , confirmButtonText: 'نعم'
                                        })
                                    }
                                }
                                , error: function() {
                                    Swal.fire({
                                        text  : " هذا القسم يحتوي علي مقالات لذلك لا تستطيع مسحها  يمكنك نقل المقالات الي قسم آخر و المحاوله مره اخري؟؟ "
                                        , icon: 'error'
                                        , confirmButtonText: 'نعم'
                                    })
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
