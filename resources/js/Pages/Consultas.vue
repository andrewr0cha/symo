<template>
  <Head title="Consultas" />
  <BreezeAuthenticatedLayout>
    <div class="tw-w-11/12 tw-mx-auto tw-bg-red-300 tw-flex tw-mt-4">
      <div class="tw-w-1/2 sm:tw-w-1/3 tw-bg-gray-900">teste 2</div>
      <div class="tw-w-1/2 sm:tw-w-2/3 tw-bg-purple-900">teste 3</div>
    </div>

    <div class="tw-w-11/12 tw-mx-auto sm:tw-flex tw-mt-4 tw-text-center">
      <div class="tw-w-11/12 tw-mx-auto sm:tw-w-1/2 sm:tw-pr-4">
        <div class="borda tw-bg-black tw-w-full tw-text-white">Entradas</div>
        <div class="tw-w-full">
          <div v-for="item in entradas" :key="item.id" class="tw-mb-2 entrada">
            <q-card class="flex inline-flex">
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
        <div class="tw-text-left tw-pl-4">
          <div @click="modalEntradas = true">
            <span class="material-icons md-36"> add_circle_outline </span>
          </div>
          <span class="material-icons md-36"> remove_circle_outline </span>
        </div>
      </div>
      <div class="tw-w-11/12 tw-mx-auto sm:tw-w-1/2 sm:tw-pl-4">
        <div class="borda tw-bg-black tw-w-full tw-text-white">Saídas</div>
        <div v-for="item in saidas" :key="item.id">
          {{ item.id }}<br />
          {{ item.nome }}<br />
          {{ item.valor }}<br />
          {{ item.data }}<br />
          {{ item.descricao }}<br />
        </div>
        <div class="tw-text-left tw-pl-4">
          <span class="material-icons md-36"> add_circle_outline </span>
          <span class="material-icons md-36"> remove_circle_outline </span>
        </div>
      </div>
    </div>
    <form method="post" action="{{route('adicionar.entrada')}}">
      <q-dialog
        v-model="modalEntradas"
        persistent
        transition-show="scale"
        transition-hide="scale"
      >
        <q-card>
          <q-card-section class="row items-center q-pb-none">
            <div class="text-h6">Close icon</div>
            <q-space />
            <q-btn icon="close" flat round dense v-close-popup />
          </q-card-section>
          <q-card-section>
            <div class="tw-w-7/12 sm:tw-w-5/12 tw-mx-auto">
              <input type="hidden" v-model="formEntrada.id_usuario" />
              <input
                type="text"
                v-model="formEntrada.nome"
                placeholder="Título*"
                class="bordaCompleta tw-p-2 tw-mb-2"
              />
              <input
                type="number"
                v-model="formEntrada.valor"
                min="0.01"
                step="0.01"
                placeholder="Valor*"
                class="bordaCompleta tw-p-2 tw-mb-2"
              />
              <input
                list="categorias"
                v-model="formEntrada.id_categoria"
                placeholder="Categoria*"
                class="bordaCompleta tw-p-2 tw-mb-2"
              />
              <datalist id="categorias">
                <option v-for="categoria in categorias" :key="categoria.id">
                  {{ categoria.nome }}
                </option>
              </datalist>
              <input
                type="text"
                v-model="formEntrada.descricao"
                placeholder="Descrição"
                class="bordaCompleta tw-p-2 tw-mb-2"
              />
            </div>
          </q-card-section>
          <button type="button" @click="lancarEntrada">
            <span class="material-icons md-36">task_alt</span>
          </button>
        </q-card>
      </q-dialog>
    </form>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import Head from "@inertiajs/inertia-vue3";
import { ref } from "vue";
const modalEntradas = ref(false);
defineExpose({ modalEntradas });
</script>

<script>
import dayjs from "dayjs";
export default {
  props: {
    entradas: Object,
    saidas: Object,
    categorias: Object,
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

    lancarEntrada() {
      this.formEntrada.post(route("adicionar.entrada"));
    },
  },
  data() {
    return {
      formEntrada: this.$inertia.form({
        id_usuario: null,
        nome: null,
        id_categoria: null,
        valor: null,
        descricao: null,
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

.bordaCompleta {
  border: 2px solid black;
  border-radius: 20px;
  width: 100%;
}

.entrada :hover {
  background-color: #59f792;
}
</style>