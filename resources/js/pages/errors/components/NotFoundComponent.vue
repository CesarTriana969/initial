<template>
  <section class="h-screen flex flex-col items-center justify-center max-[768px]:items-end">

    <div class="flex flex-col items-center justify-center">
      <h2 class="font-bold text-8xl text-black max-[768px]:text-5xl">NOT FOUND</h2>

      <figure class="w-96 max-[768px]:w-full">
        <img 
          loading="lazy" 
          :src="notFound" 
          alt="not found img"
        >
      </figure>
    </div>

  </section>


</template>

<script>

import notFound from '../../../../../public/images/not-found.png'

export default {
  data() {
    return {
      notFound: notFound,
    }
  },
};
</script>
