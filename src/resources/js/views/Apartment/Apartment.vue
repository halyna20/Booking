<template>
  <section class="apartment-details page">
    <apartment-details></apartment-details>
    <room></room>
  </section>
</template>

<script>
import { mapActions } from "vuex";
import ApartmentDetails from "../../components/apartment/ApartmentDetails.vue";
import Room from "../../components/apartment/Room.vue";
export default {
  name: "Apartment",
  components: {
    ApartmentDetails,
    Room,
  },
  mounted() {
    this.getApartment();
  },

  methods: {
    ...mapActions({ getApartment: "main/getApartment" }),
  },
};
</script>

<style>
</style>
