<template>

  <section class="h-screen flex items-center justify-center max-[768px]:items-end">

    <div class="bg-white rounded-lg overflow-hidden shadow-lg px-8 py-6 w-96 flex flex-col gap-2 max-[768px]:w-full max-[768px]:h-5/6 max-[768px]:pt-10">

      <h2 class="text-5xl font-bold text-left mb-4 text-gray-800">Sign up</h2>

      <div>
        <div class="mb-4">
          <input 
            type="text" 
            v-model="form.user"
            class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="User"
          >
          <span v-if="errors.user" class="text-sm">{{ errors.user }}</span>
        </div>

        <div class="mb-4">
          <input 
            type="text" 
            v-model="form.email"
            class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Email"
          >
          <span v-if="errors.email" class="text-sm">{{ errors.email }}</span>
        </div>

        <div class="mb-4">
          <input 
            type="text" 
            v-model="form.phone_number"
            class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Phone Number"
            @input="validateNumericField"
          >
          <span v-if="errors.phone_number" class="text-sm">{{ errors.phone_number }}</span>
        </div>

        <div class="mb-4">
          <input 
            type="password" 
            v-model="form.password"
            class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Password"
          >
          <span v-if="errors.password" class="text-sm">{{ errors.password }}</span>
        </div>

        <div class="mb-4">
          <input 
            type="password" 
            v-model="form.confirm_password"
            class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Confirm Password"
          >
          <span v-if="errors.confirm_password" class="text-sm">{{ errors.confirm_password }}</span>
        </div>

      </div>

      <button 
        @click="formSave"
        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center mt-5 "
      >
        Send
      </button>

      <button 
        class="flex flex-row items-center text-gray-800 font-bold justify-start max-[768px]:pt-2 max-[768px]:justify-center" @click="back"
      >

        <svg class="icon icon-tabler icon-tabler-arrow-narrow-left " width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M5 12l4 4" /><path d="M5 12l4 -4" /></svg>

        back
      </button>

    </div>
  </section>

</template>



<script>
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      form: {
        user: '',
        email: '',
        phone_number: '',
        password: '',
        confirm_password: '',
      },
      customErrorMessages: {
        user: 'Please Enter a Valid User.',
        phone_number: 'Please Enter a Phone Number.',
        password: 'Please Enter a Valid Password.',
        confirm_password: 'Please Enter a Valid Password.',
        email: 'Please Enter a Valid Email.',
      },

      errors: {},
    }
  },
  created() {
  },
  methods: {
    validateNumericField() {
      this.form.phone_number = this.form.phone_number.replace(/[^0-9]/g, '');
    },
    showAlert(icon, title, text) {
      Swal.fire({
        icon: icon,
        title: title,
        text: text,
      });
    },
    async formSave() {
      const requiredFields = [
        'user',
        'email',
        'phone_number',
        'password',
        'confirm_password',
      ];

      const isEmpty = requiredFields.some(field => !(this.form[field]));

      this.errors = {};

      if (isEmpty) {
        const fieldName = requiredFields.find(field => !(this.form[field]));
        this.errors[fieldName] = this.customErrorMessages[fieldName] ? this.customErrorMessages[fieldName] : '';
        this.showAlert("warning", this.errors[fieldName], "Try again!");

      } else {
        // try {
        //   Swal.fire({
        //     title: "Saving...",
        //     text: "Please wait...",
        //     showConfirmButton: false,
        //     allowOutsideClick: false,
        //     willOpen: () => {
        //       Swal.showLoading();
        //     },
        //   });

        //   const phoneNumber = this.form.phone_number;
        //   const template= 12345

        //   const url = `https://telesign-telesign-send-sms-verification-code-v1.p.rapidapi.com/sms-verification-code?phoneNumber=${phoneNumber}&verifyCode=${template}`;

        //   const options = {
        //     method: 'POST',
        //     headers: {
        //       'X-RapidAPI-Key': 'b98d7a583cmshbfd420fff7af656p1b9f1bjsne0dec1620c82',
        //       'X-RapidAPI-Host': 'telesign-telesign-send-sms-verification-code-v1.p.rapidapi.com'
        //     }
        //   };

        //   const response = await fetch(url, options);
        //   const result = await response.text();
        //   console.log(result);


        //   Swal.close();
        // } catch (error) {
        //   console.error(error);

        // }


        Swal.fire({
          title: "Saving...",
          text: "Please wait...",
          showConfirmButton: false,
          allowOutsideClick: false,
          willOpen: () => {
            Swal.showLoading();
          },
        });

        const formData = new FormData();
        formData.append("name", this.form.user);
        formData.append("email", this.form.email);
        formData.append("phone_number", this.form.phone_number);
        formData.append("password", this.form.password);
        formData.append("password_confirmation", this.form.confirm_password);

        await axios.post('/user/store', formData)

          .then((response) => {
            let message = response.data.message;

            this.form.name = '';
            this.form.email = '';
            this.form.phone_number = '';
            this.form.password = '';
            this.form.confirm_password = '';

            Swal.close()
            Swal.fire({
              title: 'Perfect',
              text: message,
              icon: 'success',
              confirmButtonText: 'Ok',
              confirmButtonColor: '#3085d6',
            }).then((response) => {
              this.$emit('close')
            })
          })
          .catch(error => {

            console.error(error.response);
            Swal.close()
            let errorMessage = error.response.data.message || "Unknown error";

            Swal.fire({
              icon: 'error',
              title: 'Error...',
              text: errorMessage,
            })
          })
      }
    },
    back() {

      this.errors = {};

      this.$emit('back');
    }
  }
}
</script>