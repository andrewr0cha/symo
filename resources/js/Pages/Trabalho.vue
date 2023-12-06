<script setup>
import BarChart from '@/Components/Bar.ts';
</script>

<template>
    <div class="tw-w-full tw-mt-4">
        <div class="tw-mx-auto tw-w-11/12 tw-text-center tw-mb-4">
            <div class="tw-mb-6">
                <span class="tw-mb-2 tw-text-lg">Tempo de Execução</span>
                <q-carousel v-model="grafico" transition-prev="scale" height="550px" transition-next="scale" swipeable
                    animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                    <!-- Slide para 10 posições -->
                    <q-carousel-slide :name="1" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">10 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataAleatorio10PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataCrescente10PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataDecrescente10PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataQuase10PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 100 posições -->
                    <q-carousel-slide :name="2" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">100 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataAleatorio100PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataCrescente100PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataDecrescente100PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataQuase100PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 1000 posições -->
                    <q-carousel-slide :name="3" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">1000 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataAleatorio1000PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataCrescente1000PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataDecrescente1000PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataQuase1000PosicoesTempo" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>

                </q-carousel>
            </div>

            <div class="tw-mb-6">
                <span class="tw-mb-2 tw-text-lg">Comparações Realizadas</span>
                <q-carousel v-model="grafico" transition-prev="scale" height="550px" transition-next="scale" swipeable
                    animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                    <!-- Slide para 10 posições -->
                    <q-carousel-slide :name="1" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">10 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataComparacoesAleatorio10" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataComparacoesCrescente10" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataComparacoesDecrescente10" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataComparacoesQuase10" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 100 posições -->
                    <q-carousel-slide :name="2" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">100 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataComparacoesAleatorio100" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataComparacoesCrescente100" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataComparacoesDecrescente100" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataComparacoesQuase100" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 1000 posições -->
                    <q-carousel-slide :name="3" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">1000 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataComparacoesAleatorio1000" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataComparacoesCrescente1000" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataComparacoesDecrescente1000" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataComparacoesQuase1000" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>
                </q-carousel>
            </div>

            <div class="tw-mb-6">
                <span class="tw-mb-2 tw-text-lg">Trocas Efetuadas</span>
                <q-carousel v-model="grafico" transition-prev="scale" height="550px" transition-next="scale" swipeable
                    animated control-color="primary" arrows class="tw-w-full tw-bg-black">
                    <!-- Slide para 10 posições -->
                    <q-carousel-slide :name="1" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">10 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataTrocasAleatorio10" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataTrocasCrescente10" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataTrocasDecrescente10" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataTrocasQuase10" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 100 posições -->
                    <q-carousel-slide :name="2" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">100 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataTrocasAleatorio100" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataTrocasCrescente100" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataTrocasDecrescente100" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataTrocasQuase100" />
                                    </div>
                                </q-carousel-slide>
                            </q-carousel>
                        </div>
                    </q-carousel-slide>
                    <!-- Slide para 1000 posições -->
                    <q-carousel-slide :name="3" class="tw-w-full">
                        <div class="tw-w-11/12 tw-mx-auto tw-text-center tw-mb-4">
                            <span class="tw-mb-2 tw-mx-auto tw-text-lg">1000 posições</span><br />
                            <q-carousel v-model="subSlide" vertical transition-prev="slide-down" height="500px"
                                transition-next="slide-up" swipeable animated control-color="primary" arrows
                                class="tw-w-full tw-bg-black">
                                <q-carousel-slide :name="1" class="tw-w-full">
                                    <div>
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Aleatório</span><br />
                                        <BarChart :chartData="chartDataTrocasAleatorio1000" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="2" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Crescente</span><br />
                                        <BarChart :chartData="chartDataTrocasCrescente1000" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="3" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Decrescente</span><br />
                                        <BarChart :chartData="chartDataTrocasDecrescente1000" />
                                    </div>
                                </q-carousel-slide>
                                <q-carousel-slide :name="4" class="tw-w-full">
                                    <div class="tw-pt-6">
                                        <span class="tw-mb-4 tw-mx-auto tw-text-lg">Quase ordenado</span><br />
                                        <BarChart :chartData="chartDataTrocasQuase1000" />
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
            chartDataAleatorio10PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [311]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [366]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [191]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [283]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [1410]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [278]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [202]
                    },
                ],
            },
            chartDataCrescente10PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [182]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [71]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [79]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [99]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [398]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [236]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [87]
                    },
                ],
            },
            chartDataDecrescente10PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [205]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [259]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [181]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [180]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [414]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [323]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [196]
                    },
                ],
            },
            chartDataQuase10PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [137]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [284]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [118]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [205]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [380]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [228]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [121]
                    },
                ],
            },

            chartDataAleatorio100PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [5770]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [20500]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [2380]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [3520]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [5880]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [3340]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [2930]
                    },
                ],
            },
            chartDataCrescente100PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [3610]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [156]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [169]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [627]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [2470]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [7790]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [725]
                    },
                ],
            },
            chartDataDecrescente100PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [5620]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [26740]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [3930]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [1380]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [2470]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [4770]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [2450]
                    },
                ],
            },
            chartDataQuase100PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [4020]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [11950]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [1370]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [2610]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [4210]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [3210]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [1990]
                    },
                ],
            },

            chartDataAleatorio1000PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [324440]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [2168930]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [150630]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [51690]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [73220]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [40170]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [49710]
                    },
                ],
            },
            chartDataCrescente1000PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [397280]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [1210]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [1250]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [8460]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [22900]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [273710]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [7770]
                    },
                ],
            },
            chartDataDecrescente1000PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [575840]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [4244320]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [292510]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [16130]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [27530]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [298430]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [27890]
                    },
                ],
            },
            chartDataQuase1000PosicoesTempo: {
                labels: ['Tempo de Execução (ns)'],
                datasets: [
                    {
                        label: ['Selection'],
                        backgroundColor: ['#33CC45'],
                        data: [305700]
                    },
                    {
                        label: ['Bubble'],
                        backgroundColor: ['#33CC79'],
                        data: [1023950]
                    },
                    {
                        label: ['Insertion'],
                        backgroundColor: ['#33CCAE'],
                        data: [72760]
                    },
                    {
                        label: ['Shell'],
                        backgroundColor: ['#33B6CC'],
                        data: [46370]
                    },
                    {
                        label: ['Merge'],
                        backgroundColor: ['#3381CC'],
                        data: [48850]
                    },
                    {
                        label: ['Quick'],
                        backgroundColor: ['#334DCC'],
                        data: [39880]
                    },
                    {
                        label: ['Tim'],
                        backgroundColor: ['#4E33CC'],
                        data: [31390]
                    },
                ],
            },

            chartDataTrocasAleatorio100: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [90],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [2505],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [2505],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [443],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [263],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [425],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [667],
                    },
                ],
            },
            chartDataTrocasCrescente100: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [0],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [0],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [0],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [0],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [0],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [347],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [0],
                    },
                ],
            },
            chartDataTrocasDecrescente100: {
                labels: ['Trocas'],
                datasets: [
                    { label: 'Selection', backgroundColor: ['#33CC45'], data: [51] },
                    { label: 'Bubble', backgroundColor: ['#33CC79'], data: [4946] },
                    { label: 'Insertion', backgroundColor: ['#33CCAE'], data: [4946] },
                    { label: 'Shell', backgroundColor: ['#33B6CC'], data: [259] },
                    { label: 'Merge', backgroundColor: ['#3381CC'], data: [314] },
                    { label: 'Quick', backgroundColor: ['#334DCC'], data: [395] },
                    { label: 'Tim', backgroundColor: ['#4E33CC'], data: [1296] },
                ],
            },
            chartDataTrocasQuase100: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [26],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [983],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [983],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [266],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [193],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [450],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [395],
                    },
                ],
            },

            chartDataTrocasAleatorio1000: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [994],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [248595],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [248595],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [7053],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [3870],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [6045],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [10190],
                    },
                ],
            },
            chartDataTrocasCrescente1000:{
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [0],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [0],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [0],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [0],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [0],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [5242],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [0],
                    },
                ],
            },
            chartDataTrocasDecrescente1000: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [608],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [498984],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [498984],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [4461],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [4709],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [5528],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [17351],
                    },
                ],
            },
            chartDataTrocasQuase1000: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [369],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [114350],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [114350],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [6091],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [3870],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [7452],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [7292],
                    },
                ],
            },

            chartDataComparacoesAleatorio100: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [4950],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [4940],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [2604],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [503],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [547],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [631],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [861],
                    },
                ],
            },
            chartDataComparacoesCrescente100: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [4950],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [99],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [99],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [503],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [356],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [481],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [196],
                    },
                ],
            },
            chartDataComparacoesDecrescente100: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [4950],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [4950],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [5045],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [503],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [318],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [520],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [1392],
                    },
                ],
            },
            chartDataComparacoesQuase100: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [4950],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [4572],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [1082],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [503],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [509],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [552],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [591],
                    },
                ],
            },


            chartDataComparacoesAleatorio1000: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [499500],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [499347],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [249594],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [8006],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [8706],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [10443],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [13694],
                    },
                ],
            },
            chartDataComparacoesCrescente1000: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [499500],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [999],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [999],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [8006],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [5044],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [8168],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [3528],
                    },
                ],
            },
            chartDataComparacoesDecrescente1000: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [499500],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [499500],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [499983],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [8006],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [5144],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [8583],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [18338],
                    },
                ],
            },
            chartDataComparacoesQuase1000: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [499500],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [489630],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [115349],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [8006],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [8492],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [11370],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [10799],
                    },
                ],
            },


            chartDataTrocasAleatorio10: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [8],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [26],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [26],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [14],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [10],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [18],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [26],
                    },
                ],
            },
            chartDataTrocasCrescente10: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [0],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [0],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [0],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [0],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [0],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [19],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [0],
                    },
                ],
            },
            chartDataTrocasDecrescente10: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [5],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [45],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [45],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [13],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [15],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [24],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [45],
                    },
                ],
            },
            chartDataTrocasQuase10: {
                labels: ['Trocas'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [2],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [14],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [14],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [10],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [9],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [21],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [14],
                    },
                ],
            },

            chartDataComparacoesAleatorio10: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [45],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [45],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [35],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [22],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [24],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [30],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [35],
                    },
                ],
            },
            chartDataComparacoesCrescente10: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [45],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [9],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [9],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [22],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [19],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [19],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [9],
                    },
                ],
            },
            chartDataComparacoesQuase10: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [45],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [44],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [23],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [22],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [23],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [19],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [23],
                    },
                ],
            },
            chartDataComparacoesDecrescente10: {
                labels: ['Comparações'],
                datasets: [
                    {
                        label: 'Selection',
                        backgroundColor: ['#33CC45'],
                        data: [45],
                    },
                    {
                        label: 'Bubble',
                        backgroundColor: ['#33CC79'],
                        data: [45],
                    },
                    {
                        label: 'Insertion',
                        backgroundColor: ['#33CCAE'],
                        data: [54],
                    },
                    {
                        label: 'Shell',
                        backgroundColor: ['#33B6CC'],
                        data: [22],
                    },
                    {
                        label: 'Merge',
                        backgroundColor: ['#3381CC'],
                        data: [15],
                    },
                    {
                        label: 'Quick',
                        backgroundColor: ['#334DCC'],
                        data: [21],
                    },
                    {
                        label: 'Tim',
                        backgroundColor: ['#4E33CC'],
                        data: [54],
                    },
                ],
            },
        }
    }
}
</script>
