<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import PlayerDropdown from "@/Components/PlayerDropdown.vue";


const props = defineProps({ news: Array, authr: Object})

function destroy(id) {
  if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
    router.delete(route('news.destroy', id))
  }
}

// if (props.authr != null) {
//     defineOptions({ layout: Layout })
//
// }

</script>

<template>
    <ALayout v-if="authr != null">
        <div class="w-full text-center mt-24 flex">
            <div class=" w-full mx-auto text-center">
                <a :href="route('news.create')" class="text-white p-2 mr-2 bg-gray-600 text-xl rounded-xl">
                    Публикация новости
                </a>
            </div>
        </div>
        <div class="w-full mt-12  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
            <div v-for="(new1, index) in news"  class="w-full ">
                <div class="rounded-xl z-30 bg-gray-500 mt-2 w-full flex flex text-white px-4 py-2">
                    <a :href="route('news.show', new1)" class="w-6/12 xl:w-4/6 2xl:w-4/6 my-auto">
                        <span class="contentt font-semibold pl-2">{{new1['title']}}</span>
                    </a>
                    <div class="right-0 w-6/12 xl:w-2/6 2xl:w-2/6 my-auto flex">
                        <a :href="route('news.show', new1)" class="text-[14px] xl:text-[20px] w-5/6 font-thin">{{new1['time']}}</a>
                        <a :href="route('news.edit', new1['id'])" class="p-2 mr-2 bg-gray-700 rounded-xl">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a @click="destroy(new1['id'])" class="p-2 z-50 bg-red-700 rounded-xl">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </ALayout>
    <Layout v-else>
        <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
            <div v-for="(new1, index) in news"  class="w-full ">
                <a :href="route('news.show', new1)" class="rounded-xl bg-gray-500 mt-2 w-full flex flex text-white px-4 py-2">
                    <div class="w-8/12 xl:w-4/6 2xl:w-4/6 my-auto">
                        <span class="font-semibold pl-2">{{new1['title']}}</span>
                    </div>
                    <div class="w-4/12 xl:w-2/6 2xl:w-2/6 my-auto text-left font-thin text-gray-100">
                        <span class="text-[14px] xl:text-[20px] w-5/6 font-thin">{{new1['time']}}</span>
                    </div>
                </a>
            </div>
        </div>

    </Layout>
</template>
