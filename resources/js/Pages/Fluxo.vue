<template>

  <Head title="Fluxo" />
  <BreezeAuthenticatedLayout>
    <div class="tw-text-center tw-w-full tw-bg-neutral-800">
      <div class="tw-mx-auto tw-my-4 tw-w-11/12 tw-flex tw-inline-flex">
        <div class="tw-w-full">
          <div class="tw-w-full tw-flex tw-text-white tw-inline-flex">
            <div class="tw-w-full tw-items-center tw-flex tw-flex-col">
              <div class="md:tw-hidden tw-flex tw-w-11/12  tw-mx-auto">
                <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless rounded
                  v-model="model" :options="options" label="Período" dense @update:model-value="calcula(model)"
                  class="tw-w-full" />
              </div>
              <div class=" tw-flex tw-inline-flex tw-w-full tw-p-2 tw-border-double tw-border-4 tw-border-cyan-600">
                <div class="tw-w-2/3 sm:tw-w-1/3 tw-mr-4"><div
                  class="tw-bg-white  tw-h-40 tw-w-40 tw-mx-auto tw-p-2 borda tw-flex tw-items-center">
                  <div>
                    <div class="tw-text-lg tw-text-black">O saldo do período é:</div>
                    <div v-if="entrada-saida<0" class="tw-text-lg tw-text-red-600">R$
                      {{valorFormatado(entrada-saida)}} </div>
                    <div v-else class="tw-text-lg tw-text-green-600">R$ {{valorFormatado(entrada-saida)}} </div>
                  </div>
                </div></div>
                <div class="tw-w-1/3 sm:tw-w-2/3 tw-flex tw-inline-flex">
                  <div class="tw-w-full sm:tw-w-8/12"><div class="tw-w-11/12 md:tw-w-9/12 tw-h-6 tw-mx-auto tw-mt-2 tw-mb-4 sm:tw-my-2">
                    Total de Entradas:
                  </div>
                  <div
                    class="borda2 tw-text-black tw-w-full sm:tw-w-2/3 tw-bg-white tw-mx-auto tw-h-8 sm:tw-mb-2 tw-flex tw-justify-center tw-items-center">
                    R$ {{valorFormatado( entrada )}}</div>
                  <div class="tw-w-full md:tw-w-9/12  tw-h-6 tw-mx-auto tw-mt-2 tw-mb-4 sm:tw-my-2">
                    Total de Saídas:
                  </div>
                  <div
                    class="borda2 tw-text-black tw-w-full sm:tw-w-2/3 tw-bg-white tw-mx-auto tw-h-8 sm:tw-mb-2 tw-flex tw-justify-center tw-items-center">
                    R$ {{valorFormatado( saida )}}</div></div>
                    <div class="tw-hidden tw-w-1/2 tw-items-center md:tw-flex tw-inline-flex">
                <div class="tw-w-11/12 tw-m-4 tw-mx-auto">
                  <div class="tw-p-2 w-flex tw-items-center">
                    <div class="tw-hidden md:tw-flex">
                      <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless
                        rounded v-model="model" :options="options" label="Período" dense
                        @update:model-value="calcula(model)" class="tw-w-full" />
                    </div>
                  </div>
                </div>
              </div>
                </div>
              </div>
              
            </div>


            <!--<div class="tw-w-1/2 tw-items-center  tw-flex tw-inline-flex">
              <div class="tw-w-1/2 tw-m-4 tw-mx-auto">
                <div
                  class="tw-bg-white tw-mx-auto tw-h-28 tw-w-28 md:tw-h-40 md:tw-w-40  tw-p-2 borda tw-flex tw-items-center tw-border-double tw-border-4 tw-border-cyan-600">
                  <div>
                    <div class="tw-text-lg tw-text-black">O saldo do período é:</div>
                    <div v-if="entrada-saida<0" class="tw-text-lg tw-text-red-600">R$
                      {{valorFormatado(entrada-saida)}} </div>
                    <div v-else class="tw-text-lg tw-text-green-600">R$ {{valorFormatado(entrada-saida)}} </div>
                  </div>
                </div>
              </div>
              <div class="tw-hidden tw-w-1/2 tw-items-center md:tw-flex tw-inline-flex">
                <div class="tw-w-11/12 tw-m-4 tw-mx-auto">
                  <div class="tw-p-2 w-flex tw-items-center">
                    <div class="tw-hidden md:tw-flex">
                      <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless
                        rounded v-model="model" :options="options" label="Período" dense
                        @update:model-value="calcula(model)" class="tw-w-full" />
                    </div>
                  </div>
                </div>
              </div>
            </div>-->

          </div>
        </div>
      </div>
      <div class="tw-mx-auto tw-w-11/12 tw-flex tw-inline-flex tw-mb-4">
        <q-carousel v-model="grafico" vertical transition-prev="slide-down" height="480px" transition-next="slide-up"
          swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
          <q-carousel-slide :name="1" class="tw-w-full">
            <div>
              <span class="tw-mb-4 tw-mx-auto tw-text-lg">Barras</span> <br />
              <span v-if="model==''" class="tw-text-lg tw-mx-auto tw-mt-4">Selecione uma opção para ver este
                gráfico.</span>
              <BarChart :chartData="chartDataLinha" v-else-if="model=='Ano'" />
              <BarChart :chartData="chartDataBarra" v-else />
            </div>
          </q-carousel-slide>
          <q-carousel-slide :name="2" class="tw-w-full">
            <div class="tw-pt-6">
              <span class="tw-mx-auto tw-text-lg">Setores</span><br />
              <span v-if="model==''" class="tw-text-lg tw-mx-auto tw-mt-4">Selecione uma opção para ver este
                gráfico.</span>
              <PieChart :chartData="chartDataSetor" />
            </div>
          </q-carousel-slide>
          <q-carousel-slide :name="3" class="tw-w-full">
            <div class="tw-pt-6">
              <span class="tw-mx-auto tw-text-lg">Linhas</span>
              <LineChart :chartData="chartDataLinha" v-if="model=='Ano'" />
              <div v-else class="tw-w-full tw-flex tw-items-center">
                <span class="tw-text-lg tw-mx-auto tw-mt-4">Selecione a opção 'Ano' para ver este gráfico.</span>
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
  border-radius: 50%
}

.borda2 {
  border-radius: 50px 50px 50px 50px
}
</style>
<script setup>
import LineChart from '@/Components/Line.ts';
import BarChart from '@/Components/Bar.ts';
import PieChart from '@/Components/Pie.ts';
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>
<script>
import { ref } from "vue";
export default {
  props: {
    dados: Object,
    dadosAnuais: Object,
    meses: Array,
  },
  methods: {
    valorFormatado(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    porcentagem(value) {
      if (value == 0) return value.toString() + "%";
      else {
        let val = (value / 1).toFixed(0).replace(".", ",");
        return val.toString() + "%";
      }
    },

    calcula(value) {
      switch (value) {
        case "Hoje":
          var total = (this.dados[0][0] + this.dados[1][0]) == 0 ? total = 1 : total = this.dados[0][0] + this.dados[1][0];
          this.chartDataSetor = {
            labels: ['Entradas (' + this.porcentagem((this.dados[0][0] / total) * 100) + ')', 'Saídas (' + this.porcentagem((this.dados[1][0] / total) * 100) + ')'],
            datasets: [
              {
                label: ['Entradas', 'Saídas'],
                backgroundColor: ['#33cccc', '#FFFFF'],
                data: [this.dados[0][0], this.dados[1][0]]
              }
            ],
          },
            this.chartDataBarra = {
              labels: ["Movimentações"],
              datasets: [
                {
                  label: ['Entradas'],
                  backgroundColor: ['#33cccc'],
                  data: [this.dados[0][0]]
                },
                {
                  label: ['Saídas'],
                  backgroundColor: ['#FFFFF'],
                  data: [this.dados[1][0]]
                },
              ],
            },
            this.entrada = this.dados[0][0]
          this.saida = this.dados[1][0]
          break;
        case "Semana":
          var total = (this.dados[0][1] + this.dados[1][1]) == 0 ? total = 1 : total = this.dados[0][1] + this.dados[1][1];
          this.chartDataSetor = {
            labels: ['Entradas (' + this.porcentagem((this.dados[0][1] / total) * 100) + ')', 'Saídas (' + this.porcentagem((this.dados[1][1] / total) * 100) + ')'],
            datasets: [
              {
                label: ['Entradas', 'Saídas'],
                backgroundColor: ['#33cccc', '#FFFFF'],
                data: [this.dados[0][1], this.dados[1][1]]
              }
            ],
          },

            this.chartDataBarra = {
              labels: ["Movimentações"],
              datasets: [
                {
                  label: ['Entradas'],
                  backgroundColor: ['#33cccc'],
                  data: [this.dados[0][1]]
                },
                {
                  label: ['Saídas'],
                  backgroundColor: ['#FFFFF'],
                  data: [this.dados[1][1]]
                },


              ],
            },
            this.entrada = this.dados[0][1]
          this.saida = this.dados[1][1]
          break;
        case "Mês":
          var total = (this.dados[0][2] + this.dados[1][2]) == 0 ? total = 1 : total = this.dados[0][2] + this.dados[1][2];
          this.chartDataSetor = {
            labels: ['Entradas (' + this.porcentagem((this.dados[0][2] / total) * 100) + ')', 'Saídas (' + this.porcentagem((this.dados[1][2] / total) * 100) + ')'],
            datasets: [
              {
                label: ['Entradas', 'Saídas'],
                backgroundColor: ['#33cccc', '#FFFFF'],
                data: [this.dados[0][2], this.dados[1][2]]
              }
            ],
          },

            this.chartDataBarra = {
              labels: ["Movimentações"],
              datasets: [
                {
                  label: ['Entradas'],
                  backgroundColor: ['#33cccc'],
                  data: [this.dados[0][2]]
                },
                {
                  label: ['Saídas'],
                  backgroundColor: ['#FFFFF'],
                  data: [this.dados[1][2]]
                },


              ],
            },
            this.entrada = this.dados[0][2]
          this.saida = this.dados[1][2]
          break;
        case "Ano":
          var total = (this.dados[0][3] + this.dados[1][3]) == 0 ? total = 1 : total = this.dados[0][3] + this.dados[1][3];
          this.chartDataSetor = {
            labels: ['Entradas (' + this.porcentagem((this.dados[0][3] / total) * 100) + ')', 'Saídas (' + this.porcentagem((this.dados[1][3] / total) * 100) + ')'],
            datasets: [
              {
                label: ['Entradas', 'Saídas'],
                backgroundColor: ['#33cccc', '#FFFFF'],
                data: [this.dados[0][3], this.dados[1][3]]
              }
            ],
          },
            this.chartDataLinha = {
              labels: this.meses,
              datasets: [
                {
                  label: 'Entradas',
                  backgroundColor: '#33cccc',
                  borderColor: '#33cccc',
                  data: this.dadosAnuais[0]
                }, {
                  label: 'Saídas',
                  backgroundColor: '#FFFFF',
                  borderColor: '#FFFFF',
                  data: this.dadosAnuais[1]
                }
              ],
            },

            this.chartDataBarra = {
              labels: ["Movimentações"],
              datasets: [
                {
                  label: ['Entradas'],
                  backgroundColor: ['#33cccc'],
                  data: [this.dados[0][3]]
                },
                {
                  label: ['Saídas'],
                  backgroundColor: ['#FFFFF'],
                  data: [this.dados[1][3]]
                },


              ],
            },

            this.entrada = this.dados[0][3]
          this.saida = this.dados[1][3]
          break;
      }
    }
  },
  data() {
    return {
      slide: ref(1),
      grafico: ref(1),
      model: '',
      options: [
        'Hoje', 'Semana', 'Mês', 'Ano'
      ],
      chartDataLinha: [],
      chartDataSetor: [],
      chartDataBarra: [],
      entrada: null,
      saida: null
    }
  }
};
</script>
  