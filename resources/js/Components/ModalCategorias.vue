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
                            <span>Para este cálculo, usamos apenas as movimentações ocorridas no presente mês.😄
                            </span>
                        </div>
                    </div>
                </div>
            </q-carousel-slide>
            <q-carousel-slide :name="2">
                <div style="width: 300px; max-width: 60vh; height:100%;" class="tw-flex tw-items-center tw-text-center">
                    <div class="row items-center q-pb-none">
                        <div v-if="categoria == 'Essencial'">
                            <img src="/images/essencial.png" class="tw-mx-auto" />
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Essencial</span>
                            <span class="tw-flex tw-justify-center"> Existem coisas que são imprescindíveis para nós.
                                Moradia, alimentação e, mais recentemente, internet. Tudo o que tem uma importância
                                muito grande em sua vida deve ser considerado Essencial. Use esta opção para tais
                                contas. Não há uma verdade absoluta, cada um deve fazer uma análise de sua própria vida.
                                Entretanto, para manter o equilíbrio, sugerimos que, com esta categoria, sejam dispostos
                                55% de todos os ganhos mensais. Estar ao redor disso pode significar uma vida que cabe
                                no bolso, sem apertos ou endividamentos futuros🏠.</span>
                        </div>
                        <div v-else-if="categoria == 'Aposentadoria'">
                            <img src="/images/aposentadoria.png" class="tw-mx-auto" />
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Aposentadoria</span>
                            <span class="tw-flex tw-justify-center">Existem poucas verdades nessa vida. Uma delas, sem
                                dúvidas, é a de que amanhã estaremos mais velhos do que hoje. Mesmo a pessoa mais
                                energética não consegue manter o ritmo do trabalho para sempre. Por isso, é de suma
                                importância economizar um pouco para que, quando essa hora chegar, possamos desenvolver
                                uma vida tranquila. Neste sentido, sugerimos que esta categoria receba um total de 10%
                                de todos os ganhos mensais. Fazer um pouco de cada vez é uma forma muito eficaz de se
                                construir grandes coisas👴.</span>
                        </div>
                        <div v-else-if="categoria == 'Educação'">
                            <img src="/images/educacao.png" class="tw-mx-auto" />
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Educação</span>
                            <span class="tw-flex tw-justify-center">Tudo nos pode ser retirado, exceto uma coisa: o
                                conhecimento. O conhecimento é libertador, seja ele qual for. O ato de sempre
                                aprimorar-se é o que diferencia algumas pessoas. Por isso, investir em nosso próprio
                                conhecimento nunca é um desperdício de dinheiro e, em algum momento, gerará bons frutos.
                                A esta categoria sugerimos que sejam destinados 5% dos ganhos mensais. Vale lembrar que
                                educação não se resume apenas a cursos. Um livro, por exemplo, auxilia na compreensão e
                                aumenta o vocabulário📚.</span>
                        </div>
                        <div v-else-if="categoria == 'Lazer'">
                            <img src="/images/lazer1.png" class="tw-mx-auto" />
                            <span class="tw-text-lg tw-mt-2 tw-text-green-600">Lazer</span>
                            <span class="tw-flex tw-justify-center">Ninguém é de ferro. Na maioria das vezes, todos
                                gostamos de estar com amigos ou família. Por isso, é justo que destinemos uma parte de
                                nossos ganhos a esses momentos de descontração. Jantares fora, passeios ou simplesmente
                                uma pizza em casa no sábado, é bom que tenhamos momentos assim. Portanto, sugerimos que,
                                para o Lazer, destinem-se 10% do ganhos mensais. Lembrando que podemos apenas fazer
                                sugestões, mas o melhor deve ser definido por cada um🥳.</span>
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