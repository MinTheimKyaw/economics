<template>
  <div>
    <Head title="Categories" />
    <h1 class="mb-8 text-3xl font-bold">Categories</h1>
    <div class="flex items-center justify-between mb-6">
        <Link class="btn btn-success" href="/categories/create">
          <span>Create</span>
          <span class="hidden md:inline">&nbsp;Category</span>
        </Link>
    </div>
    
    <div class="overflow-x-auto">
      <table  class="table w-full">
        <thead>
          <tr>
          <th>Action</th>
          <th>Name</th>
        </tr>
        </thead>
        <tbody>
          <tr v-for="category in categories.data" :key="category.id">
              <td>
                <button class="btn btn-error btn-sm" @click="destroy(category.id)">Destory </button>

                <Link  class="btn btn-info btn-sm" :href="`/categories/${category.id}/edit`"> 
                <span>Edit</span>
                </Link>
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ category.name }}
              </td>
              
          </tr>
        </tbody>
        <tr v-if="categories.data.length === 0">
          <td colspan="2">No categories found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="categories.links" />
  </div>
</template>

<script>
import { Head ,Link} from '@inertiajs/inertia-vue3'
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'
import Pagination from '@/Shared/Pagination'

export default {
  components: {
    Head,
    Icon,
    Pagination,
    Link,
  },
  layout: Layout,
  props: {
    categories: Object,
  },
  methods: {
    destroy(id)
    {
      this.$inertia.delete('/categories/'+id);
    }    
  }
}
</script>
