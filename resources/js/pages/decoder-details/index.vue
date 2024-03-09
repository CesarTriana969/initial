<template>
  <section class="grid__container gap-8 pt-10 pb-12">


    <div class="grid grid-cols-[minmax(0,_auto)_minmax(0,_1fr)] gap-[40px] items-center max-[768px]:grid-cols-1 max-[768px]:items-center max-[768px]:gap-3">

      <div class="bg-[#fff] w-[180px] h-[180px] relative rounded-[50%] border-[15px] border-[solid] border-[#e3e1e6] [box-shadow:0px_0px_0px_1px_rgba(44,_42,_51,_0.2)] flex items-center justify-center max-[768px]:w-[120px] max-[768px]:h-[120px] max-[768px]:m-auto">

        <span class="material-symbols-outlined car__icon">
          garage
        </span>
      </div>


      <div class="flex flex-col gap-[10px] max-[768px]:m-auto max-[768px]:items-center">

        <div class="max-[768px]:flex max-[768px]:flex-col max-[768px]:items-center">
          <P>Entered VIN</P>
  
          <h1 class="text-[45px] leading-[1.2] max-[768px]:text-3xl">{{ decodeVin.vin }}</h1>
        </div>

        <div class="border rounded-3xl border-gray-600 flex items-center gap-2 w-[230px] h-[49px] p-[2px]">

          <span class="material-symbols-outlined bg-[#37c21b] rounded-[50%] w-[40px] h-[40px] flex items-center justify-center text-center text-[25px] font-bold text-[#FFFFFF] pt-2">
            check
          </span>

          <p class="text-gray-800">Vehicle detected</p>

        </div>

      </div>

    </div>


    <div class="bg-white rounded-lg overflow-hidden">

      <header class="bg-black text-white h-[48px] flex items-center pl-[25px]">
        Information
      </header>

      <div 
        v-for="(value, key) in decodeVin.specification" 
        :key="key" 
        class="grid grid-cols-[auto,1fr] items-center border-b border-gray-300 mx-[25px] my-[0] max-[768px]:grid-cols-[1fr,1fr]"
      >

        <div class="w-[240px] h-[47px] flex items-center font-semibold capitalize max-[768px]:w-full">
          {{ key }}
        </div>
  
        <div>
          {{ value }}
        </div>
      </div>
    </div>


  </section>
</template>

<script>
export default {
  props: {
    decodeVin: Object
  },
  data() {
    return {
      form: {
        vin: '',
      },
    };
  },
  mounted() {
    console.log('decodeVin:', this.decodeVin);
  },
  methods: {

  }
}
</script>


<style>
.car__icon{
  font-size: 80px;
  font-weight: 200;
}
</style>