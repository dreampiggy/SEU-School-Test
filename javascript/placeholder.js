$(document).ready(function(){
    var doc=document,inputs=doc.getElementsByTagName('input'),supportPlaceholder='placeholder'in doc.createElement('input'),placeholder=function(input){var text=input.getAttribute('placeholder'),defaultValue=input.defaultValue;
    if(defaultValue==''){
        input.value=text;input.style.color='#888';}
        input.onfocus=function(){
            if(input.value===text){this.value='';this.style.color='#000'}};
            input.onblur=function(){if(input.value===''){this.value=text;this.style.color='#888'}}};
            if(!supportPlaceholder){
                for(var i=0,len=inputs.length;i<len;i++){var input=inputs[i],text=input.getAttribute('placeholder');
                if(input.type==='text'&&text){placeholder(input)}}}});