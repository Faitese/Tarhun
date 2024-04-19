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


const logout = () => {
    router.post(route('logout'));
};
</script>

<template>

        <Head :title="title" />

    <nav class="bg-gray-700 xl:px-[20%] 2xl:px-[20%] flex menu items-center p-3 flex-wrap text-white w-full top-0 fixed z-40">
        <!-- <a href="#" class="p-2 mr-4 inline-flex items-center">
            <img class="w-36" src="img/miniLogo.png" alt="" srcset="">
        </a> -->


        <button class="text-white font-black inline-flex p-3 rounded lg:hidden xl:hidden 2xl:lg:hidden ml-auto outline-none nav-toggler" data-target="#navigation">
            <i class="material-icons">menu</i>
        </button>
        <div class="text-white font-semibold hidden text-xl top-navbar w-full lg:inline-flex 2xl:inline-flex xl:inline-flex lg:flex-grow lg:w-auto" id="navigation">

            <div class="lg:inline-flex text-left lg:flex-row xl:mr-auto 2xl:mr-auto lg:w-auto w-full lg:items-center items-start  flex flex-col lg:h-auto">
                <a href="#gallery" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-xl rounded items-center justify-center ">
                    <span>Новости</span>
                </a>
                <a href="#goods" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-xl rounded items-center justify-center ">
                    <span>Турниры</span>
                </a>
                <a :href="route('index')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-xl rounded items-center justify-center ">
                    <span>Рейтинг</span>
                </a>

                <a :href="route('create')" class="lg:inline-flex lg:w-auto w-full px-3 py-2 text-xl rounded items-center justify-center ">
                    <span>Подать заявку</span>
                </a>
                <div class="ms-3 rounded-xl">
                    <Dropdown align="left" width="48">
                        <template #trigger>
                            <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </button>

                            <span v-else class="inline-flex rounded-md">
                                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                        </template>

                        <template #content>
                            <!-- Account Management -->

                            <!-- Authentication -->
                            <form @submit.prevent="logout">
                                <DropdownLink as="button">
                                    Выйти
                                </DropdownLink>
                            </form>
                        </template>
                    </Dropdown>
                </div>

                <!-- <a href="#programm" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded items-center justify-center ">
                  <span>Программа курса</span>
                </a>
                <a href="#result" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded items-center justify-center ">
                  <span>Результат</span>
                </a>
                <a href="#beforeAfter" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded items-center justify-center ">
                    <span>До/после</span>
                </a>
                <a href="#reviews" class="lg:inline-flex lg:w-auto w-full px-3 py-2 rounded items-center justify-center ">
                  <span>Отзывы</span>
                </a> -->
            </div>
        </div>


    </nav>

            <!-- Page Heading -->

            <!-- Page Content -->



        <slot />


</template>
