<template>
    <q-dialog v-model="dialog" position="left" rounded>
        <q-card style="width: 300px; max-width: 60vh">
            <q-card-section class="row items-center q-pb-none">
                <q-btn icon="info" flat round dense />
                <q-space />
                <q-btn icon="close" flat round dense v-close-popup />
            </q-card-section>
            <q-card-section>
                <span>Aqui são inseridas as movimentações financeiras nas quais você é o pagante.</span>
                <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Título:
                        </span>Campo obrigatório e a principal identificação para aquela movimentação. Poucas palavras
                        que
                        facilitem a lembrança de para onde foi aquele dinheiro.</span></div>
                <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Valor:
                        </span>Quanto dinheiro tal movimentação subtraiu de seu saldo. Campo obrigatório.</span></div>
                <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Categoria:
                        </span>Classificação dada à despesa. Contemplam as despesas consideradas básicas a uma vida
                        saudável
                        financeiramente falando. Campo obrigatório.</span></div>
                <div class="tw-flex tw-inline-flex tw-mt-2"><span><span class="tw-text-green-600 tw-text-lg">Descrição:
                        </span>Campo opcional. Preencha caso exista mais alguma informação importante sobre a
                        movimentação.</span>
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
    }</script>
   