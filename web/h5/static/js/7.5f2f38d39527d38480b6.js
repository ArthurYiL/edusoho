webpackJsonp([7],{P8if:function(e,t,i){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var s=i("Dd8w"),r=i.n(s),n=i("jW8y"),a=i("gMS5"),o=i("NYxO"),u=i("Du/2"),c={components:{Directory:n.a,DetailHead:a.a},computed:r()({},Object(o.mapState)("course",{details:function(e){return e.details}}),Object(o.mapState)({isLoading:function(e){return e.isLoading}})),beforeRouteLeave:function(e,t,i){this.$store.commit("course/"+u.i,{sourceType:"img"}),i()}},d={render:function(){var e=this.$createElement,t=this._self._c||e;return t("div",{staticClass:"course-detail try"},[this.isLoading?t("e-loading"):this._e(),this._v(" "),t("detail-head",{attrs:{courseSet:this.details.courseSet}}),this._v(" "),t("directory",{attrs:{hiddeTitle:!0,courseItems:this.details.courseItems}})],1)},staticRenderFns:[]},l=i("VU/8")(c,d,!1,null,null,null);t.default=l.exports},gMS5:function(e,t,i){"use strict";var s=i("//Fk"),r=i.n(s),n=i("Xxa5"),a=i.n(n),o=i("woOf"),u=i.n(o),c=(i("eqfM"),i("/QYm")),d=i("exGp"),l=i.n(d),p=i("Dd8w"),v=i.n(p),m=i("PirY"),y=i.n(m),f=i("NYxO"),h=i("gyMJ"),w={data:function(){return{isEncryptionPlus:!1,mediaOpts:{}}},props:{courseSet:{type:Object,default:{}}},computed:v()({},Object(f.mapState)("course",{sourceType:function(e){return e.sourceType},selectedPlanId:function(e){return e.selectedPlanId},taskId:function(e){return e.taskId},details:function(e){return e.details},joinStatus:function(e){return e.joinStatus},user:function(e){return e.user}})),watch:{taskId:{immediate:!0,handler:function(e,t){["video","audio"].includes(this.sourceType)&&(window.scrollTo(0,0),this.initPlayer())}}},methods:{viewAudioDoc:function(){this.$router.push({name:"course_audioview",query:v()({},this.mediaOpts)})},getParams:function(){return!this.joinStatus?{query:{courseId:this.selectedPlanId,taskId:this.taskId},params:{preview:1}}:{query:{courseId:this.selectedPlanId,taskId:this.taskId}}},initPlayer:function(){var e=this;return l()(a.a.mark(function t(){var i,s,r;return a.a.wrap(function(t){for(;;)switch(t.prev=t.next){case 0:return e.$refs.video&&(e.$refs.video.innerHTML=""),t.next=3,h.a.getMedia(e.getParams());case 3:if(i=t.sent,e.isEncryptionPlus=i.media.isEncryptionPlus,!i.media.isEncryptionPlus){t.next=8;break}return Object(c.a)("该浏览器不支持云视频播放，请下载App"),t.abrupt("return");case 8:s=i.media,r={id:"course-detail__head--video",user:e.user,playlist:s.url,autoplay:!0,disableFullscreen:"audio"===e.sourceType},e.mediaOpts=u()({text:i.media.text},r),e.$store.commit("UPDATE_LOADING_STATUS",!0),e.loadPlayerSDK().then(function(t){e.$store.commit("UPDATE_LOADING_STATUS",!1);new t(r)});case 13:case"end":return t.stop()}},t,e)}))()},loadPlayerSDK:function(){if(!window.VideoPlayerSDK){var e="//service-cdn.qiqiuyun.net/js-sdk/video-player/sdk-v1.js?v="+Date.now()/1e3/60;return new r.a(function(t,i){y()(e,function(e){e&&i(e),t(window.VideoPlayerSDK)})})}return r.a.resolve(window.VideoPlayerSDK)}}},P={render:function(){var e=this,t=e.$createElement,i=e._self._c||t;return i("div",{staticClass:"course-detail__head"},[i("div",{directives:[{name:"show",rawName:"v-show",value:["audio"].includes(e.sourceType)&&!e.isEncryptionPlus,expression:"['audio'].includes(sourceType) && !isEncryptionPlus"}],staticClass:"course-detail__nav--btn",on:{click:e.viewAudioDoc}},[e._v("\n    文稿\n  ")]),e._v(" "),i("div",{directives:[{name:"show",rawName:"v-show",value:"img"===e.sourceType||e.isEncryptionPlus,expression:"sourceType === 'img' || isEncryptionPlus"}],staticClass:"course-detail__head--img"},[i("img",{attrs:{src:e.courseSet.cover.large,alt:""}})]),e._v(" "),i("div",{directives:[{name:"show",rawName:"v-show",value:["video","audio"].includes(e.sourceType)&&!e.isEncryptionPlus,expression:"['video', 'audio'].includes(sourceType) && !isEncryptionPlus"}],ref:"video",attrs:{id:"course-detail__head--video"}})])},staticRenderFns:[]},_=i("VU/8")(w,P,!1,null,null,null);t.a=_.exports}});