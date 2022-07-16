<template>
  <div class="container create-room">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title text-center">Створення номеру</h3>
            <div
              class="
                alert alert-success alert-dismissible
                fade
                show
                col-6
                m-auto
              "
              role="alert"
              v-show="message.success"
              style="background-color: #d1e7dd; color: #0f5132"
            >
              {{ message.success }}
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Close"
              ></button>
            </div>
            <form class="col-6 m-auto" @submit.prevent="createRoom">
              <div class="mb-3">
                <label for="name" class="form-label">Назва номеру</label>
                <input
                  type="text"
                  v-model="name"
                  :class="{ 'is-invalid': message.name }"
                  class="form-control"
                  id="name"
                />
                <div v-show="message.name" class="invalid-feedback">
                  <span v-for="nameError in message.name" :key="nameError">
                    {{ nameError }}
                  </span>
                </div>
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Опис</label>
                <textarea
                  class="form-control"
                  :class="{ 'is-invalid': message.description }"
                  id="description"
                  v-model="description"
                  rows="3"
                ></textarea>
                <div v-show="message.description" class="invalid-feedback">
                  <span
                    v-for="descriptionError in message.description"
                    :key="descriptionError"
                  >
                    {{ descriptionError }}
                  </span>
                </div>
              </div>

              <div class="mb-3">
                <label for="number_of_adults" class="form-label"
                  >Кількість дорослих</label
                >
                <input
                  type="number"
                  v-model="number_of_adults"
                  :class="{ 'is-invalid': message.number_of_adults }"
                  class="form-control"
                  id="number_of_adults"
                />
                <div v-show="message.number_of_adults" class="invalid-feedback">
                  <span
                    v-for="numberAdultsError in message.number_of_adults"
                    :key="numberAdultsError"
                  >
                    {{ numberAdultsError }}
                  </span>
                </div>
              </div>

              <div class="mb-3">
                <label for="number_of_children" class="form-label"
                  >Кількість дітей</label
                >
                <input
                  type="number"
                  v-model="number_of_children"
                  :class="{ 'is-invalid': message.number_of_children }"
                  class="form-control"
                  id="number_of_children"
                />
                <div v-if="message.number_of_children" class="invalid-feedback">
                  <span
                    v-for="numberChildrenError in message.number_of_children"
                    :key="numberChildrenError"
                  >
                    {{ numberChildrenError }}
                  </span>
                </div>
              </div>

              <div class="mb-3">
                <label for="size" class="form-label">Розмір номеру</label>
                <input
                  type="number"
                  v-model="size"
                  :class="{ 'is-invalid': message.size }"
                  class="form-control"
                  id="size"
                />
                <div v-show="message.size" class="invalid-feedback">
                  <span v-for="sizeError in message.size" :key="sizeError">
                    {{ sizeError }}
                  </span>
                </div>
              </div>

              <div class="mb-3">
                <label for="price" class="form-label">Ціна</label>
                <input
                  type="number"
                  v-model="price"
                  :class="{ 'is-invalid': message.price }"
                  class="form-control"
                  id="price"
                />
                <div v-show="message.price" class="invalid-feedback">
                  <span v-for="priceError in message.price" :key="priceError">
                    {{ priceError }}
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
  name: "CreateRoom",
  data() {
    return {
      name: "",
      description: "",
      number_of_adults: null,
      number_of_children: null,
      size: null,
      price: null,
    };
  },
  computed: {
    ...mapGetters({ message: "room/getMessage" }),
  },
  methods: {
    ...mapActions({ create: "room/addRoom" }),
    createRoom() {
      if (this.number_of_children === "" || this.number_of_children === null) {
        this.number_of_children = 0;
      }

      this.create({
        name: this.name,
        description: this.description,
        number_of_adults: this.number_of_adults,
        number_of_children: this.number_of_children,
        size: this.size,
        price: this.price,
      });

      this.name = "";
      this.description = "";
      this.number_of_adults = null;
      this.number_of_children = null;
      this.size = null;
      this.price = null;
    },
  },
};
</script>

<style>
</style>
