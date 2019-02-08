<template>
  <div>
    <div class="customModal" id="loading">
      <span class="loading">
        <i class="fas fa-circle-o-notch fa-spin"></i>
      </span>
    </div>
  </div>
</template>
<script>
</script>
<style scoped>
.customModal{
  position: fixed;
  background: rgba(254, 254, 254, 0.5);
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  width: 100%;
  z-index: 100000 !important;
  -webkit-transition: all 0.3s;
  -moz-transition: all 0.3s;
  transition: all 0.3s;
  text-align: center;
  display: none;
}
.customModal .loading{
  font-size: 75px;
  margin-top: 20vh;
  height: 35vh;
  float: left;
  width: 20%;
  margin-left: 40%;
  margin-right: 40%;
  text-align: center;
  color: #3f0050;
  background: #fff;
  line-height: 30vh;
  border-radius: 5px;
  border: solid 1px #eee;
}
.fa-spin{
}
</style>
