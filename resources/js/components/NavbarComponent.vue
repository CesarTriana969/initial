<template>
    <nav class=" border-gray-200  py-0 rounded px-7"
        style="
            -webkit-box-shadow: -1px 13px 42px -8px rgba(0,0,0,0.1);
            -moz-box-shadow: -1px 13px 42px -8px rgba(0,0,0,0.);
            box-shadow: -1px 13px 42px -8px rgba(0,0,0,0.1);
            background: #FAFAFA 0% 0% no-repeat padding-box;
            box-shadow: 0px 3px 6px #00000029;
        "
    >
         <div class="container flex flex-wrap justify-between items-center mx-auto "  style="margin-top:0px !important; min-height:80px !important;">
             <a href="https://seeklogo.com/images/A/American_Library_Association-logo-C053B6D846-seeklogo.com.png" class="flex items-center">
                 
             </a>
             <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false">
                 <a 
                     href="#"
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"
                     class="block py-2 pr-4 pl-3 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-gray-600 md:p-0">
                     Log Out
                 </a>
                 
             </button>

             <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                 <ul 
                 class="flex flex-col  mt-10 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0" 
                 >
                     <li>
                         <div class="relative inline-block text-left">
                             <div>
                                 <button 
                                     type="button" 
                                     class="inline-flex justify-center w-full rounded-md border bg-gray-100 border-gray-300 shadow-sm px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2
                                      focus:ring-offset-gray-100 focus:ring-indigo-500"
                                     @click="menu = !menu"
                                     >
                                     Settings
                                     <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                         <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                     </svg>
                                 </button>
                             </div>
                             <div 
                                 class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" 
                                 v-if="menu"
                                 style="z-index:100 !important"
                             >

                                 <div class="py-1" role="none">
                                     <button 
                                             onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                                             type="submit" 
                                             class="text-gray-700 block w-full text-left px-4 py-2 text-sm" 
                                             role="menuitem" 
                                             tabindex="-1" 
                                             id="menu-item-3"
                                         >Log out
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>
     </nav>
 </template>
 
 <script>
 export default {
     data(){
         return{
             menu: false
         }
     },
     props: {
          user: {
              type: Number
          },
      },
      computed: {
        modalData() {
            return this.$store.state
            },
        },
      created(){
        this.permissions()
      },
      methods:{
        async permissions(){
            await axios.get('/system/user-permissions')
                .then(response => {
                    this.$store.state.permissions =  response.data.permissions
                });
        }
      }
 }
 </script>
 
 <style>
 .shade-component{
  -webkit-box-shadow: -1px 13px 42px -8px rgba(0,0,0,0.3);
  -moz-box-shadow: -1px 13px 42px -8px rgba(0,0,0,0.3);
  box-shadow: -1px 13px 42px -8px rgba(0,0,0,0.3);
}

 </style>
