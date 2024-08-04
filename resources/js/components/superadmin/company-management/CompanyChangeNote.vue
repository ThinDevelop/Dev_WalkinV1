<template>
    <div class="">
        <div class="show-border">
            <textarea style="width:50mm;text-align:left" class="form-control" v-model="note" rows=10></textarea>
        </div>
        <div  class="mt-3">
            <button @click="saveData()"  class="btn btn-primary ml-1 br-1"  name="button">บันทึกข้อมูล</button>
            <button  @click="redirectBack()"  class="btn btn-danger ml-1 br-1"  name="button">ย้อนกลับ</button>
        </div>
    </div>
</template>
<script>
export default {
     props: ['company_id','company_note'],
    data(){
      return{
           isLoading: false,
           fullPage: false,
           note: '',
      };
    },
    mounted(){
        // console.log(this.company_id)
        // console.log(this.company_note)
        this.note = this.company_note
    },
    methods:{
        redirectBack(){
            window.location.href = "/superadmin/company";
        },
        saveData(){
           Vue.axios.put('/superadmin/savenote',{
                _method: 'PUT',
                company_id: this.company_id,
                note: this.note
            })
            .then((response) => {
                const Toast = this.$swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', this.$swal.stopTimer)
                            toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'บันทึกหมายเหตุ(ท้ายใบสลิป) สำเร็จ'
                    });
            });
        }
    }
}
</script>
