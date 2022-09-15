<template>

  <Head title="Previsões" />
  <BreezeAuthenticatedLayout>
    <div class="tw-text-center tw-w-full tw-bg-black">
      <div class="tw-mx-auto tw-w-11/12 tw-bg-green-600 tw-flex tw-inline-flex">
        <q-carousel v-model="slide" vertical transition-prev="slide-down" height="380px" transition-next="slide-up"
          swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
          <q-carousel-slide :name="1" class="tw-w-full tw-bg-black">
            <div class="tw-w-full tw-flex tw-text-white tw-inline-flex">
              <div class="tw-w-1/2 tw-items-center tw-flex tw-flex-col">
                <div class="tw-mt-2 tw-w-11/12 md:tw-w-9/12" style="min-width:100px">
                  <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless rounded
                    v-model="model" :options="options" label="Período" dense @update:model-value="calcula(model)" />
                </div>
                <div class="tw-w-11/12 md:tw-w-9/12 tw-h-6 tw-my-2">
                  Total de Entradas:
                </div>
                <div
                  class="borda2 tw-text-black tw-w-11/12 md:tw-w-9/12 tw-bg-white tw-h-14 tw-mb-2 tw-flex tw-justify-center tw-items-center">
                  R$ {{valorFormatado( entrada )}}</div>
                <div class="tw-w-11/12 md:tw-w-9/12  tw-h-6 tw-my-2">
                  Total de Saídas:
                </div>
                <div
                  class="borda2 tw-text-black tw-w-11/12 md:tw-w-9/12 tw-bg-white tw-h-14 tw-mb-2 tw-flex tw-justify-center tw-items-center">
                  R$ {{valorFormatado( saida )}}</div>
              </div>
              <div class="tw-w-1/2 tw-items-center  tw-flex tw-inline-flex">
                <div class="tw-w-1/2 tw-m-4">
                  <div class="tw-bg-white tw-h-32 tw-w-32 md:tw-h-36 md:tw-w-36 borda tw-flex tw-items-center">
                    <div>
                      <div class="tw-text-lg tw-text-black">O saldo do período é:</div>
                      <div v-if="entrada-saida<0" class="tw-text-lg tw-text-red-600">R$
                        {{valorFormatado(entrada-saida)}} </div>
                      <div v-else class="tw-text-lg tw-text-green-600">R$ {{valorFormatado(entrada-saida)}} </div>
                    </div>
                  </div>
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
                  <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless rounded
                    v-model="model" :options="options" label="Período" dense @update:model-value="a(model)" />
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
  props: {
    dados: Object
  },
  methods: {
    valorFormatado(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    calcula(value) {
      switch (value) {
        case "Hoje":
          this.entrada = this.dados[0][0]
          this.saida = this.dados[1][0]
          break;
        case "Semana":
          this.entrada = this.dados[0][1]
          this.saida = this.dados[1][1]
          break;
        case "Mês":
          this.entrada = this.dados[0][2]
          this.saida = this.dados[1][2]
          break;
        case "Ano":
          this.entrada = this.dados[0][3]
          this.saida = this.dados[1][3]
          break;
      }
    }
  },
  data() {
    return {
      slide: ref(1),
      options: [
        'Hoje', 'Semana', 'Mês', 'Ano'
      ],
      entrada: null,
      saida: null
    }
  }
};
</script>
  