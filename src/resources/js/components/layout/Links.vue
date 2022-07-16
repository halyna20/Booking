<template>
  <li class="nav-item">
    <router-link
      :class="{ active: $route.name === 'Home' }"
      class="nav-link"
      to="/"
      >Головна</router-link
    >
  </li>
  <li class="nav-item" v-if="!token">
    <router-link
      :class="{ active: $route.name === 'Login' }"
      class="nav-link"
      to="/user/login"
      >Увійти</router-link
    >
  </li>
  <li class="nav-item" v-if="!token">
    <router-link
      :class="{ active: $route.name === 'Registration' }"
      class="nav-link pe-0"
      to="/user/registration"
      >Зареєструватись</router-link
    >
  </li>
  <li class="nav-item" v-if="token">
    <router-link
      :class="{ active: $route.name === 'CreateApartment' }"
      class="nav-link pe-0"
      to="/apartment/create"
      >Зареєструвати помешкання</router-link
    >
  </li>

  <li class="nav-item dropdown" v-if="token">
    <a
      class="nav-link dropdown-toggle"
      href="#"
      id="navbarDropdownMenuLink"
      role="button"
      data-bs-toggle="dropdown"
      aria-expanded="false"
    >
      Профіль
    </a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <li>
        <router-link class="dropdown-item" to="/user/profile">
          Мій акаунт
        </router-link>
      </li>
      <li>
        <router-link class="dropdown-item" to="/user/booking"
          >Бронювання</router-link
        >
      </li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
    </ul>
  </li>
  <li class="nav-item" v-if="token">
    <a @click.prevent="logout" href="#" class="nav-link pe-0">Вихід</a>
  </li>
</template>

<script>

import { mapActions } from "vuex";
export default {
  name: "Links",
  data() {
    return {
      token: null,
      //user: null,
    };
  },
  mounted() {
    this.getToken();
  },
  updated() {
    this.getToken();
  },
  methods: {
    ...mapActions({ logout: "auth/logout" }),
    getToken() {
      this.token = localStorage.getItem("x_xsrf_token");
    },
  },
};
</script>

<style>
</style>
