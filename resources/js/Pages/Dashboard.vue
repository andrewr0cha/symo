<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButon from "@/Components/Button.vue";
import Texto from "@/Components/Text.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>

<template>
  <Head title="Página Inicial" />

  <BreezeAuthenticatedLayout>
    <div class="tw-flex">
      <div
        class="
          tw-flex
          tw-flex-col
          tw-h-screen
          tw-px-4
          tw-py-8
          tw-overflow-y-auto
          tw-border-r
        "
        style="width: 700px !important"
      >
        <div class="tw-flex tw-flex-col tw-mx-auto">
          <aside>
            <div class="tw-flex sm:tw-max-w-7xl tw-mx-auto">
              <div class="fundo tw-flex sm:tw-max-w-2/6 tw-mr-4 tw-pl-5">
                <div class="topo tw-mx-auto sm:tw-max-w-2/6 tw-pl-2">
                  <img
                    class="
                      tw-rounded tw-max-w-40 tw-max-h-40 tw-mx-auto tw-pt-1
                    "
                    src="/images/user.png"
                  />
                  Boa noite, {{ $page.props.auth.user.name }}
                  <img src="/images/noite.png" class="imagem" />
                  <hr />
                  <div class="tw-mt-5">
                    <Texto class="tw-w-8/10 tw-text-center tw-p-4">
                      <!--<img src="/images/carteira.png" />-->
                      Seu saldo: {{ $page.props.auth.user.saldo }}
                    </Texto>
                  </div>

                  <div class="tw-mt-5">
                    <Texto class="tw-w-8/10 tw-text-center tw-p-4">
                      <img src="/images/carteira.png" class="imagem" />
                      Despesas
                    </Texto>
                  </div>
                </div>
              </div>
            </div>
          </aside>
        </div>
      </div>
      <div
        class="
          tw-hidden
          sm:tw-inline-flex
          tw-w-full
          tw-h-full
          tw-flex
          tw-flex-col
          tw-overflow-y-auto
          tw-py-8
          tw-px-4
        "
      >
        <!-- Calendario -->
        <div class="tw-flex tw-border-1 tw-border-dotted">
          <br />
          <div
            class="calendario tw-hidden sm:tw-inline-flex sm:tw-w-full tw-pl-4"
          >
            <div class="tempo tw-w-2/5"></div>
            <div class="topo-calendario tw-w-3/5"></div>
          </div>
        </div>

        <!-- Painel de Ações 2 -->
        <div class="tw-flex">
          <div
            class="consulta tw-hidden sm:tw-block sm:tw-w-full tw-mt-4 tw-p-2"
          >
            <div class="tw-flex-auto tw-w-full">Suas Operações</div>
            <div
              class="
                tw-inline-flex
                tw-flex-auto
                tw-w-full
                tw-mt-4
                tw-items-center
                tw-justify-center
              "
            >
              <div class="tw-w-1/3 tw-mr-2 tw-min-w-32">
                <Link :href="route('consultas', { id: $page.props.auth.user.id })">
                  <Texto class="tw-w-full tw-text-center tw-p-2"
                    >Consultar</Texto
                  >
                </Link>
              </div>
              <div class="tw-w-1/3 tw-mr-2 tw-min-w-32">
                <Texto class="tw-w-full tw-text-center tw-p-2">Despesas</Texto>
              </div>
              <div class="tw-w-1/3 tw-min-w-32">
                <Texto class="tw-w-full tw-text-center tw-p-2">Entradas</Texto>
              </div>
            </div>
          </div>
        </div>

        <!--metas-->
        <div class="tw-flex tw-mt-4">
          <div class="tw-inline-flex tw-flex-auto tw-w-full tw-mt-4">
            <div class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-mr-4 tw-p-2">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center"
                >Minhas metas a curto prazo</span
              >
            </div>
            <div class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-mr-4 tw-p-2">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center"
                >Minhas metas a medio prazo</span
              >
            </div>
            <div class="metas tw-w-1/3 tw-h-32 tw-min-h-full tw-p-2">
              <span class="tw-h-full tw-flex tw-items-center tw-justify-center"
                >Minhas metas a longo prazo</span
              >
            </div>
          </div>
        </div>

        <!-- Resumo das categorias 
      <div
        class="
          fundo
          hidden
          sm:inline-flex
          max-w-2/6
          h-min
          mt-10
          pl-2
          p-5
          text-white
        "
      >
        <img src="/images/carteira.png" class="imagem ml-6" /> 45%
        <img src="/images/carteira.png" class="imagem ml-6" /> 45%
        <img src="/images/carteira.png" class="imagem ml-6" /> 45%
      </div>-->
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<style scoped>
.fundo {
  background-color: black;
  max-width: 310px;
  border-radius: 20px;
}

.topo {
  background-color: white;
  text-align: center;
  width: 300px;
  height: 360px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.imagem {
  display: inline-block;
  margin-right: 5px;
  width: 30px;
}

.calendario {
  background-color: black;
  border-radius: 20px;
  height: 360px;
}
.tempo {
  background-color: #1ed760;
  height: 360px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}
.topo-calendario {
  background-color: white;
  height: 360px;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.consulta {
  background-color: white;
  text-align: center;
  border-radius: 20px;
  padding-right: 5px;
  border: 2px solid black;
}

.metas {
  border: 2px solid black;
  border-radius: 20px;
  text-align: center;
}
</style>
