<template>
    <q-dialog v-model="dialog" position="right" rounded>
        <q-carousel v-model="slide" vertical height="450px" transition-prev="slide-down" transition-next="slide-up"
            swipeable animated control-color="primary" arrows>
            <q-carousel-slide :name="1">
                <div style="width: 300px; max-width: 60vh">
                    <div class="row items-center q-pb-none">
                    </div>
                    <div>
                        <div v-if="diferenca > 0" class="tw-mx-auto tw-text-center">
                            Neste mês, o seu gasto com essa categoria é <span class="tw-text-green-500">{{
                                    porcentagem(diferenca)
                            }}</span>
                            maior
                            do
                            que a média dos demais usuários.
                        </div>
                        <div v-else-if="diferenca < 0" class=" tw-mx-auto tw-text-center">
                            Neste mês, o seu gasto com essa categoria é <span class="tw-text-green-500">{{
                                    porcentagem(diferenca
                                        * (-1))
                            }}</span>
                            menor do que a média dos demais usuários.
                        </div>
                        <div v-else class=" tw-mx-auto tw-text-center">
                            <span>Neste mês, o seu gasto com essa categoria é igual à média dos demais usuários.</span>
                        </div>
                        <Bar :chart-data="chartData" />
                        <div class=" tw-mx-auto tw-text-center">
                            <span>Para este cálculo, usamos apenas as moviementações ocorridas no presente mês.😄
                            </span>
                        </div>
                    </div>
                </div>
            </q-carousel-slide>
            <q-carousel-slide :name="2">
                <div style="width: 300px; max-width: 60vh; height:100%;" class="tw-flex tw-items-center tw-text-center">
                    <div class="row items-center q-pb-none">
                        <div v-if="categoria=='Essencial'">
                        <img src="/images/essencial.png" class="tw-mx-auto"/>
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Essencial</span>
                            <span class="tw-flex tw-justify-center"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit, voluptatum obcaecati eligendi rem exercitationem qui fugit culpa similique illo dolore, quisquam tenetur ratione quis. Deleniti maiores repudiandae architecto obcaecati neque?</span>
                        </div>
                        <div v-else-if="categoria=='Objetivos'">
                        <img src="/images/objetivos.png" class="tw-mx-auto"/>
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Objetivos</span>
                            <span class="tw-flex tw-justify-center"> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aut omnis itaque iure! Ea et facilis dolor numquam blanditiis quo rerum ut, quia vitae nostrum. Quisquam ipsa harum obcaecati voluptatibus adipisci.</span>
                        </div>
                        <div v-else-if="categoria=='Aposentadoria'">
                        <img src="/images/aposentadoria.png" class="tw-mx-auto"/>
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Aposentadoria</span>
                            <span class="tw-flex tw-justify-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt eligendi veritatis facere adipisci maiores, deserunt excepturi tempora architecto ipsum temporibus minus vitae beatae odio voluptate sapiente nobis totam similique perferendis.</span>
                            </div>
                        <div v-else-if="categoria=='Educação'">
                        <img src="/images/educacao.png" class="tw-mx-auto"/>
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Educação</span>
                            <span class="tw-flex tw-justify-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt eligendi veritatis facere adipisci maiores, deserunt excepturi tempora architecto ipsum temporibus minus vitae beatae odio voluptate sapiente nobis totam similique perferendis.</span>
                        </div>
                        <div v-else-if="categoria=='Lazer'">
                        <img src="/images/lazer1.png" class="tw-mx-auto"/>
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Lazer</span>
                            <span class="tw-flex tw-justify-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt eligendi veritatis facere adipisci maiores, deserunt excepturi tempora architecto ipsum temporibus minus vitae beatae odio voluptate sapiente nobis totam similique perferendis.</span>
                        </div>
                    </div>
                </div>
            </q-carousel-slide>
        </q-carousel>
    </q-dialog>
</template>
<script setup>
import { Bar } from 'vue-chartjs';
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
        diferenca: Number,
        categoria: String,
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