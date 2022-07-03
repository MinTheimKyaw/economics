<template>
  <div>
    <Head title="Order" />
    <h1 class="mb-8 text-3xl font-bold">Order</h1>
    
    <div class="overflow-x-auto">
      <table  class="table w-full">
        <thead>
          <tr>
            <th>Action</th>
            <th>Order Code</th>
            <th>Customer Name</th>
            <th>Addresss</th>
            <th>Phone No</th>
            <th>Total</th>
            <th>Status</th>
            </tr>
        </thead>
        <tbody>
          <tr v-for="order in orders.data" :key="order.id">
              <td>
                <Link  class="btn btn-info btn-sm" :href="`/order/${order.id}/show`"> 
                <span>Detail</span>
                </Link>
                <button class="btn btn-secondary btn-sm" @click="changestatus(order.id)">Change Status</button>
                
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ order.order_code }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ order.customer_name }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ order.address }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ order.phone }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                {{ order.total }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                <label v-if="order.status === 1" class="bg-green-400">Pending</label>
                <label v-if="order.status === 2" class="bg-red-400">Completed</label>
              </td>
          </tr>
        </tbody>
        <tr v-if="orders.data.length === 0">
          <td colspan="7">No Orders found.</td>
        </tr>
      </table>
    </div>
    <pagination class="mt-6" :links="orders.links" />
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
    orders: Object,
  },
  methods: {
    changestatus(id)
    {
      if (confirm('Are you sure you want to change status this order?')) {
        this.$inertia.put(`/order/`+id)
      }
    } 
  }
}
</script>
