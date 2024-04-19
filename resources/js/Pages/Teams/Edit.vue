<script setup>
import {ref} from "vue";

const props = defineProps({ team: Array })
import { useForm, Link, router } from '@inertiajs/vue3'
import ALayout from "@/Layouts/ALayout.vue";
import Layout from "@/Layouts/Layout.vue";


const form = useForm({
    name: props.team.name,
    points: props.team.points,
    logo_path: props.team.logo_path,
})
console.log(props.team.id);
function update() {
    form.put(route('update', props.team.id))
}

</script>

<template>
  <ALayout v-if="authr != null">

  <div class="w-full h-full">
        <div class="w-full  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
            <form @submit.prevent="update" method="post">
                <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                    <label class="text-xl font-semibold">
                        Название команды
                        <input class="rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left focus:outline-gray-300 focus:border-none" type="text" v-model="form.name">
                    </label>
                </div>
                <div class = "mt-8 w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                  <label class="text-xl font-semibold">
                    Количество очков
                    <input class="rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left focus:outline-gray-300 focus:border-none" type="number" v-model="form.points">
                  </label>
                </div>
                <div class="w-full mt-8 text-center">
                    <button class="bg-gray-600 p-3 rounded-xl text-white">
                        Изменить
                    </button>
                </div>
            </form>
        </div>
    </div>
  </ALayout>

  <Layout v-else>
    <div class="w-full h-full">
      <div class="w-full  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
        <form @submit.prevent="update" method="post">
          <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
            <label class="text-xl font-semibold">
              Название команды
              <input class="rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left focus:outline-gray-300 focus:border-none" type="text" v-model="form.name">
            </label>
          </div>
          <div class = "mt-8 w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
            <label class="text-xl font-semibold">
              Количество очков
              <input class="rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left focus:outline-gray-300 focus:border-none" type="number" v-model="form.points">
            </label>
          </div>
          <div class="w-full mt-8 text-center">
            <button class="bg-gray-600 p-3 rounded-xl text-white">
              Изменить
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
