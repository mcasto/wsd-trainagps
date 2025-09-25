<template>
  <div class="row" v-if="store.registrations">
    <div class="col-12 col-md-6">
      <q-img src="/images/phoenix-ma-ad.jpeg" fit="contain"></q-img>
    </div>
    <div class="col-12 col-md-6">
      <div class="text-center q-mt-md">
        <div
          class="flex items-center justify-left"
          :class="Screen.gt.sm ? 'q-pl-xl' : 'q-pl-sm'"
        >
          <span class="text-grey-6 text-uppercase text-subtitle2 q-mr-md"
            >Date</span
          >
          <span class="text-subtitle1"
            >October 11, 2025 at 10:00 AM - Noon</span
          >
        </div>

        <div
          class="flex items-center justify-left"
          :class="Screen.gt.sm ? 'q-pl-xl' : 'q-pl-sm'"
        >
          <span class="text-grey-6 text-uppercase text-subtitle2 q-mr-md"
            >Cost</span
          >
          <span class="text-subtitle1">$30</span>
        </div>

        <div
          class="flex items-center justify-left"
          :class="Screen.gt.sm ? 'q-pl-xl' : 'q-pl-sm'"
        >
          <span class="text-grey-6 text-uppercase text-subtitle2 q-mr-md"
            >Wear</span
          >
          <span class="text-subtitle1"
            >Whatever you might normally wear is ideal. Bring what you would
            normally carry.</span
          >
        </div>

        <div
          class="flex items-center justify-left"
          :class="Screen.gt.sm ? 'q-pl-xl' : 'q-pl-sm'"
        >
          <span class="text-grey-6 text-uppercase text-subtitle2 q-mr-md"
            >Location</span
          >
          <span class="text-subtitle1"
            >Phoenix Studio, Rafael Fajardo and Daniel Muñoz, Northeast
            corner</span
          >
        </div>

        <div
          class="flex items-center justify-left"
          :class="Screen.gt.sm ? 'q-pl-xl' : 'q-pl-sm'"
        >
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d249.04596849340328!2d-79.0323077143556!3d-2.8924092502598406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2s!5e0!3m2!1sen!2sec!4v1758755729561!5m2!1sen!2sec"
            width="600"
            height="450"
            style="border: 0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>
      </div>

      <q-separator class="q-mt-md"></q-separator>

      <div class="column justify-center">
        <q-form @submit.prevent="submitRegistration">
          <div>
            <q-toolbar>
              <q-toolbar-title>
                <div>
                  Reserve Your Spot Today!
                </div>
              </q-toolbar-title>
            </q-toolbar>

            <div class="column q-gutter-y-sm q-pa-sm">
              <q-input
                type="text"
                label="First Name"
                dense
                outlined
                required
                v-model="formData.first_name"
              ></q-input>
              <q-input
                type="text"
                label="Last Name"
                dense
                outlined
                required
                v-model="formData.last_name"
              ></q-input>
              <q-input
                type="email"
                label="Email"
                dense
                outlined
                required
                v-model="formData.email"
              ></q-input>
              <q-input
                type="text"
                label="Phone (Optional)"
                mask="(###) ###-####"
                dense
                outlined
                v-model="formData.phone"
              ></q-input>

              <div class="flex justify-end q-mt-md">
                <q-btn type="submit" label="Register" color="blue-grey"></q-btn>
              </div>
            </div>
          </div>
        </q-form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Loading, Screen } from "quasar";
import callApi from "src/assets/call-api";
import { useStore } from "src/stores/store";
import { ref } from "vue";

const store = useStore();

const formData = ref({
  first_name: null,
  last_name: null,
  email: null,
  phone: null,
});

const submitRegistration = async () => {
  Loading.show({ delay: 300 });
  const response = await callApi({
    path: "/register",
    method: "post",
    payload: formData.value,
  });

  console.log({ response });
  Loading.hide();
};
</script>
