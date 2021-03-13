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
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
          <label class="btn btn-secondary active">
            <input
              type="radio"
              id="option1"
              value="0"
              checked
              v-model="form.interval"
            />
            من ٦ الى ١٠ مساء
          </label>
          <label class="btn btn-secondary">
            <input
              type="radio"
              id="option2"
              value="1"
              v-model="form.interval"
            />
            من ١٠ الى ١٢ مساء
          </label>
        </div>
      </div>
      <div class="row" style="flex-direction: row-reverse">
        <div class="col-8 title">السعر</div>
        <div class="col-4 price">ريال {{ price }}</div>
        <div class="col-8 title">ضريبة القيمة المضافة</div>
        <div class="col-4 price">ريال {{ tax }}</div>
        <div class="col-8 title">المبلغ الاجمالي</div>
        <div class="col-4 price">ريال {{ totalAmount }}</div>
      </div>
      <div class="form-group mt-4">
        <label for="exampleInputPassword1" class="title">طريقة الدفع</label>
        <div class="form-check" style="direction: rtl">
          <input
            class="form-check-input"
            type="radio"
            id="exampleRadios1"
            value="0"
            checked
            v-model="form.paymentMethod"
          />
          <label class="form-check-label title" for="exampleRadios1">
            كاش
          </label>
        </div>
        <div class="form-check" style="direction: rtl">
          <input
            class="form-check-input"
            type="radio"
            id="exampleRadios2"
            value="1"
            v-model="form.paymentMethod"
          />
          <label class="form-check-label title" for="exampleRadios2">
            اونلاين
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="exampleFormControlInput1" class="title">الاسم</label>
        <input
          type="text"
          class="form-control"
          id="exampleFormControlInput1"
          placeholder="اكتب اسمك"
          required
          v-model="form.name"
        />
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
        />
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
        />
        <label class="form-check-label" for="defaultCheck1">
          لقد قرات وقبلت الشروط والاحكام
        </label>
      </div>
      <button
        type="button"
        @click="sendReservation"
        class="btn btn-primary mt-2"
      >
        احجز
      </button>
    </form>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      form: {
        name: "",
        phone: "",
        notes: "",
        paymentMethod: "0",
        price: 0,
        interval: 0,
        date: "",
        guests_count: 1,
      },
    };
  },
  methods: {
    increaseGuestsCount() {
      this.form.guests_count++;
    },
    decreaseGuestsCount() {
      if (this.form.guests_count > 1) this.form.guests_count--;
    },
    sendReservation() {
      this.form.total_amount = this.totalAmount;
      axios.post("/reservation", this.form).then((response) => {
        // window.location.href = response.data.url;
      });
    },
  },
  computed: {
    price() {
      return this.form.guests_count * 500;
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
</style>
