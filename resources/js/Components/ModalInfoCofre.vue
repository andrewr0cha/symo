<template>
    <q-dialog v-model="dialog" position="left" rounded>
        <q-card style="width: 300px; max-width: 60vh">
            <q-card-section class="row items-center q-pb-none">
                <q-btn icon="info" flat round dense />
                <q-space />
                <q-btn icon="close" flat round dense v-close-popup />
            </q-card-section>
            <q-card-section>
                <span>Este é o cofre. Todo o dinheiro posto aqui é subtraído do saldo e fica guardado. Usamos a quantia guardada para calcular a progressão das metas cadastradas. Há dois formulários: o primeiro para guardar dinheiro no cofre; e o segundo para retirar. Toda quantia retirada volta a integrar o saldo disponível. Lembre-se de guardar um pouco todo mês para que seus objetivos sejam alcançados😄.</span>
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
   