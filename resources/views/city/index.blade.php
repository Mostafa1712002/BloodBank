@extends('layouts.master')
@section('main-word')
الأماكن
@endsection
{{-- Page headerr  --}}
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1"> قائمة المدن</h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                @if (auth()->user()->can("create-city"))
                <a class="btn btn-info mt-3 mb-1 ml-1 btn-sm" href="{{ route("city.create") }}"> <i class="fa fa-plus">
                        @endif
                    </i>...
                    إنشاء مدينه جديده</a>
                @include('flash::message')
                @if (count($records))

                <table class="table  table-hover m-1">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="text-center">الترتيب</th>
                            <th scope="col" class="text-center">الأسم</th>
                            <th scope="col" class="text-center">أسم المحافظه</th>
                            @if (auth()->user()->can("update-city"))
                            <th scope="col" class="text-center">تعديل</th>
                            @endif
                            @if (auth()->user()->can("destroy-city"))

                            <th scope="col" class="text-center">حذف</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($records as $record)
                        <tr data-row="#form{{ $record->id }}" id="form{{ $record->id }}">
                            <td scope="row" class="text-center">{{ $loop->iteration	 }}</td>
                            <td scope="row" class="text-center">{{ $record->name	 }}</td>
                            <td scope="row" class="text-center">{{ $record->governorate->name	 }}</td>
                            @if (auth()->user()->can("update-city"))
                            <td scope="row" class="text-center"> <a class=" btn btn-success btn-sm" href="{{ route("city.edit",$record->id)}}"> <i class="fa fa-edit"></i> </a>
                            </td>
                            @endif
                            @if (auth()->user()->can("destroy-city"))
                            <td scope="row" class="text-center">
                                <div class="btn btn-danger destroy btn-sm" data-route="{{ route("city.destroy",$record->id) }}" data-token="{{ csrf_token() }}">
                                    <i class="fa fa-sm fa-trash"> </i>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $records->links("front.paginate") }}

                @else
                <div class="alert alert-danger ">
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
                title: 'تأكيد عملية الحذف'
                , icon: 'fa fa-spinner fa-spin'
                , content: ' هل انت منأكد انك تريد حدف  هذه المدينه !! '
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
                                        Swal.fire("", " ", "success");
                                        Swal.fire({
                                            text: 'تم حذف هذه المدينه بنجاح'
                                            , icon: 'success'
                                            , confirmButtonText: 'نعم'
                                        })
                                    }
                                }
                                , error: function() {
                                    Swal.fire({
                                        text: 'حدث خطأ الرجاء المحاوله مره اخري'
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



        //  Show Messages
        $("td > button").click(function() {
            console.log("sucess")
            $(this).each(function() {
                var message = $(this).next().next().text();
                var subject = $(this).next().text();
                $.confirm({
                    backgroundDismiss: function() {
                        return true;
                    }
                    , title: "<b> Subject : - " + subject + "</b>"
                    , content: " <h5> Message: -  </h5>   <div>" + message + "</div> "
                    , buttons: {
                        close: function() {}
                    }
                    , columnClass: "col-md-8"
                , });
            });
        })


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
    })

</script>
@endsection
