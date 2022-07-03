<template>
<div>
  <navigation></navigation>
  <Head title="Product Detail" />
  <div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <div class="grid grid-rows-2 grid-flow-col gap-4">
            <div class="items-center">
                <div class="avatar">
                    <div class="rounded">
                        <img   v-if="product.photo" :src="product.photo" >
                    </div>
                </div>
                <div class="font-bold text-slate-700 leading-snug">
                    Name - {{product.name}}
                </div>
                <div class="font-bold text-slate-700 leading-snug">
                    Price - {{product.price}}
                </div>
                <div class="font-bold text-slate-700 leading-snug">
                    Stock Available - {{product.sku}}
                </div>
                <div class="font-bold text-slate-700 leading-snug">
                    Detail - {{product.detail}}
                </div>
                <div >
                    <div class="form-control" v-if="product.sku<form.amount">
                        <div class="alert alert-error shadow-lg">
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Stock No Enough Amount!</span>
                            </div>
                        </div>
                    </div>
                    <input type="number" v-model="form.amount" class="input input-bordered"  />
                </div>
                <br>
                <div>
                    <button class="btn btn-primary" @click="addcart()">Add Cart </button>
                </div>
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
      cartItems: [],
      orderhistory:[],
      form: {
        product_id: this.product.id,
        name: this.product.name,
        amount: 0,
        sku: this.product.sku,
        price: this.product.price,
      },
    }
  },
  components: {
    Link,
    Head,
    navigation,
    Pagination
  },
  methods: {
    addcart() {
        
        if(localStorage.getItem('orderhistory')===null)
        {
            this.orderhistory.push(this.form);
            const parsed=JSON.stringify(this.orderhistory);
            localStorage.setItem('orderhistory',parsed);
            location.reload();
        }
        else{
            this.orderhistory = JSON.parse(localStorage.getItem('orderhistory'));
            this.orderhistory.push(this.form);
            const parsed=JSON.stringify(this.orderhistory);
            localStorage.setItem('orderhistory',parsed);
            location.reload();
        }
        
       // localStorage.setItem('orderhistory', this.form)
    }

  }
}
</script>
