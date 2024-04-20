<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});


</script>

<template>

        <Head :title="title" />

    <nav class="mb-4 bg-gray-700 xl:px-[20%] 2xl:px-[20%]  flex menu items-center p-3 flex-wrap text-white w-full top-0 fixed z-40">
        <!-- <a href="#" class="p-2 mr-4 inline-flex items-center">
            <img class="w-36" src="img/miniLogo.png" alt="" srcset="">
        </a> -->


        <button class="text-white font-black inline-flex p-3 rounded lg:hidden xl:hidden 2xl:lg:hidden ml-auto outline-none nav-toggler" data-target="#navigation">
            <i class="material-icons">menu</i>
        </button>
        <div class="text-white font-semibold hidden text-xl top-navbar w-full lg:inline-flex 2xl:inline-flex xl:inline-flex lg:flex-grow lg:w-auto" id="navigation">

            <div class="lg:inline-flex lg:flex-row xl:mr-auto 2xl:mr-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto">
              <a href="#gallery" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-lg rounded items-center justify-center ">
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



        <slot />


</template>
