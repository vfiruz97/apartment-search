<script setup>
import { ref, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { ElNotification } from "element-plus";

import AppLayout from "./../Layouts/AppLayout.vue";
import SearchForm from "./../Components/SearchForm.vue";

const props = defineProps({
  properties: Object,
  price: Array,
});

const pageParams = {
  page: parseInt(props.properties?.current_page),
  per_page: parseInt(props.properties?.per_page),
};

const propertiesData = ref(props.properties);

const handleSizeChange = (val) => {
  pageParams.per_page = val;
  pageParams.page = 1;
  reload();
};

const handleCurrentChange = (val) => {
  pageParams.page = val;
  reload();
};

const reload = () =>
  Inertia.reload({
    data: pageParams,
    preserveState: false,
    preserveScroll: true,
  });

const onSearchResultSuccess = (res) => {
  propertiesData.value = res;
  if (res.data.length > 0) {
    ElNotification({
      message: "Congrats, table is refreshed with new data.",
      type: "success",
      duration: 4000,
    });
  } else {
    ElNotification({
      message: "No results were found ((-",
      type: "warning",
      duration: 4000,
    });
  }
};

const onSearchResultError = (error) => {
  ElNotification({
    message: "Oops, something went wrong :((",
    type: "error",
    duration: 4000,
  });
};
</script>

<template>
  <app-layout>
    <div class="mb-4">
      <search-form
        :page-params="pageParams"
        :price="price"
        @on-success="onSearchResultSuccess"
        @on-error="onSearchResultError"
      />
    </div>

    <div class="mb-4">
      <el-table :data="propertiesData.data" style="width: 100%">
        <el-table-column type="index" width="50" />
        <el-table-column prop="name" label="Name" width="180" />
        <el-table-column prop="price" label="Price" width="180" />
        <el-table-column prop="bedrooms" label="Bedrooms" />
        <el-table-column prop="bathrooms" label="Bathrooms" />
        <el-table-column prop="storeys" label="Storeys" />
        <el-table-column prop="garages" label="Garages" />
      </el-table>
    </div>
    <div class="mt-2">
      <el-pagination
        :total="propertiesData.total"
        v-model:currentPage="pageParams.page"
        v-model:page-size="pageParams.per_page"
        :page-sizes="[50, 100, 150, 200]"
        layout="sizes, prev, pager, next"
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
      />
    </div>
  </app-layout>
</template>
