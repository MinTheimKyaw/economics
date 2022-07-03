<template>
<div class="navbar bg-info rounded">
  <div class="flex-1">
    <Link class="btn btn-ghost normal-case text-xl" href="/welcome">
    <div :class="isUrl('welcome') ? 'text-white' : 'text-black-300 group-hover:text-white'">Category</div>
    </Link>
    
  </div>
  
  <div class="flex-none">
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle">
        <div class="indicator">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
          <span class="badge badge-sm indicator-item">{{item.length}}</span>
        </div>
      </label>
      <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
        <div class="card-body">
          <span class="font-bold text-lg">{{item.length}} Items</span>
         
          <div class="card-actions">
            <Link class="btn btn-primary btn-block" href="/orderhistory">View cart</Link>
          </div>
        </div>
      </div>
    </div>
    <div class="dropdown dropdown-end">
      <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="indicator">
          <a href="/login">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
          </svg>
          </a>
        </div>
      </label>
      
    </div>
  </div>
</div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import FlashMessages from '@/Shared/FlashMessages'
export default {
  components: {
    Link,
    FlashMessages
  },
   data() {
    return {
      item: [],
      
    }
  },
  mounted() {
    if (localStorage.getItem('orderhistory')) {
      try {
        this.item = JSON.parse(localStorage.getItem('orderhistory'));
      } catch(e) {
        localStorage.removeItem('orderhistory');
      }
    }
  },
  props: {
  },
  methods: {
    isUrl(...urls) {
      let currentUrl = this.$page.url.substr(1)
      if (urls[0] === '') {
        return currentUrl === ''
      }
      return urls.filter((url) => currentUrl.startsWith(url)).length
    },
  },
}
</script>
