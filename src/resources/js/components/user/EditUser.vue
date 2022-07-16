<template>
  <form action="" :class="this.$parent.editUser == true ? '' : 'd-none'">
    <div>
      <div class="mb-3 row">
        <label for="first_name" class="col-sm-2 col-form-label"> Ім'я </label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            id="first_name"
            v-model="firstName"
          />
        </div>
      </div>
      <div class="mb-3 row">
        <label for="last_name" class="col-sm-2 col-form-label">
          Прізвище
        </label>
        <div class="col-sm-10">
          <input
            type="text"
            v-model="lastName"
            class="form-control"
            id="last_name"
          />
        </div>
      </div>
      <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
          <input
            type="text"
            class="form-control"
            id="email"
            readonly
            :value="user.email"
          />
        </div>
      </div>
      <div class="mb-3 row">
        <label for="phone" class="col-sm-2 col-form-label">
          Номер телефону
        </label>
        <div class="col-sm-10">
          <input type="text" v-model="phone" class="form-control" id="phone" />
        </div>
      </div>
      <div class="mb-3 row">
        <label for="country" class="col-sm-2 col-form-label"> Країна </label>
        <div class="col-sm-10">
          <select id="country" v-model="country" class="form-select">
            <option
              v-for="country in countries"
              :key="country.id"
              :value="country.id"
            >
              {{ country.name }}
            </option>
          </select>
        </div>
      </div>
      <button @click.prevent="updateUser(user.id)" class="btn btn-yellow">
        Оновити
      </button>
    </div>
  </form>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import config from "../../config/config";
export default {
  name: "EditUser",
  data() {
    return {
      firstName: "",
      lastName: "",
      phone: null,
      country: null,
    };
  },
  props: ["user"],
  computed: {
    ...mapGetters({
      countries: "country/getCountries",
    }),
  },
  mounted() {
    this.getCountries();
  },
  methods: {
    ...mapActions({
      getCountries: "country/getCountries",
      userUpdate: "user/editUser",
    }),
    updateUser(id) {
      this.userUpdate({
        id: id,
        firstName: this.firstName,
        lastName: this.lastName,
        phone: this.phone,
        country: this.country,
      });
      this.$parent.editUser = false;
    },
  },
};
</script>

<style>
</style>
