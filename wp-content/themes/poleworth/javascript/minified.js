(function(e,t){"use strict";function n(e){var t=Array.prototype.slice.call(arguments,1);return e.prop?e.prop.apply(e,t):e.attr.apply(e,t)}function s(e,t,n){var s,a;for(s in n)n.hasOwnProperty(s)&&(a=s.replace(/ |$/g,t.eventNamespace),e.bind(a,n[s]))}function a(e,t,n){s(e,n,{focus:function(){t.addClass(n.focusClass)},blur:function(){t.removeClass(n.focusClass),t.removeClass(n.activeClass)},mouseenter:function(){t.addClass(n.hoverClass)},mouseleave:function(){t.removeClass(n.hoverClass),t.removeClass(n.activeClass)},"mousedown touchbegin":function(){e.is(":disabled")||t.addClass(n.activeClass)},"mouseup touchend":function(){t.removeClass(n.activeClass)}})}function i(e,t){e.removeClass(t.hoverClass+" "+t.focusClass+" "+t.activeClass)}function r(e,t,n){n?e.addClass(t):e.removeClass(t)}function l(e,t,n){var s="checked",a=t.is(":"+s);t.prop?t.prop(s,a):a?t.attr(s,s):t.removeAttr(s),r(e,n.checkedClass,a)}function u(e,t,n){r(e,n.disabledClass,t.is(":disabled"))}function o(e,t,n){switch(n){case"after":return e.after(t),e.next();case"before":return e.before(t),e.prev();case"wrap":return e.wrap(t),e.parent()}return null}function c(t,s,a){var i,r,l;return a||(a={}),a=e.extend({bind:{},divClass:null,divWrap:"wrap",spanClass:null,spanHtml:null,spanWrap:"wrap"},a),i=e("<div />"),r=e("<span />"),s.autoHide&&t.is(":hidden")&&"none"===t.css("display")&&i.hide(),a.divClass&&i.addClass(a.divClass),s.wrapperClass&&i.addClass(s.wrapperClass),a.spanClass&&r.addClass(a.spanClass),l=n(t,"id"),s.useID&&l&&n(i,"id",s.idPrefix+"-"+l),a.spanHtml&&r.html(a.spanHtml),i=o(t,i,a.divWrap),r=o(t,r,a.spanWrap),u(i,t,s),{div:i,span:r}}function d(t,n){var s;return n.wrapperClass?(s=e("<span />").addClass(n.wrapperClass),s=o(t,s,"wrap")):null}function f(){var t,n,s,a;return a="rgb(120,2,153)",n=e('<div style="width:0;height:0;color:'+a+'">'),e("body").append(n),s=n.get(0),t=window.getComputedStyle?window.getComputedStyle(s,"").color:(s.currentStyle||s.style||{}).color,n.remove(),t.replace(/ /g,"")!==a}function p(t){return t?e("<span />").text(t).html():""}function m(){return navigator.cpuClass&&!navigator.product}function v(){return window.XMLHttpRequest!==void 0?!0:!1}function h(e){var t;return e[0].multiple?!0:(t=n(e,"size"),!t||1>=t?!1:!0)}function C(){return!1}function w(e,t){var n="none";s(e,t,{"selectstart dragstart mousedown":C}),e.css({MozUserSelect:n,msUserSelect:n,webkitUserSelect:n,userSelect:n})}function b(e,t,n){var s=e.val();""===s?s=n.fileDefaultHtml:(s=s.split(/[\/\\]+/),s=s[s.length-1]),t.text(s)}function y(e,t,n){var s,a;for(s=[],e.each(function(){var e;for(e in t)Object.prototype.hasOwnProperty.call(t,e)&&(s.push({el:this,name:e,old:this.style[e]}),this.style[e]=t[e])}),n();s.length;)a=s.pop(),a.el.style[a.name]=a.old}function g(e,t){var n;n=e.parents(),n.push(e[0]),n=n.not(":visible"),y(n,{visibility:"hidden",display:"block",position:"absolute"},t)}function k(e,t){return function(){e.unwrap().unwrap().unbind(t.eventNamespace)}}var H=!0,x=!1,A=[{match:function(e){return e.is("a, button, :submit, :reset, input[type='button']")},apply:function(e,t){var r,l,o,d,f;return l=t.submitDefaultHtml,e.is(":reset")&&(l=t.resetDefaultHtml),d=e.is("a, button")?function(){return e.html()||l}:function(){return p(n(e,"value"))||l},o=c(e,t,{divClass:t.buttonClass,spanHtml:d()}),r=o.div,a(e,r,t),f=!1,s(r,t,{"click touchend":function(){var t,s,a,i;f||e.is(":disabled")||(f=!0,e[0].dispatchEvent?(t=document.createEvent("MouseEvents"),t.initEvent("click",!0,!0),s=e[0].dispatchEvent(t),e.is("a")&&s&&(a=n(e,"target"),i=n(e,"href"),a&&"_self"!==a?window.open(i,a):document.location.href=i)):e.click(),f=!1)}}),w(r,t),{remove:function(){return r.after(e),r.remove(),e.unbind(t.eventNamespace),e},update:function(){i(r,t),u(r,e,t),e.detach(),o.span.html(d()).append(e)}}}},{match:function(e){return e.is(":checkbox")},apply:function(e,t){var n,r,o;return n=c(e,t,{divClass:t.checkboxClass}),r=n.div,o=n.span,a(e,r,t),s(e,t,{"click touchend":function(){l(o,e,t)}}),l(o,e,t),{remove:k(e,t),update:function(){i(r,t),o.removeClass(t.checkedClass),l(o,e,t),u(r,e,t)}}}},{match:function(e){return e.is(":file")},apply:function(t,r){function l(){b(t,p,r)}var d,f,p,v;return d=c(t,r,{divClass:r.fileClass,spanClass:r.fileButtonClass,spanHtml:r.fileButtonHtml,spanWrap:"after"}),f=d.div,v=d.span,p=e("<span />").html(r.fileDefaultHtml),p.addClass(r.filenameClass),p=o(t,p,"after"),n(t,"size")||n(t,"size",f.width()/10),a(t,f,r),l(),m()?s(t,r,{click:function(){t.trigger("change"),setTimeout(l,0)}}):s(t,r,{change:l}),w(p,r),w(v,r),{remove:function(){return p.remove(),v.remove(),t.unwrap().unbind(r.eventNamespace)},update:function(){i(f,r),b(t,p,r),u(f,t,r)}}}},{match:function(e){if(e.is("input")){var t=(" "+n(e,"type")+" ").toLowerCase(),s=" color date datetime datetime-local email month number password search tel text time url week ";return s.indexOf(t)>=0}return!1},apply:function(e,t){var s,i;return s=n(e,"type"),e.addClass(t.inputClass),i=d(e,t),a(e,e,t),t.inputAddTypeAsClass&&e.addClass(s),{remove:function(){e.removeClass(t.inputClass),t.inputAddTypeAsClass&&e.removeClass(s),i&&e.unwrap()},update:C}}},{match:function(e){return e.is(":radio")},apply:function(t,r){var o,d,f;return o=c(t,r,{divClass:r.radioClass}),d=o.div,f=o.span,a(t,d,r),s(t,r,{"click touchend":function(){e.uniform.update(e(':radio[name="'+n(t,"name")+'"]'))}}),l(f,t,r),{remove:k(t,r),update:function(){i(d,r),l(f,t,r),u(d,t,r)}}}},{match:function(e){return e.is("select")&&!h(e)?!0:!1},apply:function(t,n){var r,l,o,d;return n.selectAutoWidth&&g(t,function(){d=t.width()}),r=c(t,n,{divClass:n.selectClass,spanHtml:(t.find(":selected:first")||t.find("option:first")).html(),spanWrap:"before"}),l=r.div,o=r.span,n.selectAutoWidth?g(t,function(){y(e([o[0],l[0]]),{display:"block"},function(){var e;e=o.outerWidth()-o.width(),l.width(d+e),o.width(d)})}):l.addClass("fixedWidth"),a(t,l,n),s(t,n,{change:function(){o.html(t.find(":selected").html()),l.removeClass(n.activeClass)},"click touchend":function(){var e=t.find(":selected").html();o.html()!==e&&t.trigger("change")},keyup:function(){o.html(t.find(":selected").html())}}),w(o,n),{remove:function(){return o.remove(),t.unwrap().unbind(n.eventNamespace),t},update:function(){n.selectAutoWidth?(e.uniform.restore(t),t.uniform(n)):(i(l,n),o.html(t.find(":selected").html()),u(l,t,n))}}}},{match:function(e){return e.is("select")&&h(e)?!0:!1},apply:function(e,t){var n;return e.addClass(t.selectMultiClass),n=d(e,t),a(e,e,t),{remove:function(){e.removeClass(t.selectMultiClass),n&&e.unwrap()},update:C}}},{match:function(e){return e.is("textarea")},apply:function(e,t){var n;return e.addClass(t.textareaClass),n=d(e,t),a(e,e,t),{remove:function(){e.removeClass(t.textareaClass),n&&e.unwrap()},update:C}}}];m()&&!v()&&(H=!1),e.uniform={defaults:{activeClass:"active",autoHide:!0,buttonClass:"button",checkboxClass:"checker",checkedClass:"checked",disabledClass:"disabled",eventNamespace:".uniform",fileButtonClass:"action",fileButtonHtml:"Choose File",fileClass:"uploader",fileDefaultHtml:"No file selected",filenameClass:"filename",focusClass:"focus",hoverClass:"hover",idPrefix:"uniform",inputAddTypeAsClass:!0,inputClass:"uniform-input",radioClass:"radio",resetDefaultHtml:"Reset",resetSelector:!1,selectAutoWidth:!0,selectClass:"selector",selectMultiClass:"uniform-multiselect",submitDefaultHtml:"Submit",textareaClass:"uniform",useID:!0,wrapperClass:null},elements:[]},e.fn.uniform=function(t){var n=this;return t=e.extend({},e.uniform.defaults,t),x||(x=!0,f()&&(H=!1)),H?(t.resetSelector&&e(t.resetSelector).mouseup(function(){window.setTimeout(function(){e.uniform.update(n)},10)}),this.each(function(){var n,s,a,i=e(this);if(i.data("uniformed"))return e.uniform.update(i),void 0;for(n=0;A.length>n;n+=1)if(s=A[n],s.match(i,t))return a=s.apply(i,t),i.data("uniformed",a),e.uniform.elements.push(i.get(0)),void 0})):this},e.uniform.restore=e.fn.uniform.restore=function(n){n===t&&(n=e.uniform.elements),e(n).each(function(){var t,n,s=e(this);n=s.data("uniformed"),n&&(n.remove(),t=e.inArray(this,e.uniform.elements),t>=0&&e.uniform.elements.splice(t,1),s.removeData("uniformed"))})},e.uniform.update=e.fn.uniform.update=function(n){n===t&&(n=e.uniform.elements),e(n).each(function(){var t,n=e(this);t=n.data("uniformed"),t&&t.update(n,t.options)})}})(jQuery);
(function(f){f.fn.noUiSlider=function(n,r){function s(a,e,c){var g=e.data("setup"),l=g.handles;e=g.settings;g=g.pos;a=0>a?0:100<a?100:a;2==e.handles&&(c.is(":first-child")?(c=parseFloat(l[1][0].style[g])-e.margin,a=a>c?c:a):(c=parseFloat(l[0][0].style[g])+e.margin,a=a<c?c:a));e.step&&(c=m.from(e.range,e.step),a=Math.round(a/c)*c);return a}function t(a){try{return[a.clientX||a.originalEvent.clientX||a.originalEvent.touches[0].clientX,a.clientY||a.originalEvent.clientY||a.originalEvent.touches[0].clientY]}catch(e){return["x",
"y"]}}var j=window.navigator.msPointerEnabled?2:"ontouchend"in document?3:1;window.debug&&console&&console.log(j);var m={to:function(a,e){e=0>a[0]?e+Math.abs(a[0]):e-a[0];return 100*e/this._length(a)},from:function(a,e){return 100*e/this._length(a)},is:function(a,e){return e*this._length(a)/100+a[0]},_length:function(a){return a[0]>a[1]?a[0]-a[1]:a[1]-a[0]}},w={handles:2,serialization:{to:["",""],resolution:0.01}};methods={create:function(){return this.each(function(){var a=f.extend(w,n),e=f(this).data("_isnS_",
!0),c=[],g,l,b="",h=function(a){return!isNaN(parseFloat(a))&&isFinite(a)},k=(a.serialization.resolution=a.serialization.resolution||0.01).toString().split("."),q=1==k[0]?0:k[1].length;a.start=h(a.start)?[a.start,0]:a.start;f.each(a,function(b,d){h(d)?a[b]=parseFloat(d):"object"==typeof d&&h(d[0])&&(d[0]=parseFloat(d[0]),h(d[1])&&(d[1]=parseFloat(d[1])));var c=!1;d="undefined"==typeof d?"x":d;switch(b){case "range":case "start":c=2!=d.length||!h(d[0])||!h(d[1]);break;case "handles":c=1>d||2<d||!h(d);
break;case "connect":c="lower"!=d&&"upper"!=d&&"boolean"!=typeof d;break;case "orientation":c="vertical"!=d&&"horizontal"!=d;break;case "margin":case "step":c="undefined"!=typeof d&&!h(d);break;case "serialization":c="object"!=typeof d||!h(d.resolution)||"object"==typeof d.to&&d.to.length<a.handles;break;case "slide":c="function"!=typeof d}c&&console&&console.error("Bad input for "+b+" on slider:",e)});a.margin=a.margin?m.from(a.range,a.margin):0;if(a.serialization.to instanceof jQuery||"string"==
typeof a.serialization.to||!1===a.serialization.to)a.serialization.to=[a.serialization.to];"vertical"==a.orientation?(b+="vertical",g="top",l=1):(b+="horizontal",g="left",l=0);b+=a.connect?"lower"==a.connect?" connect lower":" connect":"";e.addClass(b);for(b=0;b<a.handles;b++){c[b]=e.append("<a><div></div></a>").children(":last");k=m.to(a.range,a.start[b]);c[b].css(g,k+"%");100==k&&c[b].is(":first-child")&&c[b].css("z-index",2);var k=(1===j?"mousedown":2===j?"MSPointerDown":"touchstart")+".noUiSliderX",
r=(1===j?"mousemove":2===j?"MSPointerMove":"touchmove")+".noUiSlider",v=(1===j?"mouseup":2===j?"MSPointerUp":"touchend")+".noUiSlider";c[b].find("div").on(k,function(b){f("body").bind("selectstart.noUiSlider",function(){return!1});if(!e.hasClass("disabled")){f("body").addClass("TOUCH");var d=f(this).addClass("active").parent(),h=d.add(f(document)).add("body"),k=parseFloat(d[0].style[g]),j=t(b),u=j,n=!1;f(document).on(r,function(b){b.preventDefault();b=t(b);if("x"!=b[0]){b[0]-=j[0];b[1]-=j[1];var p=
[u[0]!=b[0],u[1]!=b[1]],f=k+100*b[l]/(l?e.height():e.width()),f=s(f,e,d);if(p[l]&&f!=n){d.css(g,f+"%").data("input").val(m.is(a.range,f).toFixed(q));var p=a.slide,h=e.data("_n",!0);"function"===typeof p&&p.call(h,void 0);n=f;d.css("z-index",2==c.length&&100==f&&d.is(":first-child")?2:1)}u=b}}).on(v,function(){h.off(".noUiSlider");f("body").removeClass("TOUCH");e.find(".active").removeClass("active").end().data("_n")&&e.data("_n",!1).change()})}}).on("click",function(a){a.stopPropagation()})}if(1==
j)e.on("click",function(b){if(!e.hasClass("disabled")){var d=t(b);b=100*(d[l]-e.offset()[g])/(l?e.height():e.width());d=1<c.length?d[l]<(c[0].offset()[g]+c[1].offset()[g])/2?c[0]:c[1]:c[0];b=s(b,e,d);d.css(g,b+"%").data("input").val(m.is(a.range,b).toFixed(q));b=a.slide;"function"===typeof b&&b.call(e,void 0);e.change()}});for(b=0;b<c.length;b++)k=m.is(a.range,parseFloat(c[b][0].style[g])).toFixed(q),"string"==typeof a.serialization.to[b]?c[b].data("input",e.append('<input type="hidden" name="'+a.serialization.to[b]+
'">').find("input:last").val(k).change(function(a){a.stopPropagation()})):!1==a.serialization.to[b]?c[b].data("input",{val:function(a){if("undefined"!=typeof a)this.handle.data("noUiVal",a);else return this.handle.data("noUiVal")},handle:c[b]}):c[b].data("input",a.serialization.to[b].data("handleNR",b).val(k).change(function(){var a=[null,null];a[f(this).data("handleNR")]=f(this).val();e.val(a)}));f(this).data("setup",{settings:a,handles:c,pos:g,res:q})})},val:function(a){if("undefined"!==typeof a){var e=
"number"==typeof a?[a]:a;return this.each(function(){for(var a=f(this).data("setup"),b=0;b<a.handles.length;b++)if(null!=e[b]){var c=s(m.to(a.settings.range,e[b]),f(this),a.handles[b]);a.handles[b].css(a.pos,c+"%").data("input").val(m.is(a.settings.range,c).toFixed(a.res))}})}a=f(this).data("setup").handles;for(var c=[],g=0;g<a.length;g++)c.push(parseFloat(a[g].data("input").val()));return 1==c.length?c[0]:c},disabled:function(){return r?f(this).addClass("disabled"):f(this).removeClass("disabled")}};
var v=jQuery.fn.val;jQuery.fn.val=function(){return this.data("_isnS_")?methods.val.apply(this,arguments):v.apply(this,arguments)};return"disabled"==n?methods.disabled.apply(this):methods.create.apply(this)}})(jQuery);
 ;(function($,window,document,undefined){var name="jPages",instance=null,defaults={containerID:"",first:false,previous:"← previous",next:"next →",last:false,links:"numeric",startPage:1,perPage:10,midRange:5,startRange:1,endRange:1,keyBrowse:false,scrollBrowse:false,pause:0,clickStop:false,delay:50,direction:"forward",animation:"",fallback:400,minHeight:true,callback:undefined};function Plugin(element,options){this.options=$.extend({},defaults,options);this._container=$("#"+this.options.containerID);if(!this._container.length)return;this.jQwindow=$(window);this.jQdocument=$(document);this._holder=$(element);this._nav={};this._first=$(this.options.first);this._previous=$(this.options.previous);this._next=$(this.options.next);this._last=$(this.options.last);this._items=this._container.children(":visible");this._itemsShowing=$([]);this._itemsHiding=$([]);this._numPages=Math.ceil(this._items.length/this.options.perPage);this._currentPageNum=this.options.startPage;this._clicked=false;this._cssAnimSupport=this.getCSSAnimationSupport();this.init();}Plugin.prototype={constructor:Plugin,getCSSAnimationSupport:function(){var animation=false,animationstring='animation',keyframeprefix='',domPrefixes='Webkit Moz O ms Khtml'.split(' '),pfx='',elm=this._container.get(0);if(elm.style.animationName)animation=true;if(animation===false){for(var i=0;i<domPrefixes.length;i++){if(elm.style[domPrefixes[i]+'AnimationName']!==undefined){pfx=domPrefixes[i];animationstring=pfx+'Animation';keyframeprefix='-'+pfx.toLowerCase()+'-';animation=true;break;}}}return animation;},init:function(){this.setStyles();this.setNav();this.paginate(this._currentPageNum);this.setMinHeight();},setStyles:function(){var requiredStyles="<style>"+".jp-invisible { visibility: hidden !important; } "+".jp-hidden { display: none !important; }"+"</style>";$(requiredStyles).appendTo("head");if(this._cssAnimSupport&&this.options.animation.length)this._items.addClass("animated jp-hidden");else this._items.hide();},setNav:function(){var navhtml=this.writeNav();this._holder.each(this.bind(function(index,element){var holder=$(element);holder.html(navhtml);this.cacheNavElements(holder,index);this.bindNavHandlers(index);this.disableNavSelection(element);},this));if(this.options.keyBrowse)this.bindNavKeyBrowse();if(this.options.scrollBrowse)this.bindNavScrollBrowse();},writeNav:function(){var i=1,navhtml;navhtml=this.writeBtn("first")+this.writeBtn("previous");for(;i<=this._numPages;i++){if(i===1&&this.options.startRange===0)navhtml+="<span>...</span>";if(i>this.options.startRange&&i<=this._numPages-this.options.endRange)navhtml+="<a href='#' class='jp-hidden'>";else
navhtml+="<a>";switch(this.options.links){case"numeric":navhtml+=i;break;case"blank":break;case"title":var title=this._items.eq(i-1).attr("data-title");navhtml+=title!==undefined?title:"";break;}navhtml+="</a>";if(i===this.options.startRange||i===this._numPages-this.options.endRange)navhtml+="<span>...</span>";}navhtml+=this.writeBtn("next")+this.writeBtn("last")+"</div>";return navhtml;},writeBtn:function(which){return this.options[which]!==false&&!$(this["_"+which]).length?"<a class='jp-"+which+"'>"+this.options[which]+"</a>":"";},cacheNavElements:function(holder,index){this._nav[index]={};this._nav[index].holder=holder;this._nav[index].first=this._first.length?this._first:this._nav[index].holder.find("a.jp-first");this._nav[index].previous=this._previous.length?this._previous:this._nav[index].holder.find("a.jp-previous");this._nav[index].next=this._next.length?this._next:this._nav[index].holder.find("a.jp-next");this._nav[index].last=this._last.length?this._last:this._nav[index].holder.find("a.jp-last");this._nav[index].fstBreak=this._nav[index].holder.find("span:first");this._nav[index].lstBreak=this._nav[index].holder.find("span:last");this._nav[index].pages=this._nav[index].holder.find("a").not(".jp-first, .jp-previous, .jp-next, .jp-last");this._nav[index].permPages=this._nav[index].pages.slice(0,this.options.startRange).add(this._nav[index].pages.slice(this._numPages-this.options.endRange,this._numPages));this._nav[index].pagesShowing=$([]);this._nav[index].currentPage=$([]);},bindNavHandlers:function(index){var nav=this._nav[index];nav.holder.bind("click.jPages",this.bind(function(evt){var newPage=this.getNewPage(nav,$(evt.target));if(this.validNewPage(newPage)){this._clicked=true;this.paginate(newPage);}evt.preventDefault();},this));if(this._first.length){this._first.bind("click.jPages",this.bind(function(){if(this.validNewPage(1)){this._clicked=true;this.paginate(1);}},this));}if(this._previous.length){this._previous.bind("click.jPages",this.bind(function(){var newPage=this._currentPageNum-1;if(this.validNewPage(newPage)){this._clicked=true;this.paginate(newPage);}},this));}if(this._next.length){this._next.bind("click.jPages",this.bind(function(){var newPage=this._currentPageNum+1;if(this.validNewPage(newPage)){this._clicked=true;this.paginate(newPage);}},this));}if(this._last.length){this._last.bind("click.jPages",this.bind(function(){if(this.validNewPage(this._numPages)){this._clicked=true;this.paginate(this._numPages);}},this));}},disableNavSelection:function(element){if(typeof element.onselectstart!="undefined")element.onselectstart=function(){return false;};else if(typeof element.style.MozUserSelect!="undefined")element.style.MozUserSelect="none";else
element.onmousedown=function(){return false;};},bindNavKeyBrowse:function(){this.jQdocument.bind("keydown.jPages",this.bind(function(evt){var target=evt.target.nodeName.toLowerCase();if(this.elemScrolledIntoView()&&target!=="input"&&target!="textarea"){var newPage=this._currentPageNum;if(evt.which==37)newPage=this._currentPageNum-1;if(evt.which==39)newPage=this._currentPageNum+1;if(this.validNewPage(newPage)){this._clicked=true;this.paginate(newPage);}}},this));},elemScrolledIntoView:function(){var docViewTop,docViewBottom,elemTop,elemBottom;docViewTop=this.jQwindow.scrollTop();docViewBottom=docViewTop+this.jQwindow.height();elemTop=this._container.offset().top;elemBottom=elemTop+this._container.height();return((elemBottom>=docViewTop)&&(elemTop<=docViewBottom));},bindNavScrollBrowse:function(){this._container.bind("mousewheel.jPages DOMMouseScroll.jPages",this.bind(function(evt){var newPage=(evt.originalEvent.wheelDelta||-evt.originalEvent.detail)>0?(this._currentPageNum-1):(this._currentPageNum+1);if(this.validNewPage(newPage)){this._clicked=true;this.paginate(newPage);}evt.preventDefault();return false;},this));},getNewPage:function(nav,target){if(target.is(nav.currentPage))return this._currentPageNum;if(target.is(nav.pages))return nav.pages.index(target)+1;if(target.is(nav.first))return 1;if(target.is(nav.last))return this._numPages;if(target.is(nav.previous))return nav.pages.index(nav.currentPage);if(target.is(nav.next))return nav.pages.index(nav.currentPage)+2;},validNewPage:function(newPage){return newPage!==this._currentPageNum&&newPage>0&&newPage<=this._numPages;},paginate:function(page){var itemRange,pageInterval;itemRange=this.updateItems(page);pageInterval=this.updatePages(page);this._currentPageNum=page;if($.isFunction(this.options.callback))this.callback(page,itemRange,pageInterval);this.updatePause();},updateItems:function(page){var range=this.getItemRange(page);this._itemsHiding=this._itemsShowing;this._itemsShowing=this._items.slice(range.start,range.end);if(this._cssAnimSupport&&this.options.animation.length)this.cssAnimations(page);else this.jQAnimations(page);return range;},getItemRange:function(page){var range={};range.start=(page-1)*this.options.perPage;range.end=range.start+this.options.perPage;if(range.end>this._items.length)range.end=this._items.length;return range;},cssAnimations:function(page){clearInterval(this._delay);this._itemsHiding.removeClass(this.options.animation+" jp-invisible").addClass("jp-hidden");this._itemsShowing.removeClass("jp-hidden").addClass("jp-invisible");this._itemsOriented=this.getDirectedItems(page);this._index=0;this._delay=setInterval(this.bind(function(){if(this._index===this._itemsOriented.length)clearInterval(this._delay);else{this._itemsOriented.eq(this._index).removeClass("jp-invisible").addClass(this.options.animation);}this._index=this._index+1;},this),this.options.delay);},jQAnimations:function(page){clearInterval(this._delay);this._itemsHiding.addClass("jp-hidden");this._itemsShowing.fadeTo(0,0).removeClass("jp-hidden");this._itemsOriented=this.getDirectedItems(page);this._index=0;this._delay=setInterval(this.bind(function(){if(this._index===this._itemsOriented.length)clearInterval(this._delay);else{this._itemsOriented.eq(this._index).fadeTo(this.options.fallback,1);}this._index=this._index+1;},this),this.options.delay);},getDirectedItems:function(page){var itemsToShow;switch(this.options.direction){case"backwards":itemsToShow=$(this._itemsShowing.get().reverse());break;case"random":itemsToShow=$(this._itemsShowing.get().sort(function(){return(Math.round(Math.random())-0.5);}));break;case"auto":itemsToShow=page>=this._currentPageNum?this._itemsShowing:$(this._itemsShowing.get().reverse());break;default:itemsToShow=this._itemsShowing;}return itemsToShow;},updatePages:function(page){var interval,index,nav;interval=this.getInterval(page);for(index in this._nav){if(this._nav.hasOwnProperty(index)){nav=this._nav[index];this.updateBtns(nav,page);this.updateCurrentPage(nav,page);this.updatePagesShowing(nav,interval);this.updateBreaks(nav,interval);}}return interval;},getInterval:function(page){var neHalf,upperLimit,start,end;neHalf=Math.ceil(this.options.midRange/2);upperLimit=this._numPages-this.options.midRange;start=page>neHalf?Math.max(Math.min(page-neHalf,upperLimit),0):0;end=page>neHalf?Math.min(page+neHalf-(this.options.midRange%2>0?1:0),this._numPages):Math.min(this.options.midRange,this._numPages);return{start:start,end:end};},updateBtns:function(nav,page){if(page===1){nav.first.addClass("jp-disabled");nav.previous.addClass("jp-disabled");}if(page===this._numPages){nav.next.addClass("jp-disabled");nav.last.addClass("jp-disabled");}if(this._currentPageNum===1&&page>1){nav.first.removeClass("jp-disabled");nav.previous.removeClass("jp-disabled");}if(this._currentPageNum===this._numPages&&page<this._numPages){nav.next.removeClass("jp-disabled");nav.last.removeClass("jp-disabled");}},updateCurrentPage:function(nav,page){nav.currentPage.removeClass("jp-current");nav.currentPage=nav.pages.eq(page-1).addClass("jp-current");},updatePagesShowing:function(nav,interval){var newRange=nav.pages.slice(interval.start,interval.end).not(nav.permPages);nav.pagesShowing.not(newRange).addClass("jp-hidden");newRange.not(nav.pagesShowing).removeClass("jp-hidden");nav.pagesShowing=newRange;},updateBreaks:function(nav,interval){if(interval.start>this.options.startRange||(this.options.startRange===0&&interval.start>0))nav.fstBreak.removeClass("jp-hidden");else nav.fstBreak.addClass("jp-hidden");if(interval.end<this._numPages-this.options.endRange)nav.lstBreak.removeClass("jp-hidden");else nav.lstBreak.addClass("jp-hidden");},callback:function(page,itemRange,pageInterval){var pages={current:page,interval:pageInterval,count:this._numPages},items={showing:this._itemsShowing,oncoming:this._items.slice(itemRange.start+this.options.perPage,itemRange.end+this.options.perPage),range:itemRange,count:this._items.length};pages.interval.start=pages.interval.start+1;items.range.start=items.range.start+1;this.options.callback(pages,items);},updatePause:function(){if(this.options.pause&&this._numPages>1){clearTimeout(this._pause);if(this.options.clickStop&&this._clicked)return;else{this._pause=setTimeout(this.bind(function(){this.paginate(this._currentPageNum!==this._numPages?this._currentPageNum+1:1);},this),this.options.pause);}}},setMinHeight:function(){if(this.options.minHeight&&!this._container.is("table, tbody")){setTimeout(this.bind(function(){this._container.css({"min-height":this._container.css("height")});},this),1000);}},bind:function(fn,me){return function(){return fn.apply(me,arguments);};},destroy:function(){this.jQdocument.unbind("keydown.jPages");this._container.unbind("mousewheel.jPages DOMMouseScroll.jPages");if(this.options.minHeight)this._container.css("min-height","");if(this._cssAnimSupport&&this.options.animation.length)this._items.removeClass("animated jp-hidden jp-invisible "+this.options.animation);else this._items.removeClass("jp-hidden").fadeTo(0,1);this._holder.unbind("click.jPages").empty();}};$.fn[name]=function(arg){var type=$.type(arg);if(type==="object"){if(this.length&&!$.data(this,name)){instance=new Plugin(this,arg);this.each(function(){$.data(this,name,instance);});}return this;}if(type==="string"&&arg==="destroy"){instance.destroy();this.each(function(){$.removeData(this,name);});return this;}if(type==='number'&&arg%1===0){if(instance.validNewPage(arg))instance.paginate(arg);return this;}return this;};})(jQuery,window,document);
(function(C,z,f,r){var q=f(C),n=f(z),b=f.fancybox=function(){b.open.apply(this,arguments)},H=navigator.userAgent.match(/msie/i),w=null,s=z.createTouch!==r,t=function(a){return a&&a.hasOwnProperty&&a instanceof f},p=function(a){return a&&"string"===f.type(a)},F=function(a){return p(a)&&0<a.indexOf("%")},l=function(a,d){var e=parseInt(a,10)||0;d&&F(a)&&(e*=b.getViewport()[d]/100);return Math.ceil(e)},x=function(a,b){return l(a,b)+"px"};f.extend(b,{version:"2.1.4",defaults:{padding:15,margin:20,width:800,
height:600,minWidth:100,minHeight:100,maxWidth:9999,maxHeight:9999,autoSize:!0,autoHeight:!1,autoWidth:!1,autoResize:!0,autoCenter:!s,fitToView:!0,aspectRatio:!1,topRatio:0.5,leftRatio:0.5,scrolling:"auto",wrapCSS:"",arrows:!0,closeBtn:!0,closeClick:!1,nextClick:!1,mouseWheel:!0,autoPlay:!1,playSpeed:3E3,preload:3,modal:!1,loop:!0,ajax:{dataType:"html",headers:{"X-fancyBox":!0}},iframe:{scrolling:"auto",preload:!0},swf:{wmode:"transparent",allowfullscreen:"true",allowscriptaccess:"always"},keys:{next:{13:"left",
34:"up",39:"left",40:"up"},prev:{8:"right",33:"down",37:"right",38:"down"},close:[27],play:[32],toggle:[70]},direction:{next:"left",prev:"right"},scrollOutside:!0,index:0,type:null,href:null,content:null,title:null,tpl:{wrap:'<div class="fancybox-wrap" tabIndex="-1"><div class="fancybox-skin"><div class="fancybox-outer"><div class="fancybox-inner"></div></div></div></div>',image:'<img class="fancybox-image" src="{href}" alt="" />',iframe:'<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" frameborder="0" vspace="0" hspace="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen'+
(H?' allowtransparency="true"':"")+"></iframe>",error:'<p class="fancybox-error">The requested content cannot be loaded.<br/>Please try again later.</p>',closeBtn:'<a title="Close" class="fancybox-item fancybox-close" href="javascript:;"></a>',next:'<a title="Next" class="fancybox-nav fancybox-next" href="javascript:;"><span></span></a>',prev:'<a title="Previous" class="fancybox-nav fancybox-prev" href="javascript:;"><span></span></a>'},openEffect:"fade",openSpeed:250,openEasing:"swing",openOpacity:!0,
openMethod:"zoomIn",closeEffect:"fade",closeSpeed:250,closeEasing:"swing",closeOpacity:!0,closeMethod:"zoomOut",nextEffect:"elastic",nextSpeed:250,nextEasing:"swing",nextMethod:"changeIn",prevEffect:"elastic",prevSpeed:250,prevEasing:"swing",prevMethod:"changeOut",helpers:{overlay:!0,title:!0},onCancel:f.noop,beforeLoad:f.noop,afterLoad:f.noop,beforeShow:f.noop,afterShow:f.noop,beforeChange:f.noop,beforeClose:f.noop,afterClose:f.noop},group:{},opts:{},previous:null,coming:null,current:null,isActive:!1,
isOpen:!1,isOpened:!1,wrap:null,skin:null,outer:null,inner:null,player:{timer:null,isActive:!1},ajaxLoad:null,imgPreload:null,transitions:{},helpers:{},open:function(a,d){if(a&&(f.isPlainObject(d)||(d={}),!1!==b.close(!0)))return f.isArray(a)||(a=t(a)?f(a).get():[a]),f.each(a,function(e,c){var k={},g,h,j,m,l;"object"===f.type(c)&&(c.nodeType&&(c=f(c)),t(c)?(k={href:c.data("fancybox-href")||c.attr("href"),title:c.data("fancybox-title")||c.attr("title"),isDom:!0,element:c},f.metadata&&f.extend(!0,k,
c.metadata())):k=c);g=d.href||k.href||(p(c)?c:null);h=d.title!==r?d.title:k.title||"";m=(j=d.content||k.content)?"html":d.type||k.type;!m&&k.isDom&&(m=c.data("fancybox-type"),m||(m=(m=c.prop("class").match(/fancybox\.(\w+)/))?m[1]:null));p(g)&&(m||(b.isImage(g)?m="image":b.isSWF(g)?m="swf":"#"===g.charAt(0)?m="inline":p(c)&&(m="html",j=c)),"ajax"===m&&(l=g.split(/\s+/,2),g=l.shift(),l=l.shift()));j||("inline"===m?g?j=f(p(g)?g.replace(/.*(?=#[^\s]+$)/,""):g):k.isDom&&(j=c):"html"===m?j=g:!m&&(!g&&
k.isDom)&&(m="inline",j=c));f.extend(k,{href:g,type:m,content:j,title:h,selector:l});a[e]=k}),b.opts=f.extend(!0,{},b.defaults,d),d.keys!==r&&(b.opts.keys=d.keys?f.extend({},b.defaults.keys,d.keys):!1),b.group=a,b._start(b.opts.index)},cancel:function(){var a=b.coming;a&&!1!==b.trigger("onCancel")&&(b.hideLoading(),b.ajaxLoad&&b.ajaxLoad.abort(),b.ajaxLoad=null,b.imgPreload&&(b.imgPreload.onload=b.imgPreload.onerror=null),a.wrap&&a.wrap.stop(!0,!0).trigger("onReset").remove(),b.coming=null,b.current||
b._afterZoomOut(a))},close:function(a){b.cancel();!1!==b.trigger("beforeClose")&&(b.unbindEvents(),b.isActive&&(!b.isOpen||!0===a?(f(".fancybox-wrap").stop(!0).trigger("onReset").remove(),b._afterZoomOut()):(b.isOpen=b.isOpened=!1,b.isClosing=!0,f(".fancybox-item, .fancybox-nav").remove(),b.wrap.stop(!0,!0).removeClass("fancybox-opened"),b.transitions[b.current.closeMethod]())))},play:function(a){var d=function(){clearTimeout(b.player.timer)},e=function(){d();b.current&&b.player.isActive&&(b.player.timer=
setTimeout(b.next,b.current.playSpeed))},c=function(){d();f("body").unbind(".player");b.player.isActive=!1;b.trigger("onPlayEnd")};if(!0===a||!b.player.isActive&&!1!==a){if(b.current&&(b.current.loop||b.current.index<b.group.length-1))b.player.isActive=!0,f("body").bind({"afterShow.player onUpdate.player":e,"onCancel.player beforeClose.player":c,"beforeLoad.player":d}),e(),b.trigger("onPlayStart")}else c()},next:function(a){var d=b.current;d&&(p(a)||(a=d.direction.next),b.jumpto(d.index+1,a,"next"))},
prev:function(a){var d=b.current;d&&(p(a)||(a=d.direction.prev),b.jumpto(d.index-1,a,"prev"))},jumpto:function(a,d,e){var c=b.current;c&&(a=l(a),b.direction=d||c.direction[a>=c.index?"next":"prev"],b.router=e||"jumpto",c.loop&&(0>a&&(a=c.group.length+a%c.group.length),a%=c.group.length),c.group[a]!==r&&(b.cancel(),b._start(a)))},reposition:function(a,d){var e=b.current,c=e?e.wrap:null,k;c&&(k=b._getPosition(d),a&&"scroll"===a.type?(delete k.position,c.stop(!0,!0).animate(k,200)):(c.css(k),e.pos=f.extend({},
e.dim,k)))},update:function(a){var d=a&&a.type,e=!d||"orientationchange"===d;e&&(clearTimeout(w),w=null);b.isOpen&&!w&&(w=setTimeout(function(){var c=b.current;c&&!b.isClosing&&(b.wrap.removeClass("fancybox-tmp"),(e||"load"===d||"resize"===d&&c.autoResize)&&b._setDimension(),"scroll"===d&&c.canShrink||b.reposition(a),b.trigger("onUpdate"),w=null)},e&&!s?0:300))},toggle:function(a){b.isOpen&&(b.current.fitToView="boolean"===f.type(a)?a:!b.current.fitToView,s&&(b.wrap.removeAttr("style").addClass("fancybox-tmp"),
b.trigger("onUpdate")),b.update())},hideLoading:function(){n.unbind(".loading");f("#fancybox-loading").remove()},showLoading:function(){var a,d;b.hideLoading();a=f('<div id="fancybox-loading"><div></div></div>').click(b.cancel).appendTo("body");n.bind("keydown.loading",function(a){if(27===(a.which||a.keyCode))a.preventDefault(),b.cancel()});b.defaults.fixed||(d=b.getViewport(),a.css({position:"absolute",top:0.5*d.h+d.y,left:0.5*d.w+d.x}))},getViewport:function(){var a=b.current&&b.current.locked||
!1,d={x:q.scrollLeft(),y:q.scrollTop()};a?(d.w=a[0].clientWidth,d.h=a[0].clientHeight):(d.w=s&&C.innerWidth?C.innerWidth:q.width(),d.h=s&&C.innerHeight?C.innerHeight:q.height());return d},unbindEvents:function(){b.wrap&&t(b.wrap)&&b.wrap.unbind(".fb");n.unbind(".fb");q.unbind(".fb")},bindEvents:function(){var a=b.current,d;a&&(q.bind("orientationchange.fb"+(s?"":" resize.fb")+(a.autoCenter&&!a.locked?" scroll.fb":""),b.update),(d=a.keys)&&n.bind("keydown.fb",function(e){var c=e.which||e.keyCode,k=
e.target||e.srcElement;if(27===c&&b.coming)return!1;!e.ctrlKey&&(!e.altKey&&!e.shiftKey&&!e.metaKey&&(!k||!k.type&&!f(k).is("[contenteditable]")))&&f.each(d,function(d,k){if(1<a.group.length&&k[c]!==r)return b[d](k[c]),e.preventDefault(),!1;if(-1<f.inArray(c,k))return b[d](),e.preventDefault(),!1})}),f.fn.mousewheel&&a.mouseWheel&&b.wrap.bind("mousewheel.fb",function(d,c,k,g){for(var h=f(d.target||null),j=!1;h.length&&!j&&!h.is(".fancybox-skin")&&!h.is(".fancybox-wrap");)j=h[0]&&!(h[0].style.overflow&&
"hidden"===h[0].style.overflow)&&(h[0].clientWidth&&h[0].scrollWidth>h[0].clientWidth||h[0].clientHeight&&h[0].scrollHeight>h[0].clientHeight),h=f(h).parent();if(0!==c&&!j&&1<b.group.length&&!a.canShrink){if(0<g||0<k)b.prev(0<g?"down":"left");else if(0>g||0>k)b.next(0>g?"up":"right");d.preventDefault()}}))},trigger:function(a,d){var e,c=d||b.coming||b.current;if(c){f.isFunction(c[a])&&(e=c[a].apply(c,Array.prototype.slice.call(arguments,1)));if(!1===e)return!1;c.helpers&&f.each(c.helpers,function(d,
e){e&&(b.helpers[d]&&f.isFunction(b.helpers[d][a]))&&(e=f.extend(!0,{},b.helpers[d].defaults,e),b.helpers[d][a](e,c))});f.event.trigger(a+".fb")}},isImage:function(a){return p(a)&&a.match(/(^data:image\/.*,)|(\.(jp(e|g|eg)|gif|png|bmp|webp)((\?|#).*)?$)/i)},isSWF:function(a){return p(a)&&a.match(/\.(swf)((\?|#).*)?$/i)},_start:function(a){var d={},e,c;a=l(a);e=b.group[a]||null;if(!e)return!1;d=f.extend(!0,{},b.opts,e);e=d.margin;c=d.padding;"number"===f.type(e)&&(d.margin=[e,e,e,e]);"number"===f.type(c)&&
(d.padding=[c,c,c,c]);d.modal&&f.extend(!0,d,{closeBtn:!1,closeClick:!1,nextClick:!1,arrows:!1,mouseWheel:!1,keys:null,helpers:{overlay:{closeClick:!1}}});d.autoSize&&(d.autoWidth=d.autoHeight=!0);"auto"===d.width&&(d.autoWidth=!0);"auto"===d.height&&(d.autoHeight=!0);d.group=b.group;d.index=a;b.coming=d;if(!1===b.trigger("beforeLoad"))b.coming=null;else{c=d.type;e=d.href;if(!c)return b.coming=null,b.current&&b.router&&"jumpto"!==b.router?(b.current.index=a,b[b.router](b.direction)):!1;b.isActive=
!0;if("image"===c||"swf"===c)d.autoHeight=d.autoWidth=!1,d.scrolling="visible";"image"===c&&(d.aspectRatio=!0);"iframe"===c&&s&&(d.scrolling="scroll");d.wrap=f(d.tpl.wrap).addClass("fancybox-"+(s?"mobile":"desktop")+" fancybox-type-"+c+" fancybox-tmp "+d.wrapCSS).appendTo(d.parent||"body");f.extend(d,{skin:f(".fancybox-skin",d.wrap),outer:f(".fancybox-outer",d.wrap),inner:f(".fancybox-inner",d.wrap)});f.each(["Top","Right","Bottom","Left"],function(a,b){d.skin.css("padding"+b,x(d.padding[a]))});b.trigger("onReady");
if("inline"===c||"html"===c){if(!d.content||!d.content.length)return b._error("content")}else if(!e)return b._error("href");"image"===c?b._loadImage():"ajax"===c?b._loadAjax():"iframe"===c?b._loadIframe():b._afterLoad()}},_error:function(a){f.extend(b.coming,{type:"html",autoWidth:!0,autoHeight:!0,minWidth:0,minHeight:0,scrolling:"no",hasError:a,content:b.coming.tpl.error});b._afterLoad()},_loadImage:function(){var a=b.imgPreload=new Image;a.onload=function(){this.onload=this.onerror=null;b.coming.width=
this.width;b.coming.height=this.height;b._afterLoad()};a.onerror=function(){this.onload=this.onerror=null;b._error("image")};a.src=b.coming.href;!0!==a.complete&&b.showLoading()},_loadAjax:function(){var a=b.coming;b.showLoading();b.ajaxLoad=f.ajax(f.extend({},a.ajax,{url:a.href,error:function(a,e){b.coming&&"abort"!==e?b._error("ajax",a):b.hideLoading()},success:function(d,e){"success"===e&&(a.content=d,b._afterLoad())}}))},_loadIframe:function(){var a=b.coming,d=f(a.tpl.iframe.replace(/\{rnd\}/g,
(new Date).getTime())).attr("scrolling",s?"auto":a.iframe.scrolling).attr("src",a.href);f(a.wrap).bind("onReset",function(){try{f(this).find("iframe").hide().attr("src","//about:blank").end().empty()}catch(a){}});a.iframe.preload&&(b.showLoading(),d.one("load",function(){f(this).data("ready",1);s||f(this).bind("load.fb",b.update);f(this).parents(".fancybox-wrap").width("100%").removeClass("fancybox-tmp").show();b._afterLoad()}));a.content=d.appendTo(a.inner);a.iframe.preload||b._afterLoad()},_preloadImages:function(){var a=
b.group,d=b.current,e=a.length,c=d.preload?Math.min(d.preload,e-1):0,f,g;for(g=1;g<=c;g+=1)f=a[(d.index+g)%e],"image"===f.type&&f.href&&((new Image).src=f.href)},_afterLoad:function(){var a=b.coming,d=b.current,e,c,k,g,h;b.hideLoading();if(a&&!1!==b.isActive)if(!1===b.trigger("afterLoad",a,d))a.wrap.stop(!0).trigger("onReset").remove(),b.coming=null;else{d&&(b.trigger("beforeChange",d),d.wrap.stop(!0).removeClass("fancybox-opened").find(".fancybox-item, .fancybox-nav").remove());b.unbindEvents();
e=a.content;c=a.type;k=a.scrolling;f.extend(b,{wrap:a.wrap,skin:a.skin,outer:a.outer,inner:a.inner,current:a,previous:d});g=a.href;switch(c){case "inline":case "ajax":case "html":a.selector?e=f("<div>").html(e).find(a.selector):t(e)&&(e.data("fancybox-placeholder")||e.data("fancybox-placeholder",f('<div class="fancybox-placeholder"></div>').insertAfter(e).hide()),e=e.show().detach(),a.wrap.bind("onReset",function(){f(this).find(e).length&&e.hide().replaceAll(e.data("fancybox-placeholder")).data("fancybox-placeholder",
!1)}));break;case "image":e=a.tpl.image.replace("{href}",g);break;case "swf":e='<object id="fancybox-swf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100%" height="100%"><param name="movie" value="'+g+'"></param>',h="",f.each(a.swf,function(a,b){e+='<param name="'+a+'" value="'+b+'"></param>';h+=" "+a+'="'+b+'"'}),e+='<embed src="'+g+'" type="application/x-shockwave-flash" width="100%" height="100%"'+h+"></embed></object>"}(!t(e)||!e.parent().is(a.inner))&&a.inner.append(e);b.trigger("beforeShow");
a.inner.css("overflow","yes"===k?"scroll":"no"===k?"hidden":k);b._setDimension();b.reposition();b.isOpen=!1;b.coming=null;b.bindEvents();if(b.isOpened){if(d.prevMethod)b.transitions[d.prevMethod]()}else f(".fancybox-wrap").not(a.wrap).stop(!0).trigger("onReset").remove();b.transitions[b.isOpened?a.nextMethod:a.openMethod]();b._preloadImages()}},_setDimension:function(){var a=b.getViewport(),d=0,e=!1,c=!1,e=b.wrap,k=b.skin,g=b.inner,h=b.current,c=h.width,j=h.height,m=h.minWidth,u=h.minHeight,n=h.maxWidth,
v=h.maxHeight,s=h.scrolling,q=h.scrollOutside?h.scrollbarWidth:0,y=h.margin,p=l(y[1]+y[3]),r=l(y[0]+y[2]),z,A,t,D,B,G,C,E,w;e.add(k).add(g).width("auto").height("auto").removeClass("fancybox-tmp");y=l(k.outerWidth(!0)-k.width());z=l(k.outerHeight(!0)-k.height());A=p+y;t=r+z;D=F(c)?(a.w-A)*l(c)/100:c;B=F(j)?(a.h-t)*l(j)/100:j;if("iframe"===h.type){if(w=h.content,h.autoHeight&&1===w.data("ready"))try{w[0].contentWindow.document.location&&(g.width(D).height(9999),G=w.contents().find("body"),q&&G.css("overflow-x",
"hidden"),B=G.height())}catch(H){}}else if(h.autoWidth||h.autoHeight)g.addClass("fancybox-tmp"),h.autoWidth||g.width(D),h.autoHeight||g.height(B),h.autoWidth&&(D=g.width()),h.autoHeight&&(B=g.height()),g.removeClass("fancybox-tmp");c=l(D);j=l(B);E=D/B;m=l(F(m)?l(m,"w")-A:m);n=l(F(n)?l(n,"w")-A:n);u=l(F(u)?l(u,"h")-t:u);v=l(F(v)?l(v,"h")-t:v);G=n;C=v;h.fitToView&&(n=Math.min(a.w-A,n),v=Math.min(a.h-t,v));A=a.w-p;r=a.h-r;h.aspectRatio?(c>n&&(c=n,j=l(c/E)),j>v&&(j=v,c=l(j*E)),c<m&&(c=m,j=l(c/E)),j<u&&
(j=u,c=l(j*E))):(c=Math.max(m,Math.min(c,n)),h.autoHeight&&"iframe"!==h.type&&(g.width(c),j=g.height()),j=Math.max(u,Math.min(j,v)));if(h.fitToView)if(g.width(c).height(j),e.width(c+y),a=e.width(),p=e.height(),h.aspectRatio)for(;(a>A||p>r)&&(c>m&&j>u)&&!(19<d++);)j=Math.max(u,Math.min(v,j-10)),c=l(j*E),c<m&&(c=m,j=l(c/E)),c>n&&(c=n,j=l(c/E)),g.width(c).height(j),e.width(c+y),a=e.width(),p=e.height();else c=Math.max(m,Math.min(c,c-(a-A))),j=Math.max(u,Math.min(j,j-(p-r)));q&&("auto"===s&&j<B&&c+y+
q<A)&&(c+=q);g.width(c).height(j);e.width(c+y);a=e.width();p=e.height();e=(a>A||p>r)&&c>m&&j>u;c=h.aspectRatio?c<G&&j<C&&c<D&&j<B:(c<G||j<C)&&(c<D||j<B);f.extend(h,{dim:{width:x(a),height:x(p)},origWidth:D,origHeight:B,canShrink:e,canExpand:c,wPadding:y,hPadding:z,wrapSpace:p-k.outerHeight(!0),skinSpace:k.height()-j});!w&&(h.autoHeight&&j>u&&j<v&&!c)&&g.height("auto")},_getPosition:function(a){var d=b.current,e=b.getViewport(),c=d.margin,f=b.wrap.width()+c[1]+c[3],g=b.wrap.height()+c[0]+c[2],c={position:"absolute",
top:c[0],left:c[3]};d.autoCenter&&d.fixed&&!a&&g<=e.h&&f<=e.w?c.position="fixed":d.locked||(c.top+=e.y,c.left+=e.x);c.top=x(Math.max(c.top,c.top+(e.h-g)*d.topRatio));c.left=x(Math.max(c.left,c.left+(e.w-f)*d.leftRatio));return c},_afterZoomIn:function(){var a=b.current;a&&(b.isOpen=b.isOpened=!0,b.wrap.css("overflow","visible").addClass("fancybox-opened"),b.update(),(a.closeClick||a.nextClick&&1<b.group.length)&&b.inner.css("cursor","pointer").bind("click.fb",function(d){!f(d.target).is("a")&&!f(d.target).parent().is("a")&&
(d.preventDefault(),b[a.closeClick?"close":"next"]())}),a.closeBtn&&f(a.tpl.closeBtn).appendTo(b.skin).bind("click.fb",function(a){a.preventDefault();b.close()}),a.arrows&&1<b.group.length&&((a.loop||0<a.index)&&f(a.tpl.prev).appendTo(b.outer).bind("click.fb",b.prev),(a.loop||a.index<b.group.length-1)&&f(a.tpl.next).appendTo(b.outer).bind("click.fb",b.next)),b.trigger("afterShow"),!a.loop&&a.index===a.group.length-1?b.play(!1):b.opts.autoPlay&&!b.player.isActive&&(b.opts.autoPlay=!1,b.play()))},_afterZoomOut:function(a){a=
a||b.current;f(".fancybox-wrap").trigger("onReset").remove();f.extend(b,{group:{},opts:{},router:!1,current:null,isActive:!1,isOpened:!1,isOpen:!1,isClosing:!1,wrap:null,skin:null,outer:null,inner:null});b.trigger("afterClose",a)}});b.transitions={getOrigPosition:function(){var a=b.current,d=a.element,e=a.orig,c={},f=50,g=50,h=a.hPadding,j=a.wPadding,m=b.getViewport();!e&&(a.isDom&&d.is(":visible"))&&(e=d.find("img:first"),e.length||(e=d));t(e)?(c=e.offset(),e.is("img")&&(f=e.outerWidth(),g=e.outerHeight())):
(c.top=m.y+(m.h-g)*a.topRatio,c.left=m.x+(m.w-f)*a.leftRatio);if("fixed"===b.wrap.css("position")||a.locked)c.top-=m.y,c.left-=m.x;return c={top:x(c.top-h*a.topRatio),left:x(c.left-j*a.leftRatio),width:x(f+j),height:x(g+h)}},step:function(a,d){var e,c,f=d.prop;c=b.current;var g=c.wrapSpace,h=c.skinSpace;if("width"===f||"height"===f)e=d.end===d.start?1:(a-d.start)/(d.end-d.start),b.isClosing&&(e=1-e),c="width"===f?c.wPadding:c.hPadding,c=a-c,b.skin[f](l("width"===f?c:c-g*e)),b.inner[f](l("width"===
f?c:c-g*e-h*e))},zoomIn:function(){var a=b.current,d=a.pos,e=a.openEffect,c="elastic"===e,k=f.extend({opacity:1},d);delete k.position;c?(d=this.getOrigPosition(),a.openOpacity&&(d.opacity=0.1)):"fade"===e&&(d.opacity=0.1);b.wrap.css(d).animate(k,{duration:"none"===e?0:a.openSpeed,easing:a.openEasing,step:c?this.step:null,complete:b._afterZoomIn})},zoomOut:function(){var a=b.current,d=a.closeEffect,e="elastic"===d,c={opacity:0.1};e&&(c=this.getOrigPosition(),a.closeOpacity&&(c.opacity=0.1));b.wrap.animate(c,
{duration:"none"===d?0:a.closeSpeed,easing:a.closeEasing,step:e?this.step:null,complete:b._afterZoomOut})},changeIn:function(){var a=b.current,d=a.nextEffect,e=a.pos,c={opacity:1},f=b.direction,g;e.opacity=0.1;"elastic"===d&&(g="down"===f||"up"===f?"top":"left","down"===f||"right"===f?(e[g]=x(l(e[g])-200),c[g]="+=200px"):(e[g]=x(l(e[g])+200),c[g]="-=200px"));"none"===d?b._afterZoomIn():b.wrap.css(e).animate(c,{duration:a.nextSpeed,easing:a.nextEasing,complete:b._afterZoomIn})},changeOut:function(){var a=
b.previous,d=a.prevEffect,e={opacity:0.1},c=b.direction;"elastic"===d&&(e["down"===c||"up"===c?"top":"left"]=("up"===c||"left"===c?"-":"+")+"=200px");a.wrap.animate(e,{duration:"none"===d?0:a.prevSpeed,easing:a.prevEasing,complete:function(){f(this).trigger("onReset").remove()}})}};b.helpers.overlay={defaults:{closeClick:!0,speedOut:200,showEarly:!0,css:{},locked:!s,fixed:!0},overlay:null,fixed:!1,create:function(a){a=f.extend({},this.defaults,a);this.overlay&&this.close();this.overlay=f('<div class="fancybox-overlay"></div>').appendTo("body");
this.fixed=!1;a.fixed&&b.defaults.fixed&&(this.overlay.addClass("fancybox-overlay-fixed"),this.fixed=!0)},open:function(a){var d=this;a=f.extend({},this.defaults,a);this.overlay?this.overlay.unbind(".overlay").width("auto").height("auto"):this.create(a);this.fixed||(q.bind("resize.overlay",f.proxy(this.update,this)),this.update());a.closeClick&&this.overlay.bind("click.overlay",function(a){f(a.target).hasClass("fancybox-overlay")&&(b.isActive?b.close():d.close())});this.overlay.css(a.css).show()},
close:function(){f(".fancybox-overlay").remove();q.unbind("resize.overlay");this.overlay=null;!1!==this.margin&&(f("body").css("margin-right",this.margin),this.margin=!1);this.el&&this.el.removeClass("fancybox-lock")},update:function(){var a="100%",b;this.overlay.width(a).height("100%");H?(b=Math.max(z.documentElement.offsetWidth,z.body.offsetWidth),n.width()>b&&(a=n.width())):n.width()>q.width()&&(a=n.width());this.overlay.width(a).height(n.height())},onReady:function(a,b){f(".fancybox-overlay").stop(!0,
!0);this.overlay||(this.margin=n.height()>q.height()||"scroll"===f("body").css("overflow-y")?f("body").css("margin-right"):!1,this.el=z.all&&!z.querySelector?f("html"):f("body"),this.create(a));a.locked&&this.fixed&&(b.locked=this.overlay.append(b.wrap),b.fixed=!1);!0===a.showEarly&&this.beforeShow.apply(this,arguments)},beforeShow:function(a,b){b.locked&&(this.el.addClass("fancybox-lock"),!1!==this.margin&&f("body").css("margin-right",l(this.margin)+b.scrollbarWidth));this.open(a)},onUpdate:function(){this.fixed||
this.update()},afterClose:function(a){this.overlay&&!b.isActive&&this.overlay.fadeOut(a.speedOut,f.proxy(this.close,this))}};b.helpers.title={defaults:{type:"float",position:"bottom"},beforeShow:function(a){var d=b.current,e=d.title,c=a.type;f.isFunction(e)&&(e=e.call(d.element,d));if(p(e)&&""!==f.trim(e)){d=f('<div class="fancybox-title fancybox-title-'+c+'-wrap">'+e+"</div>");switch(c){case "inside":c=b.skin;break;case "outside":c=b.wrap;break;case "over":c=b.inner;break;default:c=b.skin,d.appendTo("body"),
H&&d.width(d.width()),d.wrapInner('<span class="child"></span>'),b.current.margin[2]+=Math.abs(l(d.css("margin-bottom")))}d["top"===a.position?"prependTo":"appendTo"](c)}}};f.fn.fancybox=function(a){var d,e=f(this),c=this.selector||"",k=function(g){var h=f(this).blur(),j=d,k,l;!g.ctrlKey&&(!g.altKey&&!g.shiftKey&&!g.metaKey)&&!h.is(".fancybox-wrap")&&(k=a.groupAttr||"data-fancybox-group",l=h.attr(k),l||(k="rel",l=h.get(0)[k]),l&&(""!==l&&"nofollow"!==l)&&(h=c.length?f(c):e,h=h.filter("["+k+'="'+l+
'"]'),j=h.index(this)),a.index=j,!1!==b.open(h,a)&&g.preventDefault())};a=a||{};d=a.index||0;!c||!1===a.live?e.unbind("click.fb-start").bind("click.fb-start",k):n.undelegate(c,"click.fb-start").delegate(c+":not('.fancybox-item, .fancybox-nav')","click.fb-start",k);this.filter("[data-fancybox-start=1]").trigger("click");return this};n.ready(function(){f.scrollbarWidth===r&&(f.scrollbarWidth=function(){var a=f('<div style="width:50px;height:50px;overflow:auto"><div/></div>').appendTo("body"),b=a.children(),
b=b.innerWidth()-b.height(99).innerWidth();a.remove();return b});if(f.support.fixedPosition===r){var a=f.support,d=f('<div style="position:fixed;top:20px;"></div>').appendTo("body"),e=20===d[0].offsetTop||15===d[0].offsetTop;d.remove();a.fixedPosition=e}f.extend(b.defaults,{scrollbarWidth:f.scrollbarWidth(),fixed:f.support.fixedPosition,parent:f("body")})})})(window,document,jQuery);
(function(e){"use strict";function r(t){var n=t.data;if(!t.isDefaultPrevented()){t.preventDefault();e(this).ajaxSubmit(n)}}function i(t){var n=t.target;var r=e(n);if(!r.is("[type=submit],[type=image]")){var i=r.closest("[type=submit]");if(i.length===0){return}n=i[0]}var s=this;s.clk=n;if(n.type=="image"){if(t.offsetX!==undefined){s.clk_x=t.offsetX;s.clk_y=t.offsetY}else if(typeof e.fn.offset=="function"){var o=r.offset();s.clk_x=t.pageX-o.left;s.clk_y=t.pageY-o.top}else{s.clk_x=t.pageX-n.offsetLeft;s.clk_y=t.pageY-n.offsetTop}}setTimeout(function(){s.clk=s.clk_x=s.clk_y=null},100)}function s(){if(!e.fn.ajaxSubmit.debug)return;var t="[jquery.form] "+Array.prototype.join.call(arguments,"");if(window.console&&window.console.log){window.console.log(t)}else if(window.opera&&window.opera.postError){window.opera.postError(t)}}var t={};t.fileapi=e("<input type='file'/>").get(0).files!==undefined;t.formdata=window.FormData!==undefined;var n=!!e.fn.prop;e.fn.attr2=function(){if(!n)return this.attr.apply(this,arguments);var e=this.prop.apply(this,arguments);if(e&&e.jquery||typeof e==="string")return e;return this.attr.apply(this,arguments)};e.fn.ajaxSubmit=function(r){function k(t){var n=e.param(t).split("&");var r=n.length;var i=[];var s,o;for(s=0;s<r;s++){n[s]=n[s].replace(/\+/g," ");o=n[s].split("=");i.push([decodeURIComponent(o[0]),decodeURIComponent(o[1])])}return i}function L(t){var n=new FormData;for(var s=0;s<t.length;s++){n.append(t[s].name,t[s].value)}if(r.extraData){var o=k(r.extraData);for(s=0;s<o.length;s++)if(o[s])n.append(o[s][0],o[s][1])}r.data=null;var u=e.extend(true,{},e.ajaxSettings,r,{contentType:false,processData:false,cache:false,type:i||"POST"});if(r.uploadProgress){u.xhr=function(){var e=jQuery.ajaxSettings.xhr();if(e.upload){e.upload.addEventListener("progress",function(e){var t=0;var n=e.loaded||e.position;var i=e.total;if(e.lengthComputable){t=Math.ceil(n/i*100)}r.uploadProgress(e,n,i,t)},false)}return e}}u.data=null;var a=u.beforeSend;u.beforeSend=function(e,t){t.data=n;if(a)a.call(this,e,t)};return e.ajax(u)}function A(t){function T(e){var t=null;try{if(e.contentWindow){t=e.contentWindow.document}}catch(n){s("cannot get iframe.contentWindow document: "+n)}if(t){return t}try{t=e.contentDocument?e.contentDocument:e.document}catch(n){s("cannot get iframe.contentDocument: "+n);t=e.document}return t}function k(){function r(){try{var e=T(v).readyState;s("state = "+e);if(e&&e.toLowerCase()=="uninitialized")setTimeout(r,50)}catch(t){s("Server abort: ",t," (",t.name,")");_(x);if(w)clearTimeout(w);w=undefined}}var t=a.attr2("target"),n=a.attr2("action");o.setAttribute("target",p);if(!i){o.setAttribute("method","POST")}if(n!=l.url){o.setAttribute("action",l.url)}if(!l.skipEncodingOverride&&(!i||/post/i.test(i))){a.attr({encoding:"multipart/form-data",enctype:"multipart/form-data"})}if(l.timeout){w=setTimeout(function(){b=true;_(S)},l.timeout)}var u=[];try{if(l.extraData){for(var f in l.extraData){if(l.extraData.hasOwnProperty(f)){if(e.isPlainObject(l.extraData[f])&&l.extraData[f].hasOwnProperty("name")&&l.extraData[f].hasOwnProperty("value")){u.push(e('<input type="hidden" name="'+l.extraData[f].name+'">').val(l.extraData[f].value).appendTo(o)[0])}else{u.push(e('<input type="hidden" name="'+f+'">').val(l.extraData[f]).appendTo(o)[0])}}}}if(!l.iframeTarget){d.appendTo("body");if(v.attachEvent)v.attachEvent("onload",_);else v.addEventListener("load",_,false)}setTimeout(r,15);try{o.submit()}catch(c){var h=document.createElement("form").submit;h.apply(o)}}finally{o.setAttribute("action",n);if(t){o.setAttribute("target",t)}else{a.removeAttr("target")}e(u).remove()}}function _(t){if(m.aborted||M){return}A=T(v);if(!A){s("cannot access response document");t=x}if(t===S&&m){m.abort("timeout");E.reject(m,"timeout");return}else if(t==x&&m){m.abort("server abort");E.reject(m,"error","server abort");return}if(!A||A.location.href==l.iframeSrc){if(!b)return}if(v.detachEvent)v.detachEvent("onload",_);else v.removeEventListener("load",_,false);var n="success",r;try{if(b){throw"timeout"}var i=l.dataType=="xml"||A.XMLDocument||e.isXMLDoc(A);s("isXml="+i);if(!i&&window.opera&&(A.body===null||!A.body.innerHTML)){if(--O){s("requeing onLoad callback, DOM not available");setTimeout(_,250);return}}var o=A.body?A.body:A.documentElement;m.responseText=o?o.innerHTML:null;m.responseXML=A.XMLDocument?A.XMLDocument:A;if(i)l.dataType="xml";m.getResponseHeader=function(e){var t={"content-type":l.dataType};return t[e]};if(o){m.status=Number(o.getAttribute("status"))||m.status;m.statusText=o.getAttribute("statusText")||m.statusText}var u=(l.dataType||"").toLowerCase();var a=/(json|script|text)/.test(u);if(a||l.textarea){var f=A.getElementsByTagName("textarea")[0];if(f){m.responseText=f.value;m.status=Number(f.getAttribute("status"))||m.status;m.statusText=f.getAttribute("statusText")||m.statusText}else if(a){var c=A.getElementsByTagName("pre")[0];var p=A.getElementsByTagName("body")[0];if(c){m.responseText=c.textContent?c.textContent:c.innerText}else if(p){m.responseText=p.textContent?p.textContent:p.innerText}}}else if(u=="xml"&&!m.responseXML&&m.responseText){m.responseXML=D(m.responseText)}try{L=H(m,u,l)}catch(g){n="parsererror";m.error=r=g||n}}catch(g){s("error caught: ",g);n="error";m.error=r=g||n}if(m.aborted){s("upload aborted");n=null}if(m.status){n=m.status>=200&&m.status<300||m.status===304?"success":"error"}if(n==="success"){if(l.success)l.success.call(l.context,L,"success",m);E.resolve(m.responseText,"success",m);if(h)e.event.trigger("ajaxSuccess",[m,l])}else if(n){if(r===undefined)r=m.statusText;if(l.error)l.error.call(l.context,m,n,r);E.reject(m,"error",r);if(h)e.event.trigger("ajaxError",[m,l,r])}if(h)e.event.trigger("ajaxComplete",[m,l]);if(h&&!--e.active){e.event.trigger("ajaxStop")}if(l.complete)l.complete.call(l.context,m,n);M=true;if(l.timeout)clearTimeout(w);setTimeout(function(){if(!l.iframeTarget)d.remove();m.responseXML=null},100)}var o=a[0],u,f,l,h,p,d,v,m,g,y,b,w;var E=e.Deferred();if(t){for(f=0;f<c.length;f++){u=e(c[f]);if(n)u.prop("disabled",false);else u.removeAttr("disabled")}}l=e.extend(true,{},e.ajaxSettings,r);l.context=l.context||l;p="jqFormIO"+(new Date).getTime();if(l.iframeTarget){d=e(l.iframeTarget);y=d.attr2("name");if(!y)d.attr2("name",p);else p=y}else{d=e('<iframe name="'+p+'" src="'+l.iframeSrc+'" />');d.css({position:"absolute",top:"-1000px",left:"-1000px"})}v=d[0];m={aborted:0,responseText:null,responseXML:null,status:0,statusText:"n/a",getAllResponseHeaders:function(){},getResponseHeader:function(){},setRequestHeader:function(){},abort:function(t){var n=t==="timeout"?"timeout":"aborted";s("aborting upload... "+n);this.aborted=1;try{if(v.contentWindow.document.execCommand){v.contentWindow.document.execCommand("Stop")}}catch(r){}d.attr("src",l.iframeSrc);m.error=n;if(l.error)l.error.call(l.context,m,n,t);if(h)e.event.trigger("ajaxError",[m,l,n]);if(l.complete)l.complete.call(l.context,m,n)}};h=l.global;if(h&&0===e.active++){e.event.trigger("ajaxStart")}if(h){e.event.trigger("ajaxSend",[m,l])}if(l.beforeSend&&l.beforeSend.call(l.context,m,l)===false){if(l.global){e.active--}E.reject();return E}if(m.aborted){E.reject();return E}g=o.clk;if(g){y=g.name;if(y&&!g.disabled){l.extraData=l.extraData||{};l.extraData[y]=g.value;if(g.type=="image"){l.extraData[y+".x"]=o.clk_x;l.extraData[y+".y"]=o.clk_y}}}var S=1;var x=2;var N=e("meta[name=csrf-token]").attr("content");var C=e("meta[name=csrf-param]").attr("content");if(C&&N){l.extraData=l.extraData||{};l.extraData[C]=N}if(l.forceSync){k()}else{setTimeout(k,10)}var L,A,O=50,M;var D=e.parseXML||function(e,t){if(window.ActiveXObject){t=new ActiveXObject("Microsoft.XMLDOM");t.async="false";t.loadXML(e)}else{t=(new DOMParser).parseFromString(e,"text/xml")}return t&&t.documentElement&&t.documentElement.nodeName!="parsererror"?t:null};var P=e.parseJSON||function(e){return window["eval"]("("+e+")")};var H=function(t,n,r){var i=t.getResponseHeader("content-type")||"",s=n==="xml"||!n&&i.indexOf("xml")>=0,o=s?t.responseXML:t.responseText;if(s&&o.documentElement.nodeName==="parsererror"){if(e.error)e.error("parsererror")}if(r&&r.dataFilter){o=r.dataFilter(o,n)}if(typeof o==="string"){if(n==="json"||!n&&i.indexOf("json")>=0){o=P(o)}else if(n==="script"||!n&&i.indexOf("javascript")>=0){e.globalEval(o)}}return o};return E}if(!this.length){s("ajaxSubmit: skipping submit process - no element selected");return this}var i,o,u,a=this;if(typeof r=="function"){r={success:r}}i=this.attr2("method");o=this.attr2("action");u=typeof o==="string"?e.trim(o):"";u=u||window.location.href||"";if(u){u=(u.match(/^([^#]+)/)||[])[1]}r=e.extend(true,{url:u,success:e.ajaxSettings.success,type:i||"GET",iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank"},r);var f={};this.trigger("form-pre-serialize",[this,r,f]);if(f.veto){s("ajaxSubmit: submit vetoed via form-pre-serialize trigger");return this}if(r.beforeSerialize&&r.beforeSerialize(this,r)===false){s("ajaxSubmit: submit aborted via beforeSerialize callback");return this}var l=r.traditional;if(l===undefined){l=e.ajaxSettings.traditional}var c=[];var h,p=this.formToArray(r.semantic,c);if(r.data){r.extraData=r.data;h=e.param(r.data,l)}if(r.beforeSubmit&&r.beforeSubmit(p,this,r)===false){s("ajaxSubmit: submit aborted via beforeSubmit callback");return this}this.trigger("form-submit-validate",[p,this,r,f]);if(f.veto){s("ajaxSubmit: submit vetoed via form-submit-validate trigger");return this}var d=e.param(p,l);if(h){d=d?d+"&"+h:h}if(r.type.toUpperCase()=="GET"){r.url+=(r.url.indexOf("?")>=0?"&":"?")+d;r.data=null}else{r.data=d}var v=[];if(r.resetForm){v.push(function(){a.resetForm()})}if(r.clearForm){v.push(function(){a.clearForm(r.includeHidden)})}if(!r.dataType&&r.target){var m=r.success||function(){};v.push(function(t){var n=r.replaceTarget?"replaceWith":"html";e(r.target)[n](t).each(m,arguments)})}else if(r.success){v.push(r.success)}r.success=function(e,t,n){var i=r.context||this;for(var s=0,o=v.length;s<o;s++){v[s].apply(i,[e,t,n||a,a])}};if(r.error){var g=r.error;r.error=function(e,t,n){var i=r.context||this;g.apply(i,[e,t,n,a])}}if(r.complete){var y=r.complete;r.complete=function(e,t){var n=r.context||this;y.apply(n,[e,t,a])}}var b=e('input[type=file]:enabled[value!=""]',this);var w=b.length>0;var E="multipart/form-data";var S=a.attr("enctype")==E||a.attr("encoding")==E;var x=t.fileapi&&t.formdata;s("fileAPI :"+x);var T=(w||S)&&!x;var N;if(r.iframe!==false&&(r.iframe||T)){if(r.closeKeepAlive){e.get(r.closeKeepAlive,function(){N=A(p)})}else{N=A(p)}}else if((w||S)&&x){N=L(p)}else{N=e.ajax(r)}a.removeData("jqxhr").data("jqxhr",N);for(var C=0;C<c.length;C++)c[C]=null;this.trigger("form-submit-notify",[this,r]);return this};e.fn.ajaxForm=function(t){t=t||{};t.delegation=t.delegation&&e.isFunction(e.fn.on);if(!t.delegation&&this.length===0){var n={s:this.selector,c:this.context};if(!e.isReady&&n.s){s("DOM not ready, queuing ajaxForm");e(function(){e(n.s,n.c).ajaxForm(t)});return this}s("terminating; zero elements found by selector"+(e.isReady?"":" (DOM not ready)"));return this}if(t.delegation){e(document).off("submit.form-plugin",this.selector,r).off("click.form-plugin",this.selector,i).on("submit.form-plugin",this.selector,t,r).on("click.form-plugin",this.selector,t,i);return this}return this.ajaxFormUnbind().bind("submit.form-plugin",t,r).bind("click.form-plugin",t,i)};e.fn.ajaxFormUnbind=function(){return this.unbind("submit.form-plugin click.form-plugin")};e.fn.formToArray=function(n,r){var i=[];if(this.length===0){return i}var s=this[0];var o=n?s.getElementsByTagName("*"):s.elements;if(!o){return i}var u,a,f,l,c,h,p;for(u=0,h=o.length;u<h;u++){c=o[u];f=c.name;if(!f||c.disabled){continue}if(n&&s.clk&&c.type=="image"){if(s.clk==c){i.push({name:f,value:e(c).val(),type:c.type});i.push({name:f+".x",value:s.clk_x},{name:f+".y",value:s.clk_y})}continue}l=e.fieldValue(c,true);if(l&&l.constructor==Array){if(r)r.push(c);for(a=0,p=l.length;a<p;a++){i.push({name:f,value:l[a]})}}else if(t.fileapi&&c.type=="file"){if(r)r.push(c);var d=c.files;if(d.length){for(a=0;a<d.length;a++){i.push({name:f,value:d[a],type:c.type})}}else{i.push({name:f,value:"",type:c.type})}}else if(l!==null&&typeof l!="undefined"){if(r)r.push(c);i.push({name:f,value:l,type:c.type,required:c.required})}}if(!n&&s.clk){var v=e(s.clk),m=v[0];f=m.name;if(f&&!m.disabled&&m.type=="image"){i.push({name:f,value:v.val()});i.push({name:f+".x",value:s.clk_x},{name:f+".y",value:s.clk_y})}}return i};e.fn.formSerialize=function(t){return e.param(this.formToArray(t))};e.fn.fieldSerialize=function(t){var n=[];this.each(function(){var r=this.name;if(!r){return}var i=e.fieldValue(this,t);if(i&&i.constructor==Array){for(var s=0,o=i.length;s<o;s++){n.push({name:r,value:i[s]})}}else if(i!==null&&typeof i!="undefined"){n.push({name:this.name,value:i})}});return e.param(n)};e.fn.fieldValue=function(t){for(var n=[],r=0,i=this.length;r<i;r++){var s=this[r];var o=e.fieldValue(s,t);if(o===null||typeof o=="undefined"||o.constructor==Array&&!o.length){continue}if(o.constructor==Array)e.merge(n,o);else n.push(o)}return n};e.fieldValue=function(t,n){var r=t.name,i=t.type,s=t.tagName.toLowerCase();if(n===undefined){n=true}if(n&&(!r||t.disabled||i=="reset"||i=="button"||(i=="checkbox"||i=="radio")&&!t.checked||(i=="submit"||i=="image")&&t.form&&t.form.clk!=t||s=="select"&&t.selectedIndex==-1)){return null}if(s=="select"){var o=t.selectedIndex;if(o<0){return null}var u=[],a=t.options;var f=i=="select-one";var l=f?o+1:a.length;for(var c=f?o:0;c<l;c++){var h=a[c];if(h.selected){var p=h.value;if(!p){p=h.attributes&&h.attributes["value"]&&!h.attributes["value"].specified?h.text:h.value}if(f){return p}u.push(p)}}return u}return e(t).val()};e.fn.clearForm=function(t){return this.each(function(){e("input,select,textarea",this).clearFields(t)})};e.fn.clearFields=e.fn.clearInputs=function(t){var n=/^(?:color|date|datetime|email|month|number|password|range|search|tel|text|time|url|week)$/i;return this.each(function(){var r=this.type,i=this.tagName.toLowerCase();if(n.test(r)||i=="textarea"){this.value=""}else if(r=="checkbox"||r=="radio"){this.checked=false}else if(i=="select"){this.selectedIndex=-1}else if(r=="file"){if(/MSIE/.test(navigator.userAgent)){e(this).replaceWith(e(this).clone(true))}else{e(this).val("")}}else if(t){if(t===true&&/hidden/.test(r)||typeof t=="string"&&e(this).is(t))this.value=""}})};e.fn.resetForm=function(){return this.each(function(){if(typeof this.reset=="function"||typeof this.reset=="object"&&!this.reset.nodeType){this.reset()}})};e.fn.enable=function(e){if(e===undefined){e=true}return this.each(function(){this.disabled=!e})};e.fn.selected=function(t){if(t===undefined){t=true}return this.each(function(){var n=this.type;if(n=="checkbox"||n=="radio"){this.checked=t}else if(this.tagName.toLowerCase()=="option"){var r=e(this).parent("select");if(t&&r[0]&&r[0].type=="select-one"){r.find("option").selected(false)}this.selected=t}})};e.fn.ajaxSubmit.debug=false})(jQuery)
$(document).ready(function() { 
(function() {
  var date_tools, minical;

  date_tools = {
    getMonthName: function(date) {
      var months;
      months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
      return months[date.getMonth()];
    },
    getDays: function() {
      var $tr, day, days, _i, _len;
      days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      $tr = $("<tr />");
      for (_i = 0, _len = days.length; _i < _len; _i++) {
        day = days[_i];
        $("<th />").text(day).appendTo($tr);
      }
      return $tr;
    },
    getStartOfCalendarBlock: function(date) {
      var firstOfMonth;
      firstOfMonth = new Date(date);
      firstOfMonth.setDate(1);
      return new Date(firstOfMonth.setDate(1 - firstOfMonth.getDay()));
    }
  };

  minical = {
    offset: {
      x: 0,
      y: 5
    },
    trigger: null,
    align_to_trigger: true,
    move_on_resize: true,
    read_only: true,
    dropdowns: {
      month: null,
      day: null,
      year: null
    },
    appendCalendarTo: function() {
      return $('body');
    },
    date_format: function(date) {
      return [date.getDate(), date.getMonth() + 1, date.getFullYear()].join("/");
    },
    from: null,
    to: null,
    date_changed: $.noop,
    month_drawn: $.noop,
    getDayClass: function(date) {
      return "minical_day_" + [date.getMonth() + 1, date.getDate(), date.getFullYear()].join("_");
    },
    render: function(date) {
      var $li, $tbody, $tr, current_date, d, day, days, w, _i, _j, _k, _len;
      if (date == null) {
        date = this.selected_day;
      }
      $li = $("<li />", {
        "class": "minical_" + (date_tools.getMonthName(date).toLowerCase())
      });
      $li.html("      <article>        <header>          <h6>" + (date_tools.getMonthName(date)) + " " + (date.getFullYear()) + "</h6>          <a href='#' class='minical_prev'></a>          <a href='#' class='minical_next'></a>        </header>        <section>          <table>            <thead>              <tr>              </tr>            </thead>            <tbody>            </tbody>          </table>        </section>      </article>    ");
      days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
      $tr = $li.find("tr");
      for (_i = 0, _len = days.length; _i < _len; _i++) {
        day = days[_i];
        $("<th />", {
          text: day
        }).appendTo($tr);
      }
      $tbody = $li.find("tbody");
      current_date = date_tools.getStartOfCalendarBlock(date);
      if (this.from && this.from > current_date) {
        $li.find(".minical_prev").hide();
      }
      for (w = _j = 1; _j <= 6; w = ++_j) {
        $tr = $("<tr />");
        for (d = _k = 1; _k <= 7; d = ++_k) {
          $tr.append(this.renderDay(current_date, date));
          current_date.setDate(current_date.getDate() + 1);
        }
        if ($tr.find(".minical_day").length) {
          $tr.appendTo($tbody);
        }
      }
      $li.find("." + (this.getDayClass(new Date()))).addClass("minical_today");
      if (this.selected_day) {
        $li.find("." + (this.getDayClass(this.selected_day))).addClass("minical_selected").addClass("minical_highlighted");
      }
      if (!$li.find(".minical_highlighted").length) {
        $li.find("td").not(".minical_disabled, .minical_past_month").eq(0).addClass("minical_highlighted");
      }
      if (this.to && this.to < new Date($li.find("td").last().data("minical_date"))) {
        $li.find(".minical_next").hide();
      }
      this.month_drawn.apply(this.$el);
      return this.$cal.empty().append($li);
    },
    renderDay: function(d, base_date) {
      var $td, current_month, month;
      $td = $("<td />").data("minical_date", new Date(d)).addClass(this.getDayClass(d)).append($("<a />", {
        "href": "#"
      }).text(d.getDate()));
      current_month = d.getMonth();
      month = base_date.getMonth();
      if ((this.from && d < this.from) || (this.to && d > this.to)) {
        $td.addClass("minical_disabled");
      }
      if (current_month > month || current_month === 0 && month === 11) {
        return $td.addClass("minical_future_month");
      } else if (current_month < month) {
        return $td.addClass("minical_past_month");
      } else {
        return $td.addClass("minical_day");
      }
    },
    selectDay: function(e) {
      var $td, mc;
      $td = $(e.target).closest("td");
      if ($td.hasClass("minical_disabled")) {
        return false;
      }
      mc = $td.closest("ul").data("minical");
      mc.selected_day = new Date($td.data("minical_date"));
      if (mc.$el.is(":text")) {
        mc.$el.val(mc.date_format(mc.selected_day));
        mc.date_changed.apply(mc.$el);
      } else {
        mc.dropdowns.$month.val(mc.selected_day.getMonth() + 1);
        mc.dropdowns.$day.val(mc.selected_day.getDate());
        mc.dropdowns.$year.val(mc.selected_day.getFullYear());
        mc.date_changed.apply(mc.dropdowns);
      }
      mc.hideCalendar();
      return false;
    },
    highlightDay: function(e) {
      var $td, klass;
      $td = $(e.target).closest("td");
      klass = "minical_highlighted";
      $td.closest("tbody").find("." + klass).removeClass(klass);
      if (e.type === "mouseenter") {
        $td.addClass(klass);
      }
      return true;
    },
    moveToDay: function(x, y) {
      var $selected, $tr, move_from, move_to;
      if (!this.$cal.is(":visible")) {
        return true;
      }
      $selected = this.$cal.find(".minical_highlighted").length ? this.$cal.find(".minical_highlighted") : this.$cal.find("tbody td").eq(0);
      $tr = $selected.closest("tr");
      move_from = $selected.data("minical_date");
      if ($tr.parent().children().eq(0).is($tr)) {
        if (($selected.parent().children().eq(0).is($selected) && x === -1) || y === -1) {
          this.prevMonth();
        }
      } else if ($tr.parent().children().eq(-1).is($tr)) {
        if (($selected.parent().children().eq(-1).is($selected) && x === 1) || y === 1) {
          this.nextMonth();
        }
      }
      move_to = new Date(move_from);
      move_to.setDate(move_from.getDate() + x + y * 7);
      this.$cal.find("." + (this.getDayClass(move_to)) + " a").trigger("mouseover");
      return false;
    },
    nextMonth: function(e) {
      var mc, next;
      mc = e ? $(e.target).closest(".minical").data("minical") : this;
      if (!mc.$cal.find(".minical_next").is(":visible")) {
        return false;
      }
      next = new Date(mc.$cal.find("td").eq(8).data("minical_date"));
      next.setMonth(next.getMonth() + 1);
      mc.render(next);
      return false;
    },
    prevMonth: function(e) {
      var mc, prev;
      mc = e ? $(e.target).closest(".minical").data("minical") : this;
      if (!mc.$cal.find(".minical_prev").is(":visible")) {
        return false;
      }
      prev = new Date(mc.$cal.find("td").eq(8).data("minical_date"));
      prev.setMonth(prev.getMonth() - 1);
      mc.render(prev);
      return false;
    },
    showCalendar: function(e) {
      var $other_cals, height, mc, offset, overlap, position;
      mc = e ? $(e.target).data("minical") : this;
      $other_cals = $("[id^='minical_calendar']").not(mc.$cal);
      if ($other_cals.length) {
        $other_cals.data("minical").hideCalendar();
      }
      if (mc.$cal.is(":visible") || mc.$el.is(":disabled")) {
        return true;
      }
      offset = mc.align_to_trigger ? mc.$trigger[mc.offset_method]() : mc.$el[mc.offset_method]();
      height = mc.align_to_trigger ? mc.$trigger.outerHeight() : mc.$el.outerHeight();
      position = {
        left: "" + (offset.left + mc.offset.x) + "px",
        top: "" + (height + offset.top + mc.offset.y) + "px"
      };
      mc.render().css(position).show();
      overlap = mc.$cal.width() + mc.$cal[mc.offset_method]().left - $(window).width();
      if (overlap > 0) {
        mc.$cal.css("left", offset.left - overlap - 10);
      }
      return mc.attachCalendarKeyEvents();
    },
    hideCalendar: function(e) {
      var $lc, mc;
      mc = this;
      if (e && (e.type === "focusout" || e.type === "blur")) {
        mc = $(e.target).data("minical");
        $lc = mc.$last_clicked;
        if ($lc && !$lc.is(mc.$trigger) && !$lc.is(mc.$el) && !$lc.closest(".minical").length) {
          mc.$cal.hide();
          return mc.detachCalendarKeyEvents();
        }
      } else {
        mc.$cal.hide();
        return mc.detachCalendarKeyEvents();
      }
    },
    attachCalendarKeyEvents: function() {
      var mc;
      mc = this;
      $(document).off("keydown.minical_" + mc.id);
      return $(document).on("keydown.minical_" + mc.id, function(e) {
        return mc.keydown.call(mc, e);
      });
    },
    detachCalendarKeyEvents: function() {
      return $(document).off("keydown.minical_" + this.id);
    },
    keydown: function(e) {
      var key, keys, mc;
      key = e.which;
      mc = this;
      keys = {
        9: function() {
          return true;
        },
        13: function() {
          mc.$cal.find(".minical_highlighted a").click();
          return false;
        },
        37: function() {
          return mc.moveToDay(-1, 0);
        },
        38: function() {
          return mc.moveToDay(0, -1);
        },
        39: function() {
          return mc.moveToDay(1, 0);
        },
        40: function() {
          return mc.moveToDay(0, 1);
        }
      };
      if (keys[key]) {
        return keys[key]();
      } else if (!e.metaKey && !e.ctrlKey) {
        return !mc.read_only;
      }
    },
    preventKeystroke: function(e) {
      var key, keys, mc;
      mc = this;
      if (mc.$cal.is(":visible")) {
        return true;
      }
      key = e.which;
      keys = {
        9: function() {
          return true;
        },
        13: function() {
          mc.showCalendar();
          return false;
        }
      };
      if (keys[key]) {
        return keys[key]();
      } else {
        return !mc.read_only;
      }
    },
    dropdownChange: function(e) {
      var dr, mc;
      mc = $(e.target).data("minical");
      dr = mc.dropdowns;
      if (dr.$year.val() && dr.$month.val() && dr.$day.val()) {
        mc.selected_day = new Date(dr.$year.val(), dr.$month.val() - 1, dr.$day.val());
      } else {
        mc.selected_day = new Date();
      }
      if (mc.$cal.is(":visible")) {
        return mc.render();
      }
    },
    outsideClick: function(e) {
      var $t;
      $t = $(e.target);
      this.$last_clicked = $t;
      if ($t.is(this.$el) || $t.is(this.$trigger) || $t.closest(".minical").length) {
        return true;
      }
      return this.hideCalendar();
    },
    init: function() {
      var dr, initial_date, max_year, mc, min_day, min_month, min_year,
        _this = this;
      this.id = $(".minical").length;
      mc = this;
      this.$cal = $("<ul />", {
        id: "minical_calendar_" + this.id,
        "class": "minical"
      }).data("minical", this).appendTo(this.appendCalendarTo.apply(this.$el));
      this.offset_method = mc.$cal.parent().is("body") ? "offset" : "position";
      if (this.trigger) {
        this.$trigger = this.$el.find(this.trigger);
        if (!this.$trigger.length) {
          this.$trigger = this.$el.parent().find(this.trigger);
        }
        this.$trigger.data("minical", this).on("blur.minical", this.hideCalendar).on("focus.minical", this.showCalendar).on("click.minical", function(e) {
          mc.$trigger.focus();
          return e.preventDefault();
        });
      } else {
        this.align_to_trigger = false;
      }
      if (this.$el.is("input")) {
        this.$el.addClass("minical_input").on("focus.minical click.minical", this.showCalendar).on("blur.minical", this.hideCalendar).on("keydown.minical", function(e) {
          return mc.preventKeystroke.call(mc, e);
        });
        initial_date = this.$el.attr("data-minical-initial") || this.$el.val();
        this.selected_day = initial_date ? new Date(initial_date) : new Date();
      } else {
        dr = this.dropdowns;
        if (dr.year) {
          dr.$year = this.$el.find(dr.year).data("minical", this).change(this.dropdownChange);
        }
        if (dr.month) {
          dr.$month = this.$el.find(dr.month).data("minical", this).change(this.dropdownChange);
        }
        if (dr.day) {
          dr.$day = this.$el.find(dr.day).data("minical", this).change(this.dropdownChange);
        }
        if (!this.from) {
          min_year = Math.min.apply(Math, dr.$year.children().map(function() {
            if ($(this).val()) {
              return $(this).val();
            }
          }).get());
          min_month = Math.min.apply(Math, dr.$month.children().map(function() {
            if ($(this).val()) {
              return $(this).val();
            }
          }).get());
          min_day = Math.min.apply(Math, dr.$day.children().map(function() {
            if ($(this).val()) {
              return $(this).val();
            }
          }).get());
          this.from = new Date(min_year, min_month - 1, min_day);
        }
        if (!this.to) {
          max_year = Math.max.apply(Math, dr.$year.children().map(function() {
            return $(this).val();
          }).get());
          this.to = new Date(max_year, dr.$month.find("option").eq(-1).val() - 1, dr.$day.find("option").eq(-1).val());
        }
        this.align_to_trigger = true;
        dr.$year.change();
      }
      this.$cal.on("click.minical", "td a", this.selectDay).on("mouseenter.minical mouseleave.minical", "td a", this.highlightDay).on("click.minical", "a.minical_next", this.nextMonth).on("click.minical", "a.minical_prev", this.prevMonth);
      if (this.move_on_resize) {
        $(window).resize(function() {
          var $cal;
          $cal = $(".minical:visible");
          return $cal.length && $cal.hide().data("minical").showCalendar();
        });
      }
      return $("body").on("click.minical touchend.minical", function(e) {
        return _this.outsideClick.call(_this, e);
      });
    }
  };

  (function(minical) {
    return $.fn.minical = function(opts) {
      return this.each(function() {
        var $e, data;
        $e = $(this);
        data = $.extend(true, {
          $el: $e
        }, minical, opts);
        data.data = data;
        $e.data("minical", data);
        return data.init();
      });
    };
  })(minical);

}).call(this)
});