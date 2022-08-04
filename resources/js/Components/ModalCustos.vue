<template>
    <q-dialog v-model="dialog" position="right" rounded>
      <q-carousel v-model="slide" vertical height="420px" transition-prev="slide-down" transition-next="slide-up"
        swipeable animated control-color="primary" arrows>
        <q-carousel-slide :name="1">
          <div style="width: 300px;  max-width: 60vh;">
            <div class="row items-center q-pb-none">
            </div>
            <div>
              <div v-if="gastosMensais == 0" class="tw-text-center tw-mx-auto tw-flex tw-items-center tw-text-lg">
                <span class="tw-w-full tw-mb-2">Parece que você ainda não tem despesas cadastradas.🙁</span><img
                  src="/images/custos1.png" />
              </div>
              <div class="tw-text-center tw-mx-auto" v-else>
                <span>Os seus gastos estão divididos da seguinte forma:</span>
                <Pie :chart-data="chartData" />
              </div>
            </div>
          </div>
        </q-carousel-slide>
        <q-carousel-slide :name="2">
          <div style="width: 300px;  max-width: 60vh; height:100%">
            <div class="tw-flex  tw-items-center tw-h-full">
              <div class="tw-flex tw-flex-col">
                <img src="/images/lampada.png" class="tw-mx-auto" />
                <span class="tw-text-lg tw-text-center">Estabilidade financeira diz respeito sobre disciplina antes de
                  tudo. Nesse sentido, sugerimos uma divisão padrão para seus gastos: ela pode ser visualizada usando
                  os
                  ícones ao lado 😉</span>
              </div>
            </div>
          </div>
        </q-carousel-slide>
      </q-carousel>
    </q-dialog>
</template>
<script setup>
import { Pie } from 'vue-chartjs';
import { Chart as ChartJS, Title, Legend, ArcElement, Tooltip, BarElement, CategoryScale, LinearScale, Chart } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, CategoryScale, ArcElement, BarElement, LinearScale);
</script>
    
<script>
import { emit } from 'process'
import { ref } from 'vue';

export default {
    setup() {
        const dialog = ref(true)

        return {
            dialog,
            open() {
                dialog.value = false
            }
        }
    },

    props: {
        chartData: Object,
        gastosMensais: Number,
    },

    methods: {

        porcentagem(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return val.toString() + "%";
        },
    },
    data() {
        return {
            slide: ref(1),
        }
    },
}
</script>