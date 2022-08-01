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
                <div style="width: 300px; max-width: 60vh">
                    <div class="row items-center q-pb-none">

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
        diferenca: Number
    },

    methods: {
        lancarEntrada() {
            if (this.form.nome == "" || this.form.valor == "") {
                this.formNulo = true;
            } else {
                this.form.valor = this.form.valor.replace(".", "").replace(",", ".");
                this.form.post(route("adicionar.entrada"), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                    },
                });
            }
        },

        porcentagem(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return val.toString() + "%";
        },
    },
    data() {
        return {
            slide: ref(1),
            form: this.$inertia.form({
                nome: "",
                id_categoria: ref(null),
                valor: "",
                descricao: "",
            }),
            formNulo: false,
        }
    },
}
</script>