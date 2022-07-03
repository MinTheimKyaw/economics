<template>
  <div>
    <Head title="Product" />
    <h1 class="mb-8 text-3xl font-bold">Product</h1>
    <div class="flex items-center justify-between mb-6">
        <Link class="btn btn-success" href="/product/create">
          <span>Create</span>
          <span class="hidden md:inline">&nbsp;Product</span>
        </Link>
    </div>
    
    <div class="overflow-x-auto">
      <table  class="table w-full">
        <thead>
          <tr>
          <th>Action</th>
          <th>Name</th>
          <th>Detail</th>
          <th>Stock Keeping Unit</th>
          <th>Price</th>
          <th>Sub Category</th>
          <th>Category</th>
        </tr>
        </thead>
        <tbody>
          <tr v-for="product in products.data" :key="product.id">
              <td>
                <button class="btn btn-error btn-sm" @click="destroy(product.id)">Destory </button>

                <Link  class="btn btn-info btn-sm" :href="`/product/${product.id}/edit`"> 
                <span>Edit</span>
                </Link>
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ product.name }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ product.detail }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ product.sku }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ product.price }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ product.subcategory }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ product.category }}
              </td>
          </tr>
        </tbody>
        <tr v-if="products.data.length === 0">
          <td colspan="7">No Products found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="products.links" />
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
    products: Object,
  },
  methods: {
    destroy(id)
    {
      this.$inertia.delete('/product/'+id);
    }    
  }
}
</script>
