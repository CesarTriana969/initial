<template>
  <section class="h-screen flex flex-col items-center justify-center max-[768px]:items-end">

    <h1 class="font-bold text-4xl text-gray-800 mb-5 max-[768px]:text-3xl max-[768px]:w-3/4 max-[768px]:text-center max-[768px]:m-auto">Free VIN decoder for all cars</h1>


    <div class="relative text-center w-[450px] h-[450px] flex justify-center items-center mx-auto bg-white rounded-lg overflow-hidden shadow-lg  max-[768px]:w-full max-[768px]:h-5/6 max-[768px]:pt-10">

      <div class="relative flex flex-col justify-center items-center w-4/5 gap-[10px]">
        <p class="font-bold text-2xl text-gray-800  mb-1">Enter VIN number</p>
        <input 
          type="text" 
          v-model="form.vin"
          class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
          @input="maxlength" 
        />

        <button
          class="w-3/5 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center mt-5"
          @click="send"
        >
          Decode VIN
        </button>

      </div>
    </div>
  </section>
</template>

<script>
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      form: {
        vin: '',
      },
    };
  },
  methods: {
    maxlength() {
      this.form.vin = this.form.vin.slice(0, 17);
    },
    showAlert(icon, title, text) {
      Swal.fire({
        icon: icon,
        title: title,
        text: text,
      });
    },
    showAlertLoading(title, text, options) {
      Swal.fire({
        title: title,
        text: text,
        ...options,
      });
    },
    async send() {
      const vin = this.form.vin;

      if (vin.trim() === '') {
        this.showAlert("warning", "This field must be completed.", "Try again!");
        return;
      }

      this.showAlertLoading("Decoding...", "Please wait...", {
        showConfirmButton: false,
        allowOutsideClick: false,
        willOpen: () => {
          Swal.showLoading();
        },
      });

      const url = `https://vindecoder.p.rapidapi.com/decode_vin?vin=${vin}`;
      const options = {
        method: 'GET',
        headers: {
          'X-RapidAPI-Key': '2f14671007mshc43eb0649ca7087p1b35f1jsnb98f633cbf85',
          'X-RapidAPI-Host': 'vindecoder.p.rapidapi.com',
        },
      };

      try {
        const response = await fetch(url, options);
        const result = await response.json();

        console.log(result);

        if (result.success == true) {

          window.location.href = `/decoder/${vin}`;

        } else {

          let vinErrorDetails = (result.errors && result.errors.vin) ? result.errors.vin[0] : null;
          let errorMessage = result.message || 'The given data was invalid';

          this.showAlert("error", "Error...", vinErrorDetails || errorMessage);
        }

      } catch (error) {
        console.error(error);
      }
    },
  },
};
</script>
