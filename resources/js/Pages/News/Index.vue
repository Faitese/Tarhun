<script setup>
import Layout from "../../Layouts/Layout.vue";
import ALayout from "../../Layouts/ALayout.vue";
import {Link} from "@inertiajs/vue3";
import {useForm} from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'


const props = defineProps({ players: Array, authr: Object})



function destroy(id) {
  if (confirm('ВЫ УВЕРЕНЫ????????????????')) {
    router.delete(route('destroy', id))
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
      <div id="vk_post_-222003340_424"></div>
      <iframe src="https://vk.com/wall-222003340_424" width="853" height="480" ></iframe>
    </div>
  </ALayout>
  <Layout v-else>

  </Layout>
</template>
