<template>

  <LoginComponent 
    v-show="currentStep === 1"
    @next="currentStep++" 
    @back="currentStep--" 
  />

  <CreateAccountComponent 
    v-show="currentStep === 2"
    @next="currentStep++" 
    @back="currentStep--" 
  />

</template>


<script>
import LoginComponent from './components/LoginComponent.vue';
import CreateAccountComponent from './components/CreateAccountComponent.vue';

export default {
  components: {
    LoginComponent,
    CreateAccountComponent
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
