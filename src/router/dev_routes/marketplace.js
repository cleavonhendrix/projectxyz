
export default{
  routes: [
    {
      path: '/thankyou/:orderNumber',
      name: 'thankyou',
      component: resolve => require(['modules/checkout/ThankYou.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/plan',
      name: 'plan',
      component: resolve => require(['modules/plan/Plan.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/checkout_plan',
      name: 'checkoutPlan',
      component: resolve => require(['modules/plan/Checkout.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/cp_thank_you/:orderNumber',
      name: 'cpThankYou',
      component: resolve => require(['modules/plan/ThankYou.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/orders',
      name: 'orders',
      component: resolve => require(['modules/order/Orders.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/my_orders',
      name: 'myOrders',
      component: resolve => require(['modules/order/MyOrders.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/order_items/:orderNumber',
      name: 'orderItems',
      component: resolve => require(['modules/order/OrderItems.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/my_order_items/:orderNumber',
      name: 'myOrderItems',
      component: resolve => require(['modules/order/MyOrderItems.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/coupons',
      name: 'coupons',
      component: resolve => require(['modules/coupon/Coupons.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
      path: '/products',
      name: 'products',
      component: resolve => require(['modules/product/Products.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    },
    {
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
    },
    {
      path: '/wishlists',
      name: 'wishlists',
      component: resolve => require(['modules/wishlist/Wishlists.vue'], resolve),
      meta: {
        tokenRequired: true
      }
    }
  ]
}
