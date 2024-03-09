<template>

  <NotFoundComponent 
    v-show="currentStep === 1"
    @next="currentStep++" 
  />

</template>


<script>
import NotFoundComponent from './components/NotFoundComponent.vue';


export default {
  components: {
    NotFoundComponent
  },

  data() {
    return {
      currentStep: 1,
    }
  },
  computed: {

  },
  methods: {

  }
}
</script>
