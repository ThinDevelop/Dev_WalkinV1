<template>
    <div ref="sectionobjective_type" class="vld-parent">


        <button class="btn btn-primary mb-2" @click="addRow()"><i class="fas fa-plus" aria-hidden="true"></i>&nbsp;เพิ่มวัตถุประสงค์</button>
        <!--begin::Group  is-valid is-invalid-->
        <draggable   :list="list" class="list-group" v-if="list_container" :component-data="getComponentData()">
            <div v-for="(row,index) in list" :key="row.id" class="form-group row fv-plugins-icon-container mb-2">
                <!-- <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ</label> -->
                <div class="col-lg-9 col-xl-9" >
                    <div class="input-group">
                         <div class="input-group-prepend"><span class="input-group-text">วัตถุประสงค์ {{index+1}}</span></div>
                         <input type="text" v-validate="'required'" name="name[]" v-model="row.name" class="form-control form-control-solid form-control-lg mr-2" placeholder="ระบุวัตถุประสงค์ของการมาติดต่อ" />
                         <span class="switch switch-icon switch-brand">
                             สถานะ &nbsp;&nbsp;
                                <label>
                                    <input type="checkbox" v-model="row.status" name="status[]"/>
                                    <span></span>
                                </label>
                         </span>
                         <button  @click="addSubRow(index)"  class="btn btn-primary ml-1 br-1"  name="button"><i class="la la-plus"></i></button>
                         <button  @click="removeRow(index,row.id)"  class="btn btn-danger ml-1 br-1"  name="button"><i class="la la-trash"></i></button>
                    </div>
                    <div class="fv-plugins-message-container"></div>
                </div>

            </div>
        </draggable>
        <div  class="">
            <button v-if="list.length > 0" @click="saveData()"  class="btn btn-primary ml-1 br-1"  name="button">บันทึกข้อมูล</button>
            <button  @click="redirectBack()"  class="btn btn-danger ml-1 br-1"  name="button">ย้อนกลับ</button>
        </div>
        <!--end::Group-->

    </div>

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
           remove_objective_type_id:[],
           dragging: true,
           list_container:true,
           maxAdd:20,
      };
    },
    mounted(){
        this.getDataObjectiveTypeForm();
    },
    methods:{
        redirectBack(){
            window.location.href = "/superadmin/company";
        },
        async getDataObjectiveTypeForm(){
            try {
                let company_id =  await this.company.id;
                this.list_container = false;
                let loader = this.$loading.show({
                      // Optional parameters
                      container: this.fullPage ? null : this.$refs.sectionobjective_type,
                      canCancel: false,
                });
                await axios.get('/superadmin/objective-type?company_id='+ company_id)
                .then(response=>{
                    var options_objective_type_form = [];
                    if(response.data.length > 0){
                        $.each(response.data, function (index,objective_type) {
                            options_objective_type_form.splice(index, 1,{
                                id:objective_type.id,
                                name:objective_type.name,
                                status:objective_type.status
                            });

                        });
                        this.list = options_objective_type_form;


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
                  var remove_objective_type_id = '';
                  if(typeof this.remove_objective_type_id != 'undefined'){
                      remove_objective_type_id = this.remove_objective_type_id;
                  }
                  let loader = this.$loading.show({
                        // Optional parameters
                        container: this.fullPage ? null : this.$refs.sectionobjective_type,
                        canCancel: true,
                  });
                 axios.post('/superadmin/objective-type/saveDataObjectiveType',{
                     list: this.list,
                     company_id:company_id,
                     status:this.status,
                     remove_objective_type_id:remove_objective_type_id,
                 })
                 .then(response=>{
                    this.getDataObjectiveTypeForm();
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
                        title: 'บันทึกข้อมูลวัตถุประสงค์ของผู้มาติดต่อ สำเร็จ'
                    });
                    this.remove_objective_type_id = [];
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
               if(this.list.length < this.maxAdd){
                   this.list.splice(this.list.length, 0,{name:'',status:1});
               }else{
                   this.$swal.fire({
                       title: "สามารถสร้างได้สูงสุด 20 รายการ",
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
               if(this.list.length < this.maxAdd){
                   // console.log(index);
                   this.list.splice(index+1, 0,{name:'',status:1});
               }else{
                   this.$swal.fire({
                       title: "สามารถสร้างได้สูงสุด 20 รายการ",
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
                    this.remove_objective_type_id.push(id);
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
