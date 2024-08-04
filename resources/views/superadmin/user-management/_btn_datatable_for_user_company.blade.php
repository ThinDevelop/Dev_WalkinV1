
{{-- <a href="{{ route('superadmin.user.show',$users->id) }}" class="btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-eye"></i>
</a> --}}
<a data-toggle="modal" data-target="#{{"MD".$users->id}}"
    data-id="{{$users->id}}"
    data-username="{{$users->username}}"
    data-name="{{$users->name}}"
    data-status="{{$users->status}}"
    data-role="{{$users->roles[0]->id}}"
    id="{{"MDUS".$users->id}}"
    class="for-modal btn btn-sm btn-clean btn-icon" title="Edit details">
    <i class="la la-edit"></i>
</a>

{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCustomScrollable">
    Launch demo modal
</button> --}}
<script>
function myFunction{{'USR'.$users->id}}(id) {
    var data = id;
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
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: 'ลบข้อมูลบัญชีผู้ใช้งานของบริษัท สำเร็จ'
            });
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


<!-- Modal-->
{{-- <div class="modal fade" id="{{"MD".$users->id}}" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <div data-scroll="true" data-height="300">
                    ...
                <div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}
