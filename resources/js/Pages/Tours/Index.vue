<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import PlayerDropdown from "@/Components/PlayerDropdown.vue";


const props = defineProps({ tours: Array, authr: Object})

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
<!--        <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%]">-->
<!--            <div class="w-full grid grid-cols-2">-->
<!--                <div class="m-8">-->
<!--                    <div class="border-2 border-gray-300 w-full">-->
<!--                        <img class="w-[100%]" src="/storage/No_Image_Large.jpg">-->
<!--                    </div>-->
<!--                    <div class="border-r-2 border-l-2 border-b-2 bt-none text-left border-gray-300 w-full">-->
<!--                        <span class="ml-2 text-2xl font-semibold">Hueten</span>-->
<!--                        <div class="w-full grid justify-items-end ">-->
<!--                            <img class="mr-2 mb-2 w-4 right-0" src="/storage/No_Image.jpg">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="border-r-2 border-l-2 border-b-2 bt-none text-left border-gray-300 w-full flex">-->
<!--                        <div class="w-1/3 ml-2">-->
<!--                            <span class="font-semibold text-lg">12 may - 13 april</span><br>-->
<!--                            <span class="text-gray-500">Дата</span>-->
<!--                        </div>-->
<!--                        <div class="w-1/3 ml-2">-->
<!--                            <span class="font-semibold text-lg">1600 ₽</span><br>-->
<!--                            <span class="text-gray-500">Призовой фонд</span>-->
<!--                        </div>-->
<!--                        <div class="w-1/3 ml-2">-->
<!--                            <span class="font-semibold text-lg">8</span><br>-->
<!--                            <span class="text-gray-500">Команд</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->



        <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%]">
            <div class="w-full xl:grid xl:grid-cols-2">
                <div class="m-8" v-for="tour in tours">
                    <div class="border-2 border-gray-300 w-full">
                        <img class="w-[100%]" :src="tour.large_img">

                    </div>
                    <div class="border-r-2 border-l-2 border-b-2 bt-none text-left border-gray-300 w-full">
                        <span class="ml-2 text-2xl font-semibold">{{tour['name']}}</span>
                        <div class="w-full grid justify-items-end ">
<!--                            <template v-for="team in tour.teams_logos">-->
<!--                                {{team}}-->
<!--                            </template>-->
                            <div class="flex">
                                <img v-if="typeof tour.teams_logos != 'undefined'" v-for="team in tour.teams_logos" class="mr-2 mb-2 w-4" :src="team">
                                <img v-else class="mr-2 mb-2 w-4" src="/storage/No_Image.jpg">
                            </div>
                        </div>
                    </div>
                    <div class="border-r-2 border-l-2 border-b-2 bt-none text-left border-gray-300 w-full flex">
                        <div class="w-1/3 ml-2">
                            <span class="font-semibold text-lg">{{tour['start_date']}} -<br> {{tour['end_date']}}</span><br>
                            <span class="text-gray-500">Дата</span>
                        </div>
                        <div class="w-1/3 ml-2">
                            <span class="font-semibold text-lg">{{tour['prize_pool']}} ₽<br></span><br>
                            <span class="text-gray-500">Призовой фонд</span>
                        </div>
                        <div class="w-1/3 ml-2">
                            <span class="font-semibold text-lg">{{tour['teams']}}<br></span><br>
                            <span class="text-gray-500">Команд</span>
                        </div>
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
