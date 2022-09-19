<template>

  <Head title="Consultas" />
  <BreezeAuthenticatedLayout>
    <!--saldo e categorias-->
    <div class="tw-w-11/12 tw-mx-auto tw-flex tw-mt-4 border tw-bg-black">
      <!--saldo-->
      <div class="
          tw-w-1/3
          tw-bg-black
          tw-h-28 
          tw-flex tw-inline-flex tw-items-center
          tw-justify-center
          borda-invisivel tw-overflow-x-auto scrollbar
        ">
        <div class="tw-w-28 tw-flex tw-flex-col">
          <div class="
                round
                tw-w-20 tw-h-20 tw-ml-4
                sm:tw-w-24 sm:tw-h-24
                tw-flex tw-items-center tw-justify-center tw-text-center sm:tw-border-2 sm:tw-border-white
              hover:tw-cursor-pointer" @click="modalCofre = true">

            <div><img src="/images/bolsa-de-dinheiro.png" class="tw-mx-auto" />
              Cofre</div>
          </div>
        </div>
        <div class="
          tw-flex
          tw-flex-col
          tw-mx-2 tw-w-28">
          <img src="/images/dinheiro.png" class="imagem tw-mx-auto" />
          <div class="tw-flex tw-inline-flex tw-items-center tw-mx-auto">
            <span class="tw-text-white tw-hidden sm:tw-flex">Carteira</span>
          </div>
          <div class="tw-mx-auto">
            <span class="tw-text-white tw-text-center">R${{ valorFormatado($page.props.auth.user.saldo) }}</span>
          </div>
        </div>
      </div>
      <!--porcentagens por categoria-->
      <div class="tw-h-28 tw-w-2/3 tw-bg-white borda-invisivel">
        <div class="tw-w-full tw-h-28 tw-flex tw-inline-flex">
          <!--custos-->
          <div class="
              tw-w-28
              sm:tw-w-32
              tw-ml-2 tw-flex tw-items-center tw-justify-center
              hover:tw-cursor-pointer
            "
            @click="atualizarDataSetor(porcentagens[0], porcentagens[1], porcentagens[2], porcentagens[3], porcentagens[4],)">
            <div class="
                round
                tw-w-20 tw-h-20
                sm:tw-w-24 sm:tw-h-24
                tw-flex tw-items-center tw-justify-center tw-text-center
              ">
              Meus Custos
            </div>
          </div>
          <!--categorias-->
          <div class="tw-flex tw-inline-flex tw-overflow-x-auto scrollbar">
            <div class="
                tw-w-60
                tw-mr-2
                tw-ml-2
                tw-flex
                tw-flex-col
                tw-items-center
                tw-justify-center
                hover:tw-cursor-pointer tw-text-center
              " @click="atualizarDataBarra(porcentagens[0], porcentagensGerais[0], 'Essencial')">
              <img src="/images/essencial.png" class="imagem" />
              Essencial<br>
              {{ porcentagens[5] == false ? "0,00%" : porcentagem(porcentagens[0]) }}
            </div>
            <div class="
                tw-w-60
                tw-mr-2
                tw-flex
                tw-flex-col
                tw-items-center
                tw-justify-center
                hover:tw-cursor-pointer tw-text-center
              " @click="modalObjetivos = true">
              <img src="/images/objetivos.png" class="imagem" />
              Objetivos<br>
              {{ metasConcluidas }}/{{ metas }}
            </div>
            <div class="
                tw-w-60
                tw-mr-2
                tw-flex
                tw-flex-col
                tw-items-center
                tw-justify-center
                hover:tw-cursor-pointer tw-text-center
              " @click="atualizarDataBarra(porcentagens[1], porcentagensGerais[1], 'Aposentadoria')">
              <img src="/images/aposentadoria.png" class="imagem" />
              Aposentadoria<br>
              {{ porcentagens[5] == false ? "0,00%" : porcentagem(porcentagens[1]) }}
            </div>
            <div class="
                tw-w-60
                tw-mr-2
                tw-flex
                tw-flex-col
                tw-items-center
                tw-justify-center
                hover:tw-cursor-pointer tw-text-center
              " @click="atualizarDataBarra(porcentagens[2], porcentagensGerais[2], 'Educação')">
              <img src="/images/educacao.png" class="imagem" />
              Educação<br>
              {{ porcentagens[5] == false ? "0,00%" : porcentagem(porcentagens[2]) }}
            </div>
            <div class="
                tw-w-60 tw-flex tw-flex-col tw-items-center tw-justify-center
                hover:tw-cursor-pointer tw-text-center tw-mr-2
              " @click="atualizarDataBarra(porcentagens[3], porcentagensGerais[3], 'Lazer')">
              <img src="/images/lazer1.png" class="imagem" />
              Lazer<br>
              {{ porcentagens[5] == false ? "0,00%" : porcentagem(porcentagens[3]) }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--entradas e saídas-->
    <div class="tw-w-11/12 tw-mx-auto sm:tw-flex tw-mt-4 tw-text-center">
      <!--Entradas-->
      <div class="tw-w-11/12 tw-mx-auto sm:tw-w-1/2 sm:tw-pr-4">
        <div class="borda tw-bg-black tw-w-full tw-text-white tw-flex tw-justify-between">
          <Link :href="route('consultas', { id: $page.props.auth.user.id })"><span
            class="material-icons md-24 tw-ml-2 hover:tw-cursor-pointer">filter_list_off</span></Link>
          <span class="tw-text-lg">Entradas</span>
          <span class="material-icons md-24 tw-mr-2 hover:tw-cursor-pointer"
            @click="modalFiltroEntrada = true">filter_list</span>
        </div>
        <q-scroll-area style="height: 335px">
          <div v-if="entradas != 0" class="tw-w-full">
            <div v-for="item in entradas" :key="item.id" class="tw-mb-2 entrada">
              <q-card class="flex inline-flex">

                <div class="tw-w-11/12 tw-text-left tw-text-xl tw-pl-2 pb-2">
                  {{ item.nome }}
                </div>
                <div class="
                    tw-w-full
                    tw-flex
                    tw-inline-flex
                    tw-items-center
                    tw-justify-left
                  ">
                  <div class="tw-w-7/12">
                    {{ item.descricao }}
                  </div>
                  <div class="tw-w-4/12">
                    <div class="tw-text-green-600">
                      +R$ {{ valorFormatado(item.valor) }}
                    </div>
                    {{ dataFormatada(item.data) }}
                  </div>
                  <div v-if="apagarEntrada&&item.cofre==false" class="tw-w-1/12>">
                    <input type="checkbox" @click="adicionaItem(item.id)" />
                  </div>
                </div>
              </q-card>
            </div>
          </div>
          <div v-else class="tw-flex tw-h-96">
            <span class="
                tw-h-full tw-w-full tw-flex tw-items-center tw-justify-center
              ">Ainda não existem entradas em sua conta.</span>
          </div>
        </q-scroll-area>
        <div class="tw-text-left tw-mt-2 tw-flex tw-inline-flex">
          <div v-if="!apagarEntrada" class="tw-text-left tw-mt-2 tw-flex tw-inline-flex">
            <span class="material-icons md-36 hover:tw-cursor-pointer" @click="modalEntradas = true">
              add_circle_outline
            </span>
            <span class="material-icons md-36 hover:tw-cursor-pointer" @click="apagarentrada">
              remove_circle_outline
            </span>
          </div>
          <div v-else>
            <span class="material-icons md-36 hover:tw-cursor-pointer"
              @click="(apagarEntrada = false), (listaExclusao = [])">clear</span>
            <span class="material-icons md-36 hover:tw-cursor-pointer" @click="excluirEntrada">delete_outline</span>
          </div>
        </div>
      </div>
      <!--Saidas-->
      <div class="tw-w-11/12 tw-mx-auto sm:tw-w-1/2 sm:tw-pl-4">
        <div class="borda tw-bg-black tw-w-full tw-text-white tw-flex tw-justify-between">
          <Link :href="route('consultas', { id: $page.props.auth.user.id })"><span
            class="material-icons md-24 tw-ml-2 hover:tw-cursor-pointer">filter_list_off</span></Link>
          <span class="tw-text-lg">Saídas</span>
          <span class="material-icons md-24 tw-mr-2 hover:tw-cursor-pointer"
            @click="modalFiltroSaida = true">filter_list</span>
        </div>
        <q-scroll-area style="height: 335px">
          <div v-if="saidas != 0" class="tw-w-full">
            <div v-for="item in saidas" :key="item.id" class="tw-mb-2 entrada">
              <q-card class="flex inline-flex">
                <div class="tw-w-11/12 tw-text-left tw-text-xl tw-pl-2 pb-2">
                  {{ item.nome }}
                </div>
                <div class="
                    tw-w-full
                    tw-flex
                    tw-inline-flex
                    tw-items-center
                    tw-justify-left
                  ">
                  <div class="tw-w-2/12">
                    {{ categoriasSaida[item.id_categoria - 1] }}
                  </div>
                  <div class="tw-w-5/12">
                    {{ item.descricao }}
                  </div>
                  <div class="tw-w-4/12">
                    <div class="tw-text-red-500">
                      -R$ {{ valorFormatado(item.valor) }}
                    </div>
                    {{ dataFormatada(item.data) }}
                  </div>
                  <div v-if="apagarSaida&&item.cofre==false" class="tw-w-1/12>">
                    <input type="checkbox" class="hover:tw-cursor-pointer" @click="adicionaItem(item.id)" />
                  </div>
                </div>
              </q-card>
            </div>
          </div>
          <div v-else class="tw-flex tw-h-96">
            <span class="
                tw-h-full tw-w-full tw-flex tw-items-center tw-justify-center
              ">Ainda não existem saídas em sua conta.</span>
          </div>
        </q-scroll-area>
        <div v-if="!apagarSaida" class="tw-text-left tw-mt-2 tw-flex tw-inline-flex">
          <span class="material-icons md-36 hover:tw-cursor-pointer" @click="modalSaidas = true">
            add_circle_outline
          </span>
          <span class="material-icons md-36 hover:tw-cursor-pointer" @click="apagarsaida">
            remove_circle_outline
          </span>
        </div>
        <div v-else>
          <span class="material-icons md-36 hover:tw-cursor-pointer"
            @click="(apagarSaida = false), (listaExclusao = [])">clear</span>
          <span class="material-icons md-36 hover:tw-cursor-pointer" @click="excluirSaida">delete_outline</span>
        </div>
      </div>
    </div>
    <!--modal entradas-->
    <q-dialog v-model="modalEntradas" persistent transition-show="scale" transition-hide="scale" rounded>
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
              <q-input outlined v-model="form.nome" label="Título*" />
              <q-input v-model="form.valor" mask="###.###,##" reverse-fill-mask hint="Preencha duas casas decimais"
                outlined label="Valor*" min="0.01" step="0.01" />
              <q-input outlined v-model="form.descricao" label="Descrição" />
            </div>
          </div>
        </q-card-section>
        <div class="tw-w-full tw-text-center tw-mb-2">
          <button type="button" @click="lancarEntrada">
            <span class="material-icons md-36">task_alt</span>
          </button>
        </div>
      </q-card>
    </q-dialog>
    <!--modal saídas-->
    <q-dialog v-model="modalSaidas" persistent transition-show="scale" transition-hide="scale">
      <q-card style="width: 500px; max-width: 80vw">
        <q-card-section class="row items-center q-pb-none">
          <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="help_outline" flat round dense @click="modalInfoSaidas = true" />
            </div>
            <div class="tw-w-8/12 sm:tw-w-10/12">
              <img src="/images/saida.png" class="tw-mx-auto" />
            </div>
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
            </div>
          </div>
        </q-card-section>
        <q-card-section>
          <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
            <div class="q-gutter-y-md">
              <q-input outlined v-model="form.nome" label="Título*" />
              <q-input v-model="form.valor" mask="###.###,##" reverse-fill-mask hint="Preencha duas casas decimais"
                outlined label="Valor*" min="0.01" step="0.01" />
              <q-select outlined v-model="form.id_categoria" :options="categoriasSaida" label="Categoria*" />
              <q-input outlined v-model="form.descricao" label="Descrição" />
            </div>
          </div>
        </q-card-section>
        <div class="tw-w-full tw-text-center tw-mb-2">
          <button type="button" @click="lancarSaida">
            <span class="material-icons md-36">task_alt</span>
          </button>
        </div>
      </q-card>
    </q-dialog>
    <!--modal cofre-->
    <q-dialog v-model="modalCofre" persistent transition-show="scale" transition-hide="scale" rounded>
      <q-carousel v-model="slide" transition-prev="scale" transition-next="scale" swipeable animated
        control-color="primary" navigation height="340px">
        <q-carousel-slide :name="1" style="width:500px; max-width:85vw">
          <div style="max-width: 80vw">
            <div class="row items-center q-pb-none">
              <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
                <div class="tw-w-2/12 sm:tw-w-1/12">
                  <q-btn icon="help_outline" flat round dense @click="modalInfoCofre = true" />
                </div>
                <div class="tw-w-8/12 sm:tw-w-10/12">
                  <img src="/images/safebox.png" class="tw-mx-auto" />
                </div>
                <div class="tw-w-2/12 sm:tw-w-1/12">
                  <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
                </div>
              </div>
            </div>
            <div class="tw-mt-4">
              <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
                <div class="q-gutter-y-md">
                  <span class="tw-text-lg">Saldo atual: R${{ valorFormatado($page.props.auth.user.saldo) }}</span>
                  <q-input v-model="form.valor" mask="###.###,##" reverse-fill-mask hint="Preencha duas casas decimais"
                    outlined label="Valor*" min="0.01" step="0.01" />
                </div>
              </div>
            </div>
            <div class="tw-w-full tw-text-center tw-mb-2 tw-mt-4">
              <q-btn @click="guardarCofre($page.props.auth.user.saldo)" icon="task_alt" color="primary"
                label="Guardar" />
            </div>
          </div>
        </q-carousel-slide>
        <q-carousel-slide :name="2" style="width:500px; max-width:85vw">
          <div style="max-width: 80vw">
            <div class="row items-center q-pb-none">
              <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
                <div class="tw-w-2/12 sm:tw-w-1/12">
                  <q-btn icon="help_outline" flat round dense @click="modalInfoCofre = true" />
                </div>
                <div class="tw-w-8/12 sm:tw-w-10/12">
                  <img src="/images/safebox.png" class="tw-mx-auto" />
                </div>
                <div class="tw-w-2/12 sm:tw-w-1/12">
                  <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
                </div>
              </div>
            </div>
            <div class="tw-mt-4">
              <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
                <div class="q-gutter-y-md">
                  <span class="tw-text-lg">Cofre: R${{
                  valorFormatado($page.props.auth.user.cofre) }}</span>
                  <q-input v-model="form.valor" mask="###.###,##" reverse-fill-mask hint="Preencha duas casas decimais"
                    outlined label="Valor*" min="0.01" step="0.01" />
                </div>
              </div>
            </div>
            <div class="tw-w-full tw-text-center tw-mb-2 tw-mt-4">
              <q-btn @click="retirarCofre($page.props.auth.user.cofre)" icon="task_alt" color="primary"
                label="Retirar" />
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
    <!--modal categorias-->
    <ModalCategoria v-model="modalCategorias" :chartData="chartData" :diferenca="diferenca" :categoria="categoria"
      :temEntrada="porcentagens[5]" />
    <!--modal custos-->
    <ModalCusto v-model="modalCustos" :chartData="chartData" :gastosMensais="gastosMensais" />
    <!--modal objetivos-->
    <ModalObjetivo v-model="modalObjetivos" :metas="metas" :metasConcluidas="metasConcluidas"
      :objetivo="porcentagens[4]" />
    <!--modal explicações entrada-->
    <ModalInfoEntradas v-model="modalInfoEntradas" />
    <!--modal explicações saida-->
    <ModalInfoSaidas v-model="modalInfoSaidas" />
    <!--modal explicações cofre-->
    <ModalInfoCofre v-model="modalInfoCofre" />
    <!--modal filtro entradas-->
    <q-dialog v-model="modalFiltroEntrada" transition-show="scale" transition-hide="scale">
      <q-card style="width: 500px; max-width: 60vw">
        <q-card-section class="row items-center q-pb-none">
          <q-icon name="calendar_today" size="20px" />
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup @click="formData.reset()" />
        </q-card-section>
        <q-card-section>
          <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
            <div class="q-gutter-y-md">
              <q-input v-model="formData.dataInicial" filled type="date" hint="Data Inicial*" />
              <q-input v-model="formData.dataFinal" :min="formData.dataInicial" filled type="date" hint="Data Final*" />
            </div>
          </div>
        </q-card-section>
        <div class="tw-w-full tw-text-center tw-mb-2">
          <button type="button" @click="filtrarEntradas">
            <span class="material-icons md-36">task_alt</span>
          </button>
        </div>
      </q-card>
    </q-dialog>
    <!--modal filtro saidas-->
    <q-dialog v-model="modalFiltroSaida" transition-show="scale" transition-hide="scale">
      <q-card style="width: 500px; max-width: 60vw">
        <q-card-section class="row items-center q-pb-none">
          <q-icon name="calendar_today" size="20px" />
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup @click="formData.reset()" />
        </q-card-section>
        <q-card-section>
          <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
            <div class="q-gutter-y-md">
              <q-input v-model="formData.dataInicial" filled type="date" hint="Data Inicial*" />
              <q-input v-model="formData.dataFinal" :min="formData.dataInicial" filled type="date" hint="Data Final*" />
            </div>
          </div>
        </q-card-section>
        <div class="tw-w-full tw-text-center tw-mb-2">
          <button type="button" @click="filtrarSaidas">
            <span class="material-icons md-36">task_alt</span>
          </button>
        </div>
      </q-card>
    </q-dialog>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DialogBaixo from "@/Components/DialogBaixo.vue";
import ModalCategoria from "@/Components/ModalCategorias.vue";
import ModalCusto from "@/Components/ModalCustos.vue";
import ModalObjetivo from "@/Components/ModalObjetivos.vue";
import ModalInfoSaidas from "@/Components/ModalInfoSaidas.vue";
import ModalInfoEntradas from "@/Components/ModalInfoEntradas.vue";
import ModalInfoCofre from "@/Components/ModalInfoCofre.vue";
import { ref } from "vue";
import { Bar, Pie } from 'vue-chartjs';
import { Chart as ChartJS, Title, Legend, ArcElement, Tooltip, BarElement, CategoryScale, LinearScale, Chart } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, CategoryScale, ArcElement, BarElement, LinearScale);
const modalEntradas = ref(false);
const modalSaidas = ref(false);
const modalCategorias = ref(false);
const modalCustos = ref(false);
const modalCofre = ref(false);
const modalObjetivos = ref(false);
const modalInfoEntradas = ref(false);
const modalInfoSaidas = ref(false);
const modalFiltroEntrada = ref(false);
const modalFiltroSaida = ref(false);
const modalInfoCofre = ref(false);
defineExpose({ modalEntradas, modalSaidas, modalCategorias, modalInfoCofre, modalCustos, modalCofre, modalObjetivos, modalInfoEntradas, modalInfoSaidas, modalFiltroEntrada, modalFiltroSaida });
</script>

<script>
import dayjs from "dayjs";
export default {
  props: {
    entradas: Object,
    saidas: Object,
    porcentagens: Object,
    porcentagensGerais: Object,
    categoriasSaida: Object,
    id: Number,
    gastosMensais: Number,
    metas: Number,
    metasConcluidas: Number,
  },
  methods: {
    dataFormatada(object) {
      const data = dayjs(object);
      return data.format("DD/MM/YYYY");
    },

    valorFormatado(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    porcentagem(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString() + "%";
    },

    lancarEntrada() {
      if (this.form.nome == "" || this.form.valor == "") {
        this.formNulo = true;
      } else {
        this.form.valor = this.form.valor.replace(".", "").replace(",", ".");
        this.form.post(route("adicionar.entrada", { id: this.id }), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.modalEntradas = false;
            this.form.reset();
          },
        });
      }
    },

    lancarSaida() {
      if (
        this.form.nome == "" ||
        this.form.valor == "" ||
        this.form.id_categoria == ""
      ) {
        this.formNulo = true;
      } else {
        this.form.valor = this.form.valor.replace(".", "").replace(",", ".");
        this.form.post(route("adicionar.saida", { id: this.id }), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.modalSaidas = false;
            this.form.reset();
          },
        });
      }
    },

    guardarCofre(value) {
      this.form.valor = this.form.valor.replace(".", "").replace(",", ".");
      if (this.form.valor == "") {
        this.formNulo = true;
      } else if (value < this.form.valor) {
        this.saldoInsuficiente = true;
        this.form.reset();
      } else {
        this.form.post(route("guardar"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.modalCofre = false;
            this.form.reset();
          },
        });
      }
    },

    retirarCofre(value) {
      console.log(value);
      this.form.valor = this.form.valor.replace(".", "").replace(",", ".");
      if (this.form.valor == "") {
        this.formNulo = true;
      } else if (value < this.form.valor) {
        this.saldoInsuficiente = true;
        this.form.reset();
      } else {
        this.form.post(route("remover"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.modalCofre = false;
            this.form.reset();
          },
        });
      }
    },

    apagarsaida() {
      this.apagarSaida = true;
    },

    apagarentrada() {
      this.apagarEntrada = true;
    },

    adicionaItem(id) {
      if (this.listaExclusao.includes(id)) {
        var pos = this.listaExclusao.indexOf(id);
        this.listaExclusao.splice(pos, 1);
      } else this.listaExclusao.push(id);
    },

    excluirSaida() {
      this.$inertia.visit(route("excluir.saida"), {
        method: "post",
        data: { listaExclusao: this.listaExclusao },
      });
    },

    excluirEntrada() {
      this.$inertia.visit(route("excluir.entrada"), {
        method: "post",
        data: { listaExclusao: this.listaExclusao },
      });
    },

    atualizarDataBarra(i, j, c) {
      this.chartData = {
        labels: [''],
        datasets: [{ label: 'Entradas (%)', backgroundColor: ["#59f792"], data: [100] }, { label: c + " (%)", backgroundColor: ["#ac27e6"], data: [i] }]
      },
        this.diferenca = i - j;
      this.categoria = c;
      this.categoriaValor = i;
      this.modalCategorias = true;
    },

    atualizarDataSetor(i, j, k, l, m) {
      this.chartData = {
        labels: ['Essencial', 'Aposentadoria', 'Educação', 'Lazer', 'Objetivos'],
        datasets: [
          {
            backgroundColor: ['#41B883', '#59f792', '#ffdf00', '#ac27e6', '#d41545'],
            data: [i, j, k, l, m]
          }
        ]
      },
        this.modalCustos = true;
    },

    filtrarEntradas() {
      if (this.formData.dataInicial == null || this.formData.dataFinal == null) { this.formNulo = true }
      else {
        this.formData.post(route("filtrar.entrada"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.modalFiltroEntrada = false;
            this.formData.reset();
          },
        });
      }
    },

    filtrarSaidas() {
      if (this.formData.dataInicial == null || this.formData.dataFinal == null) { this.formNulo = true }
      else {
        this.formData.post(route("filtrar.saida"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.modalFiltroSaida = false;
            this.formData.reset();
          },
        });
      }
    }
  },
  data() {
    return {
      form: this.$inertia.form({
        nome: "",
        id_categoria: ref(null),
        valor: "",
        descricao: "",
      }),
      formNulo: false,
      saldoInsuficiente: false,
      listaExclusao: [],
      apagarSaida: false,
      apagarEntrada: false,
      diferenca: null,
      categoria: null,
      slide: ref(1),
      chartData: {
        labels: [],
        datasets: [{ backgroundColor: [], data: [] }]
      },
      formData: this.$inertia.form({
        dataInicial: null,
        dataFinal: null,
      }),
    };
  },
};
</script>

<style>
.borda {
  border: 2px solid black;
  border-top-left-radius: 20px;
  border-top-right-radius: 20px;
}

.border {
  border: 2px solid black;
  border-radius: 20px;
}

.borda-invisivel {
  border: 0px solid;
  border-radius: 20px;
}

.round {
  border-radius: 100%;
  color: white;
  background: black;
}

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

.imagem {
  display: inline-block;
  width: 30px;
}

.entrada :hover {
  background-color: #d1b6ff;
}
</style>