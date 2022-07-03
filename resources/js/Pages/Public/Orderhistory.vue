<template>
<div>
  <navigation></navigation>
  <Head title="Order History" />
  <div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <div class="grid grid-rows-2 grid-flow-col gap-4">
            <div class="items-center">
                <form @submit.prevent="store">
                    <div class="form-control" v-if="form.errors.customer_name||form.errors.phone||form.errors.address">
                    <div class="alert alert-error shadow-lg">
                        <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{form.errors.customer_name}}</span>
                        <span>{{form.errors.phone}}</span>
                        <span>{{form.errors.address}}</span>
                        </div>
                    </div>
                </div>
                    <div class="overflow-x-auto">
                      <table  class="table w-full">
                        <thead>
                          <tr>
                            <th width="10">Action</th>
                            <th>Product Name</th>
                            <th>Amount</th>
                            <th>Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(cart, n) in cartItems"  :key="cart.product_id">
                            <td><button class="btn btn-error" @click="removeCat(n)">Remove</button></td>
                            <td>{{ cart.name }}</td>
                            <td>{{ cart.amount }}</td>
                            <td>{{ cart.price }}</td>
                          </tr>
                        </tbody>
                      </table>
                      
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Name</span>
                        </label>
                        <input v-model="form.customer_name" type="text" placeholder="Name" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Phone</span>
                        </label>
                        <input v-model="form.phone" type="number" placeholder="Phone" class="input input-bordered" />
                    </div>
                    <div class="form-control">
                        <label class="label">
                        <span class="label-text">Address</span>
                        </label>
                        <textarea v-model="form.address"  class="textarea" placeholder="Address"></textarea>
                    </div>
                    <br>
                    <div class="form-control">
                        <button class="btn btn-primary" type="submit">Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
</template>

<script>

import { Head } from '@inertiajs/inertia-vue3'
import { Link } from '@inertiajs/inertia-vue3'
import navigation from '@/Public/Navigation'
import Pagination from '@/Shared/Pagination'

export default {
  props: {
    product: Object,
  },
  data() {
    return {
        i:0,
      cartItems: [],
      orderhistory:[],
      form: this.$inertia.form({
        customer_name: null,
        address: null,
        phone: null,
        cartItems:[]
      }),
     
    }
  },
  mounted() {
    if (localStorage.getItem('orderhistory')) {
      try {
        this.cartItems = JSON.parse(localStorage.getItem('orderhistory'));
        this.form.cartItems=this.cartItems;
      } catch(e) {
        localStorage.removeItem('orderhistory');
      }
    }
  },
  components: {
    Link,
    Head,
    navigation,
    Pagination
  },
  methods: {
    store() {
      this.form.post('/orderhistory')
    },
    removeCat(x) {
      this.cartItems.splice(x, 1);
      this.saveCats();
    },
    saveCats() {
      const parsed = JSON.stringify(this.cartItems);
      localStorage.setItem('orderhistory', parsed);
    }
  }
}
</script>
