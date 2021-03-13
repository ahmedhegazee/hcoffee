<template >
  <!--  -->
  <div class="wrapper">
    <!-- Page Content  -->
    <div id="content">
      <router-view></router-view>
    </div>
  </div>
</template>
<script>
export default {
  methods: {},
  computed: {},
};
</script>
<style >
.container-fluid {
  max-width: 1050px;
}
.bg-dark,
.btn-dark {
  background-color: #000000 !important;
}
.btn {
  border: none !important;
}
body {
  overflow-x: hidden;
}
#sidebar {
  z-index: 101;
}
.overflow {
  overflow: hidden;
}
.sidbar-header {
  height: 80px;
  padding-left: 25px;
  display: flex;
  align-items: center;
}
.sidbar-header .btn {
  background-color: transparent !important;
}
.payments li {
  display: inline-block;
  font-size: 35px;
}
@media (max-width: 768px) {
  .footer {
    text-align: center;
    padding-top: 0px;
  }
  .footer .col-sm-12 {
    margin-bottom: 20px;
  }
  .payments li {
    display: block;
    text-align: center;
  }
}
</style>
