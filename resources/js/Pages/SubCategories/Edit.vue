<template>
  <div>
    <Head :title="`${form.name}`" />
   
    <div class="card bg-base-100 shadow-xl">
      
      <div class="card-body">
        <h2 class="card-title">
          <Link class="text-indigo-400 hover:text-indigo-600" href="/subcategories">Sub Category</Link> 
          <span class="text-indigo-400 font-medium">/</span>{{ form.name }} 
        </h2>
        <div class="avatar">
          <div class="w-24 rounded-xl">
            <img v-if="subcategories.photo" :src="subcategories.photo" />
          </div>
        </div>
        <form @submit.prevent="update">
          <div class="form-control">
            <label class="label">
              <span class="label-text">Name</span>
            </label>
            <input v-model="form.name" type="text" placeholder="Name" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Image Path</span>
            </label>
            <file-input v-model="form.photo" :error="form.errors.photo" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" />
            
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Category</span>
            </label>
            <select  v-model="form.category"  class="select w-full" >
                <option v-for="category in categories" :key="category.id"   :value="category.id">{{ category.name}}</option>
            </select>
          </div>
          <div class="card-actions justify-end">
            <button class="btn btn-primary" type="submit">Update Sub Category</button> 
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
import TrashedMessage from '@/Shared/TrashedMessage'

export default {
  components: {
    FileInput,
    Head,
    Link,
    SelectInput,
    TextInput,
    TrashedMessage,
  },
  layout: Layout,
  props: {
    subcategories: Object,
    categories: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        _method: 'put',
        name: this.subcategories.name,
        category: this.subcategories.categories_id,
        photo: null,
      }),
    }
  },
  methods: {
    update() {
      this.form.post(`/subcategories/${this.subcategories.id}`, {
        onSuccess: () => this.form.reset( 'photo'),
      })
    }
  },
}
</script>
