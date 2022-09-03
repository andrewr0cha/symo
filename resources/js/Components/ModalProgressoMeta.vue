<template>
  <q-dialog v-model="dialog" position="right" rounded class="tw-hidden sm:tw-flex">
    <q-card style="width: 300px; max-width: 60vh; height:180px">
      <q-card-section class="row items-center q-pb-none">
        <q-btn icon="trending_up" flat round dense @click="mostrarValor" />
        <q-space />
        <q-btn icon="close" flat round dense v-close-popup @click="valor = false" />
      </q-card-section>
      <q-card-section>
        <div class="tw-flex tw-inline-flex tw-my-2 tw-w-full tw-text-center">
          <div v-if="progressaoMeta.status == 'Concluída'">
            <span class="tw-text-lg">UHUL!! Essa meta está concluída!! Parabéns!🎉</span>
          </div>
          <div v-else-if="progresso[0] > 1 && progressaoMeta.status == 'Em andamento'">
            <span class="tw-text-lg">Essa meta ainda está em andamento, mas você já poupou o valor ligado à ela!!
              Bom trabalho!🥰</span>
          </div>
          <div v-else-if="progresso[0] > 0.800 && progresso[0] <= 1.000 && progressaoMeta.status == 'Em andamento'">
            <span class="tw-text-lg">Essa meta está quase concluída!! Só mais um pouco!🤑</span>
          </div>
          <div v-else-if="progresso[0] > 0.500 && progresso[0] <= 0.800 && progressaoMeta.status == 'Em andamento'">
            <span class="tw-text-lg">Já passamos da metade!! Continue assim!🤗</span>
          </div>
          <div v-else-if="progresso[0] > 0.400 && progresso[0] <= 0.500 && progressaoMeta.status == 'Em andamento'">
            <span class="tw-text-lg">Essa meta está quase na metade. Você está indo bem!🤭</span>
          </div>
          <div v-else-if="progresso[0] <= 0.400 && progressaoMeta.status == 'Em andamento'">
            <span class="tw-text-lg">Essa meta está começando. Força!💪</span>
          </div>
        </div>
        <q-linear-progress :value="progresso" color="primary" />
        <div v-show="valor == true" class="tw-w-full tw-flex tw-place-content-between">
          <span>R$ {{ valorFormatado(0) }}</span>
          <span>R$ {{ valorFormatado(progresso[1]) }}</span>
        </div>
      </q-card-section>
    </q-card>
  </q-dialog>
</template>
    
<script>
import { emit } from 'process'
import { ref } from 'vue';

export default {
  setup() {
    const dialog = ref(true)

    return {
      dialog,
      open() {
        dialog.value = false
      }
    }
  },

  props: {
    progresso: Array,
    progressaoMeta: Object
  },

  methods: {
    porcentagem(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString() + "%";
    },

    valorFormatado(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    mostrarValor() {
      this.valor = !this.valor;
    }
  },
  data() {
    return {
      slide: ref(1),
      valor: false,
    }
  },
}
</script>