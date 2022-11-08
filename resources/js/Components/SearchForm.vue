<script setup>
import { reactive, ref, computed } from "vue";
import { Location, Search } from "@element-plus/icons-vue";

const quantityOptions = [
  {
    value: "1",
    label: "1",
  },
  {
    value: "2",
    label: "2",
    disabled: true,
  },
  {
    value: "3",
    label: "3",
  },
  {
    value: "4",
    label: "4",
  },
  {
    value: "5",
    label: "5",
  },
];

const props = defineProps({
  pageParams: Object,
  price: Array,
});

const emit = defineEmits(["on-success", "on-error"]);

const form = reactive({
  name: null,
  bedrooms: null,
  bathrooms: null,
  storeys: null,
  garages: null,
  price: props.price,
});

const processing = ref(false);

const priceRangeLabel = computed(() => {
  return `Price range ${form.price[0]}$ - ${form.price[1]}$`;
});

const submit = () => {
  processing.value = true;
  axios
    .post(route("property.search"), {
      ...form,
      ...props.pageParams,
    })
    .then(function (response) {
      console.log(response);
      if (response.status === 200) emit("on-success", response.data["properties"]);
    })
    .catch(function (error) {
      console.log(error);
      emit("on-error", error);
    })
    .then(function () {
      processing.value = false;
    });
};
</script>
<template>
  <div class="border p-3 shadow-lg">
    <p class="font-medium text-lg text-uppercase">APARTMENT SEARCH</p>
    <div class="mt-4">
      <el-input
        v-model="form.name"
        placeholder="Please input a name"
        :prefix-icon="Location"
        clearable
      />
    </div>

    <div class="flex space-x-2 mt-2">
      <div class="flex-grow">
        <el-select
          v-model="form.bedrooms"
          class="w-full"
          clearable
          placeholder="Select bedrooms"
        >
          <el-option
            v-for="item in quantityOptions"
            :key="item.value"
            :label="`${item.label}-bedroom`"
            :value="item.value"
          />
        </el-select>
      </div>
      <div class="flex-grow">
        <el-select
          v-model="form.bathrooms"
          class="w-full"
          clearable
          placeholder="Select bathrooms"
        >
          <el-option
            v-for="item in quantityOptions"
            :key="item.value"
            :label="`${item.label}-bathroom`"
            :value="item.value"
          />
        </el-select>
      </div>
      <div class="flex-grow">
        <el-select
          v-model="form.storeys"
          class="w-full"
          clearable
          placeholder="Select storeys"
        >
          <el-option
            v-for="item in quantityOptions"
            :key="item.value"
            :label="`${item.label}-storey`"
            :value="item.value"
          />
        </el-select>
      </div>
      <div class="flex-grow">
        <el-select
          v-model="form.garages"
          class="w-full"
          clearable
          placeholder="Select garages"
        >
          <el-option
            v-for="item in quantityOptions"
            :key="item.value"
            :label="`${item.label}-garage`"
            :value="item.value"
          />
        </el-select>
      </div>
    </div>
    <div class="mt-2">
      <label class="text-sm font-thin">{{ priceRangeLabel }}</label>
      <div class="px-3">
        <el-slider
          label="Price range"
          v-model="form.price"
          :min="props.price[0]"
          :step="1000"
          :max="props.price[1]"
          range
        />
      </div>
    </div>
    <div class="my-2">
      <el-button
        type="primary"
        class="w-full"
        @click="submit"
        :icon="Search"
        :loading="processing"
        >Search</el-button
      >
    </div>
  </div>
</template>
