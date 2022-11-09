<template>
  <q-dialog v-model="dialog" position="right" rounded class="">
    <q-carousel v-model="slide" vertical height="260px" transition-prev="slide-down" transition-next="slide-up"
      swipeable animated control-color="primary" arrows>
      <q-carousel-slide :name="1" style="width: 350px;">
        <div style="width: 300px; max-width: 60vh; height:180px">
          <div class="row items-center q-pb-none">
            <q-btn icon="trending_up" flat round dense @click="mostrarValor" />
            <q-space />
            <q-btn icon="close" flat round dense v-close-popup
              @click="(valor = false,formMeta.reset(),saldoInsuficiente=false)" />
          </div>
          <div class="tw-flex tw-items-center" style="height:150px">
            <div>
              <div class="tw-flex tw-inline-flex tw-my-2 tw-w-full tw-text-center">
                <div v-if="progressaoMeta.status == 'Concluída'">
                  <span class="tw-text-lg">UHUL!! Essa meta está concluída!! Parabéns!🎉</span>
                </div>
                <div v-else-if="progresso[0] > 1 && progressaoMeta.status == 'Em andamento'">
                  <span class="tw-text-lg">Essa meta ainda está em andamento, mas você já poupou o valor ligado à ela!!
                    Bom trabalho!🥰</span>
                </div>
                <div
                  v-else-if="progresso[0] > 0.800 && progresso[0] <= 1.000 && progressaoMeta.status == 'Em andamento'">
                  <span class="tw-text-lg">Essa meta está quase concluída!! Só mais um pouco!🤑</span>
                </div>
                <div
                  v-else-if="progresso[0] > 0.500 && progresso[0] <= 0.800 && progressaoMeta.status == 'Em andamento'">
                  <span class="tw-text-lg">Já passamos da metade!! Continue assim!🤗</span>
                </div>
                <div
                  v-else-if="progresso[0] > 0.400 && progresso[0] <= 0.500 && progressaoMeta.status == 'Em andamento'">
                  <span class="tw-text-lg">Essa meta está quase na metade. Você está indo bem!🤭</span>
                </div>
                <div v-else-if="progresso[0] <= 0.400 && progressaoMeta.status == 'Em andamento'">
                  <span class="tw-text-lg">Essa meta está começando. Força!💪</span>
                </div>
              </div>
              <q-linear-progress :value="progresso[0]" color="primary" />
              <div v-show="valor == true" class="tw-w-full tw-flex tw-place-content-between">
                <span>R$ {{ valorFormatado(0) }}</span>
                <span>R$ {{ valorFormatado(progresso[1]) }}</span>
              </div>
            </div>
          </div>
        </div>
      </q-carousel-slide>
      <q-carousel-slide :name="2" style="width: 350px; ">
        <q-carousel v-model="slide2" transition-prev="scale" transition-next="scale" swipeable animated
          control-color="primary" height="240px" arrows>
          <q-carousel-slide :name="1">
            <div style="margin-right:30px; width: 250px; max-width: 60vh; height:180px">
              <div class="tw-my-2 tw-w-full tw-text-center">
                <div class="tw-h-6">
                  <div v-if="saldoInsuficiente">
                    <span class="tw-text-red-600">Saldo insuficiente para a ação.</span>
                  </div>
                </div>
                <span>Guardar dinheiro para a meta: <span class="tw-text-cyan-400">{{progresso[3]}}</span></span>
                <q-input v-model="formMeta.valor" mask="###.###,##" reverse-fill-mask
                  hint="Preencha duas casas decimais" outlined label="Valor*" min="0.01" step="0.01" />
              </div>
              <div v-if="progressaoMeta.status!='Concluída'" class="tw-w-full tw-text-center tw-mb-2 tw-mt-4">
                <q-btn @click="guardarMeta($page.props.auth.user.saldo)" icon="task_alt" color="primary"
                  label="Guardar" />
              </div>
              <div v-else class="tw-w-full tw-text-center tw-mb-2 tw-mt-4">
                <q-btn @click="guardarMeta($page.props.auth.user.saldo)" icon="task_alt" color="primary" label="Guardar"
                  disable />
              </div>
            </div>
          </q-carousel-slide>
          <q-carousel-slide :name="2">
            <div style="margin-left:30px; width: 250px; max-width: 60vh; height:215px">
              <div class="tw-my-2 tw-w-full tw-text-center">
                <div class="tw-h-6">
                  <div v-if="saldoInsuficiente">
                    <span class="tw-text-red-600">Saldo insuficiente para a ação.</span>
                  </div>
                </div>
                <span>Retirar dinheiro da meta: <span class="tw-text-cyan-400">{{progresso[3]}}</span></span>
                <br>
                <span>Dinheiro guardado: <span
                    class="tw-text-cyan-400">{{valorFormatado(progressaoMeta.valor_guardado)}}</span></span>
                <q-input v-model="formMeta.valor" mask="###.###,##" reverse-fill-mask
                  hint="Preencha duas casas decimais" outlined label="Valor*" min="0.01" step="0.01" />
              </div>
              <div v-if="progressaoMeta.status!='Concluída'" class="tw-w-full tw-text-center tw-mb-2 tw-mt-4">
                <q-btn @click="retirarMeta(progressaoMeta.valor_guardado)" icon="task_alt" color="primary"
                  label="Retirar" />
              </div>
              <div v-else class="tw-w-full tw-text-center tw-mb-2 tw-mt-4">
                <q-btn @click="retirarMeta(progressaoMeta.valor_guardado)" icon="task_alt" color="primary"
                  label="Retirar" disable />
              </div>
            </div>
          </q-carousel-slide>
        </q-carousel>
      </q-carousel-slide>
    </q-carousel>
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
    },

    guardarMeta(value) {
      this.saldoInsuficiente = false;
      this.formMeta.valor = this.formMeta.valor.replace(".", "").replace(",", ".");
      if (value < this.formMeta.valor) {
        this.saldoInsuficiente = true;
        return;
      }
      else {
        this.formMeta.id = this.progresso[2];
        this.formMeta.post(route("guardar.meta"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.dialog = false;
            this.formMeta.reset();
          },
        });
      }
    },

    retirarMeta(value) {
      this.saldoInsuficiente = false;
      this.formMeta.valor = this.formMeta.valor.replace(".", "").replace(",", ".");
      if (value < this.formMeta.valor) {
        this.saldoInsuficiente = true;
        return;
      }
      else {
        this.formMeta.id = this.progresso[2];
        this.formMeta.post(route("retirar.meta"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.dialog = false;
            this.formMeta.reset();
          },
        });
      }
    }
  },
  data() {
    return {
      slide: ref(1),
      slide2: ref(1),
      valor: false,
      saldoInsuficiente: false,
      formMeta: this.$inertia.form({
        id: '',
        valor: '',
      }),
    }
  },
}
</script>