<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import PlayerDropdown from "@/Components/PlayerDropdown.vue";


const props = defineProps({ new1: Array, authr: Object})



function destroy(id) {
  if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
    router.delete(route('news.destroy', id))
  }
}
// let elem=document.getElementsByClassName('contentt')
// console.log(elem);

// if (props.authr != null) {
//     defineOptions({ layout: Layout })
//
// }

</script>

<template>
    <ALayout v-if="authr != null">
        <div class="w-full mt-24 px-[5%] xl:px-[20%] 2xl:px-[20%]">
            <div class="w-full text-center font-semibold text-2xl">{{new1['title']}}</div>
            <div v-html=new1.content class="text-lg text-left font-regular"></div>
            <div v-if="typeof new1.img !== '/storage'" class="mt-8 w-full h-full px-[20%]"> <img class="w-full" :src="new1.img"></div>
            <div class="mt-12 w-full text-center text-white">
                <a :href="route('news.index')" class="text-white p-2 mr-2 bg-gray-600 text-xl rounded-xl"> Вернуться к новостям </a>
                <a :href="route('news.edit', new1['id'])" class="p-2 mr-2 bg-gray-700 rounded-xl">
                    <i class="fa-solid fa-pen"></i>
                </a>
                <a @click="destroy(new1['id'])" class="p-2 bg-red-700 rounded-xl">
                    <i class="fa-solid fa-trash"></i>
                </a>
            </div>
        </div>


    </ALayout>
    <Layout v-else>
        <div class="w-full mt-24 px-[5%] xl:px-[20%] 2xl:px-[20%]">
            <div class="w-full text-center font-semibold text-2xl">{{new1['title']}}</div>
            <div v-html=new1.content class="text-lg text-left font-regular"></div>
            <div v-if="typeof new1.img !== '/storage'" class="mt-8 w-full h-full px-[20%]"> <img class="w-full" :src="new1.img"></div>
            <div class="mt-12 w-full text-center"><a :href="route('news.index')" class="text-white p-2 mr-2 bg-gray-600 text-xl rounded-xl"> Вернуться к новостям </a></div>
        </div>

    </Layout>
</template>
