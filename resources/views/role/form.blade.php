<div class="form-group">
    {!! Form::label("اسم رتبة ") !!}
    {!! Form::text('name',null,[
    "class" => "form-control",

    "placeholder" => "أدخل اسم رتبة"
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label("الاسم المعروض") !!}
    {!! Form::text('display_name',null,[
    "class" => "form-control",
    "placeholder" => "أدخل الاسم المعروض لرتبة"
    ]) !!}
</div>
<div class="form-group">
    {!! Form::label("وصف رتبة") !!}
    {!! Form::textarea('description',null,[
    "class" => "form-control",
    "rows" => 5,
    "cols" => 15,
    "placeholder" => "أدخل وصف رتبة"
    ]) !!}
</div>

<div class="row">

    <div class="col-12">
        <label>صلاحيات المستخدمين </label>
        <br>
        <input type="checkbox" name="checkAll" id="select-all">
        <label for="checkAll">تحديد الجميع</label>
    </div>
    @foreach ($permissions as $permission)
    <div class="col-3">
        {!! Form::checkbox('permissions[]', $permission->id , ); !!}
        {!! Form::label($permission->display_name) !!}

    </div>
    @endforeach

</div>
