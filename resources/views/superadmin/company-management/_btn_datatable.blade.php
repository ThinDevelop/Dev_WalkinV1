
<a href="{{ route('superadmin.company.show',$company->id) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-eye"></i>
</a>
<a href="{{ route('superadmin.company.edit',$company->id) }}"  class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-edit"></i>
</a>


<script>
function myFunction{{$company->id}}(id) {
    let data = id;

    Swal.fire({
        title: "คุณต้องการจะลบ {{$company->name}} หรือไม่ ?",
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
        onclick="myFunction{{$company->id}}({{'CPN'.$company->id}})">
    <i class="la la-trash"></i>
    {!! Form::open(['method' => 'DELETE','id' =>'CPN'.$company->id,'route' => ['superadmin.company.destroy', $company->id],'style'=>'display:none']) !!}
    {!! Form::close() !!}
</a>
