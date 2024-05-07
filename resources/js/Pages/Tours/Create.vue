<script setup>
import {ref} from "vue";

const props = defineProps({ authr: Object, teams: Array })
import { useForm, Link, router } from '@inertiajs/vue3'
import ALayout from "@/Layouts/ALayout.vue";
import Layout from "@/Layouts/Layout.vue";


const form = useForm({
    name: null,
    prize_pool: null,
    img_large: null,
    org_img: null,
    teams: null,
    start_date: null,
    end_date: null,
    teams1: [],
})
function store() {
    form.post(route('tour.store'))
}

const profilePictureUrl = ref(null);

const handleFileChange = (event) => {
    const file = event.target.files[0];

    profilePictureUrl.value = URL.createObjectURL(file);

}

const profilePictureUrl1 = ref(null);

const handleFileChange1 = (event) => {
    const file = event.target.files[0];

    profilePictureUrl1.value = URL.createObjectURL(file);

}
</script>

<template>
    <div class="h-4"></div>

    <ALayout v-if="authr != null">

    <div class="w-full h-full">
          <div class="w-full  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
              <form @submit.prevent="store" method="post">
                  <div class = "w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Название турнира
                          <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="text" v-model="form.name">
                      </label>
                  </div>
                  <div class = "w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Призовой фонд (₽)
                          <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="number" v-model="form.prize_pool">
                      </label>
                  </div>
                  <div class = "w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Дата начала
                          <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="date" v-model="form.start_date">
                      </label>
                  </div>
                  <div class = "w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Дата конца
                          <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="date" v-model="form.end_date">
                      </label>
                  </div>
                  <div class = "w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%] mb-4">
                      <label class="text-xl font-semibold">
                          Кол-во команд
                          <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="number" v-model="form.teams">
                      </label>
                  </div>
                  <template v-if="form.teams != null" v-for="(item, index) in form.teams">
                      <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-left xl:text-center px-[15%]">
                          <label class="text-xl font-semibold">
                              Команда {{ index + 1}}

                              <select class="text-white text-left rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2  " type="text" v-model="form.teams1[index]">
                                  <option v-bind:value="team.id" v-for="team in teams">
                                      {{ team.name }}
                                  </option>
                              </select>
                          </label>
                      </div>
                  </template>
                  <div class = "mt-6 w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Баннер турнира (желательно 1920px x 768px)
                          <input @change="handleFileChange1" @input="form.img_large = $event.target.files[0]" ref="fileInput" class="hidden" type="file" >
                          <img class=" w-full mx-auto my-4" :src="profilePictureUrl1 ? profilePictureUrl1 : '/storage/No_Image_Large.jpg'">
                      </label>
                  </div>
                  <div class = "mt-6 w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Логотип организатора
                          <input @change="handleFileChange" @input="form.org_img = $event.target.files[0]" ref="fileInput" class="hidden" type="file" >
                          <img class=" w-1/2 mx-auto my-4" :src="profilePictureUrl ? profilePictureUrl : '/storage/No_Image.jpg'">
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
</template>

<style>

</style>
