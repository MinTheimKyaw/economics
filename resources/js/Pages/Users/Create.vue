<template>
  <div>
    <Head title="Create User" />
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h2 class="card-title">
          <Link class="text-indigo-400 hover:text-indigo-600" href="/users">Users</Link> 
          <span class="text-indigo-400 font-medium">/</span>Create
        </h2>
         <form @submit.prevent="store">
          <div class="form-control">
            <label class="label">
              <span class="label-text">First Name</span>
            </label>
            <input v-model="form.first_name" type="text" placeholder="First Name" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Last Name</span>
            </label>
            <input v-model="form.last_name" type="text" placeholder="Last Name" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Email</span>
            </label>
            <input v-model="form.email" type="text" placeholder="Email" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Password</span>
            </label>
            <input v-model="form.password" type="password" placeholder="Password" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Owner</span>
            </label>
            <select  v-model="form.owner"  class="select w-full" >
                <option :value="true">Yes</option>
                <option :value="false">No</option>
            </select>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Profile Photo</span>
            </label>
            <file-input v-model="form.photo" :error="form.errors.photo" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" />
          </div>
          <div class="card-actions justify-end">
            
            <button class="btn btn-primary" type="submit">Create User</button> 
           </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import FileInput from '@/Shared/FileInput'
import TextInput from '@/Shared/TextInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
  },
  layout: Layout,
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        owner: false,
        photo: null,
      }),
    }
  },
  methods: {
    store() {
      this.form.post('/users')
    },
  },
}
</script>
