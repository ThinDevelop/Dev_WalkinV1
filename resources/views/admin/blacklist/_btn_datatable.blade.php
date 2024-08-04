
<a href="{{ route('admin.company.show',$companies->id) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-eye"></i>
</a>
<a href="{{ route('admin.company.edit',$companies->id) }}"  class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-edit"></i>
</a>


<script>
function myFunction{{$companies->id}}(id) {
    let data = id;

    Swal.fire({
        title: "คุณต้องการจะลบ {{$companies->name}} หรือไม่ ?",
        text: "ไม่สามารถทำการย้อนกลับข้อมูลได้เมื่อลบไปแล้ว",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'ต้องการลบ !',
        cancelButtonText: "ไม่ต้องการลบ !",
      }).then(function(isConfirm) {
        if (isConfirm.isConfirmed) {
            event.preventDefault();
            document.getElementById(data.id).submit();
        }
      })
}
</script>

<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete"
        onclick="myFunction{{$companies->id}}({{'CPN'.$companies->id}})">
    <i class="la la-trash"></i>
    {!! Form::open(['method' => 'DELETE','id' =>'CPN'.$companies->id,'route' => ['admin.company.destroy', $companies->id],'style'=>'display:none']) !!}
    {!! Form::close() !!}
</a>
