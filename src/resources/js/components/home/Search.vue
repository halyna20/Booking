<template lang="ua">
    <div class="search">
        <div class="container px-3 py-4">

            <form id="searchApartment" method="GET" @submit.prevent="submitSearch" class="row g-3">
                <div class="col-3 pe-5">
                    <label for="city" class="pb-1">Ваш напрямок</label>
                    <input id="city"  class="form-control py-2" :class="{ 'is-invalid': errors.city }" type="search"  v-model="city" name="city">
                     <div v-show="errors.city" class="invalid-feedback">
                        <span v-for="cityError in errors.city">{{ cityError }}</span>
                    </div>
                </div>

                <div class="col-auto pe-4">
                    <label for="date_from" class="pb-1">Заїзд</label>
                    <input @change="changeLimitDateTo()" id="date_from"  class="form-control py-2" :class="{ 'is-invalid': errors.dateFrom }" type="date" name="date_from" v-model="dateFrom" :min="minDateFrom" :max="maxDateFrom">
                    <div v-show="errors.dateFrom" class="invalid-feedback">
                        <span v-for="dateFromError in errors.dateFrom">{{ dateFromError }}</span>
                    </div>
                </div>
                <div class="col-auto pe-5">
                    <label for="date_to" class="pb-1">Виїзд</label>
                    <input id="date_to"  class="form-control py-2" :class="{ 'is-invalid': errors.dateTo }" type="date" name="date_to" v-model="dateTo" :min="minDateTo" :max="maxDateTo">
                    <div v-show="errors.dateTo" class="invalid-feedback">
                        <span v-for="dateToError in errors.dateTo">{{ dateToError }}</span>
                    </div>
                </div>

                <div class="col-1 pe-4">
                    <label for="child" class="pb-1">Дитина</label>
                    <input id="child"  class="form-control py-2" :class="{ 'is-invalid': errors.child }" min="0" max="10" type="number" name="child"  v-model="child">
                    <div v-show="errors.child" class="invalid-feedback">
                        <span v-for="childError in errors.child">{{ childError }}</span>
                    </div>
                </div>
                <div class="col-1 pe-4">
                    <label for="adult" class="pb-1">Дорослий</label>
                    <input id="adult"  class="form-control py-2" :class="{ 'is-invalid': errors.adult }" min="1"  max="30" type="number" name="adult"  v-model="adult">
                    <div v-show="errors.adult" class="invalid-feedback">
                        <span v-for="adultError in errors.adult">{{ adultError }}</span>
                    </div>
                </div>

                <div class="col-2 pe-4">
                    <label for="room_count" class="pb-1">Кількість номерів</label>
                    <input id="room_count"  class="form-control py-2" :class="{ 'is-invalid': errors.roomCount }" type="number" min="1" name="room_count"  v-model="roomCount">
                    <div v-show="errors.roomCount" class="invalid-feedback">
                        <span v-for="roomCountError in errors.roomCount">{{ roomCountError }}</span>
                    </div>
                </div>

                <button type="submit" class="btn btn-yellow col-auto ms-2">Забронювати</button>
            </form>

        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Search",
  data() {
    return {
      city: "",
      dateFrom: "",
      dateTo: "",
      child: 0,
      adult: 1,
      roomCount: 1,
      minDateFrom: "",
      minDateTo: "",
      maxDateTo: "",
      maxDateFrom: "",
    };
  },
  computed: {
    ...mapGetters({
      errors: "main/getErrors",
    }),
  },
  created: function () {
    this.setLimitDateFrom();
  },
  methods: {
    ...mapActions({ findCities: "main/findCities", search: "main/search" }),

    setLimitDateFrom() {
      let currentDate = new Date();

      this.minDateFrom = currentDate.toISOString().split("T")[0];

      currentDate.setFullYear(currentDate.getFullYear() + 1);
      let maxDateFrom = currentDate.toISOString().split("T")[0];
      this.maxDateFrom = maxDateFrom;
    },

    changeLimitDateTo() {
      let dateFrom = new Date(this.dateFrom);

      let dateToMin = dateFrom.setDate(dateFrom.getDate() + 1);
      let minDateTo = new Date(dateToMin).toISOString().split("T")[0];
      this.minDateTo = minDateTo;

      let dateToMax = dateFrom.setDate(dateFrom.getDate() + 30);
      let maxDateTo = new Date(dateToMax).toISOString().split("T")[0];
      this.maxDateTo = maxDateTo;
    },

    submitSearch() {
      if (this.adult == "") {
        this.adult = 1;
      }
      if (this.roomCount == "") {
        this.roomCount = 1;
      }

      this.search({
        city: this.city,
        dateFrom: this.dateFrom,
        dateTo: this.dateTo,
        child: this.child,
        adult: this.adult,
        roomCount: this.roomCount,
      });
    },
  },
};
</script>
<style lang=""></style>
