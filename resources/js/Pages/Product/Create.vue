<template>
  <div>
    <Head title="Create Product" />
    <div class="card bg-base-100 shadow-xl">
      
      <div class="card-body">
        <h2 class="card-title">
          <Link class="text-indigo-400 hover:text-indigo-600" href="/product">Product</Link>
          <span class="text-indigo-400 font-medium">/</span> Create
        </h2>
        <form @submit.prevent="store">
          <div class="form-control" v-if="form.errors.name||form.errors.photo||form.errors.detail||form.errors.sku||form.errors.price||form.errors.category||form.errors.subcategory">
              <div class="alert alert-error shadow-lg">
                <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <span>{{form.errors.name}}</span>
                  <span>{{form.errors.photo}}</span>
                  <span>{{form.errors.detail}}</span>
                  <span>{{form.errors.sku}}</span>
                  <span>{{form.errors.price}}</span>
                  <span>{{form.errors.category}}</span>
                  <span>{{form.errors.subcategory}}</span>
                </div>
              </div>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Name</span>
            </label>
            <input v-model="form.name" type="text" placeholder="Name" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Price</span>
            </label>
            <input v-model="form.price" type="number" placeholder="Price" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Stock Keeping Unit</span>
            </label>
            <input v-model="form.sku" type="number" placeholder="SKU" class="input input-bordered" />
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Category</span>
            </label>
            <select  v-model="form.category" @change="onChange($event)" class="select w-full" >
                <option v-for="category in categories" :key="category.id"   :value="category.id">{{ category.name}}</option>
            </select>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Sub Category</span>
            </label>
            <select  v-model="form.subcategory"  class="select w-full" >
                <option v-for="subcategory in subcategories" :key="subcategory.id"   :value="subcategory.id">{{ subcategory.name}}</option>
            </select>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Detail</span>
            </label>
            <textarea v-model="form.detail"  class="textarea" placeholder="Detail"></textarea>
          </div>
          <div class="form-control">
            <label class="label">
              <span class="label-text">Photo</span>
            </label>
            <file-input v-model="form.photo" class="pb-8 pr-6 w-full lg:w-1/2" type="file" accept="image/*" />
          </div>
          
          
          
          <div class="card-actions justify-end">
            <button class="btn btn-primary" type="submit">Create Product</button>
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

export default {
  components: {
    Head,
    Link,
    FileInput,
    TextInput,
  },
  layout: Layout,
  props: {
    categories: Object,
    subcategories: Object,
  },
  remember: 'form',
  data() {
    return {
      form: this.$inertia.form({
        name: null,
        detail: null,
        sku: null,
        price: null,
        photo: null,
        category: null,
        subcategory: null,
      }),
    }
  },
  methods: {
    onChange(event) {
        this.$inertia.get("/product/create", { category: event.target.value},
        {
            preserveState:true,
            preserveScroll:true,
            replace:true
        });
    },
    store() {
      this.form.post('/product')
    },
  },
}
</script>
