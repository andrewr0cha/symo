<template>

  <Head title="Grupo" />
  <BreezeAuthenticatedLayout>
    <div class="tw-text-center tw-w-full tw-bg-neutral-800">
      <div class="tw-w-11/12 tw-mx-auto tw-flex tw-justify-center tw-pt-4">
        <img src="/images/caderno.png" style="max-height:64px">
        <div class="tw-flex tw-items-center tw-text-white tw-ml-4 ">
          <span class="tw-text-lg">Quem somos? </span>
        </div>
      </div>
      <div class="tw-w-11/12 tw-mx-auto  tw-flex tw-inline-flex tw-mt-4">

        <div class="tw-mr-4 tw-w-full md:tw-w-1/2 tw-text-white tw-my-auto">
          <div>A Symo, abrevida do inglês "Save your money" e traduzido para o português "Guarde seu dinheiro", é um
            projeto criado para o trabalho de conclusão de curso (TCC),na área de informática do Colégio Técnico
            Industrial - Isaac Portal Roldan no ano de 2022. A missão da Symo é propor condições adequadas para a
            estabilização financeira individual ou familiar. O sistema envolverá conceitos contábeis, como entradas e
            saídas, bem como formas de gerar e apresentar dados acerca da vida financeira do usuário a partir dos dados
            inseridos por ele no site.
          </div>
          <div class="tw-w-full tw-flex tw-inline-flex tw-mt-6 tw-items-center">
            <div class="tw-bg-white borda tw-p-3  " style="width:65px; height:65px"> <img src="/images/o-email.gif"
                style="max-width:40px"></div>
            <div class="tw-ml-2"> projetosymo@gmail.com </div>
          </div>
        </div>
        <div class="tw-w-1/2 tw-hidden md:tw-flex ">
          <img src="/images/sentados.jpeg" class="tw-border-double tw-border-4 tw-border-cyan-600 tw-mx-auto "
            style="height:280px;">
        </div>

      </div>
      <div class="tw-w-11/12 tw-mx-auto tw-flex tw-flex-col md:tw-flex-row tw-mt-8 tw-place-content-center">
        <div class="tw-w-full md:tw-w-1/6 tw-mt-2">
          <div class="aluno tw-mx-auto andrew borda tw-mx-auto ">
            <img src="/images/codigo.png" style="max-width:40px">
          </div>
          <div class="tw-mt-2 tw-text-white">Andrew</div>
          <div class="tw-mt-2 tw-text-white">Líder</div>
        </div>
        <div class="tw-w-full md:tw-w-1/6 tw-mt-2">
          <div class="aluno tw-mx-auto carol borda tw-mx-auto">
            <img src="/images/codigo.png" style="max-width:40px">
          </div>
          <div class="tw-mt-2 tw-text-white">Carolina</div>
          <div class="tw-mt-2 tw-text-white">Vice-Líder</div>
        </div>
        <div class="tw-w-full md:tw-w-1/6 tw-mt-2">
          <div class="aluno tw-mx-auto enzo borda tw-mx-auto">
            <img src="/images/codigo.png" style="max-width:40px">
          </div>
          <div class="tw-mt-2 tw-text-white">Enzo</div>
          <div class="tw-mt-2 tw-text-white">Desenvolvedor</div>
        </div>
        <div class="tw-w-full md:tw-w-1/6 tw-mt-2">
          <div class="aluno tw-mx-auto guib borda tw-mx-auto">
            <img src="/images/codigo.png" style="max-width:40px">
          </div>
          <div class="tw-mt-2 tw-text-white">Guilherme Barboza</div>
          <div class="tw-mt-2 tw-text-white">Desenvolvedor</div>
        </div>
        <div class="tw-w-full md:tw-w-1/6 tw-mt-2">
          <div class="aluno tw-mx-auto guig borda tw-mx-auto">
            <img src="/images/codigo.png" style="max-width:40px">
          </div>
          <div class="tw-mt-2 tw-text-white">Guilherme Garcia</div>
          <div class="tw-mt-2 tw-text-white">Desenvolvedor</div>
        </div>
        <div class="tw-w-full md:tw-w-1/6 tw-mt-2">
          <div class="aluno tw-mx-auto lucas borda tw-mx-auto ">
            <img src="/images/codigo.png" style="max-width:40px">
          </div>
          <div class="tw-mt-2 tw-text-white">Lucas</div>
          <div class="tw-mt-2 tw-text-white">Desenvolvedor</div>
        </div>
      </div>
    </div>

  </BreezeAuthenticatedLayout>
</template>
  
<style scoped>
.borda {
  border-radius: 100%
}

.borda2 {
  border-radius: 50px 50px 50px 50px
}

.aluno {
  width: 128px;
  height: 128px;
}

.andrew {
  background-image: url("/images/andrew.jpg");
}

.carol {
  background-image: url("/images/novacarol.jpg");
}

.enzo {
  background-image: url("/images/enzo.jpg");
}

.guib {
  background-image: url("/images/guilherme.jpg");
}

.guig {
  background-image: url("/images/garcia.jpg");
}

.lucas {
  background-image: url("/images/lucas.jpg");
}
</style>
<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
</script>
<script>

</script>
    