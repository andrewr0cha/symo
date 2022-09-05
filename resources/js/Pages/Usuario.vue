<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeGuestLayout from "@/Layouts/Guest.vue";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { ref } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DialogBaixo from "@/Components/DialogBaixo.vue";
const modalFoto = ref(false);
defineExpose({ modalFoto });
</script>

<template>

    <Head title="Editar Usuário" />
    <BreezeAuthenticatedLayout>
        <div class="
      tw-min-h-screen tw-flex
      sm:tw-justify-center
      tw-items-left tw-p-6
      sm:tw-pt-0
      tw-bg-gray-900
      tw-flex-col
      md:tw-flex-row
    ">

            <div class="
        sm:tw-max-w-md
        tw-rounded
        tw-m-auto
        tw-px-6
        tw-py-4
        tw-bg-white
        tw-shadow-md
        tw-overflow-hidden
        sm:tw-rounded-lg
        tw-items-center tw-justify-center
      ">
                <div class="tw-flex tw-inline-flex tw-w-full tw-px-4 tw-place-content-between">
                    <q-btn color="primary" label="Foto" @click="modalFoto = true" no-caps />
                    <q-btn color="primary" label="Remover Foto" @click="selecionarFoto('/images/user.png')" no-caps />
                </div>
                <div v-if="form.foto != null" class="tw-flex tw-justify-center tw-mt-2">
                    <img :src=form.foto style="width:80px;" />
                </div>
                <form @submit.prevent="submit" class="tw-w-max-10/12">

                    <BreezeValidationErrors class="tw-mb-4" />
                    <div class="tw-mt-2">
                        <BreezeLabel for="name" value="Nome" />
                        <BreezeInput id="name" type="text" class="tw-mt-1 tw-block tw-w-full" v-model="form.name"
                            required autofocus autocomplete="name" />
                    </div>

                    <div class="tw-mt-4">
                        <BreezeLabel for="email" value="E-mail" />
                        <BreezeInput id="email" type="email" class="tw-mt-1 tw-block tw-w-full" v-model="form.email"
                            required autocomplete="username" />
                    </div>

                    <div class="tw-mt-4">
                        <BreezeLabel for="usuario" value="Usuário" />
                        <BreezeInput id="usuario" type="text" class="tw-mt-1 tw-block tw-w-full" v-model="form.usuario"
                            required autocomplete="usuario" />
                    </div>

                    <div class="tw-text-center tw-mt-4">
                        <BreezeButton :class="{ 'tw-opacity-25': form.processing }" :disabled="form.processing">
                            <span class="material-icons">check_circle_outline</span>
                        </BreezeButton>
                    </div>
                </form>
            </div>
            <div class=" tw-h-10/12 tw-hidden md:tw-w-1/2 md:tw-flex tw-items-end tw-pb-4">
                <img src="/images/porco.png" class="tw-mx-auto" style="height: ;" />
            </div>
        </div>
        <!-- escolher uma foto -->
        <q-dialog v-model="modalFoto">
            <q-card style="width: 450px; max-width: 80vw; height:420px;">
                <q-card-section style="height: 400px;">
                    <q-scroll-area style="height:400px">
                        <div class="tw-w-full tw-mx-auto tw-flex tw-inline flex">
                            <div v-for="item in fotos">
                                <img :src="item" @click="selecionarFoto(item), modalFoto = false"
                                    class="hover:tw-cursor-pointer tw-m-2" style="width:80px" />
                            </div>
                        </div>
                    </q-scroll-area>
                </q-card-section>
            </q-card>
        </q-dialog>
    </BreezeAuthenticatedLayout>
</template>


<script>
export default {
    props: {
        user: Object,
    },
    methods: {
        submit() {
            this.form.post(route("alterar.usuario"));
        },

        selecionarFoto(item) {
            this.form.foto = item;
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
                usuario: this.user.usuario,
                foto: this.user.foto,
            }),
            fotos: ['/images/baleia.png', '/images/cao.png', '/images/caracol.png', '/images/coelho.png',
                '/images/crocodilo.png', '/images/elefante.png', '/images/gato.png', '/images/girafa.png',
                '/images/leao.png', '/images/macaco.png', '/images/pinguim.png', '/images/polvo.png',
                '/images/porco_icon.png', '/images/ra.png', '/images/tartaruga.png', '/images/tigre.png',
                '/images/urso.png', '/images/urso-panda.png', '/images/vaca.png', '/images/zebra.png',]

        }
    }
};
</script>