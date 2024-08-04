<template>
    <div class="table-responsive">
        <table class="table table-borderless table-hover table-vertical-center">
            <thead>
                <tr>
                    <th class="pl-0 text-center">ลำดับ</th>
                    <th class="pl-0 ">ชื่อเข้าใช้ระบบ</th>
                    <th v-if="check_type == 'admin'" class="pl-0">ชื่อ - นามสกุล</th>
                    <th v-else class="pl-0 ">ช่องทาง</th>
                    <th class="pl-0 text-center">สถานะ</th>
                    <th v-if="check_type == 'device'" class="pl-0 text-center">เปลี่ยนรหัสผ่าน</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="!items.length">
                    <td v-if="check_type == 'admin'" colspan="4" class="text-center text-danger">ไม่มีข้อมูล</td>
                    <td v-else colspan="5" class="text-center text-danger">ไม่มีข้อมูล</td>
                </tr>
                <tr v-for="(item,i) in items" :key="i">
                    <td class="text-center">{{ i+1 }}</td>
                    <td>{{ item.username }}</td>
                    <td>{{ item.name }}</td>
                    <td class="text-center">
                        <span v-if="item.status == 1" class="label label-lg font-weight-bold label-light-success label-inline">Active</span>
                        <span v-else class="label label-lg font-weight-bold label-light-danger label-inline">Disabled</span>
                    </td>
                    <td v-if="check_type == 'device'" class="text-center">
                        <a href="javascript:;" @click="changePassword(item.id)"><i class="icon-xl fas fa-key"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" id="showModal" ref="mymodal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="showModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form @submit.prevent="saveChangePassword">

                        <div class="modal-header">
                            <h5 class="modal-title" id="showModalLabel">เปลี่ยนรหัสผ่าน</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <i aria-hidden="true" class="ki ki-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="field" :class="{error: errors.has('password')}">
                                <label for="exampleInputPassword1">รหัสผ่าน ใหม่</label>
                                <input type="password" v-validate="'required'" v-model="password" v-bind:class="'form-control '+valid.error" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ยืนยันรหัสผ่านอีกครั้ง</label>
                                <input type="password" v-validate="'required'" v-model="re_password" v-bind:class="'form-control '+valid.error" placeholder="Confirm Password">
                                <div v-if="valid.error" class="invalid-feedback">รหัสผ่านไม่ตรงกัน</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">ยกเลิก</button>
                            <input type="submit" class="btn btn-primary font-weight-bold" value="บันทึก เปลี่ยนรหัสผ่าน">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>
<script>
export default {
    data(){
        return{
            check_type: '',
            items: [],
            showModal: true,
            password: '',
            re_password: '',
            user_id: '',
            valid:{
                error: '',
            }
        }
    },
    props: ['type'],
    created(){
        this.check_type = this.type
        this.showUsers();
    },
    methods:{
        showUsers(){
            try {
                Vue.axios.get('/admin/users/'+this.check_type,{
                    params:{
                        user_id: this.user_id,
                        search: this.quickSearch,
                    }
                })
                .then((response) => {
                    if(response.data.status_code === 200){
                        this.items = response.data.data;
                    }else{
                        this.items = [];
                    }
                });
            }catch (ex) {
                console.log(ex);
                this.items = [];
            }
        },
        changePassword(id){
            this.user_id = id
            $('#showModal').modal('show')
        },
        async saveChangePassword(){
            let result = await this.$validator.validateAll()
            if(result) {
            
                if(this.password != this.re_password){
                    this.valid.error = 'is-invalid'
                }else{
                    this.valid.error = ''
                    Vue.axios.put('/admin/users/changepassword',{
                        _method: 'PUT',
                        user_id: this.user_id,
                        password: this.password,
                    })
                    .then((response) => {

                        if(response.data.status_code == 200){
                            this.$swal('สำเร็จ','เปลี่ยนรหัสผ่านสำเร็จ!!!');
                            this.user_id = '';
                            $('#showModal').modal('hide')
                        }else{
                            this.$swal('ผิดพลาด','ไม่สามารถเปลี่ยนรหัสผ่านได้!!!');
                            this.user_id = '';
                            $('#showModal').modal('hide')
                        }
                    });
                }
            }
        }
        
    }
}
</script>