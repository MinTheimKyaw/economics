<template>
<div>
  <navigation></navigation>
  <Head title="Order History Success" />
  <div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <div class="card-title">
            Product Order!
            <div class="badge badge-secondary">Successful!</div>
            We will delivery product soon. Thank You !
      </div>
            <div class="items-center">
              <div class="font-bold text-slate-700 leading-snug">
                    Order Code - {{order.order_code}}
                </div>
                <div class=" text-slate-700 leading-snug">
                    Name - {{order.customer_name}}
                </div>
                <div class="text-slate-700 leading-snug">
                    Address - {{order.address}}
                </div>
                <div class="text-slate-700 leading-snug">
                    Phone - {{order.phone}}
                </div>
                <div class="text-slate-700 leading-snug">
                    Total - {{order.total}}
                </div>
                 <button class="btn btn-primary" @click="printdata()">Print</button>
                <Link class="btn btn-success" href="/welcome">Back Order Stock</Link> 
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
  mounted() {
    if (localStorage.getItem('orderhistory')) {
      try {
       localStorage.removeItem('orderhistory');
      } catch(e) {
        localStorage.removeItem('orderhistory');
      }
    }
  },
  props: {
    order: Object,
  },
  components: {
    Link,
    Head,
    navigation,
    Pagination
  },
  methods: {
    printdata() {
        window.print();
    }
  }

}
</script>