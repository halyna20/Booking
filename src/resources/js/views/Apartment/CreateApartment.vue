<template>
  <div class="container create-apartment">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center">Створення апартаменту</h3>
            <form
              class="col-6 m-auto"
              method="POST"
              @submit.prevent="createApartment"
            >
              <div class="mb-3">
                <label for="name" class="form-label">Назва апартаменту</label>
                <input
                  type="text"
                  v-model="name"
                  :class="{ 'is-invalid': errors.name }"
                  class="form-control"
                  id="name"
                />
                <div v-show="errors.name" class="invalid-feedback">
                  <span v-for="nameError in errors.name" :key="nameError">
                    {{ nameError }}
                  </span>
                </div>
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">Місто</label>
                <select
                  id="city"
                  v-model="city"
                  class="form-select"
                  :class="{ 'is-invalid': errors.city_id }"
                >
                  <option
                    v-for="city in cities"
                    :key="city.id"
                    :value="city.id"
                  >
                    {{ city.name }}
                  </option>
                </select>
                <div v-show="errors.city_id" class="invalid-feedback">
                  <span v-for="cityError in errors.city_id" :key="cityError">
                    {{ cityError }}
                  </span>
                </div>
              </div>
              <div class="mb-3">
                <label for="address" class="form-label">Адреса</label>
                <input
                  type="text"
                  v-model="address"
                  :class="{ 'is-invalid': errors.address }"
                  class="form-control"
                  id="address"
                />
                <div v-show="errors.address" class="invalid-feedback">
                  <span
                    v-for="addressError in errors.address"
                    :key="addressError"
                  >
                    {{ addressError }}
                  </span>
                </div>
              </div>
              <div class="mb-3">
                <label for="type" class="form-label">Тип помешкання</label>
                <select
                  id="type"
                  v-model="type"
                  class="form-select"
                  :class="{ 'is-invalid': errors.type_id }"
                >
                  <option v-for="type in types" :key="type.id" :value="type.id">
                    {{ type.name }}
                  </option>
                </select>
                <div v-show="errors.type_id" class="invalid-feedback">
                  <span v-for="typeError in errors.type_id" :key="typeError">
                    {{ typeError }}
                  </span>
                </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Опис</label>
                <textarea
                  class="form-control"
                  id="description"
                  v-model="description"
                  rows="3"
                  :class="{ 'is-invalid': errors.description }"
                ></textarea>
                <div v-show="errors.description" class="invalid-feedback">
                  <span
                    v-for="descriptionError in errors.description"
                    :key="descriptionError"
                  >
                    {{ descriptionError }}
                  </span>
                </div>
              </div>
              <button type="submit" class="btn btn-yellow">Зберегти</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "CreateApartment",
  data() {
    return {
      name: "",
      city: "",
      address: "",
      type: "",
      description: "",
    };
  },
  computed: {
    ...mapGetters({
      types: "typeApartment/getTypes",
      cities: "city/getCities",
      errors: "apartment/getErrors",
    }),
  },
  mounted() {
    this.getTypes();
    this.getCities();
  },
  methods: {
    ...mapActions({
      getTypes: "typeApartment/getTypes",
      getCities: "city/getCities",
      create: "apartment/addApartment",
    }),
    createApartment() {
      this.create({
        name: this.name,
        address: this.address,
        description: this.description,
        city: this.city,
        type: this.type,
      });
    },
  },
};
</script>

<style>
</style>
