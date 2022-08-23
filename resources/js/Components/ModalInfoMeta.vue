<template>
    <q-dialog v-model="dialog" position="left" rounded class="tw-hidden sm:tw-flex">
        <q-card style="width: 320px; max-width: 60vh">
          <q-card-section class="row items-center q-pb-none">
            <q-btn icon="info" flat round dense />
            <q-space />
            <q-btn icon="close" flat round dense v-close-popup />
          </q-card-section>
          <q-card-section>
            <span>Aqui são inseridas as suas metas. Tudo aquilo que você pretende alcançar (e a gente pretende te
              ajudar🤩).</span>
            <div class="tw-flex tw-inline-flex tw-mt-2">
              <span><span class="tw-text-green-600 tw-text-lg">Curto Prazo: </span>São aquelas metas urgentes, com prazo
                máximo de um ano. Vamos considerar um ano como
                prazo padrão.</span>
            </div>
            <div class="tw-flex tw-inline-flex tw-mt-2">
              <span><span class="tw-text-green-600 tw-text-lg">Médio Prazo: </span>São metas que têm sua prioridade, mas
                não são urgentes com as de curto prazo. Seus prazos
                variam de um ano a cinco. Como padrão para o prazo, consideraremos três anos.</span>
            </div>
            <div class="tw-flex tw-inline-flex tw-mt-2">
              <span><span class="tw-text-green-600 tw-text-lg">Longo Prazo: </span>Representam aquelas metas que não
                estão ao seu alcance no momento, mas fazem parte de um
                projeto futuro. Juntos, as alcançaremos! Os prazos destas têm mais de cinco anos. Para o padrão,
                usaremos sete anos.</span>
            </div>
            <div class="tw-flex tw-inline-flex tw-mt-2">
              <span>Para calcular como estamos indo, usaremos a quantia disponível no cofre. Não se esqueça de guardar
                um pouco mensalmente😇</span>
            </div>
          </q-card-section>
        </q-card>
    </q-dialog>
</template>

    <script>
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
    }
    </script>
   