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
          tw-flex
          tw-flex-col
          tw-items-center
          tw-justify-center
          borda-invisivel
        ">
          <img src="/images/dinheiro.png" class="imagem" />
        <div class="tw-flex tw-inline-flex tw-items-center tw-justify-center">
          <span class="tw-text-white">Seu saldo</span>
        </div>
        <div class="tw-mb-4">
          <span class="tw-text-white">R$ {{ valorFormatado($page.props.auth.user.saldo) }}</span>
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
              {{ porcentagem(porcentagens[0]) }}
            </div>
            <div class="
                tw-w-60
                tw-mr-2
                tw-flex
                tw-flex-col
                tw-items-center
                tw-justify-center
                hover:tw-cursor-pointer tw-text-center
              " @click="atualizarDataBarra(porcentagens[1], porcentagensGerais[1], 'Objetivos')">
              <img src="/images/objetivos.png" class="imagem" />
              Objetivos<br>
              {{ porcentagem(porcentagens[1]) }}
            </div>
            <div class="
                tw-w-60
                tw-mr-2
                tw-flex
                tw-flex-col
                tw-items-center
                tw-justify-center
                hover:tw-cursor-pointer tw-text-center
              " @click="atualizarDataBarra(porcentagens[2], porcentagensGerais[2], 'Aposentadoria')">
              <img src="/images/aposentadoria.png" class="imagem" />
              Aposentadoria<br>
              {{ porcentagem(porcentagens[2]) }}
            </div>
            <div class="
                tw-w-60
                tw-mr-2
                tw-flex
                tw-flex-col
                tw-items-center
                tw-justify-center
                hover:tw-cursor-pointer tw-text-center
              " @click="atualizarDataBarra(porcentagens[3], porcentagensGerais[3], 'Educação')">
              <img src="/images/educacao.png" class="imagem" />
              Educação<br>
              {{ porcentagem(porcentagens[3]) }}
            </div>
            <div class="
                tw-w-60 tw-flex tw-flex-col tw-items-center tw-justify-center
                hover:tw-cursor-pointer tw-text-center tw-mr-2
              " @click="atualizarDataBarra(porcentagens[4], porcentagensGerais[4], 'Lazer')">
              <img src="/images/lazer1.png" class="imagem" />
              Lazer<br>
              {{ porcentagem(porcentagens[4]) }}
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
        <q-scroll-area style="height: 350px">
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
                  <div class="tw-w-2/12">
                    {{ item.id }}
                  </div>
                  <div class="tw-w-5/12">
                    {{ item.descricao }}
                  </div>
                  <div class="tw-w-4/12">
                    <div class="tw-text-green-500">
                      +R$ {{ valorFormatado(item.valor) }}
                    </div>
                    {{ dataFormatada(item.data) }}
                  </div>
                  <div v-if="apagarEntrada" class="tw-w-1/12>">
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
        <q-scroll-area style="height: 350px">
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
                  <div v-if="apagarSaida" class="tw-w-1/12>">
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
      <q-card style="width: 500px; max-width: 60vw">
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
      <q-card style="width: 500px; max-width: 60vw">
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
    <!--form nulo-->
    <DialogBaixo v-model="formNulo" :value="'Preencha todos os campos obrigatórios. (Marcados com *)'" :icon="'error'">
    </DialogBaixo>
    <!--modal categorias-->
    <ModalCategoria v-model="modalCategorias" :chartData="chartData" :diferenca="diferenca" :categoria="categoria"/>
    <!--modal custos-->
    <!--<q-dialog v-model="modalCustos" position="right" rounded>
      <q-carousel v-model="slide" vertical height="420px" transition-prev="slide-down" transition-next="slide-up"
        swipeable animated control-color="primary" arrows>
        <q-carousel-slide :name="1">
          <div style="width: 300px;  max-width: 60vh;">
            <div class="row items-center q-pb-none">
            </div>
            <div>
              <div v-if="gastosMensais == 0" class="tw-text-center tw-mx-auto tw-flex tw-items-center tw-text-lg">
                <span class="tw-w-full tw-mb-2">Parece que você ainda não tem despesas cadastradas.🙁</span><img
                  src="images/custos1.png" />
              </div>
              <div class="tw-text-center tw-mx-auto" v-else>
                <span>Os seus gastos estão divididos da seguinte forma:</span>
                <Pie :chart-data="chartData" />
              </div>
            </div>
          </div>
        </q-carousel-slide>
        <q-carousel-slide :name="2">
          <div style="width: 300px;  max-width: 60vh; height:100%">
            <div class="tw-flex  tw-items-center tw-h-full">
              <div class="tw-flex tw-flex-col">
                <img src="/images/lampada.png" class="tw-mx-auto" />
                <span class="tw-text-lg tw-text-center">Estabilidade financeira diz respeito sobre disciplina antes de
                  tudo. Nesse sentido, sugerimos uma divisão padrão para seus gastos: ela pode ser visualizada usando
                  os
                  ícones ao lado 😉</span>
              </div>
            </div>
          </div>
        </q-carousel-slide>
      </q-carousel>
    </q-dialog>-->
    <ModalCusto v-model="modalCustos" :chartData="chartData" :gastosMensais="gastosMensais"/>
    
    <!--modal explicações entrada-->
    <q-dialog v-model="modalInfoEntradas" position="left" rounded>
      <q-card style="width: 300px; max-width: 60vh">
        <q-card-section class="row items-center q-pb-none">
          <q-btn icon="info" flat round dense />
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>
        <q-card-section>
          <span>Aqui são inseridas as movimentações financeiras que te favoreceram. Serviços prestados, salário, etc.
            Tudo o que, de alguma forma, 'te fez ganhar dinheiro'.</span>
          <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Título:
              </span>Campo obrigatório e a principal identificação para aquela movimentação. Poucas palavras que
              facilitem a lembrança de onde veio aquele dinheiro.</span></div>
          <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Valor:
              </span>Quanto dinheiro tal movimentação rendeu a você. Campo obrigatório.</span></div>
          <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Descrição:
              </span>Campo opcional. Preencha caso exista mais alguma informação importante sobre a
              movimentação.</span>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!--modal explicações saida-->
    <q-dialog v-model="modalInfoSaidas" position="left" rounded>
      <q-card style="width: 300px; max-width: 60vh">
        <q-card-section class="row items-center q-pb-none">
          <q-btn icon="info" flat round dense />
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>
        <q-card-section>
          <span>Aqui são inseridas as movimentações financeiras nas quais você é o pagante.</span>
          <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Título:
              </span>Campo obrigatório e a principal identificação para aquela movimentação. Poucas palavras que
              facilitem a lembrança de para onde foi aquele dinheiro.</span></div>
          <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Valor:
              </span>Quanto dinheiro tal movimentação subtraiu de seu saldo. Campo obrigatório.</span></div>
          <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Categoria:
              </span>Classificação dada à despesa. Contemplam as despesas consideradas básicas a uma vida saudável
              financeiramente falando. Campo obrigatório.</span></div>
          <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Descrição:
              </span>Campo opcional. Preencha caso exista mais alguma informação importante sobre a
              movimentação.</span>
          </div>
        </q-card-section>
      </q-card>
    </q-dialog>
    <!--modal filtro entradas-->
    <q-dialog v-model="modalFiltroEntrada" transition-show="scale" transition-hide="scale">
      <q-card style="width: 500px; max-width: 60vw">
        <q-card-section class="row items-center q-pb-none">
          <q-btn icon="calendar_today" flat round dense />
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
          <q-btn icon="calendar_today" flat round dense />
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
import { ref } from "vue";
import { Bar, Pie } from 'vue-chartjs';
import { Chart as ChartJS, Title, Legend, ArcElement, Tooltip, BarElement, CategoryScale, LinearScale, Chart } from 'chart.js'
ChartJS.register(Title, Tooltip, Legend, CategoryScale, ArcElement, BarElement, LinearScale);
const modalEntradas = ref(false);
const modalSaidas = ref(false);
const modalCategorias = ref(false);
const modalCustos = ref(false);
const modalInfoEntradas = ref(false);
const modalInfoSaidas = ref(false);
const modalFiltroEntrada = ref(false);
const modalFiltroSaida = ref(false);
defineExpose({ modalEntradas, modalSaidas, modalCategorias, modalCustos, modalInfoEntradas, modalInfoSaidas, modalFiltroEntrada, modalFiltroSaida });
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
    id: Object,
    gastosMensais: Object,
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
      this.categoria=c;
      this.modalCategorias = true;
    },

    atualizarDataSetor(i, j, k, l, m) {
      this.chartData = {
        labels: ['Essencial', 'Objetivos', 'Aposentadoria', 'Educação', 'Lazer'],
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
  background: #59f792;
  border-radius: 100vh;
}

.scrollbar::-webkit-scrollbar-thumb:hover {
  background: green;
}

.imagem {
  display: inline-block;
  margin-right: 5px;
  width: 30px;
}

.entrada :hover {
  background-color: #59f792;
}
</style>