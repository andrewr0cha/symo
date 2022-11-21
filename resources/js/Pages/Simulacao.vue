<template>

  <Head title="Simulação" />
  <BreezeAuthenticatedLayout>
    <div class="tw-text-center tw-w-full tw-bg-neutral-800 tw-pb-2">
      <div
        class="tw-mx-auto tw-my-4 tw-w-11/12 tw-flex tw-inline-flex tw-border-double tw-border-4 tw-border-cyan-600 tw-p-2">
        <div class="tw-w-1/2 md:tw-w-1/3 tw-flex tw-items-center">
          <div class="tw-w-full md:tw-w-2/3  tw-text-white ">
            <q-select bg-color="white" label-color="primary" color="black" outlined bottom-slots bordeless rounded
              v-model="model" :options="meses" label="Mês" dense @update:model-value="troca(model)" class="tw-w-full" />

            <q-btn color="primary" label="Salvar" no-caps @click="salvar" class="hover:tw-cursor-pointer" />
            <div v-if="pos == -1" class="tw-mt-4 tw-w-full tw-text-center">Selecione um mês para ver a
              lista.
            </div>
            <div v-else-if="dados1[pos] == 0" class="tw-mt-4 tw-w-full tw-text-center">Não há dados para o mês
              selecionado.
            </div>
          </div>
        </div>
        <div class="tw-w-1/2 md:tw-w-1/3">
          <div class="tw-w-full tw-flex tw-text-white tw-flex tw-flex-col">
            <q-scroll-area style="height: 335px" :content-style="{}">
              <div v-for="item in dados1[pos]" class="tw-mb-2 entrada tw-w-11/12 tw-mx-auto">
                <q-card class="flex inline-flex">
                  <div class="tw-w-11/12 tw-text-left tw-text-xl tw-pl-2 pb-2 tw-text-black">
                    {{ item.nome }}
                  </div>
                  <div class="
                    tw-w-full
                    tw-flex
                    tw-inline-flex
                    tw-items-center
                    tw-justify-left
                  ">
                    <div class="tw-w-4/12">
                    </div>
                    <div class="tw-w-7/12">
                      <div v-if="item.tipo == 'entrada'" class="tw-text-green-600">
                        +R$ {{ valorFormatado(item.valor) }}
                      </div>
                      <div v-else class="tw-text-red-600">
                        -R$ {{ valorFormatado(item.valor) }}
                      </div>
                    </div>
                    <div v-if="apagando" class="tw-w-2/12>">
                      <input type="checkbox" class="hover:tw-cursor-pointer" @click="adicionaItem(item.id)" />
                    </div>
                  </div>
                </q-card>
              </div>
            </q-scroll-area>
            <div class="tw-justify-center tw-mt-2 tw-flex tw-inline-flex">
              <div v-if="datas != '' && apagando == false" class="tw-text-left tw-mt-2 tw-flex tw-inline-flex">
                <q-btn color="primary" icon="add_circle_outline" @click="modal = true" no-caps
                  class="hover:tw-cursor-pointer tw-mr-2" />
                <q-btn color="primary" icon="remove_circle_outline" @click="apagando = true" no-caps
                  class="hover:tw-cursor-pointer" />
              </div>
              <div v-if="apagando == true" class="tw-text-left tw-mt-2 tw-flex tw-inline-flex">
                <q-btn color="primary" label="Cancelar" no-caps @click="{ apagando=false; listaExclusao=[] }"
                  class="hover:tw-cursor-pointer tw-mr-2" />
                <q-btn color="primary" label="Apagar" no-caps @click="apagar" class="hover:tw-cursor-pointer" />
              </div>
            </div>
          </div>
        </div>
        <div class="tw-hidden md:tw-flex md:tw-w-1/3">
          <div class="tw-w-full tw-flex tw-text-white tw-flex tw-items-center">
            <div
              class="tw-bg-white tw-mx-auto tw-h-28 tw-w-28 md:tw-h-40 md:tw-w-40 tw-p-2 borda tw-flex tw-items-center ">
              <div>
                <div class="tw-text-lg tw-text-black">O saldo do mês é:</div>
                <div v-if="diferenca < 0" class="tw-text-lg tw-text-red-600">R$
                  {{ valorFormatado(diferenca * (-1)) }} </div>
                <div v-else class="tw-text-lg tw-text-green-600">R$ {{ valorFormatado(diferenca) }} </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="tw-w-11/12 tw-mx-auto ">
        <LineChart :chartData="chartDataLinha" class="tw-bg-white tw-p-6 " />
      </div>
    </div>
    <q-dialog v-model="modal" persistent transition-show="scale" transition-hide="scale" rounded>
      <q-card style="width: 500px; max-width: 80vw">
        <q-card-section class="row items-center q-pb-none">
          <div class="tw-flex tw-inline-flex tw-w-full tw-my-4 tw-items-center">
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="help_outline" flat round dense />
            </div>
            <div class="tw-w-8/12 sm:tw-w-10/12">
              <img src="/images/entrada.png" class="tw-mx-auto" />
            </div>
            <div class="tw-w-2/12 sm:tw-w-1/12">
              <q-btn icon="close" flat round dense v-close-popup @click="{ nome=''; valor=''; }" />
            </div>
          </div>
        </q-card-section>
        <q-card-section>
          <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
            <div class="q-gutter-y-md">
              <q-input outlined v-model="nome" label="Título*" />
              <q-input v-model="valor" mask="###.###,##" reverse-fill-mask hint="Preencha duas casas decimais" outlined
                label="Valor*" min="0.01" step="0.01" />
              <q-radio v-model="tipo" val="entrada" label="Entrada" />
              <q-radio v-model="tipo" val="saida" label="Saída" />
            </div>
          </div>
        </q-card-section>
        <div class="tw-w-full tw-text-center tw-mb-2">
          <button type="button" @click="lancar">
            <span class="material-icons md-36">task_alt</span>
          </button>
        </div>
      </q-card>
    </q-dialog>
    <DialogBaixo v-model="formNulo" :value="'Preencha todos os campos obrigatórios. (Marcados com *)'" :icon="'error'">
    </DialogBaixo>
    <DialogBaixo v-model="formInvalido" :value="'Insira um valor válido no campo Valor do formulário.'" :icon="'error'"
      class="tw-hidden sm:tw-flex">
    </DialogBaixo>
  </BreezeAuthenticatedLayout>
</template>
  
<style scoped>
.borda {
  border-radius: 100%
}

.borda2 {
  border-radius: 50px 50px 50px 50px
}
</style>
<script setup>
import LineChart from '@/Components/Line.ts';
import DialogBaixo from "@/Components/DialogBaixo.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
const modal = ref(false);
defineExpose({ modal });

</script>
<script>
import { ref } from "vue";
export default {
  props: {
    meses: Array,
    meses2: Array,
    lista: Object,
    dados: Object
  },
  methods: {
    valorFormatado(value) {
      let val = (value / 1).toFixed(2).replace(".", ",");
      return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    },

    porcentagem(value) {
      if (value == 0) return value.toString() + "%";
      else {
        let val = (value / 1).toFixed(0).replace(".", ",");
        return val.toString() + "%";
      }
    },

    troca(value) {
      this.pos = this.meses.indexOf(value);
      this.datas = this.meses2[this.pos];
      this.dados1 = this.lista;
      this.diferenca = this.dados[0][this.pos] - this.dados[1][this.pos];
    },

    salvar() {
      this.$inertia.post(route("salvar.simulacao"), this.dados1, {
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
          this.modalFiltroEntrada = false;
        },
      });
    },

    lancar() {
      var valor = this.valor.replace(".", "").replace(",", ".");
      if (this.nome == "" || this.valor == "") {
        this.formNulo = true;
      } else if (Number(valor) > 99999999) {
        this.formInvalido = true;
      } else {
        var a = ({
          id: null,
          nome: "",
          tipo: ref('entrada'),
          valor: "",
          data: "",
          tipo: "",
        })
        a.nome = this.nome;
        a.valor = valor;
        a.tipo = this.tipo;
        a.data = this.meses2[this.pos];
        this.dados1[this.pos].push(a)
        if (a.tipo == 'entrada') {

          this.dados[0][this.pos] += parseFloat(a.valor);
        }
        else if (a.tipo == 'saida') {
          this.dados[1][this.pos] += parseFloat(a.valor);
        }
        this.modal = false;
      }
    },

    adicionaItem(id) {
      if (id == null) { return }
      else if (this.listaExclusao.includes(id)) {
        var pos = this.listaExclusao.indexOf(id);
        this.listaExclusao.splice(pos, 1);
      } else this.listaExclusao.push(id);
    },

    apagar() {
      this.$inertia.visit(route("excluir.simulacao"), {
        method: "post",
        data: { listaExclusao: this.listaExclusao },
      });
    },
  },

  data() {
    return {
      slide: ref(1),
      grafico: ref(1),
      model: '',
      nome: "",
      tipo: ref('entrada'),
      valor: "",
      datas: "",
      pos: -1,
      diferenca: 0,
      formNulo: false,
      formInvalido: null,
      dados1: [[], [], [], [], [], [], [], [], [], [], [], [], []],
      listaExclusao: [],
      apagando: false,
      chartDataLinha: {
        labels: this.meses,
        datasets: [
          {
            label: 'Entradas',
            backgroundColor: '#33cccc',
            borderColor: '#33cccc',
            data: this.dados[0]
          }, {
            label: 'Saídas',
            backgroundColor: '#FFFFF',
            borderColor: '#FFFFF',
            data: this.dados[1]
          }
        ],
      },
    }
  }
};
</script>
    