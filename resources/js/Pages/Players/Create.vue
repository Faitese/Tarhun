<script setup>
import {ref} from "vue";

const props = defineProps({ authr: Object, teams: Array })
import { useForm, Link, router } from '@inertiajs/vue3'
import ALayout from "@/Layouts/ALayout.vue";
import Layout from "@/Layouts/Layout.vue";


const form = useForm({
    nickname: null,
    team_id: null,
    fi: null,
    photo: null,
})
function store() {
    form.post(route('player.store'))
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
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            Никнейм игрока
                            <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left " type="text" v-model="form.nickname">
                        </label>
                    </div>
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-left xl:text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            <select class="text-white text-left rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2  " type="text" v-model="form.team_id">
                                <option class="text-white text-left " value="null" disabled selected>
                                    Команда игрока
                                </option>
                                <option v-bind:value="team.id" v-for="team in teams">
                                    {{ team.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            Фамилия и имя игрока (необязательно)
                            <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="text" v-model="form.fi">
                        </label>
                    </div>
                    <div class = "mt-6 w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            Фото игрока (необязательно)
                            <input @change="handleFileChange" @input="form.photo = $event.target.files[0]" ref="fileInput" class="hidden" type="file" >
                            <img class="rounded-full w-48 mx-auto my-4" :src="profilePictureUrl ? profilePictureUrl : '/storage/No_Image.jpg'">
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

    <Layout v-else>

        <div class="w-full h-full">
            <div class="w-full  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
                <form @submit.prevent="store" method="post">
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            Никнейм игрока
                            <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left " type="text" v-model="form.nickname">
                        </label>
                    </div>
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            <select class="text-white text-left xl:text-center rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2  2xl:text-center" type="text" v-model="form.team_id">
                                <option class="text-white text-left xl:text-center" value="null" disabled selected>
                                    Команда игрока
                                </option>
                                <option class="text-white text-left xl:text-center" v-bind:value="team.id" v-for="team in teams">
                                    {{ team.name }}
                                </option>
                            </select>
                        </label>
                    </div>
                    <div class = "w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            Фамилия и имя игрока (необязательно)
                            <input class="text-white rounded-xl bg-gray-500 border-2 border-gray-600 w-full mt-2 text-left" type="text" v-model="form.fi">
                        </label>
                    </div>
                    <div class = "mt-6 w-full xl:px-[30%] 2xl:px-[30%] text-center px-[15%]">
                        <label class="text-xl font-semibold">
                            Фото игрока (необязательно)
                            <input @change="handleFileChange" @input="form.photo = $event.target.files[0]" ref="fileInput" class="hidden" type="file" >
                            <img class="rounded-full w-48 mx-auto my-4" :src="profilePictureUrl ? profilePictureUrl : '/storage/No_Image.jpg'">
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
    </Layout>
</template>

<style>

</style>
