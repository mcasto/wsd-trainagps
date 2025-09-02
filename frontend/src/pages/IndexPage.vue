<template>
  <div class="row" v-if="store.registrations">
    <div class="col-12 col-md-6">
      <q-img src="/images/phoenix-ma-ad.jpeg" fit="contain"></q-img>
    </div>
    <div class="col-12 col-md-6">
      <div class="text-center q-mt-md">
        Date, time, location, cost information
      </div>

      <div class="column justify-center full-height">
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
import { Loading } from "quasar";
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
