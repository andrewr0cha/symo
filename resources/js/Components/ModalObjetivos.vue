<template>
    <q-dialog v-model="dialog" position="right" rounded>
        <q-carousel v-model="slide" vertical height="420px" transition-prev="slide-down" transition-next="slide-up"
            swipeable animated control-color="primary" arrows>
            <q-carousel-slide :name="1">
                <div style="width: 300px;  max-width: 60vh; height: 100%;">

                    <div class="row  q-pb-none" style="height:80%">
                        <q-btn icon="trending_up" flat round dense />
                        <q-space />
                        <q-btn icon="close" flat round dense v-close-popup />
                        <div style="height:100%" class="tw-flex tw-items-center">
                            <div v-if="metas == 0" class=" tw-text-lg tw-text-center">
                                <span>Parece que
                                    você ainda não adicionou nenhum objetivo para o futuro😢. Use os os botões da tela
                                    inicial para nos contar algum!</span>
                            </div>
                            <div v-else class=" tw-text-lg tw-text-center">
                                <span>Atualmente, você já nos contou sobre <span class="tw-text-green-600">{{ metas
                                }}</span> de seus objetivos
                                    para o
                                    futuro. E, enquanto usava a plataforma, você já concluiu <span
                                        class="tw-text-green-600">{{ metasConcluidas }}</span> destes
                                    objetivos.</span>
                                <div class="tw-mt-6">
                                    <q-linear-progress :value="metasConcluidas / metas" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </q-carousel-slide>
            <q-carousel-slide :name="2">
                <div style="width: 300px;  max-width: 60vh; height:100%">
                    <div class="tw-flex  tw-items-center tw-h-full">
                        <div class="tw-flex tw-flex-col tw-text-center">
                            <img src="/images/objetivos.png" class="tw-mx-auto" />
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600 ">Metas</span>
                            <span>Todos temos objetivos. Coisas que queremos conquistar, a um curto ou a um longo prazo.
                                Entretanto, para alcançar é preciso poupar. Use a opção "Cofre" para ler mais sobre.
                                Para os Objetivos, nossa sugestão é a de destinar 20% dos ganhos mensais. Atualmente,
                                você destinou <span class="tw-text-green-600">{{ porcentagem(objetivo) }}</span> aos
                                seus
                                objetivos. Não se esqueça de poupar mensalmente😉. </span>
                        </div>
                    </div>
                </div>
            </q-carousel-slide>
        </q-carousel>
    </q-dialog>
</template>
<script setup>
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
        metas: Number,
        metasConcluidas: Number,
        objetivo: Number,
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