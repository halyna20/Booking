<template>
  <div class="container">
    <div class="row">
      <div class="col-7">
        <h4>{{ apartment.name }}</h4>
        <p v-if="apartment.city != undefined">
          {{ apartment.address }}, {{ apartment.city.name }}
        </p>
        <div
          id="carouselExampleControls"
          class="carousel slide"
          data-bs-ride="carousel"
        >
          <div class="carousel-inner">
            <div
              class="carousel-item"
              v-for="(i, index) in images.length"
              :class="{ active: index === 0 }"
              :key="i"
            >
              <img :src="images[index]" class="d-block w-100" alt="..." />
            </div>
            <!--<div class="carousel-item">
              <img src="" class="d-block w-100" alt="..." />
            </div>
            <div class="carousel-item">
              <img src="" class="d-block w-100" alt="..." />
            </div>-->
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#carouselExampleControls"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#carouselExampleControls"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="col-4">
        <h5>Опис:</h5>
        <p>{{ apartment.description }}</p>
      </div>
    </div>
    {{ apartment }}
  </div>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "ApartmentDetails",
  computed: {
    ...mapGetters({ apartment: "main/getApartmentDetails" }),
    images() {
      let images = [];
      let links = [];

      if (this.apartment.image != undefined) {
        images.push(JSON.parse(this.apartment.image));
        for (var key in images[0]["link"]) {
          links.push(images[0]["link"][key]);
        }
      }

      return links;
    },
  },
};
</script>

<style>
</style>
