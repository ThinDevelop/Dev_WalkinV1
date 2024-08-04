<template>
    <div>
        <div class="row justify-content-center py-7 px-7 py-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-12">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <form @submit.prevent="submitForm">

                            <!--begin::Wizard Step 1-->
                            <div class="my-5 step">
                                <h5 class="text-dark font-weight-bold mb-10">รายละเอียดการนัดหมาย</h5>
                                    <!--begin::Group-->
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">ชื่อ-นามสกุล (*) :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <input v-bind:class="'form-control form-control-solid form-control-lg ' +valid.name" placeholder="ชื่อ" id="formData.name" type="text" v-model="formData.name" readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <input v-bind:class="'form-control form-control-solid form-control-lg ' +valid.lastname" placeholder="นามสกุล" id="formData.lastname" type="text" v-model="formData.lastname" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">ช่องทางติดต่อ (*) :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="la la-phone"></i>
                                                        </span>
                                                        <input type="text" v-bind:class="'form-control form-control-solid form-control-lg ' +valid.phone" placeholder="เบอร์โทรศัพท์" id="formData.phone" v-model="formData.phone" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="la la-at"></i>
                                                        </span>
                                                        <input type="text" v-bind:class="'form-control form-control-solid form-control-lg ' +valid.email" placeholder="อีเมล" id="formData.email" v-model="formData.email" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">แผนกติดต่อ :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select class='form-control form-control-solid form-control-lg' id="formData.department_id" v-model="formData.department_id" disabled>
                                                <option value="" disabled hidden>เลือกแผนก</option>
                                                <option v-for="dept in departments" :key="dept.id" :value="dept.id" :selected="appointment.department_id !== null && appointment.department_id === dept.id">{{ dept.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Group-->
                                    
                                    <!--begin::Group-->
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">วัตถุประสงค์ (*) :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <select v-bind:class="'form-control form-control-solid form-control-lg ' +valid.objective_id" id="formData.objective_id" v-model="formData.objective_id" disabled>
                                                <option value="" disabled hidden>เลือกวัตถุประสงค์</option>
                                                <option v-for="obj in objectiveTypes" :key="obj.id" :value="obj.id" :selected="appointment.objective_id !== null && appointment.objective_id === obj.id">{{ obj.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">มาจาก :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class='form-control form-control-solid form-control-lg' placeholder="ชื่อบริษัท" id="formData.from" type="text" v-model="formData.from" readonly/>
                                        </div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">รายละเอียดเพิ่มเติม :</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <textarea class='form-control form-control-solid form-control-lg resize-none' placeholder="รายละเอียดเพิ่มเติม (ถ้ามี)" id="formData.note" v-model="formData.note" rows="8" cols="80" readonly></textarea>
                                        <div class="fv-plugins-message-container"></div></div>
                                    </div>
                                    <!--end::Group-->

                                    <!--begin::Group-->
                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-3 col-lg-3 col-form-label">วัน/เวลานัดหมาย (*):</label>
                                        <div class="col-lg-9 col-xl-9 my-auto">
                                            <div class="row">
                                                <div class="col-lg-3 col-xl-3">
                                                    <date-picker
                                                        v-model="formData.date_appointment"
                                                        value-type="format"
                                                        type="format"
                                                        :format ="dateFormat"
                                                        :minute-step="1"
                                                        :show-time-header="false"
                                                        :show-second="false"
                                                        placeholder="วันที่"
                                                        :icon-calendar=null
                                                        :clearable="false"
                                                        v-bind:input-class="'form-control form-control-solid form-control-lg text-center ' +valid.date_appointment"
                                                        style="width: 100%;"
                                                    >
                                                        <template v-slot:icon-calendar>
                                                            <i class="mx-icon-calendar" style="display: none;">
                                                            </i>
                                                        </template>
                                                    </date-picker>
                                                </div>
                                                <div class="col-lg-2 col-xl-2 text-center">
                                                    <label class="col-form-label">เวลา :</label>
                                                </div>
                                                <div class="col-lg-3 col-xl-3">
                                                    <date-picker
                                                        v-model="formData.start_time"
                                                        value-type="format"
                                                        type="time"
                                                        :format ="timeFormat"
                                                        :minute-step="1"
                                                        :show-time-header="false"
                                                        :show-second="false"
                                                        placeholder="00:00"
                                                        :icon-calendar=null
                                                        :clearable="false"
                                                        v-bind:input-class="'form-control form-control-solid form-control-lg text-center ' +valid.start_time"
                                                        style="width: 100%;"
                                                    >
                                                        <template v-slot:icon-calendar>
                                                            <i class="mx-icon-calendar" style="display: none;">
                                                            </i>
                                                        </template>
                                                    </date-picker>
                                                </div>
                                                <div class="col-lg-1 col-xl-1 text-center">
                                                    <label class="col-form-label">ถึง</label>
                                                </div>
                                                <div class="col-lg-3 col-xl-3">
                                                    <date-picker
                                                        v-model="formData.end_time"
                                                        value-type="format"
                                                        type="time"
                                                        :format ="timeFormat"
                                                        :minute-step="1"
                                                        :show-time-header="false"
                                                        :show-second="false"
                                                        placeholder="00:00"
                                                        :icon-calendar=null
                                                        :clearable="false"
                                                        v-bind:input-class="'form-control form-control-solid form-control-lg text-center ' +valid.end_time"
                                                        style="width: 100%;"
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

                                    <!--begin::Wizard Actions-->
                                    <div class="form-group row fv-plugins-icon-container border-top pt-5 mt-5">
                                        <label class="col col-form-label"></label>
                                        <div>
                                            <a href="/admin/appointment" class="btn btn-danger font-weight-bolder px-auto py-2 mr-1" style="width: 150px; font-size:16px">
                                                ย้อนกลับ
                                            </a>
                                            <a href="#" class="btn btn-success font-weight-bolder px-auto py-2 ml-1" style="width: 150px; font-size:16px" @click.prevent="submitForm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                    <path opacity="0.3" d="M9.99984 18.3334C14.6022 18.3334 18.3332 14.6025 18.3332 10.0001C18.3332 5.39771 14.6022 1.66675 9.99984 1.66675C5.39746 1.66675 1.6665 5.39771 1.6665 10.0001C1.6665 14.6025 5.39746 18.3334 9.99984 18.3334Z" fill="white"/>
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.16667 9.16667V5.83333C9.16667 5.3731 9.53976 5 10 5C10.4602 5 10.8333 5.3731 10.8333 5.83333V9.16667H14.1667C14.6269 9.16667 15 9.53976 15 10C15 10.4602 14.6269 10.8333 14.1667 10.8333H10.8333V14.1667C10.8333 14.6269 10.4602 15 10 15C9.53976 15 9.16667 14.6269 9.16667 14.1667V10.8333H5.83333C5.3731 10.8333 5 10.4602 5 10C5 9.53976 5.3731 9.16667 5.83333 9.16667H9.16667Z" fill="white"/>
                                                </svg>
                                                สร้างนัดหมาย
                                            </a>
                                        </div>
                                    </div>
                                    <!--end::Wizard Actions-->
                            </div>
                            <!--end::Wizard Step 1-->
                        </form>
                    </div>
                </div>
                <!--end::Wizard Form-->
            </div>
        </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            formData: {
                name: null,
                lastname: null,
                phone: null,
                email: null,
                department_id: "",
                objective_id: "",
                from: null,
                note: null,
                date_appointment: null,
                start_time: null,
                end_time: null,
            },

            valid: {  
                name: null,
                lastname: null,
                phone: null,
                email: null,
                objective_id: null,
                date_appointment: null,
                start_time: null,
                end_time: null,
            },

            dateFormat: 'DD-MM-YYYY',
            timeFormat: 'HH:mm',
        }
    },
    props:{
        appointment: {
            type: Object,
            required: true,
        },
        departments: {
            type: Array,
            required: true,
        },
        objectiveTypes: {
            type: Array,
            required: true,
        },
    },
    mounted() {
        // console.log(this.appointment);
        // console.log(this.departments);
        // console.log(this.objectiveTypes);
    },
    created() {
        this.formData.name = this.appointment.name;
        this.formData.lastname = this.appointment.lastname;
        this.formData.phone = this.appointment.phone;
        this.formData.email = this.appointment.email;
        this.formData.department_id = this.appointment.department_id != null ? this.appointment.department_id : "";
        this.formData.objective_id = this.appointment.objective_id != null ? this.appointment.objective_id : "";
        this.formData.from = this.appointment.from;
        this.formData.note = this.appointment.note;
        this.formData.date_appointment = this.appointment.date_appointment_formatted;
        this.formData.start_time = this.appointment.start_time_formatted;
        this.formData.end_time = this.appointment.end_time_formatted;
    },
    methods:{
        async submitForm() {
            try {

                const requestData = {
                    ...this.formData,
                    type: 'edit',
                };

                const response = await axios.put(`/admin/appointment/${this.appointment.id}`, requestData);

                // Reset validation states
                Object.keys(this.valid).forEach(key => {
                    this.valid[key] = '';
                });

                // Handle response status
                if (response.data.status_code === 200) {
                    // Success case
                    this.$swal({
                        title: 'สำเร็จ',
                        text: 'สร้างนัดหมายสำเร็จ',
                        icon: 'success',
                        confirmButtonText: 'OK',
                    }).then((result) => {
                        // Redirect or reload page
                        if (result.isConfirmed) {
                            // Example: reload current page
                            if (result.isConfirmed) {
                                location.href = '/admin/appointment';
                            }
                        }
                    });
                } else if (response.data.status_code === 422) {
                    // Validation errors case
                    const message = response.data.message;

                    Object.keys(message).forEach(key => {
                        if (this.valid.hasOwnProperty(key)) {
                            this.valid[key] = 'is-invalid';
                        }
                    });

                    this.$swal(
                        'ผิดพลาด',
                        'กรุณากรอกข้อมูลให้ครบทุกช่อง (*) และถูกต้อง',
                        'error'
                    );
                } else {
                    // Other error cases
                    this.$swal(
                        'ผิดพลาด',
                        'ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่',
                        'error'
                    );

                    // Set all fields as invalid
                    Object.keys(this.valid).forEach(key => {
                        this.valid[key] = 'is-invalid';
                    });
                }
            } catch (error) {
                // Network or server error case
                console.error('เกิดข้อผิดพลาดในการส่งข้อมูล:', error);

                this.$swal(
                    'ผิดพลาด',
                    'ไม่สามารถเพิ่มข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่',
                    'error'
                );

                // Set all fields as invalid
                Object.keys(this.valid).forEach(key => {
                    this.valid[key] = 'is-invalid';
                });
            }
        },
    }
}
</script>

<style>

</style>