<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'
import PlayerDropdown from '@/Components/PlayerDropdown.vue';


const props = defineProps({ teams: Array, authr: Object})


function store() {
    form.post(route('store'))
}

function destroy(id) {
    if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
        router.delete(route('news.destroy', id))
    }
}

function Pdestroy(id) {
    if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
        // console.log(id);
        router.delete(route('player.destroy', id))
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
          <a :href="route('tickets')" class="text-white p-2 mr-2 bg-gray-600 text-xl rounded-xl">
            Прием команд
          </a>
          <a :href="route('player.index')" class="text-white p-2 bg-gray-600 text-xl rounded-xl">
            Прием игроков
          </a>
        </div>
      </div>
        <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
            <div v-for="(team, index) in teams"  class="w-full ">
              <PlayerDropdown>
                <template #trigger>
                  <div v-if="team['verified'] == 1" class="rounded-xl bg-gray-500 mt-2 w-full flex flex text-white px-4 py-2">
                      <div class="w-4/12 xl:w-2/12 2xl:w-2/12 flex"><span class="w-1/3 text-3xl my-auto">#{{index + 1}}</span><img class="mx-2 w-2/3 xl:w-16 2xl:w-16 xl:h-16 2xl:h-16 h-full" :src="team.logo_path"></div>
                      <div class="w-6/12 xl:w-5/6 2xl:w-5/6 my-auto">
                          <p class="ml-4"><span class="font-semibold ">{{team['name']}}</span> <span class="font-thin">({{team['points']}} points)</span></p>
                      </div>
                      <div class="right-0 w-2/12 xl:w-1/6 2xl:w-1/6 my-auto flex">
                          <a :href="route('edit', team['id'])" class="p-2 mr-2 bg-gray-700 rounded-xl">
                              <i class="fa-solid fa-pen"></i>
                          </a>
                          <a @click="destroy(team['id'])" class="p-2 bg-red-700 rounded-xl">
                              <i class="fa-solid fa-trash"></i>
                          </a>
                      </div>
                  </div>
                </template>
                <template #content>
                  <div class="w-full h-full flex text-white text-center">
                      <div class=" flex text-white text-center">
                          <template   v-for="player in team.players">
                            <div class="w-1/6 mx-1 xl:mx-4 p-2 hover:border-2 rounded-md hover:border-gray-400" v-if="player.verified == 1">

                              <div class="xl:h-4/6 h-3/6" v-if="player.photo !== 'storage/'"><a :href="route('index')" ><img class="w-full" :src="player.photo"></a></div>
                              <div class="xl:h-4/6 h-3/6" v-else><a :href="route('index')" ><img class="w-full" src='/storage/photos/noavatar.png'></a></div>
                              <div class=" xl:h-2/6 h-3/6 xl:mt-4 xl:text-lg text-[12px] w-full text-clip overflow-hidden">{{player.nickname}}<br>
                                <div class="flex w-full ">
                                  <div class="w-1/3 hidden xl:block"></div>
                                  <div class="w-1/3 flex">
                                    <a :href="route('player.edit', player['id'])" class="mt-2 xl:mr-2 mr-1 p-1  bg-gray-700 rounded-xl text-[0.7rem] xl:text-[1rem]">
                                      <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <button @click="Pdestroy(player['id'])" class="mt-2 xl:mr-2 p-1 bg-red-700 rounded-xl text-[0.7rem] xl:text-[1rem]">
                                      <i class="fa-solid fa-trash"></i>
                                    </button>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </template>
                      </div>
                  </div>
                </template>
              </PlayerDropdown>
            </div>
        </div>


    </ALayout>
    <Layout v-else>
      <div class="w-full mt-24  px-[5%] xl:px-[20%] 2xl:px-[20%] mt-16">
        <div v-for="(team, index) in teams"  class="w-full ">
          <PlayerDropdown>
            <template #trigger>
              <div v-if="team['verified'] == 1" class="rounded-xl bg-gray-500 mt-2 w-full flex flex text-white px-4 py-2">
                <div class="w-4/12 xl:w-2/12 2xl:w-2/12 flex"><span class="w-1/3 text-3xl my-auto">#{{index + 1}}</span><img class="mx-2 w-2/3 xl:w-16 2xl:w-16 xl:h-16 2xl:h-16 h-full" :src="team.logo_path"></div>
                <div class="w-6/12 xl:w-5/6 2xl:w-5/6 my-auto">
                    <p class="ml-4"><span class="font-semibold ">{{team['name']}}</span> <span class="font-thin">({{team['points']}} points)</span></p>
                </div>

              </div>
            </template>
            <template #content>
              <div class="w-full h-full flex text-white text-center">
                <div class="w-1/6 mx-1 xl:mx-4 p-2 hover:border-2 rounded-md hover:border-gray-400" v-for="player in team.players">
                  <template v-if="player.verified != 0">
                    <a :href="route('index')">
                        <div class="h-4/5" v-if="player.photo !== 'storage/'"><img class="w-full" :src="player.photo"></div>
                        <div class="h-4/5" v-else><img class="w-full" src='/storage/photos/noavatar.png'></div>
                        <div class="w-full mt-2 xl:text-lg text-[12px]">{{player.nickname}}</div>
                    </a>
                  </template>
                </div>
              </div>
            </template>
          </PlayerDropdown>
        </div>
      </div>

    </Layout>
</template>
