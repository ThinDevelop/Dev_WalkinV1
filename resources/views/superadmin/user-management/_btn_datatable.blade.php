
<a href="{{ route('superadmin.user.show',$users->id) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-eye"></i>
</a>
<a href="{{ route('superadmin.user.edit',$users->id) }}"  class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-edit"></i>
</a>


<script>
function myFunction{{'USR'.$users->id}}(id) {
    var data = id;
    // event.preventDefault();
    // document.getElementById('logout-form').submit();
    // return confirm('Are you sure you want to delete ?');
    Swal.fire({
        title: "คุณต้องการจะลบ {{$users->name}} หรือไม่ ?",
        text: "ไม่สามารถทำการย้อนกลับข้อมูลได้เมื่อลบไปแล้ว",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'ต้องการลบ !',
        cancelButtonText: "ไม่ต้องการลบ !",
      }).then(function(isConfirm) {
        if (isConfirm.isConfirmed) {
            event.preventDefault();
            document.getElementById(data.id).submit();
          // Swal.fire({
          //   title: 'Shortlisted!',
          //   text: 'Candidates are successfully shortlisted!',
          //   icon: 'success'
          // }).then(function() {
          //     event.preventDefault();
          //     document.getElementById('delete-form').submit();
          // });
        }
      })
}
</script>

<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete"
        onclick="myFunction{{'USR'.$users->id}}({{'USR'.$users->id}})">
    <i class="la la-trash"></i>
    {!! Form::open(['method' => 'DELETE','id' =>'USR'.$users->id,'route' => ['superadmin.user.destroy', $users->id],'style'=>'display:none']) !!}
    {!! Form::close() !!}
</a>
