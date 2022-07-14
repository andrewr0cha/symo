<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { ref } from "vue";
import BreezeButon from "@/Components/Button.vue";
import Texto from "@/Components/Text.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ModalEntrada from "@/Components/ModalEntrada.vue";
import ModalSaida from "@/Components/ModalSaida.vue";
import DialogBaixo from "@/Components/DialogBaixo.vue";
const modalAgendamentos = ref(false);
const modalData = ref(false);
const modalCurto = ref(false);
const modalMedio = ref(false);
const modalLongo = ref(false);
defineExpose({ modalAgendamentos, modalData, modalCurto, modalMedio, modalLongo });
</script>

<template>

  <Head title="Página Inicial" />

  <BreezeAuthenticatedLayout>
    <div class="tw-flex">
      <div class="
          tw-flex
          tw-flex-col
          tw-h-screen
          tw-px-4
          tw-py-8
          tw-overflow-y-auto
          tw-border-r
        " style="width: 690px !important">
        <div class="tw-flex tw-flex-col tw-mx-auto">
          <aside>
            <div class="tw-flex sm:tw-max-w-7xl tw-mx-auto">
              <div class="fundo tw-flex sm:tw-max-w-2/6 tw-mr-4 tw-pl-5">
                <div class="topo tw-mx-auto sm:tw-max-w-2/6 tw-pl-2">
                  <img class="
                      tw-rounded tw-max-w-40 tw-max-h-40 tw-mx-auto tw-pt-1
                    " src="/images/user.png" />
                  Boa noite, {{ $page.props.auth.user.name }}
                  <img src="/images/noite.png" class="imagem" />
                  <hr />
                  <div class="tw-mt-5">
                    <Texto class="tw-w-8/10 tw-text-center tw-p-4">
                      <!--<img src="/images/carteira.png" />-->
                      Seu saldo: {{ $page.props.auth.user.saldo }}
                    </Texto>
                  </div>

                  <div class="tw-mt-5">
                    <Texto class="tw-w-8/10 tw-text-center tw-p-4">
                      <img src="/images/carteira.png" class="imagem" />
                      Despesas
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
            <div class="tempo tw-w-2/5">
              <div v-if="agendamentos == 0" class="tw-h-full tw-flex tw-items-center tw-justify-center">
                <span class="tw-cursor-pointer tw-text-lg tw-text-center" @click="modalAgendamentos = true">
                  Você ainda não tem eventos agendados. Clique aqui para criar um evento.
                </span>
              </div>
              <div v-else>
                <q-scroll-area style="height: 300px">
                  <div class="tw-w-8/12 tw-mx-auto">
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
                    <span class="material-icons md-36 hover:tw-cursor-pointer" @click="modalAgendamentos = true">
                      add_circle_outline
                    </span>
                    <span class="material-icons md-36 hover:tw-cursor-pointer" @click="apagaragendamento">
                      remove_circle_outline
                    </span>
                  </div>
                  <div v-else class="tw-mt-2 tw-flex tw-inline-flex">
                    <span class="material-icons md-36 hover:tw-cursor-pointer"
                      @click="(apagarAgendamento = false), (listaExclusao = [])">clear</span>
                    <span class="material-icons md-36 hover:tw-cursor-pointer"
                      @click="excluirAgendamento">delete_outline</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="topo-calendario md:tw-w-3/5"></div>
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
                <Texto class="tw-w-full tw-text-center tw-p-2 tw-cursor-pointer" @click="modalSaidas = true">Despesas
                </Texto>
              </div>
              <div class="tw-w-1/3 tw-min-w-32">
                <Texto class="tw-w-full tw-text-center tw-p-2 tw-cursor-pointer" @click="modalEntradas = true">Entradas
                </Texto>
              </div>
            </div>
          </div>
        </div>

        <!--metas-->
        <div class="tw-flex tw-mt-4">
          <div class="tw-inline-flex tw-flex-auto tw-w-full tw-mt-4">
            <div class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-mr-4 tw-p-2 tw-cursor-pointer"
              @click="modalCurto = true">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a curto prazo</span>
            </div>
            <div class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-mr-4 tw-p-2 tw-cursor-pointer"
              @click="modalMedio = true">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a médio prazo</span>
            </div>
            <div class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-p-2 tw-cursor-pointer" @click="modalLongo = true">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center">Minhas metas a longo prazo</span>
            </div>
          </div>
        </div>

        <ModalEntrada v-model="modalEntradas"></ModalEntrada>
        <ModalSaida v-model="modalSaidas"></ModalSaida>
      </div>
      <!--adicionar agendamento-->
      <q-dialog v-model="modalAgendamentos" transition-show="scale" transition-hide="scale" rounded>
        <q-card style="width: 500px; max-width: 60vw">
          <q-card-section class="row items-center q-pb-none">
            <div class="tw-w-10/12 sm:tw-w-11/12">
              <img src="/images/entrada.png" class="tw-mx-auto hover:tw-cursor-pointer"
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
                  <div v-if="form.dataAgendamento != ''">
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
      <q-dialog v-model="modalData" transition-show="scale" transition-hide="scale" rounded>
        <q-card style="width: 400px; max-width: 60vw">
          <q-card-section>
            <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
              <q-date v-model="form.dataAgendamento" today-btn mask="YYYY-MM-DD"
                :locale="{ monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'], months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Novembro', 'Dezembro'], daysShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'], days: ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'] }" />
            </div>
          </q-card-section>
          <div class="tw-w-full tw-text-center tw-mb-2">
            <q-btn v-close-popup color="primary" label="OK" />
          </div>
        </q-card>
      </q-dialog>
      <!--meta curto prazo-->
      <q-dialog v-model="modalCurto">
        <q-card style="width: 500px; max-width: 60vw">
          <q-card-section class="row items-center q-pb-none">
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
            </div>
            <div class="tw-w-8/12 sm:tw-w-10/12">
              <img src="/images/entrada.png" class="tw-mx-auto hover:tw-cursor-pointer"
                @click="modalInfoEntradas = true" />
            </div>
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="formMeta.reset()" />
            </div>
          </q-card-section>
          <q-card-section>
            <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
              <div class="q-gutter-y-md">
                <q-input outlined v-model="formMeta.nome" label="Título*" />
                <q-input outlined v-model="formMeta.descricao" label="Descrição" />
                <q-input v-model.number="formMeta.valor" type="number" outlined label="Valor*" min="0.01" step="0.01" />
                <q-select outlined v-model="formMeta.duracao" label='Curto Prazo' disable />
              </div>
            </div>
          </q-card-section>
          <div class="tw-w-full tw-text-center tw-mb-2">
            <button type="button" @click="lancarMeta('Curto')">
              <span class="material-icons md-36">task_alt</span>
            </button>
          </div>
        </q-card>
      </q-dialog>
      <!--meta médio prazo-->
      <q-dialog v-model="modalMedio">
        <q-card style="width: 500px; max-width: 60vw">
          <q-card-section class="row items-center q-pb-none">
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
            </div>
            <div class="tw-w-8/12 sm:tw-w-10/12">
              <img src="/images/entrada.png" class="tw-mx-auto hover:tw-cursor-pointer"
                @click="modalInfoEntradas = true" />
            </div>
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="formMeta.reset()" />
            </div>
          </q-card-section>
          <q-card-section>
            <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
              <div class="q-gutter-y-md">
                <q-input outlined v-model="formMeta.nome" label="Título*" />
                <q-input outlined v-model="formMeta.descricao" label="Descrição" />
                <q-input v-model.number="formMeta.valor" type="number" outlined label="Valor*" min="0.01" step="0.01" />
                <q-select outlined v-model="formMeta.duracao" label='Médio Prazo' disable />
              </div>
            </div>
          </q-card-section>
          <div class="tw-w-full tw-text-center tw-mb-2">
            <button type="button" @click="lancarMeta('Médio')">
              <span class="material-icons md-36">task_alt</span>
            </button>
          </div>
        </q-card>
      </q-dialog>
      <!--meta longo prazo-->
      <q-dialog v-model="modalLongo">
        <q-card style="width: 500px; max-width: 60vw">
          <q-card-section class="row items-center q-pb-none">
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="form.reset()" />
            </div>
            <div class="tw-w-8/12 sm:tw-w-10/12">
              <img src="/images/entrada.png" class="tw-mx-auto hover:tw-cursor-pointer"
                @click="modalInfoEntradas = true" />
            </div>
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="formMeta.reset()" />
            </div>
          </q-card-section>
          <q-card-section>
            <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
              <div class="q-gutter-y-md">
                <q-input outlined v-model="formMeta.nome" label="Título*" />
                <q-input outlined v-model="formMeta.descricao" label="Descrição" />
                <q-input v-model.number="formMeta.valor" type="number" outlined label="Valor*" min="0.01" step="0.01" />
                <q-select outlined v-model="formMeta.duracao" label='Longo Prazo' disable />
              </div>
            </div>
          </q-card-section>
          <div class="tw-w-full tw-text-center tw-mb-2">
            <button type="button" @click="lancarMeta('Longo')">
              <span class="material-icons md-36">task_alt</span>
            </button>
          </div>
        </q-card>
      </q-dialog>
      <DialogBaixo v-model="formNulo" :value="'Preencha todos os campos obrigatórios. (Marcados com *)'"
        :icon="'error'"></DialogBaixo>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import dayjs from "dayjs";
export default {
  props: {
    agendamentos: Object
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
        data: { listaExclusao: this.listaExclusao },
      });
    },

    lancarMeta(i) {
      if (this.formMeta.nome == "" || this.formMeta.valor == "") {
        this.formNulo = true;
      } else {
        this.formMeta.duracao = i;
        this.formMeta.post(route("adicionar.meta"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.modalCurto = false;
            this.modalmedio = false;
            this.modalLongo = false;
            this.formMeta.reset();
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
  },

  data() {
    return {
      modalEntradas: false,
      modalSaidas: false,
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
      listaExclusao: [],
      apagarAgendamento: false,
    }
  },
};
</script>

<style scoped>
.fundo {
  background-color: black;
  max-width: 310px;
  border-radius: 20px;
}

.topo {
  background-color: white;
  text-align: center;
  width: 300px;
  height: 360px;
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
  height: 360px;
}

.tempo {
  background-color: #1ed760;
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

.consulta {
  background-color: white;
  text-align: center;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.metas {
  border: 2px solid black;
  border-radius: 20px;
  text-align: center;
}
</style>
