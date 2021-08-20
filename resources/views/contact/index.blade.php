@extends('layouts.master')

@section('main-word')
الرسائل المستلمه

@endsection
{{-- Page headerr  --}}
@section('page-header')
<div class="breadcrumb-header justify-content-between">
    <div class="left-content">
        <div>
            <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">قائمة الرسائل المستلمه </h2>
        </div>
    </div>
</div>
@endsection
@section('content')
<!-- Modal Delete  -->
<div class="modal fade" id="contactSearch" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تصفية و القائمة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(["method" => "get"]) !!}
                <div class="form-group">
                    {!! Form::label("client_email","تصفيه بواسطة البريد الألكتروني ") !!}
                    {!! Form::text('email',null,["class" => "form-control", "id"=> "client_email","placeholder" =>
                    "تصفية البريد الألكتروني "]) !!}
                </div>

                <div class="form-group">
                    {!! Form::label("client_phone","تصفيه بواسطة رقم الهاتف") !!}
                    {!! Form::text('phone',null,["class" => "form-control","id"=> "client_phone","placeholder" => " تصفية الهاتف المحمول"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("client_message","تصفيه بواسطة الرسالة او كلمات بها ") !!}
                    {!! Form::textarea('message',null,["class" => "form-control","id"=> "client_message","placeholder"
                    => "تصفية الرسائل"]) !!}
                </div>


                <button class="btn btn-info mt-3 btn-sm "> حفظ </button>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Delete -->
<div class="row row-sm">
    <div class="col-xl-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header ui-sortable-handle">
                <div class="card-tools">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn  " data-toggle="modal" data-target="#contactSearch">
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
                            <th> الترتيت</th>
                            <th> رقم الهاتف</th>
                            <th> البريد الالكتروني </th>
                            <th>إظهار الرساله</th>
                            @if (auth()->user()->can("destroy-contact"))
                            <th> حذف</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($records as $record)
                        <tr data-row="#row{{ $record->id }}" id="row{{ $record->id  }}">
                            <td scope="col">{{ $loop->iteration	 }}</td>
                            <td scope="col">{{ $record->phone	 }}</td>
                            <td scope="col">{{ $record->email	 }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary">
                                    إظهار
                                </button>
                                <p style=" display: none ">{{ $record->subject }}</p>
                                <article style=" display: none ">{{ $record->message }}</article>
                            </td>
                            @if (auth()->user()->can("destroy-contact"))
                            <td scope="col">
                                <div class="btn btn-danger destroy btn-sm" data-route="{{ route("contact.destroy",$record->id) }}" data-token="{{ csrf_token() }}">
                                    <i class="fa fa-trash "></i>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $records->links("front.paginate") }}
                @else
                <div class="alert alert-danger text-center">
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
                title: 'تأكد عملية الحذف'
                , icon: 'fa fa-spinner fa-spin'
                , content: ' هل انت منأكد انك تريد حذف هذه الرساله !! '
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
                                            text: 'تم حذف الرساله بنجاح'
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
                    , title: "<b> الغرض : - " + subject + "</b>"
                    , content: " <h5> الرساله: -  </h5>   <div>" + message + "</div> "
                    , buttons: {
                        "no": {
                            text: "إغلاق"
                        }
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
