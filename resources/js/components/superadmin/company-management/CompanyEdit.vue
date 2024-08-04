<template>
    <div>
        <div class="row justify-content-center py-7 px-7 py-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-12">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <!--begin::Wizard Step 1-->
                        <div class="my-5 step">
                            <h5 class="text-dark font-weight-bold mb-10">รายละเอียดบริษัท</h5>

                            <!--begin::Group  is-valid is-invalid-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">รหัสบริษัท :</label>
                                <div class="col-lg-9 col-xl-9">
                                    <label class="col-form-label">{{mid}}</label>
                                </div>
                            </div>

                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">ชื่อบริษัท :</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input
                                        v-bind:class="'form-control form-control-solid form-control-lg ' +valid.name"
                                        name="companyname"
                                        type="text"
                                        v-model="name"
                                    />
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">เบอร์โทรศัพท์ :</label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="la la-phone"></i>
                                        </span>
                                        <input
                                            type="text"
                                            v-bind:class="'form-control form-control-solid form-control-lg ' +valid.phone"
                                            name="phone"
                                            v-model="phone"
                                            placeholder=""
                                        />
                                    </div>
                                    <span class="form-text text-muted">ตัวอย่าง (e.g: 08123456789).</span>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">อีเมล :</label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="la la-at"></i>
                                        </span>
                                        <input
                                            type="text"
                                            v-bind:class="'form-control form-control-solid form-control-lg ' +valid.email"
                                            name="email"
                                            v-model="email"
                                        />
                                    </div>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">ที่อยู่ :</label>
                                <div class="col-lg-9 col-xl-9">
                                    <textarea
                                        v-bind:class="'form-control form-control-solid form-control-lg ' +valid.address"
                                        name="address"
                                        v-model="address"
                                        rows="5"
                                        cols="200"
                                    ></textarea>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::Group-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">โลโก้บริษัท :</label>
                                <div class="col-lg-9 col-xl-9">
                                    <input
                                        @change="selectFile"
                                        v-bind:class="'form-control form-control-solid form-control-lg ' +valid.logo"
                                        name="logo"
                                        type="file"
                                    />
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>
                            <!--end::Group-->

                            <!--begin::pdpa-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">พรบ.คุ้มครองข้อมูลส่วนบุคคล :</label>
                                <div class="col-lg-9 col-xl-9 my-auto col-form-label">
                                    <textarea 
                                        v-bind:class="'form-control form-control-solid form-control-lg ' +valid.pdpa" 
                                        name="pdpa"
                                        rows="10"
                                        v-model="pdpa" 
                                        cols="200" 
                                        placeholder="นโยบายคุ้มครองข้อมูลส่วนบุคคลฉบับนี้ (นโยบายฉบับนี้) จัดทำขึ้นโดยบริษัท คเชนทร์ ดิจิทัล จำกัด (บริษัท) โดยนโยบายฉบับนี้มีวัตถุประสงค์ใช้สำหรับบุคคลดังต่อไปนี้ ผู้ซึ่งซื้อสินค้าหรือบริการจากบริษัททั้งหน่วยงานภาครัฐและเอกชน รวมถึงบุคคลธรรมดาที่มาติดต่อและใช้บริการหรือบุคคลทั้งหลายซึ่งท่านเก็บหรือรักษาข้อมูลส่วนบุคคลไว้เนื่องมาจากการดำเนินการผ่านระบบบันทึกผู้มาติดต่อพร้อมเครื่องบันทึกผู้มาติดต่อในกรณีที่ท่านเลือกการติดตั้งโปรแกรมบันทึกผู้มาติดต่อในรูปแบบเช่าพื้นที่วางระบบ (Server) "
                                        style="text-align: justify; text-justify: inter-word;"
                                    ></textarea>
                                </div>
                            </div>
                            <!--end::pdpa-->

                            <!--begin::line-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label my-auto">Line Token (แบล็กลิสต์) :</label>
                                <div class="col-lg-4 col-xl-4 col-form-label">
                                    <input type="text" v-bind:class="'form-control form-control-solid form-control-lg ' + valid.linetoken" name="linetoken" v-model="linetoken" placeholder=""/>
                                </div>
                                <div class="col-lg-auto col-xl-auto col-form-label my-auto p-0">
                                    <button class="btn btn-secondary font-weight-bolder px-4 py-2" type="button" @click="sendMessage">Test</button>
                                </div>
                            </div>

                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label my-auto"></label>
                                <div class="col-lg-9 col-xl-9 col-form-label">
                                    <p style="text-align: justify;">
                                        By connecting to LINE Notify, LINE users will be able to receive notifications from various services. easily After completing the connection to the web service You will receive a notification. from the official account "LINE Notify" and also receive group notifications.
                                    </p>
                                    <br>
                                    <!-- Link -->
                                    <a href="#" @click="openModal($event)">+ How to add LINE Notify to groups</a>
                                    <!-- Modal -->
                                    <div class="modal" v-if="showModal">
                                        <div class="modal-content">
                                            <span class="close" @click="showModal = false">&times;</span>
                                            <img :src="lineImage" alt="คำอธิบายของรูปภาพ">
                                        </div>
                                    </div>

                                    <br>
                                    <!-- <a :href="downloadUrl" download="Test.pdf">+ Guide to Adding LINE Notify to Groups</a> -->
                                </div>
                            </div>
                            <!--begin::Group-->

                            <div class="form-group row fv-plugins-icon-container" >
                                <label class="col-xl-3 col-lg-3 col-form-label" >สถานะ :</label >
                                <div class="col-lg-9 col-xl-9">
                                    <span class="switch switch-icon switch-brand" >
                                        <label>
                                            <input
                                                type="checkbox"
                                                v-model="status1"
                                                name="status"
                                            />
                                            <span></span>
                                        </label>
                                    </span>
                                    <div
                                        class="fv-plugins-message-container"
                                    ></div>
                                </div>
                            </div>

                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label">ฟังก์ชันพิเศษ :</label>
                                <div class="col-lg-9 col-xl-9">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3">
                                            <label class="col-form-label">คิดค่าจอดรถ :</label>
                                        </div>
                                        <div class="col-xl-7 col-lg-7">
                                            <span class="switch switch-icon switch-brand">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        v-model="status2"
                                                        name="status2"
                                                    />
                                                    <span></span>
                                                </label>
                                            </span>
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-3 col-lg-3 col-form-label"></label>
                                <div class="col-lg-9 col-xl-9" v-show="status2">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-3">
                                            <label class="col-form-label">ระบุรหัสพร้อมเพย์ :</label>
                                        </div>
                                        <div class="col-xl-7 col-lg-7">
                                            <label>
                                                <input v-bind:class="[ 'form-control form-control-solid form-control-lg', valid.prompay ]" name="prompay" type="text" v-model="prompay" placeholder="ตัวอย่าง 0891234567" />
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row fv-plugins-icon-container" v-show="status2">
                                <label class="col-xl-3 col-lg-3 my-auto col-form-label">เวลาการใช้งานฟังก์ชันพิเศษ :</label>
                                <div class="col-lg-9 col-xl-9 my-auto">
                                    <div class="row" style="height: 40px;">
                                        <div class="col-lg-5 col-xl-5 radio-inline">
                                            <label class="col-auto radio radio-lg pl-0">
                                                <input
                                                    type="radio"
                                                    value="all"
                                                    name="select_type"
                                                    checked
                                                    onchange=""
                                                    v-model="selectedContract"/>
                                                <span></span>
                                                ซื้อขาด
                                            </label>
                                            <label class="col-auto radio radio-lg pl-0">
                                                <input
                                                    type="radio"
                                                    value="time"
                                                    name="select_type"
                                                    onchange=""
                                                    v-model="selectedContract"
                                                />
                                                <span></span>
                                                กำหนดวัน
                                            </label>
                                        </div>
                                        <div class="col-lg-3 col-xl-3 px-0" v-show="selectedContract == 'time'">
                                            <date-picker
                                                v-model="selectedDate1"
                                                :format="dateFormat1"
                                                v-bind:input-class="'form-control form-control-solid form-control-lg ' + valid.selectedDate1"
                                                placeholder="เลือกวันที่"
                                                style="width: 100%;"
                                                value-type="format"
                                            >
                                                <template v-slot:icon-calendar>
                                                    <i class="mx-icon-calendar" style="display: none;"></i>
                                                </template>
                                            </date-picker>
                                        </div>
                                        <p class="col-lg-1 col-xl-1 m-auto text-center" v-show="selectedContract == 'time'">ถึง</p>
                                        <div class="col-lg-3 col-xl-3 px-0" v-show="selectedContract == 'time'">
                                            <date-picker
                                                v-model="selectedDate2"
                                                :format="dateFormat2"
                                                v-bind:input-class="'form-control form-control-solid form-control-lg ' + valid.selectedDate2"
                                                placeholder="เลือกวันที่"
                                                style="width: 100%;"
                                                value-type="format"
                                            >
                                            <template v-slot:icon-calendar>
                                                <i class="mx-icon-calendar" style="display: none;">
                                                </i>
                                            </template>
                                            </date-picker>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Group-->
                        </div>
                        <!--end::Wizard Step 1-->
                        <!--begin::Wizard Actions-->
                        <div class="d-flex justify-content-between border-top pt-10 mt-15">
                            <div class="mr-2"></div>
                            <div>
                                <a href="/superadmin/company" class="btn btn-danger font-weight-bolder px-4 py-2">ย้อนกลับ</a>
                                <button @click="updateData" type="button" class="btn btn-success font-weight-bolder px-4 py-2">บันทึก</button>
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

export default {
    data() {
        return {
            id: '',
            mid: '',
            name: '',
            address: '',
            phone: '',
            email: '',
            logo: '',
            logo_base64: '',
            logo_url: '',
            status1: true,
            special: true,
            status2: false,
            prompay: '',
            selectedContract: 'all',
            timespecial: true,
            linetoken: '',
            pdpa: '',
            valid: {
                name: '',
                address: '',
                phone: '',
                email: '',
                prompay: '',
                selectedDate1: '',
                selectedDate2: '',
                linetoken: '',
                pdpa: '',
            },
            selectedDate1: '',
            selectedDate2: '',
            dateFormat1: 'YYYY-MM-DD',
            dateFormat2: 'YYYY-MM-DD',

            lineImage: "/images/GuildLineNotify.png",
            showModal: false,
            downloadUrl: '/download-pdf/Test.pdf',
        };
    },
    props: ['company'],
    created() {
        var obj = JSON.parse(this.company);
        // console.log(obj);
        this.id = obj.id;
        this.mid = obj.mid;
        this.name = obj.name;
        this.address = obj.address;
        this.phone = obj.phone;
        this.email = obj.email;
        this.logo_url = obj.logo;
        this.linetoken = obj.line_token != null && typeof obj.line_token !== 'undefined' ? obj.line_token : '';
        if(obj.pdpa != null){
            if(obj.pdpa.pdpa != null || obj.pdpa.pdpa != ""){
                this.pdpa = obj.pdpa.pdpa;
            } 
        }
        if (obj.status == 1) {
            this.status1 = true;
        } else {
            this.status1 = false;
        }

        if(obj.promptpay != null){
            this.prompay = obj.promptpay;
        } else {
            this.prompay = "";
        }

        if(obj.contract_vechicles != null){
            this.selectedContract = obj.contract_vechicles.vechicle_function_id == 1 ? "all" : "time";
            this.selectedDate1 = obj.contract_vechicles.start_date;
            this.selectedDate2 = obj.contract_vechicles.end_date;
        }

        if (obj.status_vechicle == 1) {
            this.status2 = true;
        } else {
            this.status2 = false;
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
                let response = await axios.post('/superadmin/send-message', formData, {
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

        getLogo() {
            var photo = '';

            if (
                !this.isFileImage(this.logo_base64) &&
                this.logo_url.length < 100 &&
                this.logo_url != ''
            ) {
                photo = '../../../' + this.logo_url;
                console.log('in 1-----' + photo);
            } else if (
                this.isFileImage(this.logo_base64) &&
                this.logo_url.length > 100
            ) {
                photo = this.logo_base64;
                console.log('in 2-----' + photo);
            } else {
                photo = '../../../images/noimage.png';
                console.log('in 3-----' + photo);
            }
            // if((this.logo.length > 0) && (this.logo.length < 100)){
            //   photo = "../../../" + this.logo;
            // }else if ((this.logo_base64.length > 100)){
            //   photo = this.logo_base64;
            // }
            // console.log("photo---" + photo);
            return photo;
        },

        selectFile(event) {
            // `files` is always an array because the file input may be in multiple mode
            if (typeof event.target.files[0] != 'undefined') {
                var file = event.target.files[0];
                var reader = new FileReader();
                if (this.isFileType(file)) {
                    reader.onloadend = file => {
                        this.logo_base64 = reader.result;
                    };
                    reader.readAsDataURL(file);
                    this.logo = event.target.files[0];
                } else {
                    this.logo = '';
                    this.logo_base64 = '../../../images/noimage.png';
                }
            } else {
                this.logo = '';
                this.logo_base64 = '../../../images/noimage.png';
            }
            // console.log(this.logo);
        },

        isFileType(file) {
            // console.log("file type---" + file);
            return file && file['type'].split('/')[0] === 'image';
        },

        isFileImage(file) {
            // console.log("isFileImage---" + file);
            return file && file.split('/')[0] === 'data:image';
        },

        updateData() {
            let formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('mid', this.mid);
            formData.append('name', this.name);
            formData.append('address', this.address);
            formData.append('phone', this.phone);
            formData.append('email', this.email);
            formData.append('status1', this.status1);
            formData.append('linetoken', this.linetoken);
            formData.append('special', this.special);
            formData.append('prompay', this.prompay);
            formData.append('status2', this.status2);
            formData.append('selectedContract', this.selectedContract);
            formData.append('timespecial', this.timespecial);
            formData.append('selectedDate1', this.selectedDate1);
            formData.append('selectedDate2', this.selectedDate2);
            formData.append('pdpa', this.pdpa != "" ? this.pdpa : null );
            if (this.logo) {
                formData.append('logo', this.logo);
            }

            // console.log(this.status);

            this.valid.name = '';
            this.valid.address = '';
            this.valid.phone = '';
            this.valid.email = '';
            this.valid.prompay = '';
            this.valid.selectedDate1 = '';
            this.valid.selectedDate2 = '';
            this.valid.linetoken = '';
            this.valid.pdpa = '';

            axios
                .post('/superadmin/company/' + this.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        enctype: 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.valid.name = 'is-valid';
                    this.valid.address = 'is-valid';
                    this.valid.phone = 'is-valid';
                    this.valid.email = 'is-valid';
                    if(this.status2){
                        this.valid.prompay = 'is-valid';
                        if(this.selectedContract == "time"){
                            this.valid.selectedDate1 = 'is-valid';
                            this.valid.selectedDate2 = 'is-valid';
                        }
                    }
                    // this.valid.linetoken = 'is-valid';
                    // this.valid.pdpa = 'is-valid';

                    if (response.data.status_code == 422) {
                        var message = response.data.message;

                        if (message.name) {
                            this.valid.name = 'is-invalid';
                        }

                        if (message.address) {
                            this.valid.address = 'is-invalid';
                        }

                        if (message.phone) {
                            this.valid.phone = 'is-invalid';
                        }

                        if (message.email) {
                            this.valid.email = 'is-invalid';
                        }

                        if(this.status2){
                            if (message.prompay) {
                                this.valid.prompay = 'is-invalid';
                            }
                            if(this.selectedContract == "time"){
                                if (message.selectedDate1) {
                                    this.valid.selectedDate1 = 'is-invalid';
                                }
                                if (message.selectedDate2) {
                                    this.valid.selectedDate2 = 'is-invalid';
                                }
                            }
                        }

                        // if (message.linetoken) {
                        //     this.valid.linetoken = 'is-invalid';
                        // }
                        
                        // if (message.pdpa) {
                        //     this.valid.pdpa = 'is-invalid';
                        // }

                        this.$swal(
                            'ผิดพลาด',
                            'กรุณากรอกข้อมูลให้ครบทุกช่องและถูกต้อง!!!',
                            'error'
                        );
                    } else if (response.data.status_code == 200) {
                        this.$swal({
                            title: 'สำเร็จ',
                            text: 'แก้ไขบริษัทสำเร็จ',
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '/superadmin/company';
                            }
                        });
                    } else if(response.data.status_code == 422){
                    } else {
                        this.$swal(
                            'ผิดพลาด',
                            'ไม่สามารถแก้ไข ข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่!!!',
                            'error'
                        );
                        this.valid.name = 'is-invalid';
                        this.valid.address = 'is-invalid';
                        this.valid.phone = 'is-invalid';
                        this.valid.email = 'is-invalid';
                        this.valid.prompay = 'is-invalid';
                        this.valid.selectedDate1 = 'is-invalid';
                        this.valid.selectedDate2 = 'is-invalid';
                        this.valid.linetoken = 'is-invalid';
                        this.valid.pdpa = 'is-invalid';
                    }
                }).catch(error => {
                    console.error(error); // แสดง error ถ้ามีปัญหาในการเรียก API
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
