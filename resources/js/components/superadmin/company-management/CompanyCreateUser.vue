<template>
    <div>
        <div class="mb-3">
            <button type="button" class="btn btn-success font-weight-bolder px-4 py-2 " @click="showModal = true"><i class="fa fas-plus"></i> เพิ่มบัญชีผู้ใช้งานของบริษัท</button>
            <hr>
        </div>

        <table class="table table-separate table-head-custom table-checkable dataTable no-footer dtr-inline collapsed" id="kt_datatable_user"  ref="kt_datatable_user"  style="margin-top: 13px !important">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>ชื่อ สกุล</th>
                    <th>ชื่อเข้าสู่ระบบ</th>
                    <th>เข้าระบบล่าสุด</th>
                    <th>IP Address ล่าสุด</th>
                    <th>ประเภทบัญชี</th>
                    <th>สถานะ</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
        <div v-if="showModal">
          <transition name="modal">
            <div class="modal-mask">
              <div class="modal-wrapper">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title text-dark font-weight-bold">{{mode_status_title}}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" @click="showModal = false">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-xl-12 col-xxl-10">
                                        <div class="row justify-content-center">
                                            <div class="col-xl-12">
                                                <!--begin::Wizard Step 1-->
                                                <div class="" >
                                                    <h5 class="text-dark font-weight-bold mb-10">รายละเอียดบัญชีผู้ใช้งานของบริษัท:</h5>
                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">ชื่อเข้าใช้ระบบ *</label>
                                                        <div  class="col-lg-9 col-xl-9">
                                                            <input v-bind:class="'form-control form-control-solid form-control-lg '"  v-validate="'required'" ref="username" name="username" type="text" v-model="username" >
                                                            <span  v-if="errors.has('username')" class="form-text text-danger">{{ errors.first('username') }}</span>
                                                        </div>

                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::password-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">รหัสผ่าน *</label>
                                                        <div v-if="mode_status == 'create'" class="col-lg-9 col-xl-9">
                                                            <input v-bind:class="'form-control form-control-solid form-control-lg '"  v-validate="'required'" ref="password" name="password" type="password" v-model="password">
                                                        </div>
                                                        <div v-if="mode_status == 'edit'" class="col-lg-9 col-xl-9">
                                                            <input v-bind:class="'form-control form-control-solid form-control-lg '"  ref="password" name="password" type="password" v-model="password">
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::re password-->
                                                    <div v-if="password" class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">ยืนยันรหัสผ่าน *</label>
                                                        <div v-if="mode_status == 'create'" class="col-lg-9 col-xl-9">
                                                            <input v-bind:class="'form-control form-control-solid form-control-lg '" v-validate="'required|confirmed:password'" name="password_confirmation" type="password" >
                                                            <span v-if="errors.has('password_confirmation')" class="form-text text-danger"> {{ errors.first('password_confirmation') }}</span>
                                                        </div>
                                                        <div v-if="mode_status == 'edit'" class="col-lg-9 col-xl-9">
                                                            <input v-bind:class="'form-control form-control-solid form-control-lg '" v-validate="'required|confirmed:password'" name="password_confirmation" type="password" >
                                                            <span v-if="errors.has('password_confirmation')" class="form-text text-danger"> {{ errors.first('password_confirmation') }}</span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ-สกุล</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <input v-bind:class="'form-control form-control-solid form-control-lg '" v-validate="'required'" name="name" type="text" v-model="name">
                                                            <!-- <span class="form-text text-success">Validate text</span> -->
                                                            <!-- <div class="fv-plugins-message-container"></div> -->
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">ประเภทบัญชี</label>
                                                        <div class="col-lg-9 col-xl-9">

                                                            <select2 style="width:280px;"
                                                                v-model="role_id"
                                                                :settings="{placeholder:'กรุณาเลือกประเภทของบัญชี',allowClear:false}"
                                                                :options="option_roles"
                                                                name="role_id">
                                                            </select2>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row fv-plugins-icon-container">
                                                        <label class="col-xl-3 col-lg-3 col-form-label">สถานะ</label>
                                                        <div class="col-lg-9 col-xl-9">
                                                            <span class="switch switch-icon switch-brand">
                                                                   <label>
                                                                       <input type="checkbox" v-model="status" name="status"/>
                                                                       <span></span>
                                                                   </label>
                                                            </span>
                                                        <div class="fv-plugins-message-container"></div></div>
                                                    </div>
                                                    <!--end::Group-->
                                                </div>

                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-danger font-weight-bolder px-4 py-2" @click="showModal = false">ปิด</button>
                         <button type="button" @click="saveData()" class="btn btn-success font-weight-bolder px-4 py-2" >บันทึก</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </transition>
        </div>

    </div>
</template>

<script>

export default{
    props:['company'],
    data(){
      return{
            showModal: false,
            user_id:'',
            username:'',
            password:'',
            confirm_password:'',
            name:'',
            status:1,
            mode_status_title:'เพิ่มบัญชีผู้ใช้งานของบริษัท ' + this.company.name,
            mode_status: 'create',
            option_roles:[],
            role_id:3,
            conpany_id: this.company.id,
            table: Object,
            username_duplicate: ''

      };
    },
    mounted(){
        this.initDatatable();
        this.getRoleNames();
    },
    methods:{
        initDatatable(){
            var table = $('#kt_datatable_user');

            // console.log(table);
            // begin first table
            let self = this;
            self.table  = table.DataTable({
                responsive: true,
                searchDelay: 500,
                processing: true,
                retrieve: true,
                  destroy: true,
                serverSide: true,
                stateSave: false,
                pageLength: 10,
                rowId: 'refId',
                language: {
                  processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
                },
                ajax: {
                    url: "/superadmin/getUserByCompanyId?company_id=" + self.company.id,
                    type: 'GET',
                    data: {
                        // parameters for custom backend script demo
                        columnsDef: [
                            'id','username','refId',
                            'name', 'email', 'last_login_at','last_login_ip','roles',
                            'status','action'
                        ],
                    },
                },
                initComplete: function(settings, json) {
                    // self.showModal = true;
                    // console.log(json);
                    // console.log(settings);
                    // console.log(settings.aIds(this));

                    $("#kt_datatable_user tbody").on('click', 'a.for-modal', function () {
                        var data = jQuery(self.$refs.kt_datatable_user);
                        // console.log($(this).attr("data-id"));
                        // console.log(data);
                        self.showModal =true;
                        self.mode_status='edit';
                        self.user_id = $(this).attr("data-id");
                        self.username = $(this).attr("data-username");
                        self.name = $(this).attr("data-name");
                        self.role_id = parseInt($(this).attr("data-role"));
                        self.status = parseInt($(this).attr("data-status"));
                        self.mode_status_title = 'เเก้ไขบัญชีผู้ใช้งานของบริษัท ' +  self.company.name;

                      // var data = $("#kt_datatable_user").rows( this ).data();
                      // alert(data);
                  } );
                    // self.$nextTick(() => {
                    //
                    // });

                },
                columns: [
                    {data: 'DT_RowIndex',name: 'DT_Row_Index' , orderable: false, searchable: false, responsivePriority: -1},
                    {data: 'name',width: '25%', responsivePriority: -1},
                    {data: 'username',width: '10%',responsivePriority: 2},
                    {data: 'last_login_at',responsivePriority: 5},
                    {data: 'last_login_ip',responsivePriority: 5},
                    {data: 'roles', width: '15%', orderable: false, searchable: false,responsivePriority: 1},
                    {data: 'status', width: '10%',responsivePriority: 1 },
                    {data: 'action',width: '15%', responsivePriority: -1},
                ],
                columnDefs: [
                    {
                        width: '150px',
                        targets: -1,
                        title: 'action',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return  data;
                        },
                    },
                    {
                        width: '250px',
                        targets: -2,
                        render: function(data, type, full, meta) {
                            var status = {
                                0: {'title': 'Disabled', 'class': ' label-light-danger'},
                                1: {'title': 'Active', 'class': ' label-light-success'},
                            };
                            if (typeof status[data] === 'undefined') {
                                return data;
                            }
                            return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
                        },
                    },
                    {
                        width: '250px',
                        targets: -3,
                        render: function(data, type, full, meta) {
                            var status_ = {
                                "admin": {'title': "ผู้ดูแลระบบ", 'class': ' label-light-warning'},
                                "user": {'title': "เครื่อง EDC", 'class': ' label-light-info'},
                            };
                            if (typeof status_[data[0].name] === 'undefined') {
                                return "";
                            }
                                                        // data.forEach(myFunction);
                            // console.log(status[data[0].name]);
                            return '<label style="width:85px;" class="label font-weight-bold' + status_[data[0].name].class + ' label-inline">' +'<span>'+ status_[data[0].name].title +'</span>'+ '</label>';
                        },
                    }
                ],
                order:[[ 1, 'asc' ]],
            });

        },
        async getRoleNames(){
            try {
                await axios.get('/superadmin/getRoleNames')
                .then(response=>{
                  var option_roles = [];
                  if(response.data.length > 0){
                      var role_type = {
                          "admin": {'title':"ผู้ดูแลระบบ"},
                          "user" : {'title':"เครื่อง EDC"}
                      };
                      $.each(response.data, function (index,role) {

                          option_roles.splice(index, 1,{
                              id:role.id,
                              text:role_type[role.name].title,
                          });
                      });
                      this.option_roles = option_roles;
                  }else{

                  }

                });
            } catch (e) {

            }
        },
        saveData(){
            this.$validator.validate().then(valid => {

              if (valid) {
                  // var company_id = this.conpany_id;

                 axios.post('/superadmin/user/saveDataUserFromCompany',{
                     user_id: this.user_id,
                     username:this.username,
                     password:this.password,
                     name:this.name,
                     company_id:this.conpany_id,
                     role_id: this.role_id,
                     status:this.status,
                     mode_status:this.mode_status
                 })
                 .then(response=>{
                     if(response.data.status_code == 422){
                         var message = response.data.message;
                         if(typeof(message) != "undefined"){
                             if(typeof(message.username) != "undefined"){
                                 this.$validator.errors.add({
                                     field: 'username',
                                       msg: message.username[0],
                                       rule:'required',
                                      vmId:this.$validator.id
                                 });
                                 this.username_duplicate  = response.data.username_duplicate;
                                 this.$refs.username.classList.add('is-valid');
                                 this.$refs.username.classList.add('is-invalid');
                                  // console.log(this.$refs.username.classList.value);
                             }
                         }
                     }else{
                         this.table.ajax.reload();
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
                             title: 'บันทึกข้อมูลบัญชีผู้ใช้งานของบริษัท สำเร็จ'
                         });
                         this.clearData();
                         this.showModal = false;
                     }

                  })
                  .catch(function (resp) {
                      // this.loading = false;
                      // alert("Could not create your delivery order.");
                      // this.loading = true;
                  });
              }
            });
        },
        clearData(){
            this.user_id = '';
            this.username = '';
            this.password = '';
            this.confirm_password = '';
            this.name = '';
            this.mode_status_title ='เพิ่มบัญชีผู้ใช้งานของบริษัท ' + this.company.name;
            this.status = 1;
            this.mode_status="create";
            this.role_id = 3;

        },
    },
    watch: {
        showModal(){
            if(this.showModal == false){
                this.clearData();
                this.table.ajax.reload();
            }else{

            }
        },
        username_duplicate(){
            if(this.username_duplicate != this.username){
                this.$validator.errors.remove({
                    field: 'username',
                });
            }
        }
    }
}
</script>

<style scoped>
.modal-mask {
    position: fixed;
    z-index: 1035; /*** more than menu is 1034 ***/
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}
.modal-body{
  max-height: calc(85vh - 200px) !important;
  overflow-y: auto !important;
}
</style>
