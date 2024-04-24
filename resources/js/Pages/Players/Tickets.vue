<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'


const props = defineProps({ players: Array, authr: Object})



function destroy(id) {
    if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
        router.delete(route('player.destroy', id))
    }
}
function verify(id) {
  if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
    router.put(route('player.verify', id))
  }
}
// if (props.authr != null) {
//     defineOptions({ layout: Layout })
//
// }

</script>

<template>
    <ALayout v-if="authr != null">
        <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
            <div v-for="player in players" class="w-full ">
                <div v-if="player['verified'] == 0" class="rounded-xl bg-gray-500 mt-2 w-full flex flex text-white px-4 py-2">
                    <div class="w-4/12 xl:w-2/12 2xl:w-2/12 flex"><img class="mx-2 w-2/3 xl:w-16 2xl:w-16 xl:h-16 2xl:h-16 h-full" :src="player.photo"></div>
                    <div class="w-6/12 xl:w-5/6 2xl:w-5/6 my-auto">
                      <span class="font-semibold pl-2">{{player['nickname']}}</span> <span class="font-thin">({{player['fi']}})</span> <span class="font-semibold pl-2">Команда: {{player.team}}</span>
                    </div>
                    <div class="right-0 w-2/12 xl:w-1/6 2xl:w-1/6 my-auto flex">
                        <a @click="verify(player['id'])" class="p-2 mr-2 bg-green-500 rounded-xl">
                            <i class="fa-solid fa-check"></i>
                        </a>
                        <a @click="destroy(player['id'])" class="p-2 mr-2 bg-red-700 rounded-xl">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                        <a :href="route('player.edit', player['id'])" class="p-2 mr-2 bg-gray-700 rounded-xl">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </ALayout>
</template>
