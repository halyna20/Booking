<template>
  <section class="page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-6">
          <h2 class="text-center">Особисті дані</h2>
          <show-user :user="user" />
          <edit-user :user="user" ref="edit" />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapGetters } from "vuex";
import EditUser from "../../components/user/EditUser.vue";
import ShowUser from "../../components/user/ShowUser.vue";
export default {
  components: { EditUser, ShowUser },
  name: "Profile",
  data() {
    return {
      editUser: false,
      firstName: "",
      lastName: "",
      phone: null,
      country: null,
    };
  },
  computed: {
    ...mapGetters({ user: "auth/getUser" }),
  },
  methods: {
    isEdit() {
      this.editUser = true;
      this.$refs.edit.firstName = this.user.first_name;
      this.$refs.edit.lastName = this.user.last_name;
      this.$refs.edit.phone = this.user.phone;
      if (this.user.country != null)
        this.$refs.edit.country = this.user.country.id;
      else this.$refs.edit.country = null;
    },
  },
};
</script>

<style>
</style>
