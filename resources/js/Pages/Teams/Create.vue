<script setup>
import {ref} from "vue";

const props = defineProps({ authr: Object })
import { useForm, Link, router } from '@inertiajs/vue3'
import ALayout from "@/Layouts/ALayout.vue";
import Layout from "@/Layouts/Layout.vue";


const form = useForm({
    name: null,
    logo_path: null,
})
function store() {
    form.post(route('store'))
}

const profilePictureUrl = ref(null);

const handleFileChange = (event) => {
    const file = event.target.files[0];

    profilePictureUrl.value = URL.createObjectURL(file);

}
</script>

<template>
  <ALayout v-if="authr != null">

    <div class="w-full h-full">
          <div class="w-full  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
              <form @submit.prevent="store" method="post">
                  <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Название команды
                          <input class="rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left focus:outline-gray-300 focus:border-none" type="text" v-model="form.name">
                      </label>
                  </div>
                  <div class = "mt-6 w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Логотип команды
                          <input @change="handleFileChange" @input="form.logo_path = $event.target.files[0]" ref="fileInput" class="hidden" type="file" >
                          <img class="rounded-full w-48 mx-auto my-4" :src="profilePictureUrl ? profilePictureUrl : '/storage/No_Image.jpg'">
                      </label>
                  </div>
                  <div class="w-full text-center">
                      <button class="bg-gray-600 p-3 rounded-xl text-white">
                          Создать
                      </button>
                  </div>
              </form>
          </div>
      </div>
    </ALayout>

  <Layout v-else>

    <div class="w-full h-full">
      <div class="w-full  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
        <form @submit.prevent="store" method="post">
          <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
            <label class="text-xl font-semibold">
              Название команды
              <input class="rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left focus:outline-gray-300 focus:border-none" type="text" v-model="form.name">
            </label>
          </div>
          <div class = "mt-6 w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
            <label class="text-xl font-semibold">
              Логотип команды
              <input @change="handleFileChange" @input="form.logo_path = $event.target.files[0]" ref="fileInput" class="hidden" type="file" >
              <img class="rounded-full w-48 mx-auto my-4" :src="profilePictureUrl ? profilePictureUrl : '/storage/No_Image.jpg'">
            </label>
          </div>
          <div class="w-full text-center">
            <button class="bg-gray-600 p-3 rounded-xl text-white">
              Создать
            </button>
          </div>
        </form>
      </div>
    </div>
  </Layout>
</template>

<style>
:active, :hover, :focus {
    outline: 0;
    outline-offset: 0;
    border:none;
}
</style>
