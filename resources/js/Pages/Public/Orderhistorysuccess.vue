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

                <Link class="text-indigo-400 hover:text-indigo-600" href="/welcome">Back Order Stock</Link> 
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
  components: {
    Link,
    Head,
    navigation,
    Pagination
  }
}
</script>