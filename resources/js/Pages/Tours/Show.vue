<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import PlayerDropdown from "@/Components/PlayerDropdown.vue";


const props = defineProps({ tour: Array, authr: Object})

const events = useForm({
    on: null,
    players: 5
})

function destroy(id) {
  if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
    router.delete(route('tour.destroy', id))
  }
}
</script>

<template>
    <ALayout v-if="authr != null">
        <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%]">
            <div class="w-full">
                <div class="px-4 text-white absolute mx-auto">
                    <a :href="route('player.edit', tour['id'])" class="mt-2 xl:mr-2 mr-1 p-2  bg-gray-700 rounded-xl w-2">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <button @click="destroy(tour['id'])" class="mt-2 xl:mr-2 p-2 bg-red-700 rounded-xl ">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
                <img class="border-2 w-full" :src="tour['large_img']" alt="" srcset="">
                <div class="w-full flex border-b-2 border-l-2 border-r-2">
                    <div class="w-1/3 px-4">
                        <span class="text-gray-500 text-lg">Дата</span><br>
                        <span class="font-semibold text-xl">{{tour['start_date']}} -<br class="xl:hidden"> {{tour['end_date']}} {{tour['year']}}</span>
                    </div>
                    <div class="w-1/3 px-4">
                        <span class="text-gray-500 text-lg">Призовой фонд</span><br>
                        <span class="font-semibold text-xl">{{tour['prize_pool']}} ₽</span>
                    </div>
                    <div class="w-1/3 px-4">
                        <span class="text-gray-500 text-lg">Команд</span><br>
                        <span class="font-semibold text-xl">{{tour['teams']}}</span>
                    </div>
<!--                    <div class="w-1/4 px-4 text-white">-->
<!--                        <span class="text-gray-500 text-lg">Действия</span><br>-->
<!--                        <a :href="route('player.edit', tour['id'])" class="mt-2 xl:mr-2 mr-1 p-2  bg-gray-700 rounded-xl w-2">-->
<!--                            <i class="fa-solid fa-pen"></i>-->
<!--                        </a>-->
<!--                        <button @click="destroy(tour['id'])" class="mt-2 xl:mr-2 p-2 bg-red-700 rounded-xl ">-->
<!--                            <i class="fa-solid fa-trash"></i>-->
<!--                        </button>-->
<!--                    </div>-->
                </div>
            </div>

            <div class="w-full xl:grid xl:grid-cols-4 grid grid-cols-2 mt-12">
                <div v-for="(test, index) in tour.teams" class="border-2 xl:mx-8 m-2 text-center" @mouseover="events.on = index" @mouseleave="events.on = null">
                    <!--                    {{// typeof tour['teams1'][index]}}-->
                    <div v-if="typeof tour['teams1'][index] !== 'undefined'">
                        <div >
                            <span class="font-semibold text-xl">{{ tour['teams1'][index]['name'] }}</span>
                            <img v-if="events.on != index" class="my-2 w-36 h-36 mx-auto" :src="tour['teams1'][index]['logo_path']">
                            <div class="h-36" v-if="events.on == index">
                                <div v-for="(test1, i) in events.players" class="h-1/5 flex text-left">
                                    <div class="w-1/5 text-center">{{i + 1}}</div>
                                    <div class="w-4/5" v-if="typeof tour['teams1'][index]['players'][i] != 'undefined'">{{tour['teams1'][index]['players'][i]['nickname']}}</div>
                                    <div class="w-4/5" v-else>TBD</div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div v-else>
                        <span class="font-semibold text-xl my-2">TBD</span>
                        <img v-if="events.on != index" class="my-2 w-36 mx-auto" src="/storage/tbd.png">
                        <div class="h-36" v-if="events.on == index">
                            <div v-for="(test1, i) in events.players" class="h-1/5 flex text-left">
                                <div class="w-1/5 text-center">{{i + 1}}</div>
                                <div class="w-4/5">TBD</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </ALayout>
    <Layout v-else>
        <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%]">
            <div class="w-full">
                <img class="border-2 w-full" :src="tour['large_img']" alt="" srcset="">
                <div class="w-full flex border-b-2 border-l-2 border-r-2">
                    <div class="w-1/3 px-4">
                        <span class="text-gray-500 text-lg">Дата</span><br>
                        <span class="font-semibold text-xl">{{tour['start_date']}} - {{tour['end_date']}} {{tour['year']}}</span>
                    </div>
                    <div class="w-1/3 px-4">
                        <span class="text-gray-500 text-lg">Призовой фонд</span><br>
                        <span class="font-semibold text-xl">{{tour['prize_pool']}} ₽</span>
                    </div>
                    <div class="w-1/3 px-4">
                        <span class="text-gray-500 text-lg">Команд</span><br>
                        <span class="font-semibold text-xl">{{tour['teams']}}</span>
                    </div>
                </div>
            </div>

            <div class="w-full xl:grid xl:grid-cols-4 grid grid-cols-2 mt-12">
                <div v-for="(test, index) in tour.teams" class="border-2 xl:mx-8 m-2 text-center" @mouseover="events.on = index" @mouseleave="events.on = null">
<!--                    {{// typeof tour['teams1'][index]}}-->
                    <div v-if="typeof tour['teams1'][index] !== 'undefined'">
                        <div >
                            <span class="font-semibold text-xl">{{ tour['teams1'][index]['name'] }}</span>
                            <img v-if="events.on != index" class="my-2 w-36 h-36 mx-auto" :src="tour['teams1'][index]['logo_path']">
                            <div class="h-36" v-if="events.on == index">
                                <div v-for="(test1, i) in events.players" class="h-1/5 flex text-left">
                                    <div class="w-1/5 text-center">{{i + 1}}</div>
                                    <div class="w-4/5" v-if="typeof tour['teams1'][index]['players'][i] != 'undefined'">{{tour['teams1'][index]['players'][i]['nickname']}}</div>
                                    <div class="w-4/5" v-else>TBD</div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div v-else>
                        <span class="font-semibold text-xl my-2">TBD</span>
                        <img v-if="events.on != index" class="my-2 w-36 mx-auto" src="/storage/tbd.png">
                        <div class="h-36" v-if="events.on == index">
                            <div v-for="(test1, i) in events.players" class="h-1/5 flex text-left">
                                <div class="w-1/5 text-center">{{i + 1}}</div>
                                <div class="w-4/5">TBD</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>
