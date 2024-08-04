<template>
    <div>
        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-10">
                    <div class="row justify-content-center">
                        <div class="col-xl-9">
                            <!--begin::Wizard Step 1-->
                            <div class="my-5 step" >
                                <h5 class="text-dark font-weight-bold mb-10">รายละเอียดบัญชีผู้ดูแลระบบ:</h5>
                                <!--begin::Group-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ชื่อเข้าใช้ระบบ *</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <label class="col-form-label">{{ username }}</label>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::password-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">รหัสผ่าน *</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input v-bind:class="'form-control form-control-solid form-control-lg '+valid.password" name="passsword" type="password" v-model="password">
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::re password-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ยืนยันรหัสผ่าน *</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input v-bind:class="'form-control form-control-solid form-control-lg '+valid.re_password" name="re-passsword" type="password" v-model="re_password">
                                        <!-- <span class="form-text text-success">Validate text</span> -->
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ-สกุล</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <input v-bind:class="'form-control form-control-solid form-control-lg '+valid.name" name="name" type="text" v-model="name">
                                        <!-- <span class="form-text text-success">Validate text</span> -->
                                        <!-- <div class="fv-plugins-message-container"></div> -->
                                    </div>
                                </div>
                                <!--end::Group-->

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
                            </div>

                            <!--begin::Wizard Actions-->
                            <div class="d-flex justify-content-between border-top pt-10 mt-15">
                                <div class="mr-2"></div>
                                <div>
                                    <a href="/superadmin/user" class="btn btn-danger font-weight-bolder px-4 py-2" >ย้อนกลับ</a>
                                    <button type="button" @click="updateUser()" class="btn btn-success font-weight-bolder px-4 py-2" >บันทึก</button>
                                </div>
                            </div>
                            <!--end::Wizard Actions-->
                        </div>
                    </div>
                <!--end::Wizard Form-->
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
export default{

    data(){
      return{
            id: '',
            username: '',
            password: '',
            re_password:'',
            name: '',
            status: '',
            valid:{
                username: '',
                password: '',
                re_password: '',
                name: '',
            },
            error:{
                username: '',
            }
        }
    },
    props: ['user'],
    created(){
        var obj = JSON.parse(this.user)
        this.id = obj.id;
        this.username = obj.username;
        this.name = obj.name;
        if(obj.status == 1){
            this.status = true;
        }else{
            this.status = false;
        }
    },
    methods:{
        updateUser(){
            var is_error = false;

            if(this.username == ''){
                is_error = true;
                this.valid.username = 'is-invalid';
            }else{
                is_error = false;
                this.valid.username = 'is-valid';
            }

            if(this.password !=""  || this.re_password !=""){
                 if(this.password != this.re_password){
                    is_error = false;
                    this.valid.password = 'is-invalid'
                    this.valid.re_password = 'is-invalid'
                }else{
                    this.valid.password = 'is-valid';
                    this.valid.re_password = 'is-valid';
                }
            }

            if(this.name == ''){
                is_error = true;
                this.valid.name = 'is-invalid';
            }else{
                is_error = false;
                this.valid.name = 'is-valid';
            }

            if(is_error == true){
                this.$swal('ผิดพลาด','กรุณากรอกข้อมูลให้ครบทุกช่อง!!!');
                return false;
            }

             Vue.axios.put('/superadmin/user/'+this.id,{
                _method: 'PUT',
                name: this.name,
                username: this.username,
                password: this.password,
                status: this.status,
            })
            .then((response) => {
                
                if(response.data.status_code == 422){
                    var message = response.data.message;
                    if(message.username != ''){
                        this.error.username = message.username[0]
                        this.valid.username = 'is-invalid';
                    }else{
                        this.valid.username = 'is-valid';
                    }
                   
                }else if(response.data.status_code == 200){
                    location.href = '/superadmin/user'
                }else{
                    this.$swal('ผิดพลาด','ไม่สามารถแก้ไข ข้อมูลได้ กรุณาลองอีกครั้ง!!!');
                    this.valid.username = 'is-invalid'
                    this.valid.name = 'is-invalid'
                }
            });
        }
    }
    
}
</script>

<style lang="css" scoped>
</style>
