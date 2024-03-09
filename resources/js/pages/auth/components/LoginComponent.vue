<template>

  <section class="h-screen flex items-center justify-center max-[768px]:items-end">

    <div class="bg-white rounded-lg overflow-hidden shadow-lg px-8 py-6 w-96 flex flex-col gap-2 max-[768px]:w-full max-[768px]:h-5/6 max-[768px]:pt-10">

      <h1 class="text-5xl font-bold text-left mb-4 text-gray-800">Login</h1>

      <div>
        <div class="mb-4">
          <input 
            type="email" 
            v-model="form.email"
            class="shadow-sm rounded-md w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
            placeholder="Email"
          >
          <span v-if="errors.email" class="text-sm">{{ errors.email }}</span>
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

        <div class="text-sm font-medium text-gray-800">
          Not registered? 
          <button 
            @click="next"
            class="text-blue-700 hover:underline cursor-pointer"
          >
            Create account
          </button>
        </div>

      </div>

      <button 
        @click="send"
        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-3xl text-sm px-5 py-2.5 text-center mt-5"
      >
        Login to your account
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
        email: '',
        password: '',
      },
      customErrorMessages: {
        password: 'Please Enter a Valid Password.',
        email: 'Please Enter a Valid Email.',
      },

      errors: {},
    }
  },
  created() {
  },
  methods: {
    showAlert(icon, title, text) {
      Swal.fire({
        icon: icon,
        title: title,
        text: text,
      });
    },
    async send() {

      const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

      const requiredFields = ['email', 'password'];

      const isEmpty = requiredFields.some(field => !(this.form[field]));

      this.errors = {};

      if (isEmpty) {

        const fieldName = requiredFields.find(field => !(this.form[field]));
        this.errors[fieldName] = this.customErrorMessages[fieldName] ? this.customErrorMessages[fieldName] : '';
        this.showAlert("warning", this.errors[fieldName], "Try again!");

      } else {
        const email = this.form.email;

        if (!EMAIL_REGEX.test(email)) {

          this.errors.email = this.customErrorMessages.email ? this.customErrorMessages.email : '';
          this.showAlert("warning", this.errors.user, "Try again!");

        } else {


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
          formData.append("email", this.form.email);
          formData.append("password", this.form.password);


          await axios.post('/login', formData)

          .then((response) => {
            let message = response.data.message;
            this.form.email = '';
            this.form.password = '';

            Swal.close()
            Swal.fire({
              title: 'Perfect',
              text: message,
              icon: 'success',
              confirmButtonText: 'Ok',
              confirmButtonColor: '#3085d6',
            }).then((response) => {
              this.$emit('close');
              window.location.href = '/decoder';
            })

          })

        .catch(error => {
          Swal.close()
          let errorMessage = error.response.data.message || "Unknown error";

          Swal.fire({
            icon: 'error',
            title: 'Error...',
            text: errorMessage,
          })
        })
        }
      }
    },
    next(){

      this.errors = {};
      this.$emit('next');
    }
  }
}
</script>