import{G as l,a as i}from"./Row.830f6397.js";import{n as r}from"./_plugin-vue2_normalizer.61652a7c.js";import{C as c}from"./Tooltip.68a8a92b.js";import{S as p}from"./CheckSolid.731d2c48.js";import{e as u}from"./index.3c70e00e.js";import{C as _}from"./SettingsRow.edbb3005.js";import{T as d}from"./Slide.15a07930.js";const v={components:{GridColumn:l,GridRow:i},props:{options:{type:Array,required:!0},name:{type:String,required:!0},value:String}};var f=function(){var t=this,e=t._self._c;return e("div",{staticClass:"aioseo-box-toggle"},[e("grid-row",t._l(t.options,function(o,n){return e("grid-column",{key:n,attrs:{sm:"6",md:"4"}},[e("input",{attrs:{id:`id_${t.name}_${n}`,name:t.name,type:"radio"},domProps:{checked:o.value===t.value},on:{input:function(a){return t.$emit("input",o.value)}}}),e("label",{attrs:{for:`id_${t.name}_${n}`}},[t._t(o.slot,function(){return[t._v(" "+t._s(o.label)+" ")]})],2)])}),1)],1)},g=[],C=r(v,f,g,!1,null,null,null,null);const h=C.exports;const m={components:{CoreTooltip:c,SvgCircleCheckSolid:p,SvgCopy:u},props:{message:{type:String,required:!0}},data(){return{copied:!1}},computed:{copyText(){return this.copied?this.$t.__("Copied!",this.$td):this.$t.__("Click to Copy",this.$td)}},methods:{onCopy(){this.copied=!0;const s=this.$refs["copy-tooltip"].$children[0];s.popperJS&&(s.popperJS.destroy(),s.popperJS=null),s.showPopper=!1,setTimeout(()=>{s.popperJS&&(s.popperJS.destroy(),s.popperJS=null),s.showPopper=!1,this.copied=!1},2e3)},onError(){}}};var y=function(){var t=this,e=t._self._c;return e("div",{staticClass:"aioseo-copy-block"},[e("div",{staticClass:"message"},[t._v(" "+t._s(t.message)+" ")]),e("core-tooltip",{ref:"copy-tooltip",staticClass:"copy-tooltip",scopedSlots:t._u([{key:"tooltip",fn:function(){return[t._v(" "+t._s(t.copyText)+" ")]},proxy:!0}])},[e("div",{directives:[{name:"clipboard",rawName:"v-clipboard:copy",value:t.message,expression:"message",arg:"copy"},{name:"clipboard",rawName:"v-clipboard:success",value:t.onCopy,expression:"onCopy",arg:"success"},{name:"clipboard",rawName:"v-clipboard:error",value:t.onError,expression:"onError",arg:"error"}],staticClass:"copy"},[t.copied?t._e():e("svg-copy"),t.copied?e("svg-circle-check-solid"):t._e()],1)])],1)},x=[],$=r(m,y,x,!1,null,null,null,null);const H=$.exports,w={};var V=function(){var t=this,e=t._self._c;return e("svg",{staticClass:"aioseo-gutenberg-block",attrs:{viewBox:"0 0 59 54",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[e("rect",{attrs:{x:"1.5",y:"1.50024",stroke:"currentColor","stroke-width":"3","stroke-dasharray":"5 3"}}),e("path",{attrs:{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M47.6849 10.0276H11.3151V43.9728H47.6849V10.0276ZM22.6301 25.8377V28.1766H28.7115V34.2742H31.0967V28.1766H37.1781V25.8377H31.0967V19.7262H28.7115V25.8377H22.6301Z",fill:"currentcolor"}})])},b=[],S=r(w,V,b,!1,null,null,null,null);const k=S.exports,L={};var M=function(){var t=this,e=t._self._c;return e("svg",{staticClass:"aioseo-php",attrs:{viewBox:"0 0 110 25",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[e("path",{attrs:{d:"M23.3994 19.1184H27.8077V23.0002H23.3994V19.1184ZM18 9.44752C18.1183 6.89548 19.0996 5.08666 20.9438 4.02106C22.1075 3.34052 23.5375 3.00024 25.2337 3.00024C27.4625 3.00024 29.3116 3.48379 30.7811 4.45088C32.2604 5.41797 33 6.8507 33 8.74907C33 9.91316 32.6795 10.8937 32.0385 11.6906C31.6637 12.1742 30.9438 12.7921 29.8787 13.5442L28.8284 14.283C28.2564 14.6859 27.8767 15.1561 27.6893 15.6933C27.571 16.0336 27.5069 16.5619 27.497 17.2783H23.503C23.5621 15.765 23.7199 14.7218 23.9763 14.1487C24.2327 13.5666 24.8935 12.8995 25.9586 12.1473L27.0385 11.3817C27.3935 11.1399 27.6795 10.8758 27.8965 10.5892C28.2909 10.0967 28.4882 9.55498 28.4882 8.96398C28.4882 8.28343 28.2663 7.66557 27.8225 7.11039C27.3886 6.54625 26.5897 6.26418 25.426 6.26418C24.2821 6.26418 23.4684 6.60893 22.9852 7.29843C22.5118 7.98793 22.2751 8.7043 22.2751 9.44752H18Z",fill:"currentColor"}}),e("path",{attrs:{d:"M49.9406 9.72752C49.9406 8.79129 49.695 8.12372 49.2038 7.7248C48.7207 7.32589 48.0403 7.12643 47.1626 7.12643H43.696V12.4263H47.1626C48.0403 12.4263 48.7207 12.2106 49.2038 11.7791C49.695 11.3476 49.9406 10.6637 49.9406 9.72752ZM53.6246 9.70309C53.6246 11.8279 53.0931 13.33 52.0302 14.2092C50.9673 15.0884 49.4494 15.5281 47.4766 15.5281H43.696V22.0002H40V4.00024H47.7544C49.542 4.00024 50.9673 4.46429 52.0302 5.39237C53.0931 6.32046 53.6246 7.75737 53.6246 9.70309Z",fill:"currentColor"}}),e("path",{attrs:{d:"M56.3905 22.0002V4.00024H60.0745V10.8632H67.0317V4.00024H70.7277V22.0002H67.0317V13.965H60.0745V22.0002H56.3905Z",fill:"currentColor"}}),e("path",{attrs:{d:"M84.3161 9.72752C84.3161 8.79129 84.0705 8.12372 83.5793 7.7248C83.0961 7.32589 82.4157 7.12643 81.538 7.12643H78.0715V12.4263H81.538C82.4157 12.4263 83.0961 12.2106 83.5793 11.7791C84.0705 11.3476 84.3161 10.6637 84.3161 9.72752ZM88 9.70309C88 11.8279 87.4685 13.33 86.4056 14.2092C85.3427 15.0884 83.8249 15.5281 81.852 15.5281H78.0715V22.0002H74.3754V4.00024H82.1298C83.9175 4.00024 85.3427 4.46429 86.4056 5.39237C87.4685 6.32046 88 7.75737 88 9.70309Z",fill:"currentColor"}}),e("path",{attrs:{d:"M12.1457 0.000244141L15 2.93774L5.72875 12.5002L15 22.0627L12.1457 25.0002L0 12.5002L12.1457 0.000244141Z",fill:"currentColor"}}),e("path",{attrs:{d:"M97.8543 0.000244141L95 2.93774L104.271 12.5002L95 22.0627L97.8543 25.0002L110 12.5002L97.8543 0.000244141Z",fill:"currentColor"}})])},Z=[],A=r(L,M,Z,!1,null,null,null,null);const B=A.exports,I={};var T=function(){var t=this,e=t._self._c;return e("svg",{staticClass:"aioseo-shortcode",attrs:{viewBox:"0 0 59 39",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[e("path",{attrs:{d:"M0 0.000244141H11V4.31055H5.91633V34.6692H11V39.0002H0V0.000244141Z",fill:"currentColor"}}),e("path",{attrs:{d:"M34.1337 0.000244141H40L25.8168 39.0002H20L34.1337 0.000244141Z",fill:"currentColor"}}),e("path",{attrs:{d:"M59 0.000244141H48V4.31055H53.0837V34.6692H48V39.0002H59V0.000244141Z",fill:"currentColor"}})])},R=[],O=r(I,T,R,!1,null,null,null,null);const P=O.exports,F={};var J=function(){var t=this,e=t._self._c;return e("svg",{staticClass:"aioseo-widget",attrs:{viewBox:"0 0 57 57",fill:"none",xmlns:"http://www.w3.org/2000/svg"}},[e("path",{attrs:{d:"M48.6875 7.12506H8.3125C7.00625 7.12506 5.9375 8.19381 5.9375 9.50006V23.7501C5.9375 25.0563 7.00625 26.1251 8.3125 26.1251H48.6875C49.9938 26.1251 51.0625 25.0563 51.0625 23.7501V9.50006C51.0625 8.19381 49.9938 7.12506 48.6875 7.12506ZM46.3125 21.3751V11.8751H10.6875V21.3751H46.3125ZM46.3125 45.1251V35.6251H10.6875V45.1251H46.3125ZM8.3125 30.8751H48.6875C49.9938 30.8751 51.0625 31.9438 51.0625 33.2501V47.5001C51.0625 48.8063 49.9938 49.8751 48.6875 49.8751H8.3125C7.00625 49.8751 5.9375 48.8063 5.9375 47.5001V33.2501C5.9375 31.9438 7.00625 30.8751 8.3125 30.8751Z",fill:"currentColor"}})])},E=[],G=r(F,J,E,!1,null,null,null,null);const D=G.exports;const j={components:{BaseBoxToggle:h,CoreCopyBlock:H,CoreSettingsRow:_,SvgGutenbergBlock:k,SvgPhp:B,SvgShortcode:P,SvgWidget:D,TransitionSlide:d},props:{label:{type:String,default(){return this.$t.__("Display Info",this.$td)}},options:{type:Object,default(){return{block:{copy:"",desc:"",input:!1},shortcode:{copy:"",desc:"",input:!1},widget:{copy:"",desc:"",input:!1},php:{copy:"",desc:"",input:!1},extra:{copy:"",desc:"",input:!1}}}}},data(){return{currentItem:Object.keys(this.options)[0],errors:[],showAdvancedSettings:!1,strings:{advancedSettings:this.$t.__("Advanced Settings",this.$td),gutenbergBlock:this.$t.__("Gutenberg Block",this.$td),phpCode:this.$t.__("PHP Code",this.$td),shortcode:this.$t.__("Shortcode",this.$td),widget:this.$t.__("Widget",this.$td)}}},computed:{boxToggleOptions(){return Object.keys(this.options).map(t=>({value:t,slot:t,copy:this.options[t].copy,desc:this.options[t].desc}))}},watch:{currentItem(s){this.currentItem=s}},methods:{inputEvent(s){this.$emit("input",s),this.showAdvancedSettings=!1}}};var q=function(){var t=this,e=t._self._c;return e("core-settings-row",{staticClass:"aioseo-display-info",attrs:{name:t.label,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("base-box-toggle",{attrs:{name:"displayInfo",options:t.boxToggleOptions},on:{input:o=>t.inputEvent(o)},scopedSlots:t._u([{key:"extra",fn:function(){return[t._t("extra")]},proxy:!0},{key:"shortcode",fn:function(){return[e("svg-shortcode"),e("p",[t._v(t._s(t.strings.shortcode))])]},proxy:!0},{key:"block",fn:function(){return[e("svg-gutenberg-block"),e("p",[t._v(t._s(t.strings.gutenbergBlock))])]},proxy:!0},{key:"php",fn:function(){return[e("svg-php"),e("p",[t._v(t._s(t.strings.phpCode))])]},proxy:!0},{key:"widget",fn:function(){return[e("svg-widget"),e("p",[t._v(t._s(t.strings.widget))])]},proxy:!0}],null,!0),model:{value:t.currentItem,callback:function(o){t.currentItem=o},expression:"currentItem"}}),e("div",{staticClass:"displayInfo-show-content"},t._l(t.boxToggleOptions,function(o,n){return e("transition-slide",{key:n,attrs:{active:o.value===t.currentItem}},[o.slot!=="extra"?e("div",{staticClass:"copy-box"},[e("div",[o.desc?e("div",{staticClass:"aioseo-description",domProps:{innerHTML:t._s(o.desc)}}):t._e(),o.copy?e("core-copy-block",{attrs:{message:o.copy}}):t._e(),t.$slots[o.slot+"Advanced"]&&!t.showAdvancedSettings?e("a",{staticClass:"advanced-settings-link",attrs:{href:"#"},on:{click:function(a){a.preventDefault(),t.showAdvancedSettings=!t.showAdvancedSettings}}},[t._v(t._s(t.strings.advancedSettings))]):t._e()],1),t.$slots[o.slot+"Advanced"]?e("transition-slide",{class:{"advanced-settings":!0,"advanced-settings-hidden":!t.showAdvancedSettings},attrs:{active:t.showAdvancedSettings}},[t._t(o.slot+"Advanced")],2):t._e()],1):t._e(),o.slot==="extra"?e("div",{staticClass:"extra-box"},[t._t("extraBox",null,{item:o})],2):t._e()])}),1)]},proxy:!0}],null,!0)})},N=[],W=r(j,q,N,!1,null,null,null,null);const et=W.exports;export{et as C};
