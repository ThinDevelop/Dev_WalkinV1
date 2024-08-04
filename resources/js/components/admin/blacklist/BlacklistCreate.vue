<template>
    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
        <div class="col-xl-12 col-xxl-10">
            <div class="col-12">
                <div class="justify-content-start col-12">
                    <!--begin::Wizard Step 1-->
                    <h4 class="text-dark font-weight-bold mb-10"> รายละเอียดผู้ถูกแบล็กลิสต์ </h4>
                    <div class="row justify-content-center">
                        <div class="col-10">
                            <div class="step">

                                <!--begin::Group idCard -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">หมายเลขบัตร :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    v-bind:class="'form-control form-control-solid form-control-lg '"
                                                    placeholder="หมายเลขบัตร"
                                                    name="idcard"
                                                    type="text"
                                                    v-model="idcard"
                                                />
                                            </div>
                                        </div>
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                                <!--end::Group idCard -->
        
                                <!--begin::Group Fullname -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ-นามสกุล :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    v-bind:class="'form-control form-control-solid form-control-lg ' +valid.fullname"
                                                    placeholder="ชื่อ"
                                                    name="fullname"
                                                    type="text"
                                                    v-model="fullname"
                                                />
                                            </div>
                                        </div>
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                                <!--end::Group Fullname -->
        
                                <!--begin::Group  Address -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ที่อยู่ :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <textarea
                                                    v-bind:class=" 'form-control form-control-solid form-control-lg '"
                                                    placeholder="ที่อยู่"
                                                    name="address"
                                                    v-model="address"
                                                    rows="5"
                                                    cols="200"
                                                ></textarea>
                                                <div class="fv-plugins-message-container"></div>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group-->
        
                                <!--begin::Group  Address  -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ทะเบียนรถ :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    v-bind:class=" 'form-control form-control-solid form-control-lg '"
                                                    placeholder="ทะเบียนรถ"
                                                    name="car_registration"
                                                    type="text"
                                                    v-model="car_registration"/>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group Vechicle -->
        
                                <!--begin::Group  From  -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">มาจาก :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    v-bind:class=" 'form-control form-control-solid form-control-lg '"
                                                    placeholder="มาจาก"
                                                    name="from"
                                                    type="text"
                                                    v-model="from"
                                                />
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group From -->
        
                                <!--begin::Group  Note-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">สาเหตุ :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    v-bind:class=" 'form-control form-control-solid form-control-lg ' +valid.note"
                                                    placeholder="สาเหตุ"
                                                    name="note"
                                                    type="text"
                                                    v-model="note"
                                                />
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group Note -->
        
                                <!--begin::Group  Image_Blacklist-->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label"> แนบรูปภาพ :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    @change="selectFile"
                                                    v-bind:class="'form-control form-control-solid form-control-lg '"
                                                    name="image_blacklist_id"
                                                    type="file"
                                                />
                                                <!-- <span v-if="errors.has('image_blacklist_id')" class="form-text text-danger">{{ errors.first('image_blacklist_id') }}</span> -->
                                                <div class="fv-plugins-message-container"></div>
                                                <img v-if="imageUrl" :src="imageUrl" alt="Preview" style="max-width: 100%; margin-top: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group Image_Blacklist -->
                            </div>
                        </div>
                    </div>
                    <!--begin::Wizard Actions-->
                    <div class="d-flex justify-content-between border-top mt-5 pt-5 col-12">
                        <div class="mr-2"></div>
                        <div>
                            <a href="/admin/blacklist" class="btn btn-danger font-weight-bolder px-auto py-2 mr-1" style="width: 150px; font-size: 16px;">ย้อนกลับ</a>
                            <button @click="saveData" type="button" class="btn btn-success font-weight-bolder py-2 ml-1" style="width: 150px; font-size:16px">บันทึก</button>
                        </div>
                    </div>
                    <!--end::Wizard Actions-->
                </div>
            </div>
            <!--end::Wizard Form-->
        </div>
    </div>
</template>

<script>
// import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
// import VueTimepicker from 'vue2-timepicker';

export default {
    data() {
        return {
            idcard: '',
            fullname: '',
            address: '',
            car_registration: '',
            from: '',
            note: '',
            image_blacklist_id: '',
            valid: {
                fullname: '',
                note: '',
            },
            imageUrl: null
        };
    },

    props: {
        url: {
            type: String,
            required: true
        }
    },

    mounted() {
    },
    methods: {

        openModal(event) {
            event.preventDefault(); // ป้องกันการเกิดเหตุการณ์เดิมของลิงก์
            this.showModal = true; // เปิด Modal
        },

        async sendMessage() {
            let formData = new FormData();
            formData.append('linetoken', this.linetoken);

            try {
                let response = await axios.post('/admin/send-message', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                });

                let thaiMessages = {
                    200: 'ส่งข้อความสำเร็จ!',
                    400: 'คำขอไม่ถูกต้อง!',
                    422: 'กรุณากรอก Token',
                    401: 'รหัส Token ไม่ถูกต้อง!',
                    500: 'เกิดข้อผิดพลาดจากเซิร์ฟเวอร์!',
                    default: 'เกิดข้อผิดพลาด กรุณาแจ้งเจ้าหน้าที่!'
                };

                let message = thaiMessages[response.data.status_code] || thaiMessages.default;
                if(response.data.status_code != 200){
                    this.valid.linetoken = 'is-invalid'

                    // แสดง Swal ด้วยข้อความที่ได้
                    this.$swal({
                        title: 'ผิดพลาด',
                        text: message,
                        icon: 'error',
                        confirmButtonText: 'ตกลง',
                    });
                } else {
                    // แสดง Swal ด้วยข้อความที่ได้
                    this.$swal({
                        title: 'สำเร็จ',
                        text: message,
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                    });
                }
            } catch (error) {
                console.error(error);
                this.$swal({
                    title: 'ผิดพลาด',
                    text: 'เกิดข้อผิดพลาดในการส่งข้อความ!',
                    icon: 'error',
                    confirmButtonText: 'ตกลง',
                });
            }
        },

        selectFile(event) {
            const file = event.target.files[0];
            this.imageUrl = URL.createObjectURL(file);

            // `files` is always an array because the file input may be in multiple mode
            if (typeof event.target.files[0] != 'undefined') {
                this.image_blacklist_id = event.target.files[0];
            } else {
                this.image_blacklist_id = '';
            }
            // const file = event.target.files[0];
            // if (!file) return; // ถ้าไม่ได้เลือกไฟล์ให้หยุดการทำงานทันที

            // // เช็คประเภทของไฟล์
            // const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
            // if (!validImageTypes.includes(file.type)) {
            // this.errors.add({ field: 'image_type', msg: 'The image type must be JPEG, PNG, JPG, or GIF.' });
            // return;
            // }

            // เช็คขนาดของไฟล์
            const maxSize = 2048; // ขนาดสูงสุดเป็น KB (2MB)
            if (file.size > maxSize * 1024) {
                this.errors.add({ field: 'image_blacklist_id', msg: 'The image size must not exceed 2MB.' });
                return;
            }

            // อ่านข้อมูลของไฟล์ภาพและแสดงตัวอย่างรูปภาพ
            const reader = new FileReader();
                reader.onload = () => {
                this.imageUrl = reader.result;
            };
            reader.readAsDataURL(file);
        },

        saveData() {
            this.$validator.validate().then(valid => {
                if (valid) {
                    let formData = new FormData();
                    formData.append('idcard', this.idcard);
                    formData.append('fullname', this.fullname);
                    formData.append('address', this.address);
                    formData.append('car_registration', this.car_registration);
                    formData.append('from', this.from);
                    formData.append('note', this.note);
                    if (this.image_blacklist_id) {
                        formData.append('image_blacklist_id', this.image_blacklist_id);
                    }

                    this.valid.fullname = '';
                    this.valid.note = '';

                    axios
                        .post('/admin/blacklist', formData, {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(response => {
                            this.valid.fullname = 'is-valid';
                            this.valid.note = 'is-valid';

                            if (response.data.status_code == 422) {
                                var message = response.data.message;

                                if (message.fullname) {
                                    this.valid.fullname = 'is-invalid';
                                }

                                if (message.note) {
                                    this.valid.note = 'is-invalid';
                                }

                                this.$swal(
                                    'ผิดพลาด',
                                    'กรุณากรอกข้อมูลให้ครบทุกช่องและถูกต้อง!!!',
                                    'error'
                                );

                            } else if (response.data.status_code == 200) {
                                this.$swal({
                                    title: 'สำเร็จ',
                                    text: 'สร้างแบล็กลิสต์สำเร็จ',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = '/admin/blacklist';
                                    }
                                });
                            } else {
                                this.$swal(
                                    'ผิดพลาด',
                                    'ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่!!!',
                                    'error'
                                );
                                this.valid.fullname = 'is-invalid';
                                this.valid.note = 'is-invalid';
                            }
                        });
                }
            });
        }
    }
};
</script>

<style scoped>
.modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    z-index: 100;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    position: relative; /* เพิ่ม line นี้เพื่อให้ position:absolute ใน .close มีผล */
}

.close {
    color: #aaa;
    position: absolute;
    top: 0;
    right: 0;
    margin: 20px;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>
