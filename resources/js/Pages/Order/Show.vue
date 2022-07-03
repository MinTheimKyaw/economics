<template>
  <div>
    <Head title="Order" />
    <h1 class="mb-8 text-3xl font-bold">Order</h1>
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="form-control">
                <label class="label">
                Order Code -{{order.order_code}}
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                Customer Name -{{order.customer_name}}
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                Address -{{order.address}}
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                Phone -{{order.phone}}
                </label>
            </div>
            <div class="form-control">
                <label class="label">
                Total -{{order.total}}
                </label>
            </div>
            <div  v-if="order.status === 1" class="form-control">
                <label class="label">
                Status - Pending
                </label>
            </div>
            <div  v-if="order.status === 2" class="form-control">
                <label class="label">
                Status - Completed
                </label>
            </div>
        </div>
    </div>
    <br>
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <table  class="table w-full">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Stock Keeping Unit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="orderhistory in orderhistories.data" :key="orderhistory.id">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ orderhistory.productname }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ orderhistory.quantity }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ orderhistory.price }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            {{ orderhistory.sku }}
                        </td>
                    </tr>
                    <tr v-if="orderhistories.data.length === 0">
                        <td colspan="4">No Order Histories found.</td>
                    </tr>
                </tbody>
            </table>
            <pagination class="mt-6" :links="orderhistories.links" />
        </div>
    </div>
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
    order: Object,
    orderhistories: Object,
  },
  methods: {
    
  }
}
</script>
