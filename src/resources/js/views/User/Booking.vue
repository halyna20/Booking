<template>
  <section class="user-booking">
    <div class="container">
      <h3 class="text-center fw-bolder mt-4 mb-4">Мої бронювання</h3>
      <div
        class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"
        v-if="Object.keys(booking).includes('rooms')"
      >
        <div class="col" v-for="(i, index) in roomsCount" :key="i">
          <div class="card" style="max-width: 350px">
            <img :src="images[index]['link'][0]" class="card-img-top" alt="" />
            <div class="card-img-overlay p-0">
              <p class="card-text p-2">
                {{ status[index][index] }}
              </p>
            </div>

            <div class="card-body">
              <h5 class="card-title">
                {{ booking.apartment[index][0]["name"] }}
              </h5>
              <p class="card-text">
                {{ booking.apartment[index][0]["city"]["name"] }}
              </p>
              <p class="card-text">
                {{ booking.rooms[index][0]["price"] }} грн.
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">
                  з {{ booking.booking_date[index]["date_from"] }} <br />
                  по {{ booking.booking_date[index]["date_to"] }}
                </small>
                <button
                  v-if="cancel[index][index]"
                  type="button"
                  class="btn btn-sm btn-outline-danger"
                  @click.prevent="
                    deleteBooking(
                      booking.booking_date[index]['id'],
                      booking.booking_date[index].booking_rooms[0]['id']
                    )
                  "
                >
                  Скасувати
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex align-items-center justify-content-center" v-else>
        <h1>{{ booking.message }}</h1>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "UserBooking",
  data() {
    return {
      color: [],
    };
  },
  created() {
    this.getBooking();
  },
  updated() {
    this.booking;
  },
  computed: {
    ...mapGetters({ booking: "user/getBooking" }),
    images() {
      let images = [];
      if (this.booking.apartment !== null) {
        for (var key in this.booking.apartment) {
          images.push(JSON.parse(this.booking.apartment[key][0].image));
        }
      }

      return images;
    },
    roomsCount() {
      let count = 0;
      if (this.booking.rooms != null) {
        count = Object.keys(this.booking.rooms).length;
      }
      return count;
    },
    cancel() {
      let currentDate = this.getCurrentDate();
      let cancelValue = [];
      if (this.booking.booking_date != null) {
        for (var key in this.booking.booking_date) {
          let dateFrom = new Date(this.booking.booking_date[key].date_from);
          dateFrom = dateFrom.toISOString().split("T")[0];
          if (dateFrom > currentDate) {
            cancelValue.push({ [key]: true });
          } else {
            cancelValue.push({ [key]: false });
          }
        }
      }
      return cancelValue;
    },
    status() {
      let currentDate = this.getCurrentDate();
      let statusBooking = [];

      if (this.booking.booking_date != null) {
        for (var key in this.booking.booking_date) {
          let dateTo = new Date(this.booking.booking_date[key].date_to);
          dateTo = dateTo.toISOString().split("T")[0];

          if (dateTo < currentDate) {
            statusBooking.push({ [key]: "Завершено" });
            this.color.push({ [key]: "grey" });
          } else {
            if (this.booking.booking_date[key].is_approved == 0) {
              statusBooking.push({ [key]: "Не підтверджено" });
              this.color.push({ [key]: "white" });
            } else if (this.booking.booking_date[key].is_approved == 1) {
              statusBooking.push({ [key]: "Підтверджено" });
              this.color.push({ [key]: "green" });
            }
          }
        }
      }
      return statusBooking;
    },
  },
  methods: {
    ...mapActions({
      getBooking: "user/getBooking",
      bookingDelete: "booking/deleteBooking",
    }),
    getCurrentDate() {
      let currentDate = new Date();
      currentDate = currentDate.toISOString().split("T")[0];
      return currentDate;
    },
    deleteBooking(bookingDateId, bookingRoomId) {
      this.bookingDelete({
        bookingDateId,
        bookingRoomId,
      });
    },
  },
};
</script>

<style>
</style>
