<template>
    <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
        <div class="col-xl-12 col-xxl-10">
            <div class="col-12">
                <div class="justify-content-start col-12">
                    <!--begin::Wizard Step 1-->
                    <h4 class="text-dark font-weight-bold mb-10">รายละเอียดผู้ถูกแบล็กลิสต์</h4>
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
                                                    placeholder="บัตรประชาชน"
                                                    name="idcard"
                                                    type="text"
                                                    v-model="idcard"
                                                    readonly
                                                />
                                            </div>
                                        </div>
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                                <!--end::Group idCard -->

                                <!--end::Group Fullname -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ-นามสกุล :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    placeholder="ชื่อ"
                                                    name="fullname"
                                                    type="text"
                                                    v-model="fullname"
                                                    readonly
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
                                                    class="form-control form-control-solid form-control-lg"
                                                    placeholder="ที่อยู่"
                                                    name="address"
                                                    type="text"
                                                    v-model="address"
                                                    rows="5"
                                                    cols="200"
                                                    readonly
                                                ></textarea>
                                            </div>
                                        </div>
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                                <!--end::Group Address -->

                                <!--begin::Group  Car Registration  -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">ทะเบียนรถ :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    placeholder="ทะเบียนรถ"
                                                    name="car_registration"
                                                    type="text"
                                                    v-model="car_registration"
                                                    readonly
                                                />
                                            </div>
                                        </div>
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                                <!--end::Group Car Registration -->

                                <!--begin::Group  From  -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">มาจาก :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    class="form-control form-control-solid form-control-lg"
                                                    placeholder="มาจาก"
                                                    name="from"
                                                    type="text"
                                                    v-model="from"
                                                    readonly
                                                />
                                            </div>
                                        </div>
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                                <!--end::Group From -->

                                <!--begin::Group  Note -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label">สาเหตุ :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <input
                                                    v-bind:class='"form-control form-control-solid form-control-lg " + valid.note'
                                                    placeholder="สาเหตุ"
                                                    name="note"
                                                    type="text"
                                                    v-model="note"
                                                />
                                            </div>
                                        </div>
                                        <div class="fv-plugins-message-container"></div>
                                    </div>
                                </div>
                                <!--end::Group Note -->

                                <!--begin::Group Images -->
                                <div class="form-group row fv-plugins-icon-container">
                                    <label class="col-xl-3 col-lg-3 col-form-label"> แนบรูปภาพ :</label>
                                    <div class="col-lg-9 col-xl-9">
                                        <div class="row">
                                            <div class="col-lg-9 col-xl-9">
                                                <!-- แสดงตัวอย่างรูปภาพ -->
                                                <img v-if="image_url" :src="url + '/' + image_url" alt="Preview" style="max-width: 100%; margin-top: 10px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group Images -->
                            </div>
                        </div>
                        <!--end::Wizard Step 1-->

                        <!--begin::Wizard Actions-->
                        <div class="d-flex justify-content-between border-top mt-5 pt-5 col-12">
                            <div class="mr-2"></div>
                            <div>
                                <a href="/admin/blacklist" class="btn btn-danger font-weight-bolder px-auto py-2 mr-1" style="width: 150px; font-size: 16px;">ย้อนกลับ</a>
                                <button @click="updateData()" type="button" class="btn btn-success font-weight-bolder py-2 ml-1" style="width: 150px; font-size:16px">บันทึก</button>
                            </div>
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
export default {
    data() {
        return {
            id: '',
            idcard:'',
            fullname: '',
            address: '',
            car_registration: '',
            from: '',
            note: '',
            image_url: '',
            valid: {
                note: '',
            }
        };
    },
    props: {
        blacklist: {
            type: String,
            required: true
        },
        url: {
            type: String,
            required: true
        }
    },
    created() {
        var obj = JSON.parse(this.blacklist);
        this.id = obj.id;
        // this.idcard = obj.idcard;
        if (obj.idcard && obj.idcard.length === 13 && /^\d+$/.test(obj.idcard)) {
            this.idcard = obj.idcard.substring(0, 3) + 'XXXXXXX' + obj.idcard.substring(10);
        } else {
            this.idcard = '-----';
        }
        this.fullname = obj.fullname;
        this.address = obj.address;
        this.car_registration = obj.car_registration;
        this.from = obj.from;
        this.note = obj.note;
        if (obj.image_url) {
            this.image_url = obj.image_url;
        } else {
            this.image_url = 'images/noimage.png';
        }
    },
    mounted() {},
    methods: {
        updateData() {
            let formData = new FormData();
            formData.append('_method', 'PATCH');
            formData.append('note', this.note);
            this.valid.note = '';
            axios
                .post('/admin/blacklist/' + this.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        enctype: 'multipart/form-data'
                    }
                })
                .then(response => {
                    this.valid.note = 'is-valid';
                    if (response.data.status_code == 422) {
                        var message = response.data.message;

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
                            text: 'แก้ไขบริษัทสำเร็จ',
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
                            'ไม่สามารถแก้ไข อัพเดทข้อมูล กรุณาติดต่อเจ้าหน้าที่!!!',
                            'error'
                        );
                    }
                }).catch(error => {
                    console.error(error); // แสดง error ถ้ามีปัญหาในการเรียก API
                });
        }
    }
};
</script>

<style></style>
