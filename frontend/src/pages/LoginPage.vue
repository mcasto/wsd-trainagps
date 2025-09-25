<template>
  <div class="flex flex-center" style="height: 100vh;">
    <q-form @submit.prevent="login">
      <q-card>
        <q-card-section class="column q-gutter-y-sm">
          <q-input
            type="email"
            required
            dense
            outlined
            v-model="form.email"
            label="Email"
          ></q-input>
          <q-input
            :type="showPass ? 'text' : 'password'"
            required
            dense
            outlined
            v-model="form.password"
            label="Password"
          >
            <template #append>
              <q-btn
                :icon="showPass ? 'visibility_off' : 'visibility'"
                @click="showPass = !showPass"
                flat
                round
              ></q-btn>
            </template>
          </q-input>
        </q-card-section>
        <q-card-actions class="justify-end">
          <q-btn label="Sign In" type="submit"></q-btn>
        </q-card-actions>
      </q-card>
    </q-form>
  </div>
</template>

<script setup>
import { Notify } from "quasar";
import callApi from "src/assets/call-api";
import { useStore } from "src/stores/store";
import { ref } from "vue";

const store = useStore();

const showPass = ref(false);

const form = ref({
  email: null,
  password: null,
});

const login = async () => {
  const response = await callApi({
    path: "/login",
    method: "post",
    payload: form.value,
  });

  if (!response.token) {
    Notify.create({
      type: "negative",
      message: "Unable to sign in",
    });

    return;
  }

  store.token = response.token;

  store.router.push("/registered");
};
</script>
