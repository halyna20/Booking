<template>
  <div>
    <div class="register-page">
      <form class="form">
        <div class="mb-3">
          <input
            type="text"
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
        <div class="mb-3">
          <input
            type="password"
            placeholder="Повторіть пароль"
            v-model="password_confirmation"
            :class="{ 'is-invalid': errors.password }"
            class="form-control"
          />
        </div>
        <button type="submit" @click.prevent="register">Зареєструватись</button>

        <p class="message">
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

<style lang="scss">
.register-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
  display: flex;
}
.form {
  position: relative;
  z-index: 1;
  background-color: var(--color-grey-dark-1);
  background-image: linear-gradient(rgba(#101d2c, 0.93), rgba(#101d2c, 0.93)),
    url(/../../../img/book.jpg);
  background-size: cover;
  background-position: center;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5), 0 5px 0 rgba(0, 0, 0, 0.2);
}
.form input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  box-sizing: border-box;
  font-size: 14px;
}
.form .message {
  margin: 15px;
  color: #b3b3b3;
  font-size: 12px;
}
.form .message a {
  color: #c69963;
  text-decoration: none;
}
</style>
