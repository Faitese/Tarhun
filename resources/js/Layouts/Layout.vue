<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import MenuDropdown from '@/Components/MenuDropdown.vue';

import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});


const logout = () => {
    router.post(route('logout'));
};
</script>

<template>

    <Head :title="title" />

    <nav class="hidden xl:flex bg-gray-700 xl:px-[20%] 2xl:px-[20%] menu items-center p-3 flex-wrap text-white w-full top-0 fixed z-40">
        <!-- <a href="#" class="p-2 mr-4 inline-flex items-center">
            <img class="w-36" src="img/miniLogo.png" alt="" srcset="">
        </a> -->


        <button class="text-white font-black inline-flex p-3 rounded lg:hidden xl:hidden 2xl:lg:hidden ml-auto outline-none nav-toggler" data-target="#navigation">
            <i class="material-icons">menu</i>
        </button>
        <div class="text-white font-semibold hidden text-xl top-navbar w-full lg:inline-flex 2xl:inline-flex xl:inline-flex lg:flex-grow lg:w-auto" id="navigation">

            <div class="lg:inline-flex text-left lg:flex-row xl:mr-auto 2xl:mr-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto">
                <a :href="route('news.index')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                    <span>Новости</span>
                </a>
                <a href="#goods" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                    <span>Турниры</span>
                </a>
                <a :href="route('index')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                    <span>Рейтинг</span>
                </a>
                <a :href="route('create')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                    <span>Регистрация команды</span>
                </a>
                <a :href="route('player.create')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                    <span>Регистрация игрока</span>
                </a>

            </div>
        </div>


    </nav>

    <!-- Page Heading -->

    <!-- Page Content -->

    <nav class="xl:hidden bg-gray-700 xl:px-[20%] 2xl:px-[20%] menu items-center p-3 flex-wrap text-white w-full top-0 fixed z-40">
        <menu-dropdown>
            <template #trigger >
                <div class="w-full text-right bg-gray-700 p-2 border-none focus:border-none">
                    <i class="material-icons">menu</i>
                </div>
            </template>
            <template #content >
                <div class="bg-gray-700 w-full h-full block">
                    <a :href="route('news.index')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                        <span>Новости</span>
                    </a><br>
                    <a href="#goods" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                        <span>Турниры</span>
                    </a><br>
                    <a :href="route('index')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                        <span>Рейтинг</span>
                    </a><br>
                    <a :href="route('create')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                        <span>Регистрация команды</span>
                    </a><br>
                    <a :href="route('player.create')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
                        <span>Регистрация игрока</span>
                    </a>
                </div>
            </template>
        </menu-dropdown>
    </nav>

    <slot />


</template>
