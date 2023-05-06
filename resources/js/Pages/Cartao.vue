<template>
    <Head title="Cartões" />
    <BreezeAuthenticatedLayout>
        <div class="tw-w-11/12 tw-mx-auto">
            <div class="tw-w-full sm:tw-w-10/12 tw-mx-auto">
                <div v-if="cartoes == 0" class="tw-w-full tw-flex tw-text-center tw-mb-2">
                    <span class="tw-text-lg tw-flex tw-text-center tw-mx-auto">Você ainda não tem cartões cadastrados. Use o
                        botão
                        abaixo para criar um.</span>
                </div>
                <div v-else class="tw-mb-2 tw-w-full">
                    <q-scroll-area style="height: 335px">
                        <span class="tw-text-lg">Seus cartões</span>
                        <div class="tw-flex tw-flex-wrap">
                            <div v-for="item in cartoes" :key="item.id" class="tw-mb-2 tw-w-1/2 tw-cursor-pointer">
                                <q-card class="tw-flex tw-flex-col tw-mx-1">
                                    <div class="tw-w-full tw-pl-2" @click="recargaCartao(item), modalRecarga = true">{{
                                        item.nome }}
                                    </div>
                                    <div class="tw-w-full tw-pl-2" @click="recargaCartao(item), modalRecarga = true"> {{
                                        valorFormatado(item.valor) }}</div>
                                    <div class="tw-w-full tw-flex tw-inline-flex">
                                        <div class="tw-w-5/6 tw-pl-2" @click="recargaCartao(item), modalRecarga = true"
                                            v-if="item.ultima_recarga != null"> Recarga em: {{
                                                dataFormatada(item.ultima_recarga) }}</div>
                                        <div class="tw-w-1/6 tw-pl-2" v-if="excluindo">
                                            <input type="checkbox" @click="adicionaItem(item.id)" />
                                        </div>
                                    </div>
                                </q-card>
                            </div>
                        </div>
                    </q-scroll-area>

                </div>
                <div class="tw-text-center">
                    <q-btn color="primary" label="Novo" v-if="excluindo == false" @click="modalNovoCartao = true" no-caps
                        class="tw-mr-2" />
                    <q-btn color="primary" label="Excluir" v-if="excluindo == false" @click="excluindo = !excluindo"
                        no-caps />
                    <q-btn color="primary" label="Confirmar" v-if="excluindo == true" @click="excluirCartao()" no-caps
                        class="tw-mr-2" />
                    <q-btn color="primary" label="Cancelar" v-if="excluindo == true" @click="excluindo = !excluindo"
                        no-caps />
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
    <!--modal cartao
    <q-dialog v-model="modalCartoes" transition-show="scale" transition-hide="scale" rounded>
        <q-card style="width: 500px; max-width: 80vw">
            <q-card-section>
                <div class="tw-w-full sm:tw-w-10/12 tw-mx-auto">
                    <div v-if="cartoes == null" class="tw-w-full tw-mb-2">
                        <span class="tw-text-lg tw-flex tw-text-center">Você ainda não tem cartões cadastrados. Use o botão
                            abaixo para criar um.</span>
                    </div>
                    <div v-else class="tw-mb-2 tw-w-full">
                        <q-scroll-area style="height: 335px">
                            <span class="tw-text-lg">Seus cartões</span>
                            <div class="tw-flex tw-flex-wrap">
                                <div v-for="item in cartoes" :key="item.id" class="tw-mb-2 tw-w-1/2 tw-cursor-pointer"
                                    @click="recargaCartao(item)">
                                    <q-card class="tw-flex tw-flex-col tw-mx-1">
                                        <div class="tw-w-full tw-pl-2">{{ item.nome }}</div>
                                        <div class="tw-w-full tw-pl-2"> {{ valorFormatado(item.valor) }}</div>
                                        <div class="tw-w-full tw-pl-2" v-if="item.ultima_recarga != null"> Recarga em:{{
                                            dataFormatada(item.ultima_recarga) }}</div>
                                    </q-card>
                                </div>
                            </div>
                        </q-scroll-area>

                    </div>
                    <div class="tw-text-center">
                        <q-btn color="primary" label="Novo" @click="modalNovoCartao = true" no-caps />
                    </div>
                </div>
            </q-card-section>
        </q-card>
    </q-dialog>-->
    <!--modal novo cartao-->
    <q-dialog v-model="modalNovoCartao" transition-show="scale" transition-hide="scale" rounded>
        <q-card style="width: 500px; max-width: 80vw">
            <q-card-section class="row items-center q-pb-none">
                <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
                    <div class="tw-w-2/12 sm:tw-w-1/12">
                        <q-btn icon="help_outline" flat round dense @click="modalInfoEntradas = true" />
                    </div>
                    <div class="tw-w-8/12 sm:tw-w-10/12">
                        <img src="/images/entrada.png" class="tw-mx-auto" />
                    </div>
                    <div class="tw-w-2/12 sm:tw-w-1/12">
                        <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
                    </div>
                </div>
            </q-card-section>
            <q-card-section>
                <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
                    <div class="q-gutter-y-md">
                        <q-input outlined v-model="formCartao.nome" label="Título*" />
                        <q-input v-model="formCartao.valorRecarga" mask="###.###,##" reverse-fill-mask
                            hint="Preencha duas casas decimais" outlined label="Valor*" min="0.01" step="0.01" />
                    </div>
                </div>
            </q-card-section>
            <div class="tw-w-full tw-text-center tw-mb-2">
                <button type="button" @click="novoCartao($page.props.auth.user.saldo)">
                    <span class="material-icons md-36">task_alt</span>
                </button>
            </div>
        </q-card>
    </q-dialog>
    <!--modal recarga cartao-->
    <q-dialog v-model="modalRecarga" transition-show="scale" transition-hide="scale" rounded>
        <q-carousel v-model="slide" transition-prev="scale" transition-next="scale" swipeable animated
            control-color="primary" navigation height="340px">
            <q-carousel-slide :name="1" style="width:300px; max-width:85vw">
                <div style="width: 200px; max-width: 80vw" class="tw-mx-auto tw-h-5/6 tw-flex tw-items-center">
                    <div>
                        <div class="tw-w-full tw-mt-2">
                            <div class="q-gutter-y-md">
                                <span class="tw-text-lg ">{{ formCartao.nome }}</span>
                                <q-input v-model="formCartao.valorRecarga" mask="###.###,##" reverse-fill-mask
                                    hint="Preencha duas casas decimais" outlined label="Recarga*" min="0.01" step="0.01" />
                            </div>
                        </div>

                        <div class="tw-w-full tw-text-center tw-mt-2">
                            <button type="button" @click="recarga($page.props.auth.user.saldo)">
                                <span class="material-icons md-36">task_alt</span>
                            </button>
                        </div>
                    </div>
                </div>
            </q-carousel-slide>
            <q-carousel-slide :name="2" style="width:300px; max-width:85vw">
                <div style="width: 200px; max-width: 80vw" class="tw-mx-auto tw-flex tw-items-center">
                    <div>
                        <div class="tw-w-full tw-mt-2">
                            <div class="q-gutter-y-md">
                                <span class="tw-text-lg ">{{ formCartao.nome }}</span>
                                <q-input v-model="formCartao.numeroPassagens" hint="Número de passagens para retirada"
                                    outlined label="Passagens*" min="1" step="1" />
                                <q-input v-model="formCartao.valorRetirada" mask="###.###,##" reverse-fill-mask
                                    hint="Preencha duas casas decimais" outlined label="Valor*" min="0.01" step="0.01" />
                            </div>
                        </div>

                        <div class="tw-w-full tw-text-center tw-mt-2">
                            <button type="button" @click="retirada()">
                                <span class="material-icons md-36">task_alt</span>
                            </button>
                        </div>
                    </div>
                </div>
            </q-carousel-slide>
            <q-carousel-slide :name="3" style="width:300px; max-width:85vw">
                <div style=" max-width: 95vw" class="tw-mx-auto tw-flex tw-items-center">
                    <div class="tw-w-full tw-mt-2">
                        <q-scroll-area style="height: 270px">
                            <div v-if="viagem != null">
                                <q-card v-for="viagem in viagem" :key="viagem.id" class="tw-w-full  tw-mb-2">
                                    <div class="tw-pl-2 tw-text-lg tw-full">{{ formCartao.nome }}</div>
                                    <div class="tw-flex tw-inline-flex tw-w-full">
                                        <div class="tw-w-2/3 tw-pl-2">Data: {{ dataFormatada(viagem.data) }}</div>
                                        <div class="tw-w-1/3">Valor: {{ valorFormatado(viagem.valor) }}</div>
                                    </div>
                                </q-card>
                            </div>
                            <div v-else style="height:270px;" class="tw-flex tw-items-center">
                                <span class="tw-text-center tw-flex tw-text-lg">Parece que este cartão ainda não tem
                                    viagens.</span>
                            </div>
                        </q-scroll-area>
                    </div>
                </div>

            </q-carousel-slide>
        </q-carousel>
    </q-dialog>
    <!--form nulo-->
    <DialogBaixo v-model="formNulo" :value="'Preencha todos os campos obrigatórios. (Marcados com *)'" :icon="'error'">
    </DialogBaixo>
    <!--saldo insuficiente-->
    <DialogBaixo v-model="saldoInsuficiente" :value="'O seu saldo não é suficiente para essa ação.'" :icon="'error'">
    </DialogBaixo>
    <!--valor muito alto-->
    <DialogBaixo v-model="formInvalido" :value="'Insira um valor válido no campo Valor do formulário.'" :icon="'error'"
        class="tw-hidden sm:tw-flex">
    </DialogBaixo>
</template>
  
<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DialogBaixo from "@/Components/DialogBaixo.vue";
import { ref } from "vue";
const modalNovoCartao = ref(false);
const modalRecarga = ref(false);
defineExpose({ modalRecarga, modalNovoCartao });
</script>
  
<script>
import dayjs from "dayjs";
export default {
    props: {
        cartoes: Object
    },
    methods: {
        dataFormatada(object) {
            const data = dayjs(object);
            return data.format("DD/MM/YYYY HH:mm");
        },

        valorFormatado(value) {
            let val = (value / 1).toFixed(2).replace(".", ",");
            return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        },

        novoCartao(value) {
            var valor = this.formCartao.valorRecarga.replace(".", "").replace(",", ".");
            if (this.formCartao.nome == "" || this.formCartao.valorRecarga == "") {
                this.formNulo = true;
            } else if (Number(valor) > 99999999 || Number(valor) < 0) {
                this.formInvalido = true;
            } else if (Number(valor) > value) {
                this.saldoInsuficiente = true;
                this.formCartao.reset();
            }
            else {
                this.formCartao.valorRecarga = valor;
                this.formCartao.post(route("adicionar.cartao", { id: this.id }), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.modalNovoCartao = false;
                        this.modalCartoes = false;
                        this.formCartao.reset();
                    },
                });
            }
        },

        recargaCartao(item) {
            this.formCartao.nome = item.nome;
            this.formCartao.valor = item.valor;
            this.formCartao.id = item.id;
            this.viagem = item.viagem.length > 0 ? item.viagem : null;
            //this.modalRecarga = true;
        },

        recarga(value) {
            var valor = this.formCartao.valorRecarga.replace(".", "").replace(",", ".");
            if (this.formCartao.valorRecarga == "") {
                this.formNulo = true;
            } else if (Number(valor) > 99999999 || Number(valor) == 0) {
                this.formInvalido = true;
            } else if (Number(valor) > value) {
                this.saldoInsuficiente = true;
                this.formCartao.reset();
            }
            else {
                this.formCartao.valorRecarga = Number(valor);
                this.formCartao.post(route("recarregar.cartao", { id: this.id }), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.modalRecarga = false;
                        this.modalCartoes = false;
                        this.formCartao.reset();
                    },
                });
            }
        },

        retirada() {
            var valorRetirada = this.formCartao.valorRetirada.replace(".", "").replace(",", ".");
            var valor = this.formCartao.valor;
            if (this.formCartao.valorRetirada == "") {
                this.formNulo = true;
            } else if (Number(valorRetirada) > 99999999 || Number(valorRetirada) == 0 || this.formCartao.numeroPassagens <= 0) {
                this.formInvalido = true;
            } else if (Number(valorRetirada) * this.formCartao.numeroPassagens > Number(valor)) {
                this.saldoInsuficiente = true;
                this.formCartao.reset();
            }
            else {
                this.formCartao.valorRetirada = valorRetirada;
                this.formCartao.post(route("retirar.cartao", { id: this.id }), {
                    preserveState: true,
                    preserveScroll: true,
                    onSuccess: () => {
                        this.modalRecarga = ref(false);
                        this.modalCartoes = ref(false);
                        this.formCartao.reset();
                    },
                });
            }
        },

        adicionaItem(id) {
            if (this.listaExclusao.includes(id)) {
                var pos = this.listaExclusao.indexOf(id);
                this.listaExclusao.splice(pos, 1);
            } else this.listaExclusao.push(id);
        },

        excluirCartao() {
            this.$inertia.visit(route("excluir.cartao"), {
                method: "post",
                data: { listaExclusao: this.listaExclusao },
            });
        },
    },
    data() {
        return {
            slide: ref(1),
            saldoInsuficiente: false,
            formNulo: false,
            formInvalido: null,
            excluindo: false,
            listaExclusao: [],
            viagem: [],
            formCartao: this.$inertia.form({
                id: null,
                nome: null,
                valor: '',
                valorRecarga: '',
                numeroPassagens: null,
                valorRetirada: ''
            }),
        };
    },
};
</script>
  
<style>
.scrollbar::-webkit-scrollbar {
    height: 8px;
    width: 8px;
}

.scrollbar::-webkit-scrollbar-track {
    border-radius: 100vh;
    background: none;
    width: 50%;
}

.scrollbar::-webkit-scrollbar-thumb {
    background: #d1b6ff;
    border-radius: 100vh;
}

.scrollbar::-webkit-scrollbar-thumb:hover {
    background: #b49fff;
}
</style>