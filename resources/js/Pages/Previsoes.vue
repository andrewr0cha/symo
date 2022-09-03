<template>

  <Head title="Previsões" />
  <BreezeAuthenticatedLayout>
    <div class="tw-text-center tw-w-full tw-bg-black">
      <div class="tw-mx-auto tw-w-11/12 tw-bg-green-600 tw-flex tw-inline-flex">
        <q-carousel v-model="slide" vertical transition-prev="slide-down" height="380px" transition-next="slide-up" swipeable animated
          control-color="primary" arrows class="tw-w-full tw-bg-black">
          <q-carousel-slide :name="1" class="tw-w-full tw-bg-black">
            <div class="tw-w-full tw-flex tw-text-white tw-inline-flex">
              <div class="tw-w-1/2 tw-items-center tw-flex tw-flex-col">
                <div class="tw-mt-2 tw-w-11/12 md:tw-w-9/12" style="min-width:100px">
                  <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless rounded v-model="model" :options="options" label="Período" dense
                    @update:model-value="a(model)" />
                </div>
                <div class="tw-w-11/12 md:tw-w-9/12 tw-h-6 tw-my-2">
                  Total de Entradas:
                </div>
                <div
                  class="borda2 tw-text-black tw-w-11/12 md:tw-w-9/12 tw-bg-white tw-h-14 tw-mb-2 tw-flex tw-justify-center tw-items-center">
                  {{ teste }}</div>
                <div class="tw-w-11/12 md:tw-w-9/12  tw-h-6 tw-my-2">
                  Total de Saídas:
                </div>
                <div
                  class="borda2 tw-text-black tw-w-11/12 md:tw-w-9/12 tw-bg-white tw-h-14 tw-mb-2 tw-flex tw-justify-center tw-items-center">
                  {{ teste }}</div>
              </div>
              <div class="tw-w-1/2 tw-items-center  tw-flex tw-inline-flex">
                <div class="tw-w-1/2 tw-m-4">
                  <div class="tw-bg-white tw-h-32 tw-w-32 md:tw-h-36 md:tw-w-36 borda"></div>
                </div>
                <div class="tw-w-1/2 tw-flex tw-flex-col tw-hidden md:tw-flex">
                  <img src="/images/lampada.png" style="max-width:30px;" class="tw-my-2" />
                  <img src="/images/lampada.png" style="max-width:30px;" class="tw-my-2" />
                </div>
              </div>
            </div>
          </q-carousel-slide>
          <q-carousel-slide :name="2">
            <div class="tw-w-full tw-flex tw-inline-flex">
              <div class="tw-w-1/2 tw-items-center tw-flex tw-flex-col">
                <div class="tw-mt-2 tw-w-11/12 md:tw-w-9/12" style="min-width:100px">
                  <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless rounded v-model="model" :options="options" label="Período" dense
                    @update:model-value="a(model)" />
                </div>
                <div class="tw-w-11/12 md:tw-w-9/12 tw-h-6 tw-my-2">
                  Total de Entradas:
                </div>
                <div
                  class="borda2 tw-w-11/12 md:tw-w-9/12 tw-bg-white tw-h-14 tw-mb-2 tw-flex tw-justify-center tw-items-center">
                  {{ teste }}</div>
                <div class="tw-w-11/12 md:tw-w-9/12  tw-h-6 tw-my-2">
                  Total de Saídas:
                </div>
                <div
                  class="borda2 tw-w-11/12 md:tw-w-9/12 tw-bg-white tw-h-14 tw-mb-2 tw-flex tw-justify-center tw-items-center">
                  {{ teste }}</div>
              </div>
              <div class="tw-w-1/2 tw-items-center  tw-flex tw-inline-flex">
                <div class="tw-w-1/2 tw-m-4">
                  <div class="tw-bg-white tw-h-32 tw-w-32 md:tw-h-36 md:tw-w-36 borda"></div>
                </div>
                <div class="tw-w-1/2 tw-flex tw-flex-col tw-hidden md:tw-flex">
                  <img src="/images/lampada.png" style="max-width:30px;" class="tw-my-2" />
                  <img src="/images/lampada.png" style="max-width:30px;" class="tw-my-2" />
                </div>
              </div>
            </div>
          </q-carousel-slide>
        </q-carousel>
      </div>

    </div>
  </BreezeAuthenticatedLayout>
</template>

<style scoped>
.borda {
  border-radius: 100%
}
.borda2 {
  border-radius: 50px 50px 50px 50px
}
</style>
<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";</script>
<script>
import { ref } from "vue";
import dayjs from "dayjs";
export default {
  methods: {
    a(value) {
      var day;
      switch (value) {
        case "Hoje":
          day = "30/08";
          break;
        case "Semana":
          day = "23/08";
          break;
        case "Mês":
          day = "30/07";
          break;
        case "Ano":
          day = "30/08/21";
          break;
      }
      this.teste = day;
    }
  },
  data() {
    return {
      slide: ref(1),
      options: [
        'Hoje', 'Semana', 'Mês', 'Ano'
      ],
      teste: null,
    }
  }
};
</script>
  