<template>
  <div class="page">
    <div class="register-page m-auto d-flex pt-5">
      <form class="form position-relative m-auto p-5 text-center">
        <div class="mb-3">
          <input
            type="text"
            placeholder="email"
            v-model="email"
            :class="{ 'is-invalid': errors.email }"
            class="form-control border-0"
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
            class="form-control border-0"
          />
          <div v-show="errors.password" class="invalid-feedback">
            <span v-for="passwordError in errors.password" :key="passwordError">
              {{ passwordError }}
            </span>
          </div>
        </div>
        <div class="mb-3">
          <input
            type="password"
            placeholder="Повторіть пароль"
            v-model="password_confirmation"
            :class="{ 'is-invalid': errors.password }"
            class="form-control border-0"
          />
        </div>
        <button type="submit" class="btn btn-yellow" @click.prevent="register">
          Зареєструватись
        </button>

        <p class="message m-3 fs-6">
          Вже зареєстровані?
          <router-link to="/user/login">Увійти </router-link>
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Registration",
  data() {
    return {
      email: null,
      password: null,
      password_confirmation: null,
    };
  },
  computed: {
    ...mapGetters({ errors: "auth/getErrorsRegister" }),
  },
  methods: {
    ...mapActions({ registration: "auth/registerUser" }),
    register() {
      this.registration({
        email: this.email,
        password: this.password,
        password_confirmation: this.password_confirmation,
      });
    },
  },
};
</script>

