<template>
  <div>
    <Head title="Sub Category" />
    <h1 class="mb-8 text-3xl font-bold">Sub subcategory</h1>
    <div class="flex items-center justify-between mb-6">
        <Link class="btn btn-success" href="/subcategories/create">
          <span>Create</span>
          <span class="hidden md:inline">&nbsp;subcategory</span>
        </Link>
    </div>
    <div class="overflow-x-auto">
      <table  class="table w-full">
        <thead>
          <tr>
          <th>Action</th>
          <th>Name</th>
          <th>Category</th>
        </tr>
        </thead>
        <tbody>
          <tr v-for="subcategories in subcategoriess.data" :key="subcategories.id">
              <td>
                <button class="btn btn-error btn-sm" @click="destroy(subcategories.id)">Destory </button>

                <Link  class="btn btn-info btn-sm" :href="`/subcategories/${subcategories.id}/edit`"> 
                <span>Edit</span>
                </Link>
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ subcategories.name }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ subcategories.category }}
              </td>
          </tr>
        </tbody>
        <tr v-if="subcategoriess.data.length === 0">
          <td colspan="3">No Sub Category found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="subcategoriess.links" />
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
    subcategoriess: Object,
  },
  methods: {
    destroy(id)
    {
      this.$inertia.delete('/subcategories/'+id);
    }    
  }
}
</script>
