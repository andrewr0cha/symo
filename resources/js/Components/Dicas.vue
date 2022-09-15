<template>
    <q-carousel v-model="slideDica" transition-prev="scale" transition-next="scale" swipeable animated
        control-color="black" arrows class="bg-deep-purple-2 text-white shadow-1 rounded-borders tw-mt-4"
        :autoplay="autoplay" infinite @mouseenter="autoplay = false" @mouseleave="autoplay = true" padding
        style="border-radius:25px; height:260px; min-height: 160px; max-width: 300px">
        <q-carousel-slide :name="1" class="column no-wrap flex-center">
            <q-icon name="tips_and_updates" size="40px" class="tw-text-black" />
            <div class="q-mt-md text-center tw-text-black tw-text-md">
                {{dicas[0]}}
            </div>
        </q-carousel-slide>
        <q-carousel-slide :name="2" class="column no-wrap flex-center">
            <q-icon name="tips_and_updates" size="40px" class="tw-text-black" />
            <div class="q-mt-md text-center tw-text-black tw-text-md">
                {{dicas[1]}}
            </div>
        </q-carousel-slide>
        <q-carousel-slide :name="3" class="column no-wrap flex-center">
            <q-icon name="tips_and_updates" size="40px" class="tw-text-black" />
            <div class="q-mt-md text-center tw-text-black tw-text-md">
                {{dicas[2]}}
            </div>
        </q-carousel-slide>
        <q-carousel-slide :name="4" class="column no-wrap flex-center">
            <q-icon name="tips_and_updates" size="40px" class="tw-text-black" />
            <div class="q-mt-md text-center tw-text-black tw-text-md">
                Entre todos os dias para receber novas dicas :)
            </div>
        </q-carousel-slide>
    </q-carousel>
</template>
<script>
import { ref } from "vue";
export default {
    props: {
        dicas: Array,
    },

    data() {
        return {
            slideDica: ref(1),
            autoplay: ref(true),
        }
    },
};
</script>
    