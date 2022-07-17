<template>
  <section class="page">
    <div class="container mt-5">
      <div class="booking-container">
        <h4>Підтвердження бронювання</h4>
        <div
          v-if="message"
          class="alert alert-light d-flex align-items-center"
          role="alert"
        >
          {{ message }}
        </div>
        <div class="list-group m-auto">
          <div
            class="list-group-item list-group-item-action p-4"
            aria-current="true"
            v-for="(i, index) in roomsBooking"
            :key="i"
          >
            <div class="row">
              <div class="col-10">
                <h5 class="mb-1">{{ roomsBooking[index].name }}</h5>
                <p class="mb-1">{{ roomsBooking[index].price }} грн.</p>
              </div>
              <div class="col-2">
                <img class="w-100" :src="images[index]['link'][0]" />
              </div>
            </div>
          </div>

          <div class="row">
            <p><b>Кількість дорослих:</b> {{ userParam.adult }}</p>
            <p v-if="userParam.child > 0">
              Кількість дiтей: {{ userParam.child }}
            </p>
            <small>
              <b>з</b> {{ userParam.dateFrom }} <br />
              <b>по</b> {{ userParam.dateTo }}
            </small>
            <h5>Загальна ціна: {{ total }} грн.</h5>
          </div>
        </div>
        <button class="btn btn-yellow" @click="sendBookingRoom">
          Підтвердити
        </button>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "Book",

  computed: {
    ...mapGetters({
      roomsBooking: "booking/getBookingRooms",
      message: "booking/getMessage",
      userParam: "main/getSearchParam",
    }),
    images() {
      let images = [];
      for (var key in this.roomsBooking) {
        images.push(JSON.parse(this.roomsBooking[key].image));
      }

      return images;
    },
    total() {
      let totalPrice = 0;
      for (var key in this.roomsBooking) {
        totalPrice = this.roomsBooking[key].price + totalPrice;
      }
      return totalPrice;
    },
  },
  methods: {
    ...mapActions({ addBooking: "booking/addBooking" }),
    sendBookingRoom() {
      this.addBooking();
    },
  },
};
</script>

<style>
</style>
