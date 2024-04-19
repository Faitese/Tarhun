<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'


const props = defineProps({ teams: Array, authr: Object})


function store() {
    form.post(route('store'))
}

function destroy(id) {
    if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
        router.delete(route('destroy', id))
    }
}
function verify(id) {
  if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
    router.put(route('verify', id))
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

            <div v-for="team in teams" class="w-full ">
                <div v-if="team['verified'] == 0" class="rounded-xl bg-gray-500 mt-2 w-full flex flex text-white px-4 py-2">
                    <div class="w-4/12 xl:w-2/12 2xl:w-2/12 flex"><img class="mx-2 w-2/3 xl:w-16 2xl:w-16 xl:h-16 2xl:h-16 h-full" :src="team.logo_path"></div>
                    <div class="w-6/12 xl:w-5/6 2xl:w-5/6 my-auto">
                        <span class="font-semibold pl-2">{{team['name']}}</span> <span class="font-thin">({{team['points']}} points)</span>
                    </div>
                    <div class="right-0 w-2/12 xl:w-1/6 2xl:w-1/6 my-auto flex">
                        <a @click="verify(team['id'])" class="p-2 mr-2 bg-green-500 rounded-xl">
                            <i class="fa-solid fa-check"></i>
                        </a>
                        <a @click="destroy(team['id'])" class="p-2 mr-2 bg-red-700 rounded-xl">
                            <i class="fa-solid fa-xmark"></i>
                        </a>
                        <a :href="route('edit', team['id'])" class="p-2 mr-2 bg-gray-700 rounded-xl">
                            <i class="fa-solid fa-pen"></i>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </ALayout>
</template>
