<template>
  <Head title="Consultas" />
  <BreezeAuthenticatedLayout>
    <div class="tw-w-11/12 tw-mx-auto tw-flex tw-mt-4">
      <div
        class="
          tw-w-1/2
          sm:tw-w-1/3
          tw-bg-black
          tw-h-max
          tw-flex
          tw-flex-col
          tw-items-center
          tw-justify-center
        "
      >
        <div
          class="
            tw-mt-4 tw-flex tw-inline-flex tw-items-center tw-justify-center
          "
        >
          <span class="tw-text-white">Seu saldo</span>
          <img src="/images/bolsa.png" class="imagem" />
        </div>
        <br />
        <div class="tw-mb-4">
          <span class="tw-text-white"
            >R$ {{ valorFormatado($page.props.auth.user.saldo) }}</span
          >
        </div>
      </div>

      <div class="tw-w-1/2 sm:tw-w-2/3 tw-bg-purple-900">teste 3</div>
    </div>
    <div class="tw-w-11/12 tw-mx-auto sm:tw-flex tw-mt-4 tw-text-center">
      <!--Entradas-->
      <div class="tw-w-11/12 tw-mx-auto sm:tw-w-1/2 sm:tw-pr-4">
        <div class="borda tw-bg-black tw-w-full tw-text-white">Entradas</div>
        <q-scroll-area style="height: 400px">
          <div v-if="entradas != 0" class="tw-w-full">
            <div
              v-for="item in entradas"
              :key="item.id"
              class="tw-mb-2 entrada"
            >
              <q-card class="flex inline-flex">
                <div v-if="apagarEntrada">
                  <input type="checkbox" @click="adicionaItem(item.id)" />
                </div>
                <div class="tw-w-full tw-text-left tw-text-xl tw-pl-2 pb-2">
                  {{ item.nome }}
                </div>
                <div
                  class="
                    tw-w-full
                    tw-flex
                    tw-inline-flex
                    tw-items-center
                    tw-justify-center
                  "
                >
                  <div class="tw-w-1/6">
                    {{ item.id }}
                  </div>
                  <div class="tw-w-3/6">
                    {{ item.descricao }}
                  </div>
                  <div class="tw-w-2/6">
                    <div class="tw-text-green-500">
                      +R$ {{ valorFormatado(item.valor) }}
                    </div>
                    {{ dataFormatada(item.data) }}
                  </div>
                </div>
              </q-card>
            </div>
          </div>
          <div v-else class="tw-flex tw-h-96">
            <span
              class="
                tw-h-full tw-w-full tw-flex tw-items-center tw-justify-center
              "
              >Ainda não existem entradas em sua conta.</span
            >
          </div>
        </q-scroll-area>
        <div class="tw-text-left tw-mt-2 tw-flex tw-inline-flex">
          <div
            v-if="!apagarEntrada"
            class="tw-text-left tw-mt-2 tw-flex tw-inline-flex"
          >
            <span class="material-icons md-36" @click="modalEntradas = true">
              add_circle_outline
            </span>
            <span class="material-icons md-36" @click="apagarentrada">
              remove_circle_outline
            </span>
          </div>
          <div v-else>
            <button
              class=""
              @click="(apagarEntrada = false), (listaExclusao = [])"
            >
              Cancelar
            </button>
            <button class="" @click="excluirEntrada">Confirmar</button>
          </div>
        </div>
      </div>
      <!--Saidas-->
      <div class="tw-w-11/12 tw-mx-auto sm:tw-w-1/2 sm:tw-pl-4">
        <div class="borda tw-bg-black tw-w-full tw-text-white">Saídas</div>
        <q-scroll-area style="height: 400px">
          <div v-if="saidas != 0" class="tw-w-full">
            <div v-for="item in saidas" :key="item.id" class="tw-mb-2 entrada">
              <q-card class="flex inline-flex">
                <div v-if="apagarSaida">
                  <input type="checkbox" @click="adicionaItem(item.id)" />
                </div>
                <div class="tw-w-full tw-text-left tw-text-xl tw-pl-2 pb-2">
                  {{ item.nome }}
                </div>
                <div
                  class="
                    tw-w-full
                    tw-flex
                    tw-inline-flex
                    tw-items-center
                    tw-justify-center
                  "
                >
                  <div class="tw-w-1/6">
                    {{ item.id }}
                  </div>
                  <div class="tw-w-3/6">
                    {{ item.descricao }}
                  </div>
                  <div class="tw-w-2/6">
                    <div class="tw-text-red-500">
                      -R$ {{ valorFormatado(item.valor) }}
                    </div>
                    {{ dataFormatada(item.data) }}
                  </div>
                </div>
              </q-card>
            </div>
          </div>
          <div v-else class="tw-flex tw-h-96">
            <span
              class="
                tw-h-full tw-w-full tw-flex tw-items-center tw-justify-center
              "
              >Ainda não existem saídas em sua conta.</span
            >
          </div>
        </q-scroll-area>
        <div
          v-if="!apagarSaida"
          class="tw-text-left tw-mt-2 tw-flex tw-inline-flex"
        >
          <span class="material-icons md-36" @click="modalSaidas = true">
            add_circle_outline
          </span>
          <span class="material-icons md-36" @click="apagarsaida">
            remove_circle_outline
          </span>
        </div>
        <div v-else>
          <button class="" @click="(apagarSaida = false), (listaExclusao = [])">
            Cancelar
          </button>
          <button class="" @click="excluirSaida">Confirmar</button>
        </div>
      </div>
    </div>
    <!--modal entradas-->
    <q-dialog
      v-model="modalEntradas"
      persistent
      transition-show="scale"
      transition-hide="scale"
    >
      <q-card style="width: 500px; max-width: 60vw">
        <q-card-section class="row items-center q-pb-none">
          <div class="text-h6">Lançamento de Entrada</div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>
        <q-card-section>
          <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
            <div class="q-gutter-y-md">
              <q-input
                rounded
                outlined
                v-model="form.nome"
                label="Título*"
                @click="mudarStatus"
              />
              <q-input
                v-model.number="form.valor"
                type="number"
                rounded
                outlined
                label="Valor*"
                min="0.01"
                step="0.01"
                @click="mudarStatus"
              />
              <q-select
                rounded
                outlined
                v-model="form.id_categoria"
                :options="categoriasEntrada"
                label="Categoria*"
              />
              <q-input
                rounded
                outlined
                v-model="form.descricao"
                label="Descrição*"
                @click="mudarStatus"
              />
            </div>
          </div>
        </q-card-section>
        <button type="button" @click="lancarEntrada">
          <span class="material-icons md-36">task_alt</span>
        </button>
      </q-card>
    </q-dialog>
    <!--modal saídas-->
    <q-dialog
      v-model="modalSaidas"
      persistent
      transition-show="scale"
      transition-hide="scale"
    >
      <q-card style="width: 500px; max-width: 60vw">
        <q-card-section class="row items-center q-pb-none">
          <div class="text-h6">Lançamento de Saída</div>
          <q-space />
          <q-btn icon="close" flat round dense v-close-popup />
        </q-card-section>
        <q-card-section>
          <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
            <div class="q-gutter-y-md">
              <q-input
                rounded
                outlined
                v-model="form.nome"
                label="Título*"
                @click="mudarStatus"
              />
              <q-input
                v-model.number="form.valor"
                type="number"
                rounded
                outlined
                label="Valor*"
                min="0.01"
                step="0.01"
                @click="mudarStatus"
              />
              <q-select
                rounded
                outlined
                v-model="form.id_categoria"
                :options="categoriasSaida"
                label="Categoria*"
              />
              <q-input
                rounded
                outlined
                v-model="form.descricao"
                label="Descrição*"
                @click="mudarStatus"
              />
            </div>
          </div>
        </q-card-section>
        <button type="button" @click="lancarSaida">
          <span class="material-icons md-36">task_alt</span>
        </button>
      </q-card>
    </q-dialog>
    <!--form nulo-->
    <DialogBaixo
      v-if="formNulo == true"
      :value="'Preencha todos os campos obrigatórios. (Marcados com *)'"
      :icon="'error'"
    ></DialogBaixo>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Head from "@inertiajs/inertia-vue3";
import DialogBaixo from "@/Components/DialogBaixo.vue";
import { ref } from "vue";
const modalEntradas = ref(false);
const modalSaidas = ref(false);
defineExpose({ modalEntradas, modalSaidas });
</script>

<script>
import dayjs from "dayjs";
export default {
  props: {
    entradas: Object,
    saidas: Object,
    categoriasEntrada: Object,
    categoriasSaida: Object,
    id: Object,
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

    mudarStatus() {
      this.formNulo = false;
    },

    lancarEntrada() {
      if (
        this.form.nome == "" ||
        this.form.valor == "" ||
        this.form.id_categoria == ""
      ) {
        this.formNulo = true;
      } else {
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

.imagem {
  display: inline-block;
  margin-right: 5px;
  width: 30px;
}

.entrada :hover {
  background-color: #59f792;
}
</style>