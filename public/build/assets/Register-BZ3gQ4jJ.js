import{l as p,T as c,o as w,k as g,w as n,b as o,u as s,Z as _,a as t,i as d,q as V,n as y,d as v}from"./app-BfhOvkBX.js";import{_ as k}from"./GuestLayout.vue_vue_type_script_setup_true_lang-BiM8bgBI.js";import{_ as l}from"./InputError.vue_vue_type_script_setup_true_lang-BbEaGZV5.js";import{_ as m,a as i}from"./TextInput.vue_vue_type_script_setup_true_lang-CBaD9KJO.js";import{P as x}from"./PrimaryButton-D-Kokau_.js";import"./ApplicationLogo-BnaeedOT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const b={class:"mt-4"},q={class:"mt-4"},B={class:"mt-4"},C={class:"flex items-center justify-end mt-4"},A=p({__name:"Register",setup(N){const e=c({name:"",email:"",password:"",password_confirmation:""}),u=()=>{e.post(route("register"),{onFinish:()=>{e.reset("password","password_confirmation")}})};return(f,a)=>(w(),g(k,null,{default:n(()=>[o(s(_),{title:"Register"}),t("form",{onSubmit:v(u,["prevent"])},[t("div",null,[o(m,{for:"name",value:"Name"}),o(i,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:s(e).name,"onUpdate:modelValue":a[0]||(a[0]=r=>s(e).name=r),required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),o(l,{class:"mt-2",message:s(e).errors.name},null,8,["message"])]),t("div",b,[o(m,{for:"email",value:"Email"}),o(i,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[1]||(a[1]=r=>s(e).email=r),required:"",autocomplete:"username"},null,8,["modelValue"]),o(l,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),t("div",q,[o(m,{for:"password",value:"Password"}),o(i,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[2]||(a[2]=r=>s(e).password=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(l,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),t("div",B,[o(m,{for:"password_confirmation",value:"Confirm Password"}),o(i,{id:"password_confirmation",type:"password",class:"mt-1 block w-full",modelValue:s(e).password_confirmation,"onUpdate:modelValue":a[3]||(a[3]=r=>s(e).password_confirmation=r),required:"",autocomplete:"new-password"},null,8,["modelValue"]),o(l,{class:"mt-2",message:s(e).errors.password_confirmation},null,8,["message"])]),t("div",C,[o(s(V),{href:f.route("login"),class:"underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:n(()=>a[4]||(a[4]=[d(" Already registered? ")])),_:1},8,["href"]),o(x,{class:y(["ms-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:n(()=>a[5]||(a[5]=[d(" Register ")])),_:1},8,["class","disabled"])])],32)]),_:1}))}});export{A as default};
