webpackJsonp([21],{kxIp:function(t,e,n){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var i={render:function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"prelogin"},[n("img",{staticClass:"prelogin-img",attrs:{src:"static/images/noLoginEmpty.png"}}),t._v(" "),n("span",{staticClass:"prelogin-text"},[t._v("登录后查看更多信息")]),t._v(" "),n("van-button",{staticClass:"prelogin-btn",attrs:{type:"default"},nativeOn:{click:function(e){return t.goLogin(e)}}},[t._v("立即登录")])],1)},staticRenderFns:[]},s=n("VU/8")({methods:{goLogin:function(){this.$router.push({name:"login",query:{redirect:this.$route.query.redirect||"/"}})}}},i,!1,null,null,null);e.default=s.exports}});