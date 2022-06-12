<template>
<q-dialog v-model="dialog" :position="position">
      <q-card style="width: 350px">
        <q-card-section class="row items-center no-wrap flex inline-flex">
          <div class="width-3/12 q-mr-sm">
            <q-icon v-if="icon" class="material-icons" size="md">{{ icon }}</q-icon>
          </div>
          <div class="width-9/12">
          <span v-if="value">{{ value }}</span></div>
        </q-card-section>
      </q-card>
    </q-dialog>
</template>

<script>
import { emit } from 'process'
import { ref } from 'vue'
export default {
  props:{
        value:String,
        icon:String,
    },
  setup () {
    const dialog = ref(true)
    const position = ref('bottom')

    return {
      dialog,
      position,

      open (pos) {
        position.value = pos
        dialog.value = false
      }
    }
  }
}
</script>

<style scoped>
.material-icons.md-24 {
    font-size: 24px;
}
</style>