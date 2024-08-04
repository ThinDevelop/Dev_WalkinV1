(ParkingIndex) vue

<template>
    <div>
        <div class="row justify-content-center py-8 px-8 py-lg-0 px-lg-10">
            <div class="col-xl-12 col-xxl-10">
                <!-- <div class="row justify-content-center">
                    <div class="col-10"> -->
                        <!--begin::Wizard Step 1-->
                        <!-- <div class="my-5 step">
                            <div
                                class="form-group row fv-plugins-icon-container"
                            >
                                <label class="col-xl-2 col-lg-2 col-form-label"
                                    >ช่วงเวลา :</label
                                >
                                <div class="col-lg-10 col-xl-10">
                                    <div class="radio-inline">
                                        <label class="radio radio-lg">
                                            <input
                                                type="radio"
                                                value="daily"
                                                v-model="vechicle_cost_types_id"
                                                @change="handlePriceTypeChange"
                                            />
                                            <span></span>
                                            รายวัน
                                        </label>
                                        <label class="radio radio-lg">
                                            <input
                                                type="radio"
                                                value="hourly"
                                                v-model="vechicle_cost_types_id"
                                            />
                                            <span></span>
                                            รายชั่วโมง
                                        </label>
                                        <label class="radio radio-lg">
                                            <input
                                                type="radio"
                                                value="yearly"
                                                v-model="vechicle_cost_types_id"
                                            />
                                            <span></span>
                                            รายปี
                                        </label>
                                    </div>
                                    <div
                                        class="fv-plugins-message-container"
                                    ></div>
                                </div>
                            </div> -->

                            <!--begin:: Station Name-->

                            <!--end:: Station Name-->

                            <!--begin:: Price-->
                            <!-- <div
                                class="form-group row fv-plugins-icon-container"
                                v-show="vechicle_cost_types_id == 'daily'"
                            >
                                <label class="col-xl-2 col-lg-2 col-form-label"
                                    >ราคา :</label
                                >
                                <div class="col-lg-10 col-xl-10">
                                    <input
                                        v-bind:class="
                                            'form-control form-control-solid form-control-lg ' +
                                                cost_valid
                                        "
                                        placeholder="ระบุราคา"
                                        name="companyname"
                                        type="number"
                                        v-model="cost"
                                    />
                                    <div
                                        class="fv-plugins-message-container"
                                    ></div>
                                </div>
                            </div> -->
                            <!--end:: Price-->

                            <!--begin:: Range Time -->
                            <!-- <div
                                v-for="(input, index) in inputs"
                                :key="index"
                                v-show="vechicle_cost_types_id == 'hourly'"
                            >
                                <div
                                    v-if="isLastItem(index)"
                                    class="form-group row fv-plugins-icon-container"
                                >
                                    <label
                                        class="col-xl-2 col-lg-2 col-form-label"
                                        >ชั่วโมงที่ :
                                    </label>
                                    <div class="col-lg-10 col-xl-10 row">
                                        <div class="ol-lg-3 col-xl-3">
                                            <date-picker
                                                v-model="input.start"
                                                value-type="format"
                                                type="time"
                                                :format="timeFormat"
                                                :minute-step="1"
                                                :show-time-header="false"
                                                :show-second="false"
                                                :placeholder="
                                                    input.startPlaceholder
                                                "
                                                :icon-calendar="null"
                                                :clearable="false"
                                                v-bind:input-class="
                                                    'form-control form-control-solid form-control-lg text-center ' +
                                                        input.start_valid
                                                "
                                                style="width: 100%;"
                                            >
                                                <template v-slot:icon-calendar>
                                                    <i
                                                        class="mx-icon-calendar"
                                                        style="display: none;"
                                                    >
                                                    </i>
                                                </template>
                                            </date-picker>
                                        </div>

                                        <div class="ol-lg-1 col-xl-2">
                                            <label class="col-form-label"
                                                >เป็นต้นไป</label
                                            >
                                        </div>

                                        <div class="ol-lg-3 col-xl-1"></div>

                                        <div
                                            class="ol-lg-1 col-xl-2 text-right"
                                        >
                                            <label class="col-form-label"
                                                >ชั่วโมงละ</label
                                            >
                                        </div>

                                        <div class="ol-lg-2 col-xl-2">
                                            <input
                                                type="number"
                                                v-bind:class="
                                                    'form-control form-control-solid form-control-lg text-center ' +
                                                        input.price_valid
                                                "
                                                :placeholder="
                                                    input.pricePlaceholder
                                                "
                                                v-model="input.price"
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div
                                    v-else
                                    class="form-group row fv-plugins-icon-container"
                                >
                                    <label
                                        class="col-xl-2 col-lg-2 col-form-label"
                                        >ชั่วโมงที่ :</label
                                    >
                                    <div class="col-lg-10 col-xl-10 row">
                                        <div class="col-lg-3 col-xl-3">
                                            <date-picker
                                                v-model="input.start"
                                                value-type="format"
                                                type="time"
                                                :format="timeFormat"
                                                :minute-step="1"
                                                :show-time-header="false"
                                                :show-second="false"
                                                :placeholder="
                                                    input.startPlaceholder
                                                "
                                                :icon-calendar="null"
                                                :clearable="false"
                                                v-bind:input-class="
                                                    'form-control form-control-solid form-control-lg text-center ' +
                                                        input.start_valid
                                                "
                                                style="width: 100%;"
                                            >
                                                <template v-slot:icon-calendar>
                                                    <i
                                                        class="mx-icon-calendar"
                                                        style="display: none;"
                                                    >
                                                    </i>
                                                </template>
                                            </date-picker>
                                        </div>

                                        <div class="col-lg-1 col-xl-1">
                                            <label class="col-form-label"
                                                >ถึง</label
                                            >
                                        </div>

                                        <div class="col-lg-3 col-xl-3">
                                            <date-picker
                                                v-model="input.end"
                                                value-type="format"
                                                type="time"
                                                :format="timeFormat"
                                                :minute-step="1"
                                                :show-time-header="false"
                                                :show-second="false"
                                                :placeholder="
                                                    input.endPlaceholder
                                                "
                                                :icon-calendar="null"
                                                :clearable="false"
                                                v-bind:input-class="
                                                    'form-control form-control-solid form-control-lg text-center ' +
                                                        input.end_valid
                                                "
                                                style="width: 100%;"
                                            >
                                                <template v-slot:icon-calendar>
                                                    <i
                                                        class="mx-icon-calendar"
                                                        style="display: none;"
                                                    >
                                                    </i>
                                                </template>
                                            </date-picker>
                                        </div>

                                        <div class="col-lg-1 col-xl-1">
                                            <label class="col-form-label"
                                                >ราคา</label
                                            >
                                        </div>

                                        <div class="col-lg-2 col-xl-2">
                                            <input
                                                type="number"
                                                v-bind:class="
                                                    'form-control form-control-solid form-control-lg text-center ' +
                                                        input.price_valid
                                                "
                                                :placeholder="
                                                    input.pricePlaceholder
                                                "
                                                v-model="input.price"
                                            />
                                        </div>

                                        <div class="col-lg-1 col-xl-1">
                                            <button
                                                @click="addInput(index)"
                                                v-show="
                                                    index === inputs.length - 2
                                                "
                                                class="btn btn-primary"
                                                name="button"
                                            >
                                                <i class="la la-plus"></i>
                                            </button>
                                        </div>

                                        <div class="col-lg-1 col-xl-1">
                                            <button
                                                @click="removeInput(index)"
                                                v-show="
                                                    index === inputs.length - 2
                                                "
                                                class="btn btn-secondary"
                                                name="button"
                                            >
                                                <i class="la la-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!--end:: Range Time -->

                            <!--begin:: Stamp -->
                            <!-- <div
                                class="form-group row fv-plugins-icon-container border-top pt-5 mt-5"
                            >
                                <div
                                    class="col-xl-12 col-lg-12 col-form-label pl-0"
                                >
                                    <button
                                        class="btn"
                                        name="button"
                                        @click="checkBoxStamp()"
                                    > -->
                            <!--begin::Svg Icon-->
                            <!-- <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            v-show="!stamp_type"
                                        >
                                            <g
                                                stroke="none"
                                                stroke-width="1"
                                                fill="none"
                                                fill-rule="evenodd"
                                            >
                                                <rect
                                                    x="0.5"
                                                    y="0.5"
                                                    width="23"
                                                    height="23"
                                                    rx="5.5"
                                                    fill="white"
                                                    stroke="#B5B5C3"
                                                />
                                            </g>
                                        </svg>
                                        <svg
                                            width="24"
                                            height="24"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            v-show="stamp_type"
                                        >
                                            <g
                                                stroke="none"
                                                stroke-width="1"
                                                fill="none"
                                                fill-rule="evenodd"
                                            >
                                                <rect
                                                    width="24"
                                                    height="24"
                                                    rx="6"
                                                    fill="#1BC5BD"
                                                />
                                                <path
                                                    d="M19.619 8.53587L10.2857 17.8692C10.2044 17.9508 10.1078 18.0155 10.0015 18.0597C9.8951 18.1038 9.78107 18.1266 9.66591 18.1266C9.55074 18.1266 9.43671 18.1038 9.33036 18.0597C9.224 18.0155 9.12741 17.9508 9.04611 17.8692L4.96278 13.7859C4.88139 13.7045 4.81682 13.6078 4.77278 13.5015C4.72873 13.3952 4.70605 13.2812 4.70605 13.1661C4.70605 13.051 4.72873 12.937 4.77278 12.8306C4.81682 12.7243 4.88139 12.6277 4.96278 12.5463C5.04417 12.4649 5.1408 12.4003 5.24714 12.3563C5.35349 12.3122 5.46747 12.2896 5.58257 12.2896C5.69768 12.2896 5.81166 12.3122 5.918 12.3563C6.02435 12.4003 6.12097 12.4649 6.20236 12.5463L9.66664 16.0106L18.3809 7.29774C18.5453 7.13336 18.7682 7.04102 19.0007 7.04102C19.2332 7.04102 19.4561 7.13336 19.6205 7.29774C19.7849 7.46212 19.8772 7.68507 19.8772 7.91753C19.8772 8.15 19.7849 8.37295 19.6205 8.53733L19.619 8.53587Z"
                                                    fill="white"
                                                />
                                            </g>
                                        </svg> -->
                            <!--end::Svg Icon-->
                            <!-- </button>
                                    <label
                                        class="col-form-label my-auto"
                                        style="font-size: 16px; font-weight: bold;"
                                        >กำหนดส่วนลด
                                        (เมื่อมีตราประทับหรือลายเซ็น)</label
                                    >
                                    <div
                                        class="fv-plugins-message-container"
                                    ></div>
                                </div>
                            </div> -->

                            <!-- <div
                                class="form-group row fv-plugins-icon-container"
                                v-show="stamp_type"
                            >
                                <label
                                    class="col-xl-2 col-lg-2 col-form-label my-auto"
                                    >ประเภทส่วนลด :</label
                                >
                                <div class="col-lg-10 col-xl-10 my-auto">
                                    <div class="radio-inline">
                                        <label class="radio radio-lg">
                                            <input
                                                type="radio"
                                                value="all"
                                                v-model="status_stamp"
                                            />
                                            <span></span>
                                            ละเว้นค่าจอดรถทั้งหมด
                                        </label>
                                        <label
                                            class="radio radio-lg"
                                            v-show="
                                                vechicle_cost_types_id ==
                                                    'hourly'
                                            "
                                        >
                                            <input
                                                type="radio"
                                                value="hour"
                                                v-model="status_stamp"
                                            />
                                            <span></span>
                                            ละเว้นค่าจอดรถ (กำหนดชั่วโมง)
                                        </label>
                                    </div>
                                </div>
                                <div class="fv-plugins-message-container"></div>
                            </div>

                            <div
                                class="form-group row fv-plugins-icon-container"
                                v-show="status_stamp && status_stamp == 'hour'"
                            >
                                <label
                                    class="col-xl-2 col-lg-2 col-form-label my-auto"
                                ></label>
                                <div class="col-lg-10 col-xl-10">
                                    <select
                                        class="form-control form-control-solid form-control-lg"
                                        v-model="num_hour"
                                    >
                                        <option
                                            v-for="option in optionStamp"
                                            :key="option.id"
                                            :value="option.value"
                                            >{{ option.label }}</option
                                        > -->
                            <!-- เพิ่มตัวเลือกแผนกต่าง ๆ ตามที่คุณต้องการ -->
                            <!-- </select>
                                    <div
                                        class="fv-plugins-message-container"
                                    ></div>
                                </div>
                            </div> -->
                            <!--end:: Stamp -->
                        <!-- </div> -->
                        <!--end::Wizard Step 1-->
                    <!-- </div>
                </div> -->
                <!--end::Wizard Form-->
            </div>
        </div>
    </div>
</template>

<script>
import DatePicker from 'vue2-datepicker';
import 'vue2-datepicker/index.css';
import 'vue2-datepicker/locale/th';

export default {
    components: {
        'date-picker': DatePicker
    },
    data() {
        return {
            id: null,
            setting_hour_id: null,
            vechicle_cost_types_id: 'daily', //1 รายวัน, 2 รายชั่วโมง
            name_place: '',
            name_place_valid: '',
            status: false, //สถานะค่าจอด 0 ไม่ใช้งาน, 1 ใช้งาน
            cost: '',
            cost_valid: '',
            status_stamp: 'all', //1 ละเว้นทั้งหมด, 2 กำหนดชั่วโมง
            stamp_type: false, //0 ไม่ใช้แสตมป์, 1 ใช้แสตมป์
            num_hour: 3600,
            inputs: [
                {
                    start: '00:01',
                    end: '',
                    price: '',
                    startPlaceholder: '00:00',
                    endPlaceholder: '00:00',
                    pricePlaceholder: 'ระบุราคา',
                    start_valid: '',
                    end_valid: '',
                    price_valid: ''
                },
                {
                    start: '',
                    end: '',
                    price: '',
                    startPlaceholder: '00:00',
                    endPlaceholder: '00:00',
                    pricePlaceholder: 'ระบุราคา',
                    start_valid: '',
                    end_valid: '',
                    price_valid: ''
                }
            ],
            timeFormat: 'HH:mm',
            optionStamp: [
                { id: 1, label: '1 ชั่วโมง', value: 1 * 60 * 60 },
                { id: 2, label: '2 ชั่วโมง', value: 2 * 60 * 60 },
                { id: 3, label: '3 ชั่วโมง', value: 3 * 60 * 60 },
                { id: 4, label: '4 ชั่วโมง', value: 4 * 60 * 60 },
                { id: 5, label: '5 ชั่วโมง', value: 5 * 60 * 60 },
                { id: 6, label: '6 ชั่วโมง', value: 6 * 60 * 60 },
                { id: 7, label: '7 ชั่วโมง', value: 7 * 60 * 60 },
                { id: 8, label: '8 ชั่วโมง', value: 8 * 60 * 60 },
                { id: 9, label: '9 ชั่วโมง', value: 9 * 60 * 60 },
                { id: 10, label: '10 ชั่วโมง', value: 10 * 60 * 60 }
            ]
        };
    },
    props: ['company'],
    created() {
        if (this.company !== null) {
            this.id = this.company.id;
            if (this.company.setting_hour !== null) {
                this.setting_hour_id = this.company.setting_hour.setting_hour_id;
                this.vechicle_cost_types_id = this.company.setting_hour.vechicle_cost_types_id; //1 รายวัน, 2 รายชั่วโมง
                this.name_place = this.company.setting_hour.name_place;
                this.status = this.company.setting_hour.status; //สถานะค่าจอด 0 ไม่ใช้งาน, 1 ใช้งาน
                this.cost = this.company.setting_hour.cost;
                this.status_stamp = this.company.setting_hour.status_stamp; //1 ละเว้นทั้งหมด, 2 กำหนดชั่วโมง
                this.stamp_type = this.company.setting_hour.stamp_type; //0 ไม่ใช้แสตมป์, 1 ใช้แสตมป์
                this.num_hour = this.company.setting_hour.num_hour;
                if (this.company.setting_hour.setting_cost !== null) {
                    this.inputs = [];
                    this.company.setting_hour.setting_cost.forEach(
                        (item, index) => {
                            this.inputs.push({
                                start: item.start_hour,
                                end: item.end_hour,
                                price: item.cost,
                                startPlaceholder: '00:00',
                                endPlaceholder: '00:00',
                                pricePlaceholder: 'ระบุราคา',
                                start_valid: '',
                                end_valid: '',
                                price_valid: ''
                            });
                        }
                    );
                }
            }
        }
    },
    mounted() {},
    methods: {
        addInput(index) {
            if (index < 4) {
                this.inputs.splice(index + 1, 0, {
                    start: '',
                    end: '',
                    price: '',
                    startPlaceholder: '00:00',
                    endPlaceholder: '00:00',
                    pricePlaceholder: 'ระบุราคา',
                    start_valid: '',
                    end_valid: '',
                    price_valid: ''
                });
            }
        },

        removeInput(index) {
            if (index != 0) {
                this.inputs.splice(index, 1);
            }
        },

        checkBoxStamp() {
            if (this.stamp_type) {
                this.stamp_type = false;
            } else {
                this.stamp_type = true;
            }
        },

        handlePriceTypeChange() {
            this.status_stamp = 'all';
        },

        isLastItem(index) {
            return index === this.inputs.length - 1;
        },

        updateData() {
            let data = {
                setting_hour_id: this.setting_hour_id,
                vechicle_cost_types_id: this.vechicle_cost_types_id,
                name_place: this.name_place,
                status: this.status,
                cost: this.cost,
                status_stamp: this.status_stamp,
                stamp_type: this.stamp_type,
                num_hour: this.num_hour
            };

            if (this.vechicle_cost_types_id != 'daily') {
                data.inputs = this.inputs;
            }

            axios.patch('/admin/parking/' + this.id, data).then(response => {
                //Reset Valid
                this.name_place_valid = '';
                this.cost_valid = '';
                this.inputs.forEach(item => {
                    item.start_valid = '';
                    item.end_valid = '';
                    item.price_valid = '';
                });

                if (response.data.status_code == 422) {
                    this.name_place_valid = response.data.data.name_place_valid;
                    if (this.vechicle_cost_types_id === 'daily') {
                        this.cost_valid = response.data.data.cost_valid;
                    } else {
                        this.inputs = response.data.data.inputs;
                    }
                    this.$swal(
                        'ผิดพลาด',
                        'กรุณากรอกข้อมูลให้ครบทุกช่อง!!!',
                        'error'
                    );
                } else if (response.data.status_code == 200) {
                    location.href = '/admin/parking/create';
                } else {
                    this.name_place_valid = 'is-invalid';
                    this.cost_valid = 'is-invalid';
                    this.inputs.forEach(item => {
                        item.start_valid = 'is-invalid';
                        item.end_valid = 'is-invalid';
                        item.price_valid = 'is-invalid';
                    });

                    this.$swal(
                        'ผิดพลาด',
                        'ไม่สามารถแก้ไข ข้อมูลได้ กรุณาลองอีกครั้ง!!!',
                        'error'
                    );
                }
            });
        }
    }
};
</script>

<style scoped>
/* Chrome, Safari, Edge, Opera */
input[type='number']::-webkit-outer-spin-button,
input[type='number']::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Standard */
input[type='number'] {
    appearance: textfield;
}
</style>

