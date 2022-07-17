<template>
  <div class="page">
    <div class="login-page d-flex m-auto pt-5">
      <form class="form position-relative m-auto p-5 text-center">
        <div class="mb-3">
          <input
            type="email"
            placeholder="email"
            v-model="email"
            :class="{ 'is-invalid': errors.email }"
            class="form-control"
          />
          <div v-show="errors.email" class="invalid-feedback">
            <span v-for="emailError in errors.email" :key="emailError">
              {{ emailError }}
            </span>
          </div>
        </div>
        <div class="mb-3">
          <input
            type="password"
            placeholder="Пароль"
            v-model="password"
            :class="{ 'is-invalid': errors.password }"
            class="form-control"
          />
          <div v-show="errors.password" class="invalid-feedback">
            <span v-for="passwordError in errors.password" :key="passwordError">
              {{ passwordError }}
            </span>
          </div>
        </div>
        <button
          class="btn btn-yellow"
          type="submit"
          @click.prevent="submitLogin"
        >
          Увійти
        </button>

        <p class="message">
          Ще не зареєстровані? <br />
          <router-link to="/user/registration">Створити акаунт</router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Login",
  data() {
    return {
      email: null,
      password: null,
    };
  },
  computed: {
    ...mapGetters({ errors: "auth/getErrorsLogin" }),
  },
  methods: {
    ...mapActions({ login: "auth/loginUser" }),
    submitLogin() {
      this.login({ email: this.email, password: this.password });
    },
  },
};
</script>

