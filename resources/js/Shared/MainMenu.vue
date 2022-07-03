<template>
  <div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/">
        <icon name="dashboard" class="mr-2 w-4 h-4" :class="isUrl('') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Dashboard</div>
      </Link>
    </div>
    
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/categories">
        <icon name="category" class="mr-2 w-4 h-4" :class="isUrl('categories') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('categories') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Categories</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/subcategories">
        <icon name="subcategory" class="mr-2 w-4 h-4" :class="isUrl('subcategories') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('subcategories') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">SubCategory</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/product">
        <icon name="product" class="mr-2 w-4 h-4" :class="isUrl('product') ? 'fill-white' : 'fill-white-400 group-hover:fill-white'" />
        <div :class="isUrl('product') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Product</div>
      </Link>
    </div>
    <div class="mb-4">
      <Link class="group flex items-center py-3" href="/order">
        <icon name="office" class="mr-2 w-4 h-4" :class="isUrl('order') ? 'fill-white' : 'fill-white-400 group-hover:fill-white'" />
        <div :class="isUrl('order') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Order</div>
      </Link>
    </div>
    
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
    Link,
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
