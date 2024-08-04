<template>
    <div>
        <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
            <div class="col-xl-12 col-xxl-10">
                <div class="row col-xl-12 col-xxl-10 mb-3" style="display: flex; align-items: center;">
                    <!-- Conditionally rendered div -->
                    <div class="my-auto col-9" v-if="setting_parking_company.setting_hours[2].status == '1'" style="display: flex; align-items: center;">
                        <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5 0C4.5374 0 0.5 4.03745 0.5 9.00006C0.5 13.9627 4.5374 18 9.5 18C14.4626 18 18.5 13.9627 18.5 9.00006C18.5 4.03745 14.4626 0 9.5 0ZM9.5 16.3636C5.43964 16.3636 2.13636 13.0604 2.13636 9.00006C2.13636 4.93975 5.43964 1.63636 9.5 1.63636C13.5604 1.63636 16.8636 4.93975 16.8636 9.00006C16.8636 13.0604 13.5603 16.3636 9.5 16.3636Z" fill="#7E8299"/>
                            <path d="M9.49987 3.81812C8.89845 3.81812 8.40918 4.30772 8.40918 4.90952C8.40918 5.51077 8.89845 5.99993 9.49987 5.99993C10.1013 5.99993 10.5906 5.51077 10.5906 4.90952C10.5906 4.30772 10.1013 3.81812 9.49987 3.81812Z" fill="#7E8299"/>
                            <path d="M9.49982 7.63647C9.04797 7.63647 8.68164 8.0028 8.68164 8.45466V13.3637C8.68164 13.8156 9.04797 14.1819 9.49982 14.1819C9.95168 14.1819 10.318 13.8156 10.318 13.3637V8.45466C10.318 8.0028 9.95168 7.63647 9.49982 7.63647Z" fill="#7E8299"/>
                        </svg>
                        <span style="color: gray; margin-left: 8px;">เงื่อนไขการตั้งค่าราคาเป็นรูปแบบยอดสะสม เช่น ชั่วโมงที่ 01:00-01:59 = 10 บาท ชั่วโมงที่ 02:00-03:59 = 20 บาทและผู้มาติดต่อจอดรถ 2 ชั่วโมง 30 นาที ราคาค่าจอดรถ เท่ากับ 30 บาท (10 + 20 บาท) เป็นต้น</span>
                    </div>
                    
                    <!-- Label and Switch -->
                    <label class="col-form-label ml-auto mr-3">สถานะ</label>
                    <span class="switch switch-icon switch-brand">
                        <label>
                            <input type="checkbox" true-value="1" false-value="0" v-model="setting_parking_company.status"/>
                            <span></span>
                        </label>
                    </span>
                </div>
                <div class="row justify-content-center">
                    <div class="col-10">
                        <!--begin::Wizard Step 1-->
                        <div class="my-5 step">
                            <!--begin:: Station Name-->
                            <div class="form-group row fv-plugins-icon-container">
                                <label class="col-xl-2 col-lg-2 col-form-label">ชื่อสถานที่ :</label>
                                <div class="col-lg-10 col-xl-10">
                                    <input v-bind:class="'form-control form-control-solid form-control-lg ' +name_place_valid" placeholder="เช่น ลานจอดรถ 1" name="companyname" type="text" v-model="setting_parking_company.name_place">
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                            </div>

                            <div class="form-group row fv-plugins-icon-container ">
                                <label class="col-xl-2 col-lg-2 col-form-label">รูปแบบค่าจอดรถ :</label>
                                <div class="col-lg-10 col-xl-10">
                                    <div class="checkbox-inline">
                                        <label class="checkbox checkbox-lg" v-for="(vechicle_cost_type, index) in vechicle_cost_types" :key="index">
                                            <input
                                                name="vechicle_cost_types[]" 
                                                type="checkbox"
                                                true-value="1" 
                                                false-value="0" 
                                                v-model="setting_parking_company.setting_hours[vechicle_cost_type.id].status"
                                                @change="handleCheckboxChange(vechicle_cost_type.id)"
                                            >
                                            <span></span>
                                            {{ vechicle_cost_type.name }}
                                        </label>
                                    </div>
                                    <div class="fv-plugins-message-container"></div>
                                </div>
                                <div class="col-12">
                                    <hr />
                                </div>
                            </div>

                            <div class="pt-2">
                                <!-- รายวัน -->
                                <div class="blackColor px-0" v-if="setting_parking_company.setting_hours[1].status == '1'">

                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-12 font-weight-bold col-form-label">รายวัน</label>
                                    </div>

                                    <!-- สถานะ รูปแบบค่าจอดรถ -->
                                    <!-- <div class="form-group row fv-plugins-icon-container mx-0">
                                        <label class="mr-3">สถานะ</label>
                                        <span class="switch switch-icon switch-brand">
                                            <label>
                                                <input type="checkbox" true-value="1" false-value="0" v-model="setting_parking_company.setting_hours[1].status"/>
                                                <span></span>
                                            </label>
                                        </span>
                                    </div> -->

                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-xl-2 col-lg-2 col-form-label">ราคา :</label>
                                        <div class="col-lg-10 col-xl-10">
                                            <input v-bind:class="'form-control form-control-solid form-control-lg ' + cost_valid" placeholder="ระบุราคา" name="companyname" type="number" v-model="setting_parking_company.setting_hours[1].cost">
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                    </div>

                                    <!-- กำหนดส่วนลด (เมื่อมีตราประทับหรือลายเซ็น) -->
                                    <div class="form-group row fv-plugins-icon-container pt-5 mt-2">
                                        <div class="col-xl-12 col-lg-12 col-form-label pl-0">
                                            <button class="btn" name="button" @click="checkBoxStamp(1)">
                                                <!--begin::Svg Icon-->
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!setting_parking_company.setting_hours[1].status_stamp">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0.5" y="0.5" width="23" height="23" rx="5.5" fill="white" stroke="#B5B5C3"/>
                                                    </g>
                                                </svg>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="setting_parking_company.setting_hours[1].status_stamp">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect width="24" height="24" rx="6" fill="#1BC5BD"/>
                                                        <path d="M19.619 8.53587L10.2857 17.8692C10.2044 17.9508 10.1078 18.0155 10.0015 18.0597C9.8951 18.1038 9.78107 18.1266 9.66591 18.1266C9.55074 18.1266 9.43671 18.1038 9.33036 18.0597C9.224 18.0155 9.12741 17.9508 9.04611 17.8692L4.96278 13.7859C4.88139 13.7045 4.81682 13.6078 4.77278 13.5015C4.72873 13.3952 4.70605 13.2812 4.70605 13.1661C4.70605 13.051 4.72873 12.937 4.77278 12.8306C4.81682 12.7243 4.88139 12.6277 4.96278 12.5463C5.04417 12.4649 5.1408 12.4003 5.24714 12.3563C5.35349 12.3122 5.46747 12.2896 5.58257 12.2896C5.69768 12.2896 5.81166 12.3122 5.918 12.3563C6.02435 12.4003 6.12097 12.4649 6.20236 12.5463L9.66664 16.0106L18.3809 7.29774C18.5453 7.13336 18.7682 7.04102 19.0007 7.04102C19.2332 7.04102 19.4561 7.13336 19.6205 7.29774C19.7849 7.46212 19.8772 7.68507 19.8772 7.91753C19.8772 8.15 19.7849 8.37295 19.6205 8.53733L19.619 8.53587Z" fill="white"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <label class="col-form-label my-auto" style="font-size: 16px; font-weight: bold;">กำหนดส่วนลด (เมื่อมีตราประทับหรือลายเซ็น)</label>
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                    </div>
                                    <!-- ประเภทส่วนลด -->
                                    <div class="border-bottom mb-5">
                                        <div class="form-group row fv-plugins-icon-container" v-show="setting_parking_company.setting_hours[1].status_stamp">
                                            <label class="col-xl-2 col-lg-2 col-form-label my-auto">ประเภทส่วนลด :</label>
                                            <div class="col-lg-10 col-xl-10 my-auto">
                                                <div class="radio-inline">
                                                    <label class="radio radio-lg">
                                                        <input type="radio" value="1" v-model="setting_parking_company.setting_hours[1].stamp_type_id">
                                                        <span></span>
                                                        ละเว้นค่าจอดรถทั้งหมด
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                    </div>

                                </div>
                                <!-- ราย ชม. -->
                                <div class="blackColor px-0" v-if="setting_parking_company.setting_hours[2].status == '1'">

                                    <div class="form-group row fv-plugins-icon-container">
                                        <label class="col-12 font-weight-bold col-form-label">รายชั่วโมง</label>
                                    </div>

                                    <!-- สถานะ รูปแบบค่าจอดรถ -->
                                    <!-- <div class="form-group row fv-plugins-icon-container mx-0">
                                        <label class="mr-3">สถานะ</label>
                                        <span class="switch switch-icon switch-brand">
                                            <label>
                                                <input type="checkbox" true-value="1" false-value="0" v-model="setting_parking_company.setting_hours[2].status"/>
                                                <span></span>
                                            </label>
                                        </span>
                                    </div> -->

                                    <div v-for="(setting_cost, index) in setting_parking_company.setting_hours[2].setting_cost" :key="index">
                                        <div v-if="isLastItem(index)" class="form-group row fv-plugins-icon-container">
                                            <label class="col-xl-2 col-lg-2 col-form-label">ชั่วโมงที่ : </label>
                                            <div class="col-lg-10 col-xl-10 row">
                                                <div class="ol-lg-3 col-xl-3">
                                                    <input v-bind:class="'form-control form-control-solid form-control-lg text-center '+setting_cost.start_valid" :placeholder="setting_cost.startPlaceholder" type="text" v-model="setting_cost.start_hour" readonly>
                                                </div>
                                                <div class="ol-lg-1 col-xl-2">
                                                    <label class="col-form-label">เป็นต้นไป</label>
                                                </div>
                                                <div class="ol-lg-3 col-xl-1">
                                                </div>
                                                <div class="ol-lg-1 col-xl-2 text-right">
                                                    <label class="col-form-label">ชั่วโมงละ</label>
                                                </div>
                                                <div class="ol-lg-2 col-xl-2">
                                                    <input type="number" v-bind:class="'form-control form-control-solid form-control-lg text-center ' +setting_cost.price_valid" :placeholder="setting_cost.pricePlaceholder" v-model="setting_cost.cost">
                                                </div>
                                            </div>
                                        </div>
                                        <div v-else class="form-group row fv-plugins-icon-container">
                                            <label class="col-xl-2 col-lg-2 col-form-label">ชั่วโมงที่ :</label>
                                            <div class="col-lg-10 col-xl-10 row">
                                                <div class="col-lg-3 col-xl-3">
                                                    <input v-bind:class="'form-control form-control-solid form-control-lg text-center '+setting_cost.start_valid" :placeholder="setting_cost.startPlaceholder" type="text" v-model="setting_cost.start_hour" readonly>
                                                </div>

                                                <div class="col-lg-1 col-xl-1">
                                                    <label class="col-form-label">ถึง</label>
                                                </div>

                                                <div class="col-lg-3 col-xl-3">
                                                    <date-picker
                                                        v-model="setting_cost.end_hour"
                                                        value-type="format"
                                                        type="time"
                                                        :format ="timeFormat"
                                                        :minute-step="1"
                                                        :show-time-header="false"
                                                        :show-second="false"
                                                        :placeholder="setting_cost.endPlaceholder"
                                                        :icon-calendar=null
                                                        :clearable="false"
                                                        v-bind:input-class="'form-control form-control-solid form-control-lg text-center ' +setting_cost.end_valid"
                                                        style="width: 100%;"
                                                        @change="changeValueInputTime(index)"
                                                    >
                                                        <template v-slot:icon-calendar>
                                                            <i class="mx-icon-calendar" style="display: none;">
                                                            </i>
                                                        </template>
                                                    </date-picker>
                                                </div>

                                                <div class="col-lg-1 col-xl-1">
                                                    <label class="col-form-label">ราคา</label>
                                                </div>

                                                <div class="col-lg-2 col-xl-2">
                                                    <input type="number" v-bind:class="'form-control form-control-solid form-control-lg text-center ' +setting_cost.price_valid" :placeholder="setting_cost.pricePlaceholder" v-model="setting_cost.cost">
                                                </div>

                                                <div class="col-lg-1 col-xl-1" v-show="index === setting_parking_company.setting_hours[2].setting_cost.length - 2 && index !== 4">
                                                    <button @click="addInput(index)" class="btn btn-primary"  name="button"><i class="la la-plus"></i></button>
                                                </div>

                                                <div class="col-lg-1 col-xl-1" v-show="index === setting_parking_company.setting_hours[2].setting_cost.length - 2 && index !== 0">
                                                    <button @click="removeInput(index)" class="btn btn-secondary"  name="button"><i class="la la-trash"></i></button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- กำหนดส่วนลด (เมื่อมีตราประทับหรือลายเซ็น) -->
                                    <div class="form-group row fv-plugins-icon-container pt-5 mt-2">
                                        <div class="col-xl-12 col-lg-12 col-form-label pl-0">
                                            <button class="btn" name="button" @click="checkBoxStamp(2)">
                                                <!--begin::Svg Icon-->
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="!setting_parking_company.setting_hours[2].status_stamp">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0.5" y="0.5" width="23" height="23" rx="5.5" fill="white" stroke="#B5B5C3"/>
                                                    </g>
                                                </svg>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" v-show="setting_parking_company.setting_hours[2].status_stamp">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect width="24" height="24" rx="6" fill="#1BC5BD"/>
                                                        <path d="M19.619 8.53587L10.2857 17.8692C10.2044 17.9508 10.1078 18.0155 10.0015 18.0597C9.8951 18.1038 9.78107 18.1266 9.66591 18.1266C9.55074 18.1266 9.43671 18.1038 9.33036 18.0597C9.224 18.0155 9.12741 17.9508 9.04611 17.8692L4.96278 13.7859C4.88139 13.7045 4.81682 13.6078 4.77278 13.5015C4.72873 13.3952 4.70605 13.2812 4.70605 13.1661C4.70605 13.051 4.72873 12.937 4.77278 12.8306C4.81682 12.7243 4.88139 12.6277 4.96278 12.5463C5.04417 12.4649 5.1408 12.4003 5.24714 12.3563C5.35349 12.3122 5.46747 12.2896 5.58257 12.2896C5.69768 12.2896 5.81166 12.3122 5.918 12.3563C6.02435 12.4003 6.12097 12.4649 6.20236 12.5463L9.66664 16.0106L18.3809 7.29774C18.5453 7.13336 18.7682 7.04102 19.0007 7.04102C19.2332 7.04102 19.4561 7.13336 19.6205 7.29774C19.7849 7.46212 19.8772 7.68507 19.8772 7.91753C19.8772 8.15 19.7849 8.37295 19.6205 8.53733L19.619 8.53587Z" fill="white"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </button>
                                            <label class="col-form-label my-auto" style="font-size: 16px; font-weight: bold;">กำหนดส่วนลด (เมื่อมีตราประทับหรือลายเซ็น)</label>
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                    </div>
                                    <!-- ประเภทส่วนลด -->
                                    <div class="border-bottom mb-5">
                                        <div class="form-group row fv-plugins-icon-container" v-show="setting_parking_company.setting_hours[2].status_stamp">
                                            <label class="col-xl-2 col-lg-2 col-form-label my-auto">ประเภทส่วนลด :</label>
                                            <div class="col-lg-10 col-xl-10 my-auto">
                                                <div class="radio-inline">
                                                    <label class="radio radio-lg">
                                                        <input type="radio" value="1" v-model="setting_parking_company.setting_hours[2].stamp_type_id">
                                                        <span></span>
                                                        ละเว้นค่าจอดรถทั้งหมด
                                                    </label>
                                                    <label class="radio radio-lg">
                                                        <input type="radio" value="2" v-model="setting_parking_company.setting_hours[2].stamp_type_id">
                                                        <span></span>
                                                        ละเว้นค่าจอดรถ (กำหนดชั่วโมง)
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                        <div class="form-group row fv-plugins-icon-container" v-show="setting_parking_company.setting_hours[2].stamp_type_id == '2'">
                                            <label class="col-xl-2 col-lg-2 col-form-label my-auto"></label>
                                            <div class="col-lg-10 col-xl-10">
                                                <select class='form-control form-control-solid form-control-lg' v-model="setting_parking_company.setting_hours[2].stamp_type_num_hour">
                                                    <option v-for="option in optionStamp" :key="option.id" :value="option.value">{{ option.label }}</option>
                                                    <!-- เพิ่มตัวเลือกแผนกต่าง ๆ ตามที่คุณต้องการ -->
                                                </select>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Wizard Step 1-->

                        <!--begin::Wizard Actions-->
                        <div class="d-flex justify-content-between pt-5 mt-5">
                            <div class="mr-2"></div>
                            <div>
                                <a href="/admin/dashboard" class="btn btn-danger font-weight-bolder px-auto py-2 mr-1" style="width: 150px; font-size: 16px;">ย้อนกลับ</a>
                                <button @click="updateData()" type="button" class="btn btn-success font-weight-bolder py-2 ml-1" style="width: 150px; font-size:16px">บันทึก</button>
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

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/th';

export default{
    components: {
        'date-picker': DatePicker,
    },
    data(){
        return{
            setting_parking_company: {},
            vechicle_cost_type_show: "1", //1 รายวัน, 2 รายชั่วโมง
            vechicle_cost_types: {}, //1 รายวัน, 2 รายชั่วโมง
            stamp_types: {},
            num_hour: 3600,
            timeFormat: 'HH:mm',
            cost_valid: '',
            name_place_valid: '',
            optionStamp: [
                { id: 1, label: '1 ชั่วโมง', value: 1 * (60 * 60) },
                { id: 2, label: '2 ชั่วโมง', value: 2 * (60 * 60) },
                { id: 3, label: '3 ชั่วโมง', value: 3 * (60 * 60) },
                { id: 4, label: '4 ชั่วโมง', value: 4 * (60 * 60) },
                { id: 5, label: '5 ชั่วโมง', value: 5 * (60 * 60) },
                { id: 6, label: '6 ชั่วโมง', value: 6 * (60 * 60) },
                { id: 7, label: '7 ชั่วโมง', value: 7 * (60 * 60) },
                { id: 8, label: '8 ชั่วโมง', value: 8 * (60 * 60) },
                { id: 9, label: '9 ชั่วโมง', value: 9 * (60 * 60) },
                { id: 10, label: '10 ชั่วโมง', value: 10 * (60 * 60) },
            ],
        }
    },
    props: ['company'],
    created() {
        this.setting_parking_company = this.company.setting_parking_company;
        this.vechicle_cost_types = this.company.vechicle_cost_types;
        this.stamp_types = this.company.stamp_types;
        if(this.setting_parking_company !== null) {
            if(this.setting_parking_company.setting_hours !== null){
                if(this.setting_parking_company.setting_hours[2].setting_cost !== null){
                    this.setting_parking_company.setting_hours[2].setting_cost.forEach((item, index) => {
                        this.setting_parking_company.setting_hours[2].setting_cost[index]['startPlaceholder'] = '00:00';
                        this.setting_parking_company.setting_hours[2].setting_cost[index]['endPlaceholder'] = '00:00';
                        this.setting_parking_company.setting_hours[2].setting_cost[index]['pricePlaceholder'] = 'ระบุราคา';
                        this.setting_parking_company.setting_hours[2].setting_cost[index]['start_valid'] = '';
                        this.setting_parking_company.setting_hours[2].setting_cost[index]['end_valid'] = '';
                        this.setting_parking_company.setting_hours[2].setting_cost[index]['price_valid'] = '';
                    });
                }
            }
        }
        // console.log(this.setting_parking_company);

    },
    mounted() {
    },
    methods: {

        handleCheckboxChange(id) {
            if(id === 3){
                if (this.setting_parking_company.setting_hours[3].status == '1') {
                    this.setting_parking_company.setting_hours[1].status = '1';
                    this.setting_parking_company.setting_hours[2].status = '1';
                }else if(this.setting_parking_company.setting_hours[3].status == '0') {
                    this.setting_parking_company.setting_hours[1].status = '0';
                    this.setting_parking_company.setting_hours[2].status = '0';
                }
            }else if(id === 2){
                if (this.setting_parking_company.setting_hours[2].status == '1') {
                    this.setting_parking_company.setting_hours[2].status = '1';
                    if(this.setting_parking_company.setting_hours[1].status == '1'){
                        this.setting_parking_company.setting_hours[1].status = '1';
                        this.setting_parking_company.setting_hours[3].status = '1';
                    }
                }else if(this.setting_parking_company.setting_hours[2].status == '0'){
                    this.setting_parking_company.setting_hours[2].status = '0';
                    this.setting_parking_company.setting_hours[3].status = '0';
                }
            }else if(id === 1){
                if (this.setting_parking_company.setting_hours[1].status == '1') {
                    this.setting_parking_company.setting_hours[1].status = '1';
                    if(this.setting_parking_company.setting_hours[2].status == '1'){
                        this.setting_parking_company.setting_hours[2].status = '1';
                        this.setting_parking_company.setting_hours[3].status = '1';
                    }
                }else if(!this.setting_parking_company.setting_hours[1].status == '0'){
                    this.setting_parking_company.setting_hours[1].status = '0';
                    this.setting_parking_company.setting_hours[3].status = '0';
                }
            }
        },

        // เพิ่ม Inputs
        addInput(index) {
            if (index < 4) {
                this.setting_parking_company.setting_hours[2].setting_cost.splice(index + 1, 0 ,{ start_hour: '', end_hour: '', cost: '', startPlaceholder: '00:00', endPlaceholder: '00:00', pricePlaceholder: 'ระบุราคา', start_valid:'', end_valid:'', price_valid:'' });
                this.changeValueInputTime(index);
            }
        },

        // ลบ Inputs
        removeInput(index) {
            if (index != 0) {
                this.setting_parking_company.setting_hours[2].setting_cost.splice(index, 1);
            }
            this.changeValueInputTime(index-1);
        },

        // เช็คเวลา
        changeValueInputTime(index){

            // แยกชั่วโมงกับนาที
            const [startHour, startMinute] = this.setting_parking_company.setting_hours[2].setting_cost[index].start_hour.split(':').map(Number);
            const [endHour, endMinute] = this.setting_parking_company.setting_hours[2].setting_cost[index].end_hour.split(':').map(Number);

            // น้อยกว่าเริ่ม
            if (endHour < startHour || (endHour === startHour && endMinute <= startMinute)) {
                this.setting_parking_company.setting_hours[2].setting_cost[index].end_valid = 'is-invalid';
            } else {
                this.setting_parking_company.setting_hours[2].setting_cost[index].end_valid = '';
            }

            // ชั่วโมงใหม่
            const newStartHour = ('0' + endHour).slice(-2);
            const newStartMinute = ( '0' + (endMinute + 1)).slice(-2);
            this.setting_parking_company.setting_hours[2].setting_cost[index + 1].start_hour = `${newStartHour}:${newStartMinute}`;

        },

        checkBoxStamp(index) {
            if (this.setting_parking_company.setting_hours[index].status_stamp) {
                this.setting_parking_company.setting_hours[index].status_stamp = 0;
            } else {
                this.setting_parking_company.setting_hours[index].status_stamp = 1;
                if (!this.setting_parking_company.setting_hours[index].stamp_type_id) {
                    this.setting_parking_company.setting_hours[index].stamp_type_id = 1;
                }
            }
        },

        isLastItem(index) {
            return index === this.setting_parking_company.setting_hours[2].setting_cost.length - 1;
        },

        updateData(){
            const checkIsInvalid = true;

            // ชั้วโมงเช็คความถูกต้อง
            if (this.setting_parking_company.setting_hours[2].status == 1) {
                this.setting_parking_company.setting_hours[2].setting_cost.forEach((input) => {
                    if (input.end_valid == "is-invalid") {
                        this.$swal('ผิดพลาด', 'กรุณากรอกเวลาให้มากกว่าชั่วโมง', 'error');
                        checkIsInvalid = false;
                    }
                });
            }

            if(checkIsInvalid){
                axios.patch('/admin/parking/' + this.company.id, this.setting_parking_company).then((response) => {
                    //Reset Valid
                    this.name_place_valid = '';
                    this.cost_valid = '';
                    this.setting_parking_company.setting_hours[2].setting_cost.forEach(item => {
                        item.start_valid = '';
                        item.end_valid = '';
                        item.price_valid = '';
                    });
                    if (response.data.status_code == 422) {
                        this.name_place_valid = response.data.data.name_place_valid;
                        this.cost_valid = response.data.data.cost_valid;
                        this.setting_parking_company.setting_hours[2].setting_cost = response.data.data.inputs;
                        this.$swal('ผิดพลาด', 'กรุณากรอกข้อมูลให้ครบทุกช่อง!!!', 'error');
                    } else if (response.data.status_code == 200) {
                        this.setting_parking_company.setting_parking_company_id = response.data.setting_parking_company_id
                        this.$swal({
                            title: 'สำเร็จ',
                            text: 'แก้ไขข้อมูลสำเร็จ',
                            icon: 'success',
                            confirmButtonText: 'OK',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.href = '/admin/parking/create';
                            }
                        });
                    } else {
                        this.$swal('ผิดพลาด', 'ไม่สามารถแก้ไข ข้อมูลได้ กรุณาแจ้งเจ้าหน้าที่!!!', 'error');
                    }
                });
            }
        },

    }
}
</script>

<style scoped>
/* Chrome, Safari, Edge, Opera */
input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Standard */
input[type=number] {
  appearance: textfield;
}

</style>
