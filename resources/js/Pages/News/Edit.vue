<script setup>
import {ref} from "vue";

const props = defineProps({ authr: Object, new1:Array })
import { useForm, Link, router } from '@inertiajs/vue3'
import ALayout from "@/Layouts/ALayout.vue";
import Layout from "@/Layouts/Layout.vue";


const form = useForm({
    title: props.new1.title,
    content: props.new1.content,
    img: props.new1.img,
})
function store() {
    form.put(route('news.update', props.new1.id))
}

const profilePictureUrl = ref(null);

const handleFileChange = (event) => {
    const file = event.target.files[0];

    profilePictureUrl.value = URL.createObjectURL(file);

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
                          Заголовок
                          <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="text" v-model="form.title">
                      </label>
                  </div>
                  <div class = "w-full xl:px-[20%] 2xl:px-[20%] text-center px-[15%]">
                      <label class="text-xl font-semibold">
                          Текст
                          <textarea class="h-[16rem] text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" v-model="form.content"></textarea>
                      </label>
                  </div>

                  <div class="w-full text-center">
                      <button class="bg-gray-600 p-3 rounded-xl text-white">
                          Изменить
                      </button>
                  </div>
              </form>
          </div>
      </div>
    </ALayout>
</template>

<style>

</style>
