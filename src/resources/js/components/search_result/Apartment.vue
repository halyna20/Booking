<template>
  <section class="search-result mt-5">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <div class="shadow-sm p-3 mb-5 rounded">
            <h5 class="filter-title mb-4 ps-3 fw-bolder">Фільтри</h5>
            <div class="accordion" id="accordionPanels">
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                  <button
                    class="accordion-button"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseOne"
                    aria-expanded="true"
                    aria-controls="panelsStayOpen-collapseOne"
                  >
                    Тип помешкання
                  </button>
                </h2>
                <div
                  id="panelsStayOpen-collapseOne"
                  class="accordion-collapse collapse show"
                  aria-labelledby="panelsStayOpen-headingOne"
                >
                  <div class="accordion-body"></div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseTwo"
                    aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseTwo"
                  >
                    Ціна
                  </button>
                </h2>
                <div
                  id="panelsStayOpen-collapseTwo"
                  class="accordion-collapse collapse"
                  aria-labelledby="panelsStayOpen-headingTwo"
                >
                  <div class="accordion-body"></div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                  <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapseThree"
                    aria-expanded="false"
                    aria-controls="panelsStayOpen-collapseThree"
                  >
                    Умови
                  </button>
                </h2>
                <div
                  id="panelsStayOpen-collapseThree"
                  class="accordion-collapse collapse"
                  aria-labelledby="panelsStayOpen-headingThree"
                >
                  <div class="accordion-body"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-9">
          <h3 class="fw-bolder mb-5">Помешкання</h3>
          <div
            class="card mb-3"
            v-for="(i, index) in apartmentsLenght"
            :key="i"
          >
            <div class="row g-0">
              <div class="col-md-4">
                <img
                  :src="images[index]['link'][0]"
                  class="img-fluid rounded-start"
                  alt="..."
                />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <router-link
                    :to="{
                      name: 'Apartment',
                      params: { id: apartments[index].id },
                    }"
                  >
                    {{ apartments[index].name }}
                  </router-link>

                  <p class="card-text">
                    <small class="text-muted">
                      {{ apartments[index].address }}
                    </small>
                  </p>
                  <p class="card-text">
                    {{ apartments[index].description }}
                  </p>

                  <router-link
                    :to="{
                      name: 'Apartment',
                      params: { id: apartments[index].id },
                    }"
                    class="btn btn-yellow"
                  >
                    Переглянути
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "SearchApartment",

  computed: {
    ...mapGetters({ apartments: "main/getApartments" }),
    images() {
      let images = [];
      for (var key in this.apartments) {
        images.push(JSON.parse(this.apartments[key].image));
      }
      return images;
    },
    apartmentsLenght() {
      return this.apartments.length;
    },
  },
};
</script>

<style>
</style>
