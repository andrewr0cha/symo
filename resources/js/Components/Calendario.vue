<script setup>
import { ref } from "vue";
import DialogBaixo from "@/Components/DialogBaixo.vue";
const modalAgendamentos = ref(false);
const modalData = ref(false);
defineExpose({ modalAgendamentos, modalData });
</script>
<script>
import dayjs from "dayjs";
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue3'
import brLocale from '@fullcalendar/core/locales/pt-br';
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';

export default {
    props: {
        atributos: Object,
    },
    components: {
        FullCalendar // make the <FullCalendar> tag available
    },
    data() {
        return {
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: 'dayGridMonth',
                locale: brLocale,
                dateClick: this.clickData,
                events: this.atributos,
                headerToolbar: {
                    left: "title",
                    right: "today prev next",
                },
                eventColor: '#b49fff',
            },
            form: this.$inertia.form({
                nome: '',
                descricao: '',
                dataAgendamento: '',
            }),
            formNulo: null,
        }
    },
    methods: {
        clickData(i) {
            this.form.dataAgendamento = i.dateStr;
            this.modalAgendamentos = true;
        },
        dataFormatada(object) {
            const data = dayjs(object);
            return data.format("DD/MM/YYYY");
        },
        lancarAgendamento() {
            if (this.form.nome == "" || this.form.dataAgendamento == "") {
                this.formNulo = true;
            } else {
                this.form.post(route("adicionar.agendamento"), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.modalAgendamentos = false;
                        this.form.reset();
                    },
                });
            }
        },
    }
}
</script>
<template>
    <div class="tw-w-full">
        <FullCalendar :options="calendarOptions" />
    </div>
    <q-dialog v-model="modalAgendamentos" transition-show="scale" transition-hide="scale" rounded>
        <q-card style="width: 500px; max-width: 95w">
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
                                <span>Data selecionada: {{ dataFormatada(form.dataAgendamento) }}</span>
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
                    <q-date v-model="form.dataAgendamento" today-btn flat mask="YYYY-MM-DD"
                        :locale="{ monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Novembro', 'Dezembro'], daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'], days: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'] }" />
                </div>
            </q-card-section>
            <div class="tw-w-full tw-text-center tw-mb-2">
                <q-btn v-close-popup color="primary" label="OK" />
            </div>
        </q-card>
    </q-dialog>
    <DialogBaixo v-model="formNulo" :value="'Preencha todos os campos obrigatórios. (Marcados com *)'" :icon="'error'">
    </DialogBaixo>
</template>

<style>
.fc .fc-button-primary {
    background-color: #d1b6ff;
    color: black;
}

.fc .fc-button-primary:hover {
    background-color: #ffdf00;
    color: black;
}

.fc .fc-button-primary:disabled {
    background-color: #9787ff;
    color: black;
}

.fc-button-active {
    background-color: #b49fff;
}

.fc .fc-button-primary:not(:disabled):active,
.fc .fc-button-primary:not(:disabled).fc-button-active {
    background-color: #9787ff;
}
</style>