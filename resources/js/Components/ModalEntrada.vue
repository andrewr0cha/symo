<template>
  <q-dialog v-model="dialog" transition-show="scale" transition-hide="scale" persistent rounded
    class="tw-hidden sm:tw-flex">
    <q-card style="width: 500px; max-width: 60vw">
      <q-card-section class="row items-center q-pb-none">
        <div class="tw-w-10/12 sm:tw-w-11/12">
          <img src="/images/entrada.png" class="tw-mx-auto" />
        </div>
        <div class="tw-w-2/12 sm:tw-w-1/12">
          <q-btn icon="close" flat round dense v-close-popup @click="[form.reset(), formNulo = false]" />
        </div>
      </q-card-section>
      <q-card-section>
        <div class="tw-w-9/12 sm:tw-w-9/12 tw-mx-auto">
          <span v-if="formNulo" class="tw-text-red-600 tw-text-lg tw-text-center tw-mb-2">Preencha todos os campos
            obrigatórios. (Marcados com *)</span>
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
</template>

<script>
import { emit } from 'process'
import { ref } from 'vue'
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
  methods: {
    lancarEntrada() {
      if (this.form.nome == "" || this.form.valor == "") {
        this.formNulo = true;
      } else {
        this.form.valor = this.form.valor.replace(".", "").replace(",", ".");
        this.form.post(route("adicionar.entrada"), {
          preserveState: true,
          preserveScroll: true,
          onSuccess: () => {
            this.form.reset();
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
    }
  },
}
</script>
