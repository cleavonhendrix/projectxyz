
export default{
  routes: [{
    path: '/marketplace',
    name: 'marketplace',
    component: resolve => require(['modules/marketplace/Marketplace.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  },
  {
    path: '/marketplace/product/:code',
    name: 'marketplaceProduct',
    component: resolve => require(['modules/marketplace/Product.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }]
}
