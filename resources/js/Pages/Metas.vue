<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DialogBaixo from "@/Components/DialogBaixo.vue";
import Texto from "@/Components/Text.vue";
const modalMeta = ref(false);
const modalInfoMetas = ref(false);
const modalProgressao = ref(false);
defineExpose({ modalMeta, modalInfoMetas, modalProgressao });
</script>

<template>

    <Head title="Metas" />
    <BreezeAuthenticatedLayout>
        <div class="tw-flex tw-items-center tw-justify-center tw-mt-4">
            <div class="tw-flex-col tw-text-center tw-mt-4 tw-px-8">
                <Texto
                    class="metas tw-max-w-xs tw-w-11/12 tw-h-32 tw-min-h-full tw-p-2 tw-mb-4 tw-mx-auto tw-cursor-pointer"
                    @click="modalmeta('Curto')">
                    <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a curto prazo</span>
                </Texto>
                <Texto
                    class="metas tw-max-w-xs tw-w-11/12 tw-h-32 tw-min-h-full tw-p-2 tw-mb-4 tw-mx-auto tw-cursor-pointer"
                    @click="modalmeta('Médio')">
                    <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a médio prazo</span>
                </Texto>
                <Texto class="metas tw-max-w-xs tw-w-11/12 tw-h-32 tw-min-h-full tw-p-2 tw-mx-auto tw-cursor-pointer"
                    @click="modalmeta('Longo')">
                    <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a longo prazo</span>
                </Texto>
            </div>
        </div>
        <!--modal meta-->
        <q-dialog v-model="modalMeta">
            <q-carousel v-model="slide" transition-prev="scale" transition-next="scale" swipeable animated
                control-color="primary" arrows height="500px">
                <q-carousel-slide :name="1" style="width:500px; max-width:85vw">
                    <div>
                        <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
                            <div class="tw-w-2/12 sm:tw-w-1/12">
                                <q-btn icon="help_outline" flat round dense @click="modalInfoMetas = true" />
                            </div>
                            <div class="tw-w-8/12 sm:tw-w-10/12">
                                <img src="/images/metas.png" class="tw-mx-auto" />
                            </div>
                            <div class="tw-w-2/12 sm:tw-w-1/12">
                                <q-btn icon="close" flat round dense v-close-popup
                                    @click="(formMeta.reset()), (slide = 1)" />
                            </div>
                        </div>
                        <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
                            <div class="q-gutter-y-md">
                                <q-input outlined v-model="formMeta.nome" label="Título*" />
                                <q-input outlined v-model="formMeta.descricao" label="Descrição" />
                                <q-input v-model="formMeta.valor" mask="###.###,##" reverse-fill-mask
                                    hint="Preencha duas casas decimais" outlined label="Valor*" min="0.01"
                                    step="0.01" />
                                <q-select outlined v-model="formMeta.duracao" label='Prazo' disable />
                            </div>
                        </div>
                        <div class="tw-w-full tw-text-center tw-my-4">
                            <button type="button" @click="lancarMeta">
                                <span class="material-icons md-36">task_alt</span>
                            </button>
                        </div>
                    </div>
                </q-carousel-slide>
                <q-carousel-slide :name="2" style="width:500px;max-width:85vw">
                    <div class="tw-h-full">
                        <div class="tw-w-full tw-flex tw-justify-between tw-mt-4">
                            <q-btn icon="arrow_back" flat round dense v-close-popup @click="slide = 1" />
                            <q-btn icon="close" flat round dense v-close-popup />
                        </div>
                        <div class="tw-h-5/6 tw-w-full">
                            <div v-if="metaList == 0"
                                class="tw-w-full tw-h-full tw-text-center tw-flex tw-items-center">
                                <span class="tw-text-lg ">Parece que você ainda não tem metas com essa duração. Use o
                                    formulário ao
                                    lado para criar uma.🤩
                                </span>
                            </div>
                            <div v-else class="tw-w-full tw-mt-2">
                                <q-scroll-area style="height:300px">
                                    <div class="tw-flex tw-flex-wrap tw-justify-center tw-w-full">
                                        <div v-for="item in metaList" :key="item.id"
                                            class="meta tw-w-5/12 tw-ml-2 tw-my-1">
                                            <q-card class="tw-w-full hover:tw-cursor-pointer ">
                                                <div class="tw-w-full tw-text-left tw-text-xl tw-pl-2 pb-2"
                                                    @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                                                    {{ item.nome }}
                                                </div>
                                                <div class="tw-w-full tw-pl-2"
                                                    @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                                                    R$ {{ valorFormatado(item.valor) }}</div>
                                                <div class="tw-w-full tw-pl-2"
                                                    @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                                                    Status: {{ item.status }}</div>

                                                <div class="tw-w-full tw-pl-2"
                                                    @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                                                    {{ item.descricao }}
                                                </div>
                                                <div class="tw-w-full tw-pl-2"
                                                    @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                                                    Início: {{ dataFormatada(item.data) }}
                                                </div>
                                                <div class="tw-w-full tw-pl-2"
                                                    @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                                                    Final: {{ dataFinalFormatada(item.data, item.duracao) }}
                                                </div>
                                                <div v-if="apagarMeta || marcarConcluida"
                                                    class="tw-w-full tw-flex tw-justify-center tw-mt-1 tw-pb-1">
                                                    <input type="checkbox" @click="adicionaItem(item.id)" />
                                                </div>
                                            </q-card>
                                        </div>
                                    </div>
                                </q-scroll-area>
                                <div class="tw-w-full tw-justify-center tw-mt-4 tw-flex tw-inline-flex">
                                    <div v-if="apagarMeta == false && marcarConcluida == false"
                                        class="tw-my-2 tw-flex tw-inline-flex tw-justify-around tw-w-full">
                                        <q-btn class="tw-mr-1" color="primary" label="Marcar como Concluída"
                                            @click="marcarconcluida" no-caps />
                                        <q-btn color="primary" label="Remover" @click="apagarmeta" no-caps />
                                    </div>
                                    <div v-else-if="apagarMeta == true" class="tw-my-2 tw-flex tw-inline-flex">
                                        <span class="material-icons md-36 hover:tw-cursor-pointer"
                                            @click="(apagarMeta = false), (lista = [])">clear</span>
                                        <span class="material-icons md-36 hover:tw-cursor-pointer"
                                            @click="excluirMeta">delete_outline</span>
                                    </div>
                                    <div v-else-if="marcarConcluida == true" class="tw-mt-2 tw-flex tw-inline-flex">
                                        <span class="material-icons md-36 hover:tw-cursor-pointer"
                                            @click="(marcarConcluida = false), (lista = [])">clear</span>
                                        <span class="material-icons md-36 hover:tw-cursor-pointer"
                                            @click="mudarStatus">check</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </q-carousel-slide>
            </q-carousel>
        </q-dialog>
        <!--modal explicações metas-->
        <q-dialog v-model="modalInfoMetas" position="left" rounded>
            <q-card style="width: 300px; max-width: 60vh">
                <q-card-section class="row items-center q-pb-none">
                    <q-btn icon="info" flat round dense />
                    <q-space />
                    <q-btn icon="close" flat round dense v-close-popup />
                </q-card-section>
                <q-card-section>
                    <span>Aqui são inseridas as suas metas. Tudo aquilo que você pretende alcançar (e a gente pretende
                        te
                        ajudar🤩).</span>
                    <div class="tw-flex tw-inline-flex tw-mt-2">
                        <span><span class="tw-text-green-600 tw-text-lg">Curto Prazo: </span>São aquelas metas urgentes,
                            com prazo
                            máximo de um ano. Vamos considerar um ano como
                            prazo padrão.</span>
                    </div>
                    <div class="tw-flex tw-inline-flex tw-mt-2">
                        <span><span class="tw-text-green-600 tw-text-lg">Médio Prazo: </span>São metas que têm sua
                            prioridade, mas
                            não são urgentes com as de curto prazo. Seus prazos
                            variam de um ano a cinco. Como padrão para o prazo, consideraremos três anos.</span>
                    </div>
                    <div class="tw-flex tw-inline-flex tw-mt-2">
                        <span><span class="tw-text-green-600 tw-text-lg">Longo Prazo: </span>Representam aquelas metas
                            que não
                            estão ao seu alcance no momento, mas fazem parte de um
                            projeto futuro. Juntos, as alcançaremos! Os prazos destas têm mais de cinco anos. Para o
                            padrão,
                            usaremos sete anos.</span>
                    </div>
                    <div class="tw-flex tw-inline-flex tw-mt-2">
                        <span>Para calcular como estamos indo, usaremos a quantia disponível no cofre. Não se esqueça de
                            guardar
                            um pouco mensalmente😇</span>
                    </div>
                </q-card-section>
            </q-card>
        </q-dialog>
        <!--modal progresso de metas-->
        <q-dialog v-model="modalProgressao" position="right" rounded>
            <q-card style="width: 300px; max-width: 60vh">
                <q-card-section class="row items-center q-pb-none">
                    <q-btn icon="trending_up" flat round dense />
                    <q-space />
                    <q-btn icon="close" flat round dense v-close-popup />
                </q-card-section>
                <q-card-section>
                    <div class="tw-flex tw-inline-flex tw-my-2 tw-w-full tw-text-center">
                        <div v-if="progressaoMeta.status == 'Concluída'">
                            <span class="tw-text-lg">UHUL!! Essa meta está concluída!! Parabéns!🎉</span>
                        </div>
                        <div v-else-if="progresso > 1 && progressaoMeta.status == 'Em andamento'">
                            <span class="tw-text-lg">Essa meta ainda está em andamento, mas você já poupou o valor
                                ligado à ela!!
                                Bom trabalho!🥰</span>
                        </div>
                        <div
                            v-else-if="progresso > 0.800 && progresso <= 1.000 && progressaoMeta.status == 'Em andamento'">
                            <span class="tw-text-lg">Essa meta está quase concluída!! Só mais um pouco!🤑</span>
                        </div>
                        <div
                            v-else-if="progresso > 0.500 && progresso <= 0.800 && progressaoMeta.status == 'Em andamento'">
                            <span class="tw-text-lg">Já passamos da metade!! Continue assim!🤗</span>
                        </div>
                        <div
                            v-else-if="progresso > 0.400 && progresso <= 0.500 && progressaoMeta.status == 'Em andamento'">
                            <span class="tw-text-lg">Essa meta está quase na metade. Você está indo bem!🤭</span>
                        </div>
                        <div v-else-if="progresso <= 0.400 && progressaoMeta.status == 'Em andamento'">
                            <span class="tw-text-lg">Essa meta está começando. Força!💪</span>
                        </div>
                    </div>
                    <q-linear-progress :value="progresso" color="primary" />
                </q-card-section>
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
        curtoPrazo: Object,
        medioPrazo: Object,
        longoPrazo: Object,
    },

    methods: {
        dataFormatada(object) {
            const data = dayjs(object);
            return data.format("DD/MM/YYYY");
        },

        dataFinalFormatada(dataMeta, duracao) {
            var dataFinal = dayjs(dataMeta);
            if (duracao === "Curto") dataFinal = dataFinal.add(1, 'year');
            else if (duracao === "Médio") dataFinal = dataFinal.add(3, 'year');
            else if (duracao === "Longo") dataFinal = dataFinal.add(7, 'year');
            return dataFinal.format("DD/MM/YYYY");
        },

        valorFormatado(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },

        modalmeta(i) {
            if (i === "Curto") this.metaList = this.curtoPrazo;
            if (i === "Médio") this.metaList = this.medioPrazo;
            if (i === "Longo") this.metaList = this.longoPrazo;
            this.formMeta.duracao = i;
            this.modalMeta = true;
        },

        lancarMeta() {
            if (this.formMeta.nome == "" || this.formMeta.valor == "") {
                this.formNulo = true;
            } else {
                this.formMeta.valor = this.formMeta.valor.replace(".", "").replace(",", ".");
                this.formMeta.post(route("meta.adicionar.meta"), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.modalMeta = false;
                        this.formMeta.reset();
                    },
                });
            }
        },

        apagarmeta() {
            this.apagarMeta = true;
        },

        marcarconcluida() {
            this.marcarConcluida = true;
        },

        excluirMeta() {
            this.$inertia.visit(route("meta.excluir.meta"), {
                method: "post",
                data: { lista: this.lista },
            });
        },

        mudarStatus() {
            this.$inertia.visit(route("meta.concluir.meta"), {
                method: "post",
                data: { lista: this.lista },
            });
        },

        mudarProgressao(i, k) {
            this.progressaoMeta = this.metaList.find((meta) => meta.id == i);
            this.progresso = k / this.progressaoMeta.valor;
            this.modalProgressao = true;
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
            slide: ref(1),
            metaList: null,
            progressaoMeta: null,
            progresso: null,
            formMeta: this.$inertia.form({
                nome: '',
                descricao: '',
                valor: '',
                duracao: '',
                status: ''
            }),
            formNulo: null,
            lista: [],
            apagarMeta: false,
            marcarConcluida: false,
        }
    },
};
</script>

<style>
.metas {
    background-color: white;
    border: 2px solid black;
    border-radius: 20px;
    text-align: center;
}
</style>