<template>
  <div>
    
    <Head :title="`${form.first_name} ${form.last_name}`" />
    <div class="card bg-base-100 shadow-xl">
      <div class="card-body">
        <h2 class="card-title">
          <Link class="text-indigo-400 hover:text-indigo-600" href="/users">Users</Link>
          <span class="text-indigo-400 font-medium">/</span>{{ form.first_name }} {{ form.last_name }}
        </h2>
        <div class="avatar">
            <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
              <img v-if="user.photo" :src="user.photo" />
            </div>
          </div>
      
        <trashed-message v-if="user.deleted_at" class="mb-6" @restore="restore"> This user has been deleted. </trashed-message>
        <form @submit.prevent="update">
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
            <button v-if="!user.deleted_at" class="btn btn-error" tabindex="-1" type="button" @click="destroy">Delete User</button>
            <button class="btn btn-primary" type="submit">Update User</button> 
           </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import TextInput from '@/Shared/TextInput'
import FileInput from '@/Shared/FileInput'
import SelectInput from '@/Shared/SelectInput'
import LoadingButton from '@/Shared/LoadingButton'
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    FileInput,
    Head,
    Link,
    LoadingButton,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    user: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        first_name: this.user.first_name,
        last_name: this.user.last_name,
        email: this.user.email,
        password: '',
        owner: this.user.owner,
        photo: null,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/users/${this.user.id}`, {
        onSuccess: () => this.form.reset('password', 'photo'),
      })
    },
    destroy() {
      if (confirm('Are you sure you want to delete this user?')) {
        this.$inertia.delete(`/users/${this.user.id}`)
      }
    },
    restore() {
      if (confirm('Are you sure you want to restore this user?')) {
        this.$inertia.put(`/users/${this.user.id}/restore`)
      }
    },
  },
}
</script>
