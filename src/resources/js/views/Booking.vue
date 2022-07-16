<template>
  <div>
    <div
      v-if="error"
      class="alert alert-danger d-flex align-items-center"
      role="alert"
    >
      {{ error }}
    </div>
    {{ roomsBooking }}
    <button @click="sendBookingRoom">Підтвердити</button>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Book",

  computed: {
    ...mapGetters({
      roomsBooking: "booking/getBookingRooms",
      error: "booking/getMessage",
    }),
  },
  methods: {
    ...mapActions({ addBooking: "booking/addBooking" }),
    sendBookingRoom() {
      console.log("ok");
      this.addBooking();
    },
  },
};
</script>

<style>
</style>
