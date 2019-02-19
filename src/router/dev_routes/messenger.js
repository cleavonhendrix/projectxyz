
export default{
  routes: [{
    path: '/messenger/:username?',
    name: 'messenger',
    component: resolve => require(['modules/messenger/Messenger.vue'], resolve),
    meta: {
      tokenRequired: true
    }
  }
  ]
}
