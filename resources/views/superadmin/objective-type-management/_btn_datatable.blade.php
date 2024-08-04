
<a href="{{ route('superadmin.objective.show',$objective_type->id) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-eye"></i>
</a>
<a href="{{ route('superadmin.objective.edit',$objective_type->id) }}"  class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-edit"></i>
</a>


<script>
function delete_form_objective_type{{$objective_type->id}}(id) {
    var data = id;
    Swal.fire({
        title: "คุณต้องการจะลบ {{$objective_type->name}} หรือไม่ ?",
        text: "ไม่สามารถทำการย้อนกลับข้อมูลได้เมื่อลบไปแล้ว",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'ต้องการลบ !',
        cancelButtonText: "ไม่ต้องการลบ !",
      }).then(function(isConfirm) {
        if (isConfirm.isConfirmed) {
            event.preventDefault();
            document.getElementById(data.id).submit();
            // $(data.id).submit();
        }
      })
}
</script>

<a href="#" class="btn btn-sm btn-clean btn-icon obj-delete" title="delete form objective type"
        onclick="delete_form_objective_type{{$objective_type->id}}({{'OBJDEL'.$objective_type->id}})">
    <i class="la la-trash"></i>
    {!! Form::open(['method' => 'DELETE','id' =>'OBJDEL'.$objective_type->id,'route' => ['superadmin.objective.destroy', $objective_type->id],'style'=>'display:none']) !!}
    {!! Form::close() !!}
</a>
