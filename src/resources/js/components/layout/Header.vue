<template lang="">

        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <router-link to="/" class="navbar-brand fs-1" >Several Nights</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div  class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <div v-if="token" class="dropdown notification">
                        <a
                        class="btn btn-link p-0 dropdown-toggle position-relative"
                        href="#"
                        role="button"
                        id="dropdownMenuLink"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        >
                        <img class="notification-img" :src="baseUrl + '/img/bell.png'" />
                        <span
                            v-if="user != null && user.email_verified_at == null"
                            class="
                            position-absolute
                            translate-middle
                            bg-danger
                            border border-light
                            rounded-circle
                            "
                        >
                            <span class="visually-hidden">New alerts</span>
                        </span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <div class="card" style="width: 18rem">
                            <div class="card-body">
                            <h5 class="card-title">Сповіщення</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li
                                v-if="user != null && user.email_verified_at == null"
                                class="list-group-item"
                            >
                                <img class="col-2 mt-2" :src="baseUrl + '/img/alert-icon.png'" />
                                <span class="col-10 float-end fs-5 p-0 ps-2"
                                >Підтвердіть свою електронну адресу</span
                                >
                            </li>
                            <li v-else class="list-group-item">Сповіщень не знайдено</li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    <ul class="navbar-nav mr-auto">
                       <links ref="userToken" />
                    </ul>
                </div>
            </div>
        </nav>
</template>
<script>
import { mapGetters } from "vuex";
import Links from "./Links";
import config from "../../config/config";
export default {
  name: "Header",
  data() {
    return {
      baseUrl: config.BASE_URL,
      token: null,
    };
  },
  mounted() {
    this.getToken();
  },
  updated() {
    this.getToken();
  },
  components: {
    Links,
  },
  computed: {
    ...mapGetters({ user: "auth/getUser" }),
  },
  methods: {
    getToken() {
      this.token = localStorage.getItem("x_xsrf_token");
    },
  },
};
</script>
