<template>
  <div>
    <div class="login-page">
      <form class="form">
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
        <button type="submit" @click.prevent="submitLogin">Увійти</button>

        <p class="message">
          Ще не зареєстровані?
          <router-link to="/user/registration">Створити акаунт</router-link>
        </p>

        <router-link to="/forgot-password">
          <p class="message">Забули пароль? <a href="#">Змінити пароль</a></p>
        </router-link>
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

<style lang="scss">
.login-page {
  width: 360px;
  padding: 8% 0 0;
  margin: auto;
  display: flex;
}
/* The alert message box */
.alert {
  padding: 20px;
  background-color: #f44336; /* Red */
  color: white;
  margin-bottom: 15px;
}
/* The close button */
.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}
/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}
</style>
