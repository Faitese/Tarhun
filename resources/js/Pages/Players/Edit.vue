<script setup>
import {ref} from "vue";

const props = defineProps({ authr: Object, teams: Array, player: Array })
import { useForm, Link, router } from '@inertiajs/vue3'
import ALayout from "@/Layouts/ALayout.vue";
import Layout from "@/Layouts/Layout.vue";


const form = useForm({
    id: props.player.id,
    nickname: props.player.nickname,
    team_id: props.player.teams_id,
    fi: props.player.fi,
    verified: props.player.verified,
    isCoach: props.player.isCoach,

})
function update() {
    // console.log(route('player.update', props.player.id));
    form.put(route('player.update', 'player' ))
}
</script>

<template>
    <div class="h-4"></div>
    <ALayout v-if="authr != null">


        <div class="w-full h-full">
            <div class="w-full  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
                <form @submit.prevent="update" method="post">
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            Никнейм игрока
                            <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left " type="text" v-model="form.nickname">
                        </label>
                    </div>
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-left xl:text-center px-[15%] mt-2">
                        <label class="text-xl font-semibold">
                            Команда игрока
                            <select class="text-white text-left rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2  " type="text" v-model="form.team_id">
                                <option v-bind:value="team.id" v-for="team in teams">
                                    {{ team.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%] mt-2">
                        <label class="text-xl font-semibold">
                            Фамилия и имя игрока (необязательно)
                            <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="text" v-model="form.fi">
                        </label>
                    </div>
                    <div class = "mt-6 w-full xl:px-[30%] 2xl:px-[30%] px-[15%]">
                        <label class="text-xl font-semibold">
                            <input type="checkbox" class="default:ring-0 ml-0.5 appearance-none ring-0 accent-gray-500 dark:accent-gray-500 checked:appearance-auto checked:ring-0 focused:ring-0 indeterminate:ring-0" v-model="form.isCoach"> Тренер
                        </label>
                    </div>
                    <div class="w-full text-center">
                        <button type="submit" class="bg-gray-600 p-3 rounded-xl text-white">
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
