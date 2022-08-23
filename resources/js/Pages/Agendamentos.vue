<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DialogBaixo from "@/Components/DialogBaixo.vue";
import Calendario from "@/Components/Calendario.vue";
const modalAgendamentos = ref(false);
const modalData = ref(false);
defineExpose({ modalAgendamentos, modalData });
</script>

<template>

    <Head title="Eventos" />
    <BreezeAuthenticatedLayout>
        <div class="tw-border-1 tw-border-dotted tw-mt-4 tw-px-8 tw-p-y-4 tw-flex tw-justify-center">
            <div class="calendario tw-w-full tw-pl-4 tw-max-w-xl">
                <!--Agendamentos-->
                <div class="tempo tw-w-full tw-max-w-xl">
                    <div v-if="agendamentos == 0" class="tw-h-full tw-flex tw-items-center tw-justify-center">
                        <span class="tw-cursor-pointer tw-text-white tw-text-lg tw-text-center"
                            @click="modalAgendamentos = true">
                            Você ainda não tem eventos agendados. Clique aqui para criar um evento.
                        </span>
                    </div>
                    <div v-else>
                        <q-scroll-area style="height: 300px">
                            <div class="tw-w-11/12 tw-mx-auto">
                                <div v-for="item in agendamentos" :key="item.id" class="tw-mb-2 tw-mt-2">
                                    <q-card class="flex inline-flex">
                                        <div class="tw-w-full tw-text-left tw-text-xl tw-pl-2 pb-2">
                                            {{ item.nome }}
                                        </div>
                                        <div class="tw-w-full tw-flex tw-inline-flex tw-items-center tw-justify-left ">
                                            <div class="tw-w-6/12 tw-pl-2">
                                                <div v-if="item.descricao != null">
                                                    {{ item.descricao }}
                                                </div>
                                            </div>
                                            <div class="tw-w-5/12">{{ dataFormatada(item.data) }}</div>
                                            <div v-if="apagarAgendamento" class="tw-w-1/12>">
                                                <input type="checkbox" @click="adicionaItem(item.id)" />
                                            </div>
                                        </div>
                                    </q-card>
                                </div>
                            </div>
                        </q-scroll-area>
                        <div class="tw-w-full tw-justify-center tw-mt-2 tw-flex tw-inline-flex">
                            <div v-if="!apagarAgendamento" class="tw-mt-2 tw-flex tw-inline-flex">
                                <span class="material-icons md-36 hover:tw-cursor-pointer"
                                    @click="modalAgendamentos = true">
                                    add_circle_outline
                                </span>
                                <span class="material-icons md-36 hover:tw-cursor-pointer" @click="apagaragendamento">
                                    remove_circle_outline
                                </span>
                            </div>
                            <div v-else class="tw-mt-2 tw-flex tw-inline-flex">
                                <span class="material-icons md-36 hover:tw-cursor-pointer"
                                    @click="(apagarAgendamento = false), (lista = [])">clear</span>
                                <span class="material-icons md-36 hover:tw-cursor-pointer"
                                    @click="excluirAgendamento">delete_outline</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="tw-border-1 tw-border-dotted tw-mt-4 tw-px-8 tw-p-y-4 tw-flex tw-justify-center">

            <div class="topo-calendario tw-w-full tw-max-h-full tw-max-w-xl tw-overflow-y-auto tw-px-2 tw-mt-6">
                <Calendario :atributos="atributosCalendario"></Calendario>
            </div>
        </div>
        <!--adicionar agendamento-->
        <q-dialog v-model="modalAgendamentos" transition-show="scale" transition-hide="scale" rounded>
            <q-card style="width: 500px; max-width: 95vw">
                <q-card-section class="row items-center q-pb-none">
                    <div class="tw-w-10/12 sm:tw-w-11/12">
                        <img src="/images/eventos.png" class="tw-mx-auto hover:tw-cursor-pointer"
                            @click="modalInfoEntradas = true" />
                    </div>
                    <div class="tw-w-2/12 sm:tw-w-1/12">
                        <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
                    </div>
                </q-card-section>
                <q-card-section>
                    <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
                        <div class="q-gutter-y-md">
                            <q-input outlined v-model="form.nome" label="Título*" />
                            <q-input outlined v-model="form.descricao" label="Descrição" />
                            <div class="tw-w-full tw-flex tw-inline-flex tw-items-center tw-justify-center">
                                <q-btn color="primary" label="Data*" @click="modalData = true" no-caps />
                                <div v-if="form.dataAgendamento != '' && form.dataAgendamento != null" class="tw-ml-2">
                                    <span>Data selecionada: {{ dataFormatada(form.dataAgendamento)
                                    }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </q-card-section>
                <div class="tw-w-full tw-text-center tw-mb-2">
                    <button type="button" @click="lancarAgendamento">
                        <span class="material-icons md-36">task_alt</span>
                    </button>
                </div>
            </q-card>
        </q-dialog>
        <!--escolher uma data-->
        <q-dialog v-model="modalData" transition-show="scale" transition-hide="scale" rounded>
            <q-card style="width: 400px; max-width: 95vw">
                <q-card-section>
                    <div class="tw-w-full tw-mx-auto tw-text-center">
                        <q-date v-model="form.dataAgendamento" today-btn mask="YYYY-MM-DD"
                            :locale="{ monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Novembro', 'Dezembro'], daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'], days: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'] }" />
                    </div>
                </q-card-section>
                <div class="tw-w-full tw-text-center tw-mb-2">
                    <q-btn v-close-popup color="primary" label="OK" />
                </div>
            </q-card>
        </q-dialog>
        <DialogBaixo v-model="formNulo" :value="'Preencha todos os campos obrigatórios. (Marcados com *)'"
            :icon="'error'">
        </DialogBaixo>
    </BreezeAuthenticatedLayout>
</template>



<script>
import dayjs from "dayjs";
export default {
    props: {
        agendamentos: Object,
        atributosCalendario: Object,
    },

    methods: {
        dataFormatada(object) {
            const data = dayjs(object);
            return data.format("DD/MM/YYYY");
        },

        lancarAgendamento() {
            if (this.form.nome == "" || this.form.dataAgendamento == "") {
                this.formNulo = true;
            } else {
                this.form.post(route("agendamento.adicionar.agendamento"), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.modalAgendamentos = false;
                        this.form.reset();
                    },
                });
            }
        },

        apagaragendamento() {
            this.apagarAgendamento = true;
        },

        excluirAgendamento() {
            this.$inertia.visit(route("agendamento.excluir.agendamento"), {
                method: "post",
                data: { lista: this.lista },
            });
        },
        adicionaItem(id) {
            if (this.lista.includes(id)) {
                var pos = this.lista.indexOf(id);
                this.lista.splice(pos, 1);
            } else this.lista.push(id);
        },
    },

    data() {
        return {
            form: this.$inertia.form({
                nome: '',
                descricao: '',
                dataAgendamento: '',
            }),
            formNulo: null,
            lista: [],
            apagarAgendamento: false,
        }
    },
};
</script>

<style>
.calendario {
    background-color: black;
    border-radius: 20px;
    height: 360px;
}

.tempo {
    background-color: black;
    height: 360px;
    border-radius: 20px;
    padding-right: 5px;
    border: 2px solid black;
}

.topo-calendario {
    background-color: white;
    height: 360px;
    border-radius: 20px;
    padding-right: 5px;
    border: 2px solid black;
}
</style>