<script setup>
import { ref } from "vue";
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";

const showingNavigationDropdown = ref(false);
</script>

<template>
  <div>
    <div class="tw-min-h-screen tw-bg-gray-100">
      <nav class="tw-bg-white tw-border-b tw-border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="tw-max-w-7xl tw-mx-auto tw-px-4 sm:tw-px-6 lg:tw-px-8">
          <div class="tw-flex tw-justify-between tw-h-20">
            <div class="tw-flex">
              <!-- Logo -->
              <div class="tw-shrink-0 tw-flex tw-items-center">
                <Link :href="route('dashboard')">
                <BreezeApplicationLogo class="tw-block tw-h-14 tw-w-auto" />
                </Link>
              </div>

              <!-- Navigation Links -->
              <div class="
                                      tw-hidden tw-space-x-8
                                      sm:tw-my-px sm:tw-ml-5 md:tw-ml-10 sm:tw-flex
                                    ">
                <BreezeNavLink :href="route('cartao')" :active="route().current('cartao')" @mouseover="gif = 'cartao'"
                  @mouseleave="gif = ''" @click="soltarGif('cartao')">
                  <img src="/images/credit-card.gif" style="max-height:45px" v-show="gif == 'cartao'" />
                  <img src="/images/credit-card.png" style="max-width:45px" v-show="gif != 'cartao'" />
                </BreezeNavLink>
              </div>
              <div class="
                                      tw-hidden tw-space-x-8
                                      sm:tw-my-px sm:tw-ml-1.5 md:tw-ml-8 sm:tw-flex
                                    ">
                <BreezeNavLink :href="route('consultas')" :active="route().current('consultas')"
                  @mouseover="gif = 'anotação'" @mouseleave="gif = ''" @click="soltarGif('anotação')">
                  <img src="/images/anotação.gif" style="max-height:40px" v-show="gif == 'anotação'" />
                  <img src="/images/anotação.png" style="max-width:40px" v-show="gif != 'anotação'" />
                </BreezeNavLink>
              </div>
              <div class="
                                      tw-hidden tw-space-x-8
                                      sm:tw-my-px sm:tw-ml-1.5 md:tw-ml-8 sm:tw-flex
                                    ">
                <BreezeNavLink :href="route('fluxo')" :active="route().current('fluxo')"
                  @mouseover="gif = 'computadorgrafico'" @mouseleave="gif = ''" @click="soltarGif('computadorgrafico')">
                  <img src="/images/computadorgrafico.gif" style="max-height:40px" v-show="gif == 'computadorgrafico'" />
                  <img src="/images/computadorgrafico.png" style="max-width:40px" v-show="gif != 'computadorgrafico'" />
                </BreezeNavLink>
              </div>
              <div class="
                                      tw-hidden tw-space-x-8
                                      sm:tw-my-px sm:tw-ml-1.5 md:tw-ml-8 sm:tw-flex
                                    ">
                <BreezeNavLink :href="route('simulacao')" :active="route().current('simulacao')"
                  @mouseover="gif = 'apresentacao'" @mouseleave="gif = ''" @click="soltarGif('apresentacao')">
                  <img src="/images/apresentacao.gif" style="max-height:40px" v-show="gif == 'apresentacao'" />
                  <img src="/images/apresentacao.png" style="max-width:40px" v-show="gif != 'apresentacao'" />
                </BreezeNavLink>
              </div>
              <div class="
                                      tw-hidden tw-space-x-8
                                      sm:tw-my-px sm:tw-ml-1.5 md:tw-ml-8 sm:tw-flex
                                    ">
                <BreezeNavLink :href="route('grupo')" :active="route().current('grupo')" @mouseover="gif = 'porcofofo'"
                  @mouseleave="gif = ''" @click="soltarGif('porcofofo')">
                  <img src="/images/porcofofo.gif" style="max-height:40px" v-show="gif == 'porcofofo'" />
                  <img src="/images/porcofofo.png" style="max-width:40px" v-show="gif != 'porcofofo'" />
                </BreezeNavLink>

              </div>
            </div>

            <div class="tw-hidden sm:tw-flex sm:tw-items-center sm:tw-ml-6">
              <!-- Settings Dropdown -->
              <div class="
                                      tw-hidden tw-space-x-8
                                      sm:tw-my-px sm:tw-ml-1.5 md:tw-ml-8 sm:tw-flex tw-h-full
                                    ">
                <BreezeNavLink :href="route('usuario')" :active="route().current('usuario')" @mouseover="gif = 'perfil'"
                  @mouseleave="gif = ''" @click="soltarGif('perfil')">
                  <img src="/images/perfil.gif" style="max-width:40px" v-show="gif == 'perfil'" />
                  <img src="/images/perfil.png" style="max-width:40px" v-show="gif != 'perfil'" />
                </BreezeNavLink>
              </div>
              <div class="tw-ml-3 tw-relative">
                <BreezeDropdown align="right" width="48">
                  <template #trigger>
                    <span class="tw-inline-flex tw-rounded-md">
                      <button type="button" class="
                                              tw-inline-flex
                                              tw-items-center
                                              tw-px-3
                                              tw-py-2
                                              tw-border
                                              tw-border-transparent
                                              tw-text-sm
                                              tw-leading-4
                                              tw-font-medium
                                              tw-rounded-md
                                              tw-text-gray-500
                                              tw-bg-white
                                              hover:tw-text-gray-700
                                              focus:tw-outline-none
                                              tw-transition tw-ease-in-out tw-duration-150
                                            ">
                        {{ $page.props.auth.user.name }}

                        <svg class="tw-ml-2 tw--mr-0.5 tw-h-4 tw-w-4" xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                        </svg>
                      </button>
                    </span>
                  </template>

                  <template #content>
                    <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                      Sair
                    </BreezeDropdownLink>
                  </template>
                </BreezeDropdown>
              </div>
            </div>

            <!-- Hamburger -->
            <div class="tw--mr-2 tw-flex tw-items-center sm:tw-hidden">
              <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="
                                      tw-inline-flex
                                      tw-items-center
                                      tw-justify-center
                                      tw-p-2
                                      tw-rounded-md
                                      tw-text-gray-400
                                      hover:tw-text-gray-500 hover:tw-bg-gray-100
                                      focus:tw-outline-none
                                      focus:tw-bg-gray-100
                                      focus:tw-text-gray-500
                                      tw-transition tw-duration-150 tw-ease-in-out
                                    ">
                <svg class="tw-h-6 tw-w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                  <path :class="{
                    hidden: showingNavigationDropdown,
                    'inline-flex': !showingNavigationDropdown,
                  }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  <path :class="{
                    hidden: !showingNavigationDropdown,
                    'inline-flex': showingNavigationDropdown,
                  }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{
          block: showingNavigationDropdown,
          hidden: !showingNavigationDropdown,
        }" class="sm:tw-hidden">
          <div class="tw-pt-2 tw-pb-3 tw-space-y-1">
            <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
              Dashboard
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('consultas')" :active="route().current('consultas')">
              Consultas
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('agendamentos')" :active="route().current('agendamentos')">
              Eventos
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('metas')" :active="route().current('metas')">
              Metas
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('fluxo')" :active="route().current('fluxo')">
              Fluxo
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('simulacao')" :active="route().current('simulacao')">
              Simulação
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('usuario')" :active="route().current('usuario')">
              Perfil
            </BreezeResponsiveNavLink>
            <BreezeResponsiveNavLink :href="route('grupo')" :active="route().current('grupo')">
              Grupo
            </BreezeResponsiveNavLink>
          </div>

          <!-- Responsive Settings Options -->
          <div class="tw-pt-4 tw-pb-1 tw-border-t tw-border-gray-200">
            <div class="tw-px-4">
              <div class="tw-font-medium tw-text-base tw-text-gray-800">
                {{ $page.props.auth.user.name }}
              </div>
              <div class="tw-font-medium tw-text-sm tw-text-gray-500">
                {{ $page.props.auth.user.email }}
              </div>
            </div>

            <div class="tw-mt-3 tw-space-y-1">
              <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                Sair
              </BreezeResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Heading -->
      <header class="tw-bg-white tw-shadow" v-if="$slots.header">
        <div class="tw-max-w-7xl tw-mx-auto tw-py-6 tw-px-4 sm:tw-px-6 lg:tw-px-8">
          <slot name="header" />
        </div>
      </header>

      <!-- Page Content -->
      <main>
        <slot />
      </main>
    </div>
  </div>
</template>
<script>
export default {
  methods: {
    soltarGif(value) {
      if (this.gif != '') this.gif = '';
      else this.gif = value;
    },
  },

  data() {
    return {
      gif: ''
    }
  },
};
</script>