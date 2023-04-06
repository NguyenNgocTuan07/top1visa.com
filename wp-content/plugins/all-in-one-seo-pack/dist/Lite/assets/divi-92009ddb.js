import{n as h,V as l}from"./js/_plugin-vue2_normalizer.61652a7c.js";import"./js/index.46447f5c.js";import{T as $}from"./js/index.0d4da42f.js";import"./js/index.4b67d3e2.js";import{s as c}from"./js/index.ec9852b3.js";import{d,S as B}from"./js/Caret.d93b302e.js";import{e as L,m as C}from"./js/attachments.437fe1f4.js";import{b as D}from"./js/_baseSet.a0ce9a58.js";import{i as k}from"./js/isEqual.3cbd4b2b.js";import{A as M}from"./js/App.1e47721b.js";import{i as x}from"./js/portal-vue.esm.98f2e05b.js";import{P}from"./js/App.91b79a40.js";import"./js/client.e62d6c37.js";import"./js/_commonjsHelpers.f84db168.js";import"./js/translations.c394afe3.js";import"./js/default-i18n.3a91e0e5.js";import"./js/index.1edc4884.js";import"./js/helpers.de7566d0.js";import"./js/constants.0d8c074c.js";import"./js/isArrayLikeObject.9b4b678d.js";import"./js/vuex.esm.8fdeb4b6.js";import"./js/cleanForSlug.51ef7354.js";import"./js/html.14f2a8b9.js";import"./js/_baseIsEqual.7a24c257.js";import"./js/_getTag.7235c98a.js";/* empty css                */import"./js/params.597cd0f5.js";import"./js/WpTable.e2f412d1.js";import"./js/Index.5f7ddb17.js";import"./js/JsonValues.870a4901.js";import"./js/SaveChanges.e40a9083.js";import"./js/SettingsRow.edbb3005.js";import"./js/Row.830f6397.js";import"./js/Checkbox.60ba2f56.js";import"./js/Checkmark.f26f6201.js";import"./js/LicenseKeyBar.f7493613.js";import"./js/LogoGear.16108a75.js";import"./js/Tabs.a309f2c7.js";import"./js/TruSeoScore.339d22e1.js";import"./js/Information.93f80cbf.js";import"./js/Slide.15a07930.js";import"./js/Portal.79020666.js";import"./js/MaxCounts.12b45bab.js";import"./js/Plus.6984df43.js";import"./js/Editor.3e312d73.js";import"./js/Blur.f36c594d.js";import"./js/Tooltip.68a8a92b.js";import"./js/RadioToggle.e6e54396.js";import"./js/GoogleSearchPreview.853cda22.js";import"./js/HtmlTagsEditor.70d3cf0a.js";import"./js/UnfilteredHtml.7bdb1712.js";import"./js/popup.b60b699f.js";import"./js/Index.21aaf27c.js";import"./js/Table.30698570.js";import"./js/PostTypes.9ab32454.js";import"./js/InternalOutbound.e736afb6.js";import"./js/RequiredPlans.3ea0b33e.js";import"./js/Image.d51c3f0f.js";import"./js/Img.c432d837.js";import"./js/FacebookPreview.6ab415ea.js";import"./js/Profile.c44d4735.js";import"./js/TwitterPreview.cb2ad48f.js";import"./js/Book.9dd59972.js";import"./js/Settings.26e66713.js";import"./js/Build.6a71ce0a.js";import"./js/Redirects.3b63a946.js";import"./js/Index.31a9bad1.js";import"./js/strings.aee612e0.js";import"./js/isString.0b99231f.js";import"./js/ProBadge.66f48bdc.js";import"./js/External.4c957e9a.js";import"./js/Exclamation.fd45a7b0.js";import"./js/Gear.184e0c65.js";import"./js/Card.db2ec99d.js";import"./js/Eye.57c925d7.js";function b(t,e,o){return t==null?t:D(t,e,o)}const y=t=>t.parentElement.removeChild(t),S=()=>{const t=f();document.body.classList.toggle("aioseo-settings-bar-is-active",t),document.body.classList.toggle("aioseo-settings-bar-is-inactive",!t)},q=()=>{const t=u();r(document.body,"aioseo-settings-bar-is"),document.body.classList.add(`aioseo-settings-bar-is-${t}`),g(t)},A=t=>{const e=document.getElementById(t);return e.contentWindow?e.contentWindow.document:e.contentDocument},O=()=>{m.addEventListener("change",()=>{w(),g(u())}),N.observe(document.querySelector(".et-fb-page-settings-bar"),{attributeFilter:["class"]}),document.addEventListener("click",_),A("et-fb-app-frame").addEventListener("click",_),s.addEventListener("click",()=>{const t=new Event("aioseo-divi-toggle-modal");document.dispatchEvent(t)})},T=()=>{const t=u();r(document.body,"aioseo-settings-bar-is"),document.body.classList.add(`aioseo-settings-bar-is-${t}`),S(),w(),U()||g(t)},w=()=>{E()&&(s=y(s))},g=t=>{if(E())return;const e=document.querySelector(".et-fb-page-settings-bar"),o=e.querySelector(".et-fb-page-settings-bar__toggle-button"),i=e.querySelectorAll(".et-fb-page-settings-bar__column");if(R(t),f())if(m.matches){const n=[...i].filter(p=>p.classList.contains("et-fb-page-settings-bar__column--main"));n.length&&n[0].appendChild(s)}else{const n=[...i].filter(p=>p.classList.contains("et-fb-page-settings-bar__column--left"));n.length&&n[0].insertBefore(s)}else o.insertAdjacentElement("afterend",s)},R=t=>{r(s,"aioseo-settings-bar-root"),s.classList.add(`aioseo-settings-bar-root-${t}`),r(s,"aioseo-settings-bar-root-is-mobile"),["aioseo-settings-bar-root-is-mobile",`aioseo-settings-bar-root-is-mobile-${t}`].forEach(i=>{s.classList.toggle(i,!m.matches)}),r(s,"aioseo-settings-bar-root-is-desktop"),["aioseo-settings-bar-root-is-desktop",`aioseo-settings-bar-root-is-desktop-${t}`].forEach(i=>{s.classList.toggle(i,m.matches)})},r=(t,e)=>{const o=[`${e}-left`,`${e}-right`,`${e}-top`,`${e}-top-left`,`${e}-top-right`,`${e}-bottom`,`${e}-bottom-left`,`${e}-bottom-right`];t.classList.remove(...o)},u=()=>{const t=document.querySelector(".et-fb-page-settings-bar").classList;return t.contains("et-fb-page-settings-bar--horizontal")&&!t.contains("et-fb-page-settings-bar--top")?"bottom":t.contains("et-fb-page-settings-bar--top")&&!t.contains("et-fb-page-settings-bar--corner")?"top":t.contains("et-fb-page-settings-bar--bottom-corner")?t.contains("et-fb-page-settings-bar--left-corner")?"bottom-left":"bottom-right":t.contains("et-fb-page-settings-bar--top-corner")?t.contains("et-fb-page-settings-bar--left-corner")?"top-left":"top-right":t.contains("et-fb-page-settings-bar--vertical--right")?"right":t.contains("et-fb-page-settings-bar--vertical--left")?"left":""},_=t=>{if(!F())return;const e=t.target,o=".aioseo-modal",i=".aioseo-app.aioseo-post-settings-modal";if(!e.closest(o)&&!e.closest(i)&&!(e!==document.querySelector(o)&&e.contains(document.querySelector(o)))&&e.getAttribute("class")&&!e.getAttribute("class").includes("aioseo")&&e!==s){const n=new Event("aioseo-divi-toggle-modal",{open:!1});document.dispatchEvent(n)}},F=()=>!document.querySelector(".aioseo-modal").classList.contains("aioseo-modal-is-closed"),E=()=>document.documentElement!==s&&document.documentElement.contains(s),f=()=>document.querySelector(".et-fb-page-settings-bar").classList.contains("et-fb-page-settings-bar--active"),U=()=>document.querySelector(".et-fb-page-settings-bar").classList.contains("et-fb-page-settings-bar--dragged")&&!f(),m=window.matchMedia("(min-width: 768px)"),N=new MutationObserver(T),W="#aioseo-settings";let s=document.querySelector(W);s=y(s);const X=()=>{S(),q(),O()};let v={};const a=()=>{const t={...v},e=L();k(t,e)||(v=e,C())},Y=()=>{c.dispatch("saveCurrentPost",c.state.currentPost)},z=()=>{a(),window.addEventListener("message",t=>{t.data.eventType==="et_fb_section_content_change"&&d(a,1e3)}),window.wp&&window.wp.hooks.addFilter("et.builder.store.setting.update","aioseo",(t,e)=>{if(t)switch(e){case"et_pb_post_settings_title":b(ETBuilderBackendDynamic,"postTitle",t),d(a,1e3);break;case"et_pb_post_settings_excerpt":b(ETBuilderBackendDynamic,"postMeta.post_excerpt",t),d(a,1e3);break}return t}),document.querySelector(".et-fb-button--save-draft, .et-fb-button--publish").addEventListener("click",Y)};const V={props:{completelyDraggable:{type:Boolean,default(){return!0}}},data(){return{position1:0,position2:0,position3:0,position4:0}},methods:{dragMouseDown(t){t=t||window.event,t.preventDefault(),this.position3=t.clientX,this.position4=t.clientY,document.onmousemove=this.elementDrag,document.onmouseup=this.closeDragElement},elementDrag(t){t=t||window.event,t.preventDefault(),this.position1=this.position3-t.clientX,this.position2=this.position4-t.clientY,this.position3=t.clientX,this.position4=t.clientY,this.$el.style.top=this.$el.offsetTop-this.position2+"px",this.$el.style.left=this.$el.offsetLeft-this.position1+"px"},closeDragElement(){document.onmouseup=null,document.onmousemove=null}}};var I=function(){var e=this,o=e._self._c;return o("div",{staticClass:"aioseo-draggable"},[e.completelyDraggable?o("div",{on:{dragMouseDown:e.dragMouseDown}},[e._t("default")],2):e._e(),e.completelyDraggable?e._e():o("div",[e._t("default")],2)])},Q=[],G=h(V,I,Q,!1,null,null,null,null);const H=G.exports,J={components:{PostSettings:M,SvgClose:B,UtilDraggable:H},data(){return{isOpen:!1,strings:{header:this.$t.sprintf(this.$t.__("%1$s settings",this.$td),"All in One SEO")}}},methods:{toggleModal(){this.isOpen=!this.isOpen}},beforeUnmount(){document.removeEventListener("aioseo-divi-toggle-modal",this.toggleModal)},mounted(){this.$nextTick(function(){document.addEventListener("aioseo-divi-toggle-modal",this.toggleModal)})}};var K=function(){var e=this,o=e._self._c;return o("util-draggable",{ref:"modal-container",attrs:{completelyDraggable:!1}},[o("div",{staticClass:"aioseo-modal",class:{"aioseo-modal-is-closed":!e.isOpen}},[o("div",{staticClass:"aioseo-modal-header",on:{mousedown:function(i){return i.preventDefault(),(n=>e.$refs["modal-container"].dragMouseDown(n)).apply(null,arguments)}}},[o("div",{staticClass:"aioseo-modal-header-title"},[e._v(e._s(e.strings.header))]),o("div",{staticClass:"aioseo-modal-header-close",on:{click:function(i){e.isOpen=!1}}},[o("svg-close")],1)]),o("div",{staticClass:"aioseo-modal-body edit-post-sidebar"},[o("PostSettings")],1)])])},Z=[],j=h(J,K,Z,!1,null,null,null,null);const tt=j.exports;l.prototype.$truSeo=new $;const et=()=>{new l({store:c,data:{tableContext:window.aioseo.currentPost.context,screenContext:"sidebar"},render:t=>t(tt)}).$mount("#aioseo-app-modal > div")},ot=()=>{l.use(x),document.querySelector("#aioseo-modal-portal")&&new l({store:c,render:e=>e(P)}).$mount("#aioseo-modal-portal")},st=()=>{X(),et(),ot(),z()};window.addEventListener("message",function(t){t.data.eventType==="et_builder_api_ready"&&st()});
