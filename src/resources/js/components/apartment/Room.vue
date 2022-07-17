<template>
  <div class="container mt-5">
    <div
      v-if="error"
      class="alert alert-danger d-flex align-items-center"
      role="alert"
    >
      {{ error }}
    </div>
    <div class="row justify-content-around">
      <table class="table w-75">
        <thead>
          <tr>
            <th scope="col">Номер</th>
            <th scope="col">Розмір</th>
            <th scope="col">Кількість дорослих</th>
            <th scope="col">Кількість дітей</th>
            <th scope="col">Ціна</th>
            <th scope="col">Обрати</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="room in rooms" :key="room.room_id">
            <td class="col-2">
              {{ room.name }}
              <hr />
              {{ room.description }}
            </td>
            <td>{{ room.size }}</td>
            <td>{{ room.number_of_adults }}</td>
            <td>{{ room.number_of_children }}</td>
            <td>{{ room.price }}</td>
            <td>
              <input
                class="form-check-input"
                type="checkbox"
                :value="room.room_id"
                v-model="chekedRoom"
              />
            </td>
          </tr>
        </tbody>
      </table>
      <button @click="booking()" class="btn btn-yellow col-2 ms-5 h-25">
        Забронювати
      </button>
    </div>
  </div>
</template>

<script>
import router from "../../router";
import { mapGetters, mapMutations } from "vuex";
export default {
  name: "Room",
  data() {
    return {
      chekedRoom: [],
      token: null,
      error: "",
      //user: null,
    };
  },
  computed: {
    ...mapGetters({ rooms: "main/getRooms", user: "auth/getUser" }),
  },
  updated() {
    this.getToken();
    //this.getUser();
  },
  methods: {
    ...mapMutations({ setBooking: "booking/setBookingRooms" }),
    booking() {
      if (!this.token) {
        this.error = "Щоб здійснити бронювання увійдіть у свій акаунт";
        return false;
      }

      if (!this.user.email_verified_at) {
        this.error =
          "Для здійснення бронювання підветрдіть свою електронну адресу";
        return false;
      }

      if (this.chekedRoom.length == 0) {
        this.error = "Оберіть кімнату для бронювання";
        return false;
      }

      let bookingRooms = this.rooms.filter((room) =>
        this.chekedRoom.some((i) => i == room.room_id)
      );
      this.setBooking(bookingRooms);

      router.push({ name: "Booking" });
    },

    getToken() {
      this.token = localStorage.getItem("x_xsrf_token");
    },
    //getUser() {
    //  this.user = JSON.parse(localStorage.getItem("user"));
    //},
  },
};
</script>

<style>
</style>
