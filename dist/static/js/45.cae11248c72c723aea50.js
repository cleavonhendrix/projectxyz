webpackJsonp([45],{332:function(t,a,e){e(858);var n=e(113)(e(703),e(991),"data-v-1343eda2",null);t.exports=n.exports},703:function(t,a,e){"use strict";Object.defineProperty(a,"__esModule",{value:!0});var n=e(19),i=e(33),A=e(27);a.default={mounted:function(){},data:function(){return{user:i.a.user,tokenData:i.a.tokenData,account:[],config:A.default,host:null}},methods:{redirect:function(t){n.a.push(t)}}}},765:function(t,a,e){a=t.exports=e(306)(),a.push([t.i,"footer[data-v-1343eda2]{width:100%;min-height:200px;float:left;overflow-y:hidden;background:#e9e9e9;margin-top:50px}.footer[data-v-1343eda2]{width:80%;float:left;min-height:50px;margin-left:10%;margin-right:10%;overflow-y:hidden}.footer-widget[data-v-1343eda2]{width:25%;float:left;margin-top:50px;list-style:none;padding:0;margin-bottom:0}.footer-widget li[data-v-1343eda2]{list-style:none;padding:5px 10px;float:left;width:100%;color:#6f6f6f!important}.footer-widget[data-v-1343eda2],.footer-widget li a[data-v-1343eda2]{color:#6f6f6f!important}.footer-widget .title[data-v-1343eda2]{color:#4c4c4c}.footer-widget li a[data-v-1343eda2]:hover{cursor:pointer;text-decoration:underline}footer-widget .title[data-v-1343eda2]:hover{cursor:default}.community .title[data-v-1343eda2]{width:100%;float:left;height:40px;text-align:left;padding-top:5px}.community .links[data-v-1343eda2]{width:100%;float:left}.community .link i[data-v-1343eda2]{font-size:24px;padding:0 10px;float:left;width:20%}.community .link i[data-v-1343eda2]:hover{color:#1caceb;cursor:pointer}.text-gray[data-v-1343eda2]{color:#212529}.contact-us li i[data-v-1343eda2]{padding-right:10px}.contact-us li .fa-phone[data-v-1343eda2]{padding-right:9px}.contact-us li .fa-mobile-alt[data-v-1343eda2]{padding-right:12px}.copyright[data-v-1343eda2]{width:100%;float:left;padding-top:5px;padding-bottom:5px;font-size:12px;text-align:center;margin-top:45px;color:#6f6f6f!important}@media screen and (max-width:992px){.footer-widget[data-v-1343eda2]{width:100%;text-align:center;margin-right:0;padding:0}.community .title[data-v-1343eda2]{text-align:center}.community i[data-v-1343eda2]{width:20%}}","",{version:3,sources:["C:/xampp/htdocs/projectxyz/src/modules/home/Landing/Footer.vue"],names:[],mappings:"AACA,wBACE,WAAW,AACX,iBAAkB,AAClB,WAAY,AACZ,kBAAmB,AACnB,mBAAoB,AACpB,eAAiB,CAClB,AACD,yBACE,UAAW,AACX,WAAY,AACZ,gBAAiB,AACjB,gBAAiB,AACjB,iBAAkB,AAClB,iBAAmB,CACpB,AACD,gCACE,UAAW,AACX,WAAY,AACZ,gBAAiB,AACjB,gBAAiB,AACjB,UAAa,AACb,eAAmB,CACpB,AACD,mCACE,gBAAiB,AACjB,iBAA2B,AAC3B,WAAY,AACZ,WAAY,AACZ,uBAA0B,CAC3B,AACD,qEACE,uBAA0B,CAC3B,AACD,uCACE,aAAe,CAChB,AACD,2CACE,eAAgB,AAChB,yBAA2B,CAC5B,AACD,4CACE,cAAgB,CACjB,AACD,mCACE,WAAY,AACZ,WAAY,AACZ,YAAa,AACb,gBAAiB,AACjB,eAAiB,CAClB,AACD,mCACE,WAAY,AACZ,UAAY,CACb,AACD,oCACE,eAAgB,AAChB,eAAuB,AACvB,WAAY,AACZ,SAAW,CACZ,AACD,0CACE,cAAe,AACf,cAAgB,CACjB,AACD,4BACE,aAAe,CAChB,AACD,kCACE,kBAAoB,CACrB,AACD,0CACE,iBAAmB,CACpB,AACD,+CACE,kBAAoB,CACrB,AACD,4BACE,WAAY,AACZ,WAAY,AACZ,gBAAiB,AACjB,mBAAoB,AACpB,eAAgB,AAChB,kBAAmB,AACnB,gBAAiB,AACjB,uBAA0B,CAC3B,AACD,oCACA,gCACI,WAAY,AACZ,kBAAmB,AACnB,eAAiB,AACjB,SAAa,CAChB,AACD,mCACI,iBAAmB,CACtB,AACD,8BACI,SAAW,CACd,CACA",file:"Footer.vue",sourcesContent:["\nfooter[data-v-1343eda2] {\r\n  width:100%;\r\n  min-height: 200px;\r\n  float: left;\r\n  overflow-y: hidden;\r\n  background: #e9e9e9;\r\n  margin-top: 50px;\n}\n.footer[data-v-1343eda2]{\r\n  width: 80%;\r\n  float: left;\r\n  min-height: 50px;\r\n  margin-left: 10%; \r\n  margin-right: 10%;\r\n  overflow-y: hidden;\n}\n.footer-widget[data-v-1343eda2]{\r\n  width: 25%;\r\n  float: left;\r\n  margin-top: 50px;\r\n  list-style: none;\r\n  padding: 0px;\r\n  margin-bottom: 0px;\n}\n.footer-widget li[data-v-1343eda2]{\r\n  list-style: none;\r\n  padding: 5px 10px 5px 10px;\r\n  float: left;\r\n  width: 100%;\r\n  color: #6f6f6f !important;\n}\n.footer-widget[data-v-1343eda2], .footer-widget li a[data-v-1343eda2]{\r\n  color: #6f6f6f !important;\n}\n.footer-widget .title[data-v-1343eda2]{\r\n  color: #4c4c4c;\n}\n.footer-widget li a[data-v-1343eda2]:hover{\r\n  cursor: pointer;\r\n  text-decoration: underline;\n}\nfooter-widget .title[data-v-1343eda2]:hover{\r\n  cursor: default;\n}\n.community .title[data-v-1343eda2]{\r\n  width: 100%;\r\n  float: left;\r\n  height: 40px;\r\n  text-align: left;\r\n  padding-top: 5px;\n}\n.community .links[data-v-1343eda2]{\r\n  width: 100%;\r\n  float: left;\n}\n.community .link i[data-v-1343eda2]{\r\n  font-size: 24px;\r\n  padding: 0 10px 0 10px;\r\n  float: left;\r\n  width: 20%;\n}\n.community .link i[data-v-1343eda2]:hover{\r\n  color: #1caceb;\r\n  cursor: pointer;\n}\n.text-gray[data-v-1343eda2]{\r\n  color: #212529;\n}\n.contact-us li i[data-v-1343eda2]{\r\n  padding-right: 10px;\n}\n.contact-us li .fa-phone[data-v-1343eda2]{\r\n  padding-right: 9px;\n}\n.contact-us li .fa-mobile-alt[data-v-1343eda2]{\r\n  padding-right: 12px;\n}\n.copyright[data-v-1343eda2]{\r\n  width: 100%;\r\n  float: left;\r\n  padding-top: 5px;\r\n  padding-bottom: 5px;\r\n  font-size: 12px;\r\n  text-align: center;\r\n  margin-top: 45px;\r\n  color: #6f6f6f !important;\n}\n@media screen and (max-width: 992px){\n.footer-widget[data-v-1343eda2]{\r\n    width: 100%;\r\n    text-align: center;\r\n    margin-right: 0%;\r\n    padding: 0px;\n}\n.community .title[data-v-1343eda2]{\r\n    text-align: center;\n}\n.community i[data-v-1343eda2]{\r\n    width: 20%;\n}\n}\r\n"],sourceRoot:""}])},858:function(t,a,e){var n=e(765);"string"==typeof n&&(n=[[t.i,n,""]]),n.locals&&(t.exports=n.locals);e(307)("032bb7ad",n,!0)},991:function(t,a){t.exports={render:function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("footer",[e("div",{staticClass:"footer"},[e("ul",{staticClass:"footer-widget contact-us"},[t._m(0),t._v(" "),e("li",{staticClass:"link"},[e("a",{on:{click:function(a){t.redirect("/")}}},[t._v("Home")])])]),t._v(" "),e("ul",{staticClass:"footer-widget"},[t._m(1),t._v(" "),e("li",{staticClass:"link"},[e("a",{on:{click:function(a){t.redirect("/terms_and_conditions")}}},[t._v("Terms & Conditions")])]),t._v(" "),e("li",{staticClass:"link"},[e("a",{on:{click:function(a){t.redirect("/privacy_policy")}}},[t._v("Privacy Policy")])])]),t._v(" "),e("ul",{staticClass:"footer-widget"},[t._m(2),t._v(" "),e("li",{staticClass:"link"},[e("a",{on:{click:function(a){t.redirect("/guide/ft")}}},[t._v("Teacher's Guide")])]),t._v(" "),e("li",{staticClass:"link"},[e("a",{on:{click:function(a){t.redirect("/guide/fs")}}},[t._v("Student's Guide")])])]),t._v(" "),t._m(3),t._v(" "),t._m(4)])])},staticRenderFns:[function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("li",{staticClass:"title"},[e("b",[t._v("ClassWorx")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("li",{staticClass:"title"},[e("b",[t._v("Privacy and Terms")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("li",{staticClass:"title"},[e("b",[t._v("Resources")])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("span",{staticClass:"footer-widget community"},[e("span",{staticClass:"title"},[e("b",[t._v("Community")])]),t._v(" "),e("span",{staticClass:"link"},[e("a",{staticClass:"text-gray",attrs:{target:"_BLANK",href:"https://www.facebook.com/classworx"}},[e("i",{staticClass:"fab fa-facebook"})])])])},function(){var t=this,a=t.$createElement,e=t._self._c||a;return e("span",{staticClass:"copyright"},[e("label",[t._v("Copyright @ClassWorx 2018. All rights reserved.")])])}]}}});
//# sourceMappingURL=45.cae11248c72c723aea50.js.map