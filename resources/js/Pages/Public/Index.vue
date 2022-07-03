<template>
<div>
  <navigation></navigation>
  <Head title="Welcome" />
  <div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">
          <Link class="text-indigo-400 hover:text-indigo-600" href=""></Link> 
        </h2>
        <div class="grid grid-rows-2 grid-flow-col gap-4">
          <div class="items-center"  v-for="category in categories.data" :key="category.id">
            <a :href="`/publiccategories/${category.id}/subcategories`" class="hover:underline">
              <div class="avatar">
                <div class="rounded">
                  <img   v-if="category.photo" :src="category.photo" >
                </div>
              </div>
              <div class="font-bold text-slate-700 leading-snug">
                  {{category.name}}
              </div>
              </a>
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
    categories: Object,
  },
  components: {
    Link,
    Head,
    navigation,
    Pagination
  },
  mounted() {
    console.log(this.categories);
  }

}
</script>
