<template>
  <Head title="Login" />
  <div class="flex items-center justify-center p-6 min-h-screen bg-skyblue-800">
    <div class="w-full max-w-md bg-white">
      <logo class="block mx-auto w-full max-w-xs " height="70" />
      <div class="card-body">
        <h2 class="card-title">
          <center>Login!</center>
        </h2>
        <form  @submit.prevent="login">
          <div class="form-control" v-if="form.errors.email||form.errors.password">
              <div class="alert alert-error shadow-lg">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <span>{{form.errors.email}}</span>
                  <span>{{form.errors.password}}</span>
                </div>
              </div>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input v-model="form.email" type="text" placeholder="Email" class="input input-bordered"  autofocus autocapitalize="off" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input v-model="form.password" type="password" placeholder="Password" class="input input-bordered"   />
          </div>
          <div class="form-control">
              <label class="label cursor-pointer">
                <span class="label-text">Remember me</span> 
                <input type="checkbox" v-model="form.remember"  id="remember"  class="checkbox" />
              </label>  
           </div>
           <div class="form-control">
              <button class="btn btn-primary" type="submit">Login</button>
           </div>
        </form>
      </div>
      
    </div>
  </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3'
import Logo from '@/Shared/Logo'
import TextInput from '@/Shared/TextInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    Head,
    LoadingButton,
    Logo,
    TextInput,
  },
  data() {
    return {
      form: this.$inertia.form({
        email: 'mintheimkyaw@example.com',
        password: 'secret',
        remember: false,
      }),
    }
  },
  methods: {
    login() {
      this.form.post('/login')
    },
  },
}
</script>
