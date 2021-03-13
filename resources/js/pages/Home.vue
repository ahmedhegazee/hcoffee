<template>
  <div class="home_slider">
    <div
      id="carouselExampleIndicators"
      class="carousel slide"
      data-ride="carousel"
    >
      <ol class="carousel-indicators">
        <li
          data-target="#carouselExampleIndicators"
          data-slide-to="0"
          class="active"
        ></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="images/slider1.jpg" class="d-block w-100" alt="" />
        </div>
        <div class="carousel-item">
          <img src="images/slider2.jpg" class="d-block w-100" alt="" />
        </div>
      </div>
      <a
        class="carousel-control-prev"
        href="#carouselExampleIndicators"
        role="button"
        data-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a
        class="carousel-control-next"
        href="#carouselExampleIndicators"
        role="button"
        data-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="coffee-details pt-4 pb-4">
      <div class="row container" style="justify-content: space-between">
        <div class="d-inline">hollywood Cafe - كافيه هولوود</div>
        <div class="d-inline">
          <img
            src="images/logo.jpg"
            alt=""
            width="50px"
            height="50px"
            style="border-radius: 50%"
          />
        </div>
      </div>
      <p class="container">kjsasdjkjsadlkdsalkdkndkjada</p>
    </div>
    <div class="mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path
          fill="#fff5e9"
          fill-opacity="1"
          d="M0,224L26.7,229.3C53.3,235,107,245,160,250.7C213.3,256,267,256,320,224C373.3,192,427,128,480,133.3C533.3,139,587,213,640,234.7C693.3,256,747,224,800,202.7C853.3,181,907,171,960,192C1013.3,213,1067,267,1120,245.3C1173.3,224,1227,128,1280,106.7C1333.3,85,1387,139,1413,165.3L1440,192L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"
        ></path>
      </svg>
    </div>
    <form class="container" style="text-align: right">
      <div class="form-group">
        <label for="exampleInputEmail1 " class="w-full d-block title"
          >عدد الزوار</label
        >
        <div style="text-align: center">
          <button
            type="button"
            class="btn btn-primary"
            style="background: #581642"
            @click="increaseGuestsCount"
          >
            +
          </button>
          <input
            type="text"
            class="form-control d-inline"
            style="width: 50px; text-align: center"
            disabled
            value="1"
            v-model="form.guests_count"
          />
          <button
            type="button"
            class="btn btn-primary"
            style="background: #581642"
            @click="decreaseGuestsCount"
          >
            -
          </button>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="title">التاريخ</label>
        <input
          type="date"
          class="form-control"
          style="text-align: right"
          required
          v-model="form.date"
        />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1" class="w-full d-block title"
          >الاوقات المتاحة</label
        >
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            v-model="form.interval"
            value="0"
          />
          <label class="form-check-label" for="inlineRadio1"
            >من ٨ الى ١٠ مساء</label
          >
        </div>
        <div class="form-check form-check-inline">
          <input
            class="form-check-input"
            type="radio"
            v-model="form.interval"
            value="1"
          />
          <label class="form-check-label" for="inlineRadio2"
            >من ١٠ الى ١٢ مساء</label
          >
        </div>
      </div>
      <div class="row" style="flex-direction: row-reverse">
        <div class="col-8 title">(١٠٠* {{ form.guests_count }}) السعر</div>
        <div class="col-4 price">ريال {{ price }}</div>
        <div class="col-8 title">ضريبة القيمة المضافة</div>
        <div class="col-4 price">ريال {{ tax }}</div>
        <div class="col-8 title">المبلغ الاجمالي</div>
        <div class="col-4 price">ريال {{ totalAmount }}</div>
      </div>
      <div class="form-group mt-4">
        <label for="exampleInputPassword1" class="title d-block"
          >طرق الدفع</label
        >
        <img src="images/mada.png" alt="" class="d-inline" width="100px" />
        <img
          src="images/mastercard.svg"
          alt=""
          class="d-inline"
          width="100px"
        />
        <img src="images/visa.png" alt="" class="d-inline" width="100px" />
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1" class="title">الاسم</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'form-group--error': $v.form.name.$error }"
          id="exampleFormControlInput1"
          placeholder="اكتب اسمك"
          required
          v-model="form.name"
        />
        <div
          class="invalid-feedback"
          v-if="!$v.form.name.required && $v.form.name.$error"
        >
          الرجاء كتابة الاسم
        </div>
        <div
          class="invalid-feedback"
          v-if="!$v.form.name.minLength && $v.form.name.$error"
        >
          يجب ان يكون الاسم على الاقل ٣ حروف
        </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1" class="title">رقم الجوال</label>
        <input
          type="text"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="اكتب رقم جوالك"
          required
          v-model="form.phone"
          :class="{ 'form-group--error': $v.form.phone.$error }"
        />
        <div
          class="invalid-feedback"
          v-if="!$v.form.phone.required && $v.form.phone.$error"
        >
          الرجاء كتابة رقم الجوال
        </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1" class="title">ملاحظات</label>
        <textarea
          class="form-control"
          id="exampleFormControlTextarea1"
          rows="3"
          v-model="form.notes"
        ></textarea>
      </div>
      <div class="notes mb-3">
        <h3>ملاحظات</h3>
        <ul style="direction: rtl">
          <li>المبالغ المدفوعة غير قابلة للااسترجاع</li>
          <li>يسمح الدخول الى الكافيه حسب الوقت المحدد لحجزك</li>
          <li>غير مسموح للاطفال من ١٥ سنة او اقل</li>
          <li>
            حجزك ساري لمدة ساعتين وسيتم الغاءه في حال التاخر وعدم الحضور لمدة
            تزيد عن ٣٠ دقيقة
          </li>
        </ul>
      </div>
      <div class="form-check" style="direction: rtl">
        <input
          class="form-check-input"
          type="checkbox"
          value=""
          id="defaultCheck1"
          required
          v-model="form.terms"
          :class="{ 'form-group--error': showTermsError }"
        />
        <label class="form-check-label" for="defaultCheck1">
          لقد قرات وقبلت الشروط والاحكام
        </label>
        <div class="invalid-feedback" v-if="showTermsError">
          الرجاء الموافقة على الشروط والاحكام
        </div>
      </div>
      <div class="w-full">
        <button
          type="button"
          @click="sendReservation"
          class="btn btn-primary mt-2"
          style="width: 100%"
        >
          اتمام الحجز
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { required, minLength } from "vuelidate/lib/validators";
export default {
  components: {},
  data() {
    let currentDate = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
    let dateString =
      currentDate.getFullYear().toString() +
      "-" +
      (currentDate.getMonth() + 1).toString().padStart(2, 0) +
      "-" +
      currentDate.getDate().toString().padStart(2, 0);
    return {
      form: {
        name: "",
        phone: "",
        notes: "",
        price: 0,
        interval: 0,
        date: dateString,
        guests_count: 1,
        terms: false,
      },
      showTermsError: false,
    };
  },
  validations: {
    form: {
      name: { required, minLength: minLength(3) },
      phone: { required },
    },
  },
  methods: {
    increaseGuestsCount() {
      this.form.guests_count++;
    },
    decreaseGuestsCount() {
      if (this.form.guests_count > 1) this.form.guests_count--;
    },
    sendReservation() {
      this.$v.form.$touch();

      if (this.$v.form.$invalid) {
        return;
      }
      if (!this.form.terms) {
        this.showTermsError = true;
        return;
      }
      this.form.total_amount = this.totalAmount;
      axios.post("/reservation", this.form).then((response) => {
        window.location.href = response.data.url;
      });
    },
  },
  computed: {
    price() {
      return this.form.guests_count * 100;
    },
    tax() {
      return this.price * 0.15;
    },
    totalAmount() {
      return this.price + this.tax;
    },
  },
};
</script>

<style  scoped>
.slider-image {
  min-height: 50vh;
  width: 100%;
  background-repeat: no-repeat !important;
  background-size: cover !important;
  background-position: center !important;
  background-attachment: fixed !important;
  margin: 0 !important;
}
.coffee-details {
  background: #fff5e9;
}
.container {
  margin: auto !important;
  color: #4c4c4c;
}
.form-control::placeholder {
  text-align: right;
}
.form-check-input {
  position: relative;
  margin-left: 0;
}
.price {
  font-size: 18pt;
  font-weight: 700;
  text-align: left;
}
.price:last-of-type {
  background: #581642;
  color: #fff;
}
.title {
  font-size: 13pt;
  font-weight: 600;
}
.notes {
  color: #4c4c4c;
  border: 1px solid #bbb;
  border-radius: 10px;
  padding: 10px 15px;
}
.invalid-feedback {
  display: block;
}
</style>
