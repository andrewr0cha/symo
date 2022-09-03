<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { ref } from "vue";
import BreezeButon from "@/Components/Button.vue";
import Texto from "@/Components/Text.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ModalEntrada from "@/Components/ModalEntrada.vue";
import ModalSaida from "@/Components/ModalSaida.vue";
import DialogBaixo from "@/Components/DialogBaixo.vue";
import Calendario from "@/Components/Calendario.vue";
import ModalInfoMetas from "@/Components/ModalInfoMeta.vue";
import ModalProgressoMeta from "@/Components/ModalProgressoMeta.vue";
const modalAgendamentos = ref(false);
const modalData = ref(false);
const modalMeta = ref(false);
const modalInfoMetas = ref(false);
const modalProgressao = ref(false);
defineExpose({ modalAgendamentos, modalData, modalMeta, modalInfoMetas, modalProgressao });
</script>

<template>

  <Head title="Página Inicial" />

  <BreezeAuthenticatedLayout>
    <div class="tw-flex">
      <div class="
          tw-flex
          tw-flex-col
          tw-py-8
          tw-overflow-y-auto
          tw-border-r
        " style="width: 690px !important">
        <div class="tw-flex tw-flex-col tw-mx-auto">
          <aside>
            <div class="tw-flex sm:tw-max-w-7xl tw-mx-auto">
              <div class="fundo tw-flex sm:tw-max-w-2/6 tw-mr-2 tw-pl-5">
                <div class="topo tw-mx-auto sm:tw-max-w-2/6 tw-pl-2">
                  <img class="
                      tw-rounded tw-max-w-40 tw-max-h-48 tw-mx-auto tw-pt-1
                    " src="/images/user.png" />
                  {{ horas() }} {{ $page.props.auth.user.name }}
                  <img v-if="horas() == 'Bom dia,'" src="/images/nascerdosol.png" class="imagem" />
                  <img v-else-if="horas() == 'Boa tarde,'" src="/images/pordosol.png" class="imagem" />
                  <img v-else-if="horas() == 'Boa noite,'" src="/images/noite.png" class="imagem" />
                  <hr />
                  <div class="tw-mt-5">
                    <Texto class="tw-w-8/10 tw-text-center tw-p-2">
                      Seu saldo: R${{ valorFormatado($page.props.auth.user.saldo) }}
                    </Texto>
                  </div>
                  <div class="tw-mt-5">
                    <Texto class="tw-w-8/10 tw-text-center tw-p-2">
                      Seus gastos este mês: R${{ valorFormatado(gastosMensais) }}
                    </Texto>
                  </div>
                  <div class="tw-mt-5">
                    <Texto class="tw-w-8/10 tw-text-center tw-p-2">
                      Dinheiro guardado: R${{ valorFormatado($page.props.auth.user.cofre) }}
                    </Texto>
                  </div>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
      <div class="
          tw-hidden
          sm:tw-inline-flex
          tw-w-full
          tw-h-full
          tw-flex
          tw-flex-col
          tw-overflow-y-auto
          tw-py-8
          tw-px-4
        ">
        <!-- Calendario -->
        <div class="tw-flex tw-border-1 tw-border-dotted">
          <br />
          <div class="calendario tw-hidden sm:tw-inline-flex sm:tw-w-full tw-pl-4">
            <!--Agendamentos-->
            <div class="tempo tw-w-full lg:tw-w-2/5">
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
                  <div v-if="!apagarAgendamento" class="tw-mt-2 tw-text-white  tw-flex tw-inline-flex">
                    <span class="material-icons md-36 hover:tw-cursor-pointer" @click="modalAgendamentos = true">
                      add_circle_outline
                    </span>
                    <span class="material-icons md-36 hover:tw-cursor-pointer" @click="apagaragendamento">
                      remove_circle_outline
                    </span>
                  </div>
                  <div v-else class="tw-mt-2 tw-flex tw-text-white  tw-inline-flex">
                    <span class="material-icons md-36 hover:tw-cursor-pointer"
                      @click="(apagarAgendamento = false), (lista = [])">clear</span>
                    <span class="material-icons md-36 hover:tw-cursor-pointer"
                      @click="excluirAgendamento">delete_outline</span>
                  </div>
                </div>
              </div>
            </div>
            <!--Calendario-->
            <div class="topo-calendario tw-hidden lg:tw-w-3/5 lg:tw-flex tw-max-h-full tw-overflow-y-auto tw-px-2">
              <Calendario :atributos="atributosCalendario"></Calendario>
            </div>
          </div>
        </div>

        <!-- Painel de Ações 2 -->
        <div class="tw-flex">
          <div class="consulta tw-hidden sm:tw-block sm:tw-w-full tw-mt-4 tw-p-2">
            <div class="tw-flex-auto tw-w-full">Suas Operações</div>
            <div class="
                tw-inline-flex
                tw-flex-auto
                tw-w-full
                tw-mt-4
                tw-items-center
                tw-justify-center
              ">
              <div class="tw-w-1/3 tw-mr-2 tw-min-w-32">
                <Link :href="route('consultas', { id: $page.props.auth.user.id })">
                <Texto class="tw-w-full tw-text-center tw-p-2 tw-cursor-pointer">Consultar</Texto>
                </Link>
              </div>
              <div class="tw-w-1/3 tw-mr-2 tw-min-w-32">
                <Texto class="tw-w-full tw-text-center tw-p-2 tw-cursor-pointer" @click="modalSaidas = true">+Despesa
                </Texto>
              </div>
              <div class="tw-w-1/3 tw-min-w-32">
                <Texto class="tw-w-full tw-text-center tw-p-2 tw-cursor-pointer" @click="modalEntradas = true">+Entrada
                </Texto>
              </div>
            </div>
          </div>
        </div>

        <!--metas-->
        <div class="tw-flex tw-mt-4">
          <div class="tw-inline-flex tw-flex-auto tw-w-full tw-mt-4">
            <Texto class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-mr-4 tw-p-2 tw-cursor-pointer"
              @click="modalmeta('Curto')">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a curto prazo</span>
            </Texto>
            <Texto class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-mr-4 tw-p-2 tw-cursor-pointer"
              @click="modalmeta('Médio')">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a médio prazo</span>
            </Texto>
            <Texto class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-p-2 tw-cursor-pointer" @click="modalmeta('Longo')">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a longo prazo</span>
            </Texto>
          </div>
        </div>

        <ModalEntrada v-model="modalEntradas"></ModalEntrada>
        <ModalSaida v-model="modalSaidas"></ModalSaida>
      </div>
      <!--adicionar agendamento-->
      <q-dialog v-model="modalAgendamentos" transition-show="scale" transition-hide="scale" rounded
        class="tw-hidden sm:tw-flex">
        <q-card style="width: 500px; max-width: 60vw">
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
                  <div v-if="form.dataAgendamento != '' && form.dataAgendamento != null">
                    <span class="tw-ml-2">Data selecionada: {{ dataFormatada(form.dataAgendamento) }}</span>
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
      <q-dialog v-model="modalData" transition-show="scale" transition-hide="scale" rounded
        class="tw-hidden sm:tw-flex">
        <q-card style="width: 400px; max-width: 60vw">
          <q-card-section>
            <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
              <q-date v-model="form.dataAgendamento" today-btn flat mask="YYYY-MM-DD"
                :locale="{ monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Novembro', 'Dezembro'], daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'], days: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'] }" />
            </div>
          </q-card-section>
          <div class="tw-w-full tw-text-center tw-mb-2">
            <q-btn v-close-popup color="primary" label="OK" />
          </div>
        </q-card>
      </q-dialog>
      <!--modal meta-->
      <q-dialog v-model="modalMeta" class="tw-hidden sm:tw-flex">
        <q-carousel transition-prev="scale" transition-next="scale" swipeable animated v-model="slide"
          control-color="primary" height="500px" arrows>
          <q-carousel-slide :name="1">
            <div style="width:500px" class="tw-h-full">
              <div class="tw-w-full tw-flex tw-justify-between tw-mt-4">
                <q-btn icon="close" flat round dense v-close-popup @click="slide = 1" />
              </div>
              <div class="tw-h-5/6 tw-w-full">
                <div v-if="metaList == 0" class="tw-w-full tw-h-full tw-text-center tw-flex tw-items-center">
                  <span class="tw-text-lg tw-w-11/12">Parece que você ainda não tem metas com essa duração. Use o
                    formulário ao
                    lado para criar uma.🤩
                  </span>
                </div>
                <div v-else class="tw-w-full tw-mt-2">
                  <q-scroll-area style="height:300px">
                    <div v-for="item in metaList" :key="item.id" class="tw-my-2 tw-w-11/12 tw-mx-auto meta">
                      <q-card class="flex inline-flex hover:tw-cursor-pointer">
                        <div class="tw-w-5/12 tw-text-left tw-text-xl tw-pl-2 pb-2"
                          @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                          {{ item.nome }}
                        </div>
                        <div class="tw-w-3/12 tw-pr-2" @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                          R$ {{ valorFormatado(item.valor) }}</div>
                        <div class="tw-w-4/12" @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                          Status: {{ item.status }}</div>
                        <div class="tw-w-full tw-flex tw-inline-flex tw-items-center tw-justify-left">
                          <div class="tw-w-5/12 tw-pl-2" @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                            {{ item.descricao }}
                          </div>
                          <div class="tw-w-3/12" @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                            Data Inicial: {{ dataFormatada(item.data) }}
                          </div>
                          <div class="tw-w-3/12" @click="mudarProgressao(item.id, $page.props.auth.user.cofre)">
                            Data Final: {{ dataFinalFormatada(item.data, item.duracao) }}
                          </div>
                          <div v-if="apagarMeta || marcarConcluida" class="tw-w-1/12>">
                            <input type="checkbox" @click="adicionaItem(item.id)" />
                          </div>
                        </div>
                      </q-card>
                    </div>
                  </q-scroll-area>
                  <div class="tw-w-full tw-justify-center tw-mt-4 tw-flex tw-inline-flex">
                    <div v-if="apagarMeta == false && marcarConcluida == false"
                      class="tw-mt-2 tw-flex tw-inline-flex tw-justify-around tw-w-full">
                      <q-btn color="primary" label="Marcar como Concluída" @click="marcarconcluida" no-caps />
                      <q-btn color="primary" label="Remover" @click="apagarmeta" no-caps />
                    </div>
                    <div v-else-if="apagarMeta == true" class="tw-mt-2 tw-flex tw-inline-flex">
                      <span class="material-icons md-36 hover:tw-cursor-pointer"
                        @click="(apagarMeta = false), (lista = [])">clear</span>
                      <span class="material-icons md-36 hover:tw-cursor-pointer"
                        @click="excluirMeta">delete_outline</span>
                    </div>
                    <div v-else-if="marcarConcluida == true" class="tw-mt-2 tw-flex tw-inline-flex">
                      <span class="material-icons md-36 hover:tw-cursor-pointer"
                        @click="(marcarConcluida = false), (lista = [])">clear</span>
                      <span class="material-icons md-36 hover:tw-cursor-pointer" @click="mudarStatus">check</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </q-carousel-slide>
          <q-carousel-slide :name="2">
            <div style="width:500px">
              <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
                <div class="tw-w-2/12 sm:tw-w-1/12">
                  <q-btn icon="help_outline" flat round dense @click="modalInfoMetas = true" />
                </div>
                <div class="tw-w-8/12 sm:tw-w-10/12">
                  <img src="/images/metas.png" class="tw-mx-auto" />
                </div>
                <div class="tw-w-2/12 sm:tw-w-1/12">
                  <q-btn icon="close" flat round dense v-close-popup @click="(formMeta.reset())" />
                </div>
              </div>
              <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
                <div class="q-gutter-y-md">
                  <q-input outlined v-model="formMeta.nome" label="Título*" />
                  <q-input outlined v-model="formMeta.descricao" label="Descrição" />
                  <q-input v-model="formMeta.valor" mask="###.###,##" reverse-fill-mask
                    hint="Preencha duas casas decimais" outlined label="Valor*" min="0.01" step="0.01" />
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

        </q-carousel>
      </q-dialog>
      <!--modal explicações metas-->
      <ModalInfoMetas v-model="modalInfoMetas" />
      <!--modal progresso de metas-->
      <ModalProgressoMeta v-model="modalProgressao" :progresso="progresso" :progressaoMeta="progressaoMeta" />
      <DialogBaixo v-model="formNulo" :value="'Preencha todos os campos obrigatórios. (Marcados com *)'" :icon="'error'"
        class="tw-hidden sm:tw-flex">
      </DialogBaixo>
    </div>
    <div class="tw-border-t-2 tw-border-black tw-justify-center tw-w-full tw-flex tw-inline-flex tw-p-4 ">
      <div class="tw-full sm:tw-w-1/3">
        <img src="/images/cti.gif" style="max-width:250px" />
      </div>
      <div class="tw-hidden sm:tw-flex sm:tw-w-2/3 tw-text-center tw-items-center tw-text-lg">
        <span>Projeto SYMO - Colégio Técnico Industrial - CTI</span>
        <span>Desenvolvido por Andrew, Carolina, Enzo, Guilherme Barboza, Guilherme Garcia, Lucas Alves</span>
      </div>
    </div>
    <!--modal meta-->
    <q-dialog v-model="metas" class="tw-hidden sm:tw-flex">
      <q-card style="height:370px">
        <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
          <div class="tw-w-2/12 sm:tw-w-1/12">
          </div>
          <div class="tw-w-8/12 sm:tw-w-10/12">
            <img src="/images/metas.png" class="tw-mx-auto" />
          </div>
          <div class="tw-w-2/12 sm:tw-w-1/12 tw-mr-2">
            <q-btn icon="close" flat round dense v-close-popup />
          </div>
        </div>
        <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto tw-text-center">
          <span class="tw-text-lg">Parece que você tem os seguintes eventos para hoje:</span>
          <q-scroll-area style="height: 150px">
            <div class="tw-w-11/12 tw-mx-auto">
              <div v-for="item in metasDia" :key="item.id" class="tw-mb-2 tw-mt-2">
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
                  </div>
                </q-card>
              </div>
            </div>
          </q-scroll-area>

          <span class="tw-text-lg tw-my-2">Não se esqueça de nos contra soble eles.😄</span>
        </div>
      </q-card>
    </q-dialog>

  </BreezeAuthenticatedLayout>
</template>

<script>
import dayjs from "dayjs";
export default {
  props: {
    agendamentos: Object,
    curtoPrazo: Object,
    medioPrazo: Object,
    longoPrazo: Object,
    atributosCalendario: Object,
    gastosMensais: Object,
    metasDia: Object,
    metas: Boolean,
  },

  methods: {
    horas() {
      var dia = new Date();
      var hora = dia.getHours() + ":" + dia.getMinutes() + ":" + dia.getSeconds();
      var mensagem;

      mensagem = "Bom dia,";
      if (hora > "5:00:00") {
        mensagem = "Bom dia,";
      } else if (hora > "12:00:00" && hora < "19:00:00") {
        mensagem = "Boa tarde,";
      } else if (hora > "19:00:01" && hora < "5:00:00") {
        mensagem = "Boa noite,";
      }
      return mensagem;
    },

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

    apagaragendamento() {
      this.apagarAgendamento = true;
    },

    excluirAgendamento() {
      this.$inertia.visit(route("excluir.agendamento"), {
        method: "post",
        data: { lista: this.lista },
      });
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
        this.formMeta.post(route("adicionar.meta"), {
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
      this.$inertia.visit(route("excluir.meta"), {
        method: "post",
        data: { lista: this.lista },
      });
    },

    mudarStatus() {
      this.$inertia.visit(route("concluir.meta"), {
        method: "post",
        data: { lista: this.lista },
      });
    },

    mudarProgressao(i, k) {
      this.progressaoMeta = this.metaList.find((meta) => meta.id == i);
      this.progresso = [k / this.progressaoMeta.valor, this.progressaoMeta.valor]
      //this.progresso = k / this.progressaoMeta.valor;
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
      modalEntradas: false,
      modalSaidas: false,
      slide: ref(1),
      metaList: null,
      progressaoMeta: null,
      progresso: null,
      form: this.$inertia.form({
        nome: '',
        descricao: '',
        dataAgendamento: '',
      }),
      formMeta: this.$inertia.form({
        nome: '',
        descricao: '',
        valor: '',
        duracao: '',
        status: ''
      }),
      formNulo: null,
      lista: [],
      apagarAgendamento: false,
      apagarMeta: false,
      marcarConcluida: false,
    }
  },
};
</script>

<style scoped>
.fundo {
  background-color: black;
  max-width: 300px;
  border-radius: 20px;
}

.topo {
  background-color: white;
  text-align: center;
  width: 290px;
  height: 430px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.imagem {
  display: inline-block;
  margin-right: 5px;
  width: 30px;
}

.calendario {
  background-color: black;
  border-radius: 20px;
  height: 430px;
}

.tempo {
  height: 430px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.topo-calendario {
  background-color: white;
  height: 430px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.consulta {
  background-color: white;
  text-align: center;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.metas {
  background-color: white;
  border: 2px solid black;
  border-radius: 20px;
  text-align: center;
}
</style>
