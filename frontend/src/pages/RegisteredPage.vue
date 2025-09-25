<template>
  <div>
    <q-table
      :rows="store.registrations"
      :pagination="{ rowsPerPage: 0 }"
      :hide-bottom="store.registrations.length > 0"
      :columns="columns"
    >
      <template #body-cell-email="props">
        <q-td class="text-left">
          <a :href="`mailto:${props.value}`">{{ props.value }}</a>
        </q-td>
      </template>
    </q-table>
  </div>
</template>

<script setup>
import { useStore } from "src/stores/store";

const store = useStore();

const columns = [
  {
    label: "First Name",
    name: "first_name",
    field: "first_name",
    align: "left",
  },
  {
    label: "Last Name",
    name: "last_name",
    field: "last_name",
    align: "left",
  },
  {
    label: "Phone",
    name: "phone",
    field: "phone",
    align: "left",
  },
  {
    label: "Email",
    name: "email",
    field: "email",
    align: "left",
  },
];
</script>
