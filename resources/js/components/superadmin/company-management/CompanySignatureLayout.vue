<template>
    <div ref="sectionSignature" class="vld-parent">


        <button class="btn btn-primary mb-2" @click="addRow()"><i class="fas fa-file-signature" aria-hidden="true"></i>&nbsp;เพิ่มลายเซ็นต์</button>
        <!--begin::Group  is-valid is-invalid-->
        <draggable   :list="list" class="list-group"  :component-data="getComponentData()">
            <div v-if="list_container">
                <div v-for="(row,index) in list" :key="row.id" class="form-group row fv-plugins-icon-container mb-2">
                    <!-- <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ</label> -->
                    <div class="col-lg-9 col-xl-9" >
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">ชื่อตำแหน่ง {{index+1}}</span></div>
                            <input type="text" v-validate="'required'" name="name[]" v-model="row.name" class="form-control form-control-solid form-control-lg " placeholder="ระบุชื่อตำแหน่งหรือระดับของพนักงาน" />
                            <button  @click="addSubRow(index)"  class="btn btn-primary ml-1 br-1"  name="button"><i class="la la-plus"></i></button>
                            <button  @click="removeRow(index,row.id)"  class="btn btn-danger ml-1 br-1"  name="button"><i class="la la-trash"></i></button>
                        </div>
                        <div class="fv-plugins-message-container"></div>
                    </div>

                </div>
            </div>
        </draggable>
        <div  class="">
            <button  v-if="list.length > 0" @click="saveData()"  class="btn btn-primary ml-1 br-1"  name="button">บันทึกข้อมูล</button>
            <button  @click="redirectBack()"  class="btn btn-danger ml-1 br-1"  name="button">ย้อนกลับ</button>
        </div>
        <!--end::Group-->

    </div>
</template>

<script>

export default{
    props: ['company'],
    data(){
      return{
           isLoading: false,
           fullPage: false,
           list: [],
           remove_signature_id:[],
           dragging: true,
           list_container:true,
      };
    },
    mounted(){
        this.getDataSignatureForm();
    },
    methods:{
        redirectBack(){
            window.location.href = "/superadmin/company";
        },
        async getDataSignatureForm(){
            try {
                let company_id =  await this.company.id;
                this.list_container = false;
                let loader = this.$loading.show({
                      // Optional parameters
                      container: this.fullPage ? null : this.$refs.sectionSignature,
                      canCancel: true,
                });
                await axios.get('/superadmin/signature-form?company_id='+ company_id)
                .then(response=>{
                    var options_signature_form = [];
                    if(response.data.length > 0){
                        $.each(response.data, function (index,signature) {
                            options_signature_form.splice(index, 1,{
                                id:signature.id,
                                name:signature.name
                            });

                        });
                        this.list = options_signature_form;


                    }
                    loader.hide();
                    this.list_container = true;

                })
                .catch(function (resp) {
                    console.log(resp);
                });
            } catch (e) {

            }
        },
        saveData(){
            // console.log(this.list);

            this.$validator.validate().then(valid => {

              if (valid) {
                  var company_id = this.company.id;
                  var remove_signature_id = '';
                  if(typeof this.remove_signature_id != 'undefined'){
                      remove_signature_id = this.remove_signature_id;
                  }
                  let loader = this.$loading.show({
                        // Optional parameters
                        container: this.fullPage ? null : this.$refs.sectionSignature,
                        canCancel: true,
                  });
                 axios.post('/superadmin/signature-form/saveDataSignature',{
                     list: this.list,
                     company_id:company_id,
                     remove_signature_id:remove_signature_id,
                 })
                 .then(response=>{
                    this.getDataSignatureForm();
                    loader.hide();
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
                        title: 'บันทึกข้อมูลแบบฟอร์มลายเซ็นบริษัท สำเร็จ'
                    });
                    this.remove_signature_id = [];
                  })
                  .catch(function (resp) {
                      // this.loading = false;
                      // alert("Could not create your delivery order.");
                      // this.loading = true;
                  });
              }
            });
        },

        addRow: function (index) {
           try {
               if(this.list.length < 10){
                   this.list.splice(this.list.length, 0,{name:''});
               }else{
                   this.$swal.fire({
                       title: "สามารถสร้างได้สูงสุด 10 รายการ",
                       icon: 'error',
                       showCancelButton: false,
                       confirmButtonColor: '#DD6B55',
                       confirmButtonText: 'ตกลง',
                   });
               }

           } catch(e)
           {
               console.log(e);
           }
        },
        addSubRow: function (index) {
           try {
               if(this.list.length < 10){
                   this.list.splice(index+1, 0,{name:''});
               }else{
                   this.$swal.fire({
                       title: "สามารถสร้างได้สูงสุด 10 รายการ",
                       icon: 'error',
                       showCancelButton: false,
                       confirmButtonColor: '#DD6B55',
                       confirmButtonText: 'ตกลง',
                   });
               }

           } catch(e)
           {
               console.log(e);
           }
        },
        removeRow: function (index,id) {
            let list = this.list;
            let isConfirmed = true;
            this.$swal.fire({
                title: "คุณต้องการจะลบหรือไม่ ?",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'ต้องการลบ !',
                cancelButtonText: "ไม่ต้องการลบ !",
            }).then(function(isConfirm){

                if (isConfirm.isConfirmed) {
                    isConfirmed = isConfirm.isConfirmed;
                    list.splice(index, 1);
                }
            });
            if(isConfirmed){
                if(typeof id != 'undefined'){
                    this.remove_signature_id.push(id);
                }
            }
        },
        handleChange() {
          // console.log('changed');
          this.$validator.validate();
          // console.log(this.list);
        },
        inputChanged(value) {
          this.activeNames = value;
          // console.log(value);
        },
        getComponentData() {
          return {
                on: {
                  change: this.handleChange,
                  input: this.inputChanged
                },
                attrs:{
                  wrap: true
                },
                props: {
                  value: this.activeNames
                }
            };
        },
    },
    computed: {

    }
}
</script>

<style scoped>
/* .button {
  margin-top: 35px;
} */
.handle {
  float: left;
  padding-top: 8px;
  padding-bottom: 8px;
}
.close {
  float: right;
  padding-top: 8px;
  padding-bottom: 8px;
}
.list-group{
    min-height: 150px;
}
/* input {
  display: inline-block;
  width: 50%;
}
.text {
  margin: 20px;
} */
</style>
