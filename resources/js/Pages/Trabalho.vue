<script setup>
import BarChart from '@/Components/Bar.ts';
</script>

<template>
    <div class="tw-w-full tw-mt-4">
        <div class="tw-mx-auto tw-w-11/12 tw-text-center tw-mb-4">
            <div class="tw-mb-6">
                <span class="tw-mb-2 tw-text-lg">Tempo de Execução</span>
                <q-carousel v-model="grafico" transition-prev="scale" height="550px" transition-next="scale"
                            swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                    <!-- Slide para 10 posições -->
                    <q-carousel-slide :name="1" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">10 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 100 posições -->
                    <q-carousel-slide :name="2" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">100 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 1000 posições -->
                    <q-carousel-slide :name="3" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">1000 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData1" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>

                </q-carousel>
            </div>
            
            <div class="tw-mb-6">
                <span class="tw-mb-2 tw-text-lg">Comparações Realizadas</span>
                <q-carousel v-model="grafico" transition-prev="scale" height="550px" transition-next="scale"
                            swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                    <!-- Slide para 10 posições -->
                    <q-carousel-slide :name="1" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">10 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 100 posições -->
                    <q-carousel-slide :name="2" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">100 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 1000 posições -->
                    <q-carousel-slide :name="3" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">1000 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData2" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                </q-carousel>
            </div>
            
            <div class="tw-mb-6">
                <span class="tw-mb-2 tw-text-lg">Trocas Efetuadas</span>
                <q-carousel v-model="grafico" transition-prev="scale" height="550px" transition-next="scale"
                            swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                    <!-- Slide para 10 posições -->
                    <q-carousel-slide :name="1" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">10 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 100 posições -->
                    <q-carousel-slide :name="2" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">100 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 1000 posições -->
                    <q-carousel-slide :name="3" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                        <span class="tw-mb-2 tw-mx-auto tw-text-lg">1000 posições</span><br/>
                        <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px" transition-next="slide-up"
                                    swipeable animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                            <q-carousel-slide :name="1" class="tw-w-full">
                            <div>
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="2" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="3" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                            <q-carousel-slide :name="4" class="tw-w-full">
                            <div class="tw-pt-6">
                                <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br/>
                                <BarChart :chartData="chartData3" />
                            </div>
                            </q-carousel-slide>
                        </q-carousel>
                        </div>
                    </q-carousel-slide>
                </q-carousel>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
export default {
  props: {
    dados: Object,
  },
  data() {
    return {
        grafico: ref(1),
      subSlide: ref(1),
      chartData1 : {
        labels: ['Tempo de Execução'],
        datasets: [
        {
        label: ['Selection'],
        backgroundColor: ['#339ccc'],
        data: [1]
        },
        {
        label: ['Bubble'],
        backgroundColor: ['#33accc'],
        data: [2]
        },
        {
        label: ['Insertion'],
        backgroundColor: ['#33bccc'],
        data: [3]
        },
        {
        label: ['Shell'],
        backgroundColor: ['#33cccc'],
        data: [4]
        },
        {
        label: ['Merge'],
        backgroundColor: ['#33dccc'],
        data: [4]
        },
        {
        label: ['Quick'],
        backgroundColor: ['#33eccc'],
        data: [3]
        },
        {
        label: ['Tim'],
        backgroundColor: ['#33fccc'],
        data: [2]
        },
        {
        label: ['Bogo'],
        backgroundColor: ['#33fccc'],
        data: [1]
        },
        ],
    },
    chartData2 : {
        labels: ['Comparações Realizadas'],
        datasets: [
        {
        label: ['Selection'],
        backgroundColor: ['#339ccc'],
        data: [1]
        },
        {
        label: ['Bubble'],
        backgroundColor: ['#33accc'],
        data: [2]
        },
        {
        label: ['Insertion'],
        backgroundColor: ['#33bccc'],
        data: [3]
        },
        {
        label: ['Shell'],
        backgroundColor: ['#33cccc'],
        data: [4]
        },
        {
        label: ['Merge'],
        backgroundColor: ['#33dccc'],
        data: [4]
        },
        {
        label: ['Quick'],
        backgroundColor: ['#33eccc'],
        data: [3]
        },
        {
        label: ['Tim'],
        backgroundColor: ['#33fccc'],
        data: [2]
        },
        {
        label: ['Bogo'],
        backgroundColor: ['#33fccc'],
        data: [1]
        },
        ],
    },
    chartData3 : {
        labels: ['Trocas Efetuadas'],
        datasets: [
        {
        label: ['Selection'],
        backgroundColor: ['#339ccc'],
        data: [1]
        },
        {
        label: ['Bubble'],
        backgroundColor: ['#33accc'],
        data: [2]
        },
        {
        label: ['Insertion'],
        backgroundColor: ['#33bccc'],
        data: [3]
        },
        {
        label: ['Shell'],
        backgroundColor: ['#33cccc'],
        data: [4]
        },
        {
        label: ['Merge'],
        backgroundColor: ['#33dccc'],
        data: [4]
        },
        {
        label: ['Quick'],
        backgroundColor: ['#33eccc'],
        data: [3]
        },
        {
        label: ['Tim'],
        backgroundColor: ['#33fccc'],
        data: [2]
        },
        {
        label: ['Bogo'],
        backgroundColor: ['#33fccc'],
        data: [1]
        },
        ],
    },
    }
  }
}
</script>