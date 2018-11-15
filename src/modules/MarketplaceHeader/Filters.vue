<template>
<nav class="navbar navbar-expand-lg">
  <span class="navbar-brand mb-0 h1"><b>MARKET</b>PLACE</span>

    <form class="form-inline my-2 my-lg-0" >
      <input class="form-control mr-sm-2" type="search" placeholder="Search item, seller, etc." aria-label="Search" >
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>

    <table class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Verification Level
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">All</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Verified</a>
          <a class="dropdown-item" href="#">Official</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Course/Program
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">All</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Law</a>
          <a class="dropdown-item" href="#">Arts & Sciences</a>
          <a class="dropdown-item" href="#">Nursing</a>
          <a class="dropdown-item" href="#">Commerce</a>
          <a class="dropdown-item" href="#">Engineering</a>
          <a class="dropdown-item" href="#">Pharmacy</a>
          <a class="dropdown-item" href="#">Architecture & Fine Arts</a>
          <a class="dropdown-item" href="#">Education</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Price
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">All</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Low to High</a>
          <a class="dropdown-item" href="#">High to Low</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Rating
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">All</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Low to High</a>
          <a class="dropdown-item" href="#">High to Low</a>
        </div>
      </li>

         <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-dark" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          School
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">All</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">University of San Carlos</a>
          <a class="dropdown-item" href="#">Others</a>
        </div>
      </li>


    </table>
    <create-product></create-product>
</nav>
</template>


<script>
import ROUTER from '../../router'
import AUTH from '../../services/auth'
import CONFIG from '../../config.js'
import axios from 'axios'
export default {
  components: {
    'create-product': require('modules/MarketplaceHeader/Create.vue')
  },
  mounted(){
  },
  props: ['params'],
  methods: {
    redirect(parameter){
      ROUTER.push(parameter)
    }
  }
}
</script>
<style scoped>
.sample{
  padding: 0px;
  margin: 0px;
  width: 100%;
  float: left;
}

.sample li{
  width: 100%;
  float: left;
  height: 50px;
}
</style>
