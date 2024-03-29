jQuery(document).ready(function($){
	
    'use strict';

    /* ======== Slider Carousel ======== */
    $(".slider").owlCarousel({
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem : true,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });

    /* ======== Newa Sticker Carousel ======== */
    $(".newsticker").owlCarousel({
        autoPlay : 3000,
        slideSpeed : 300,
        paginationSpeed : 1000,
        singleItem : true,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });

    /* ======== Featured Posts Carousel ======== */
    $(".featured-video-carousel").owlCarousel({
        autoPlay : 3000,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem : true,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });

    /* ======== Post Gallery Carousel ======== */
    $(".gallery-carousel").owlCarousel({
        autoPlay : 3000,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem : true,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ]
    });

    /* ======== FitVid ======== */
    $(".fitvid, .video-container").fitVids();

    /* ======== Scroll Up ======== */
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $('.scrollup').on("click" ,function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    /*! SmartMenus jQuery Plugin - v0.9.7 - August 25, 2014
     * http://www.smartmenus.org/
     * Copyright 2014 Vasil Dinkov, Vadikom Web Ltd. http://vadikom.com; Licensed MIT */(function(t){function i(i){var a=".smartmenus_mouse";if(h||i)h&&i&&(t(document).unbind(a),h=!1);else{var u=!0,l=null;t(document).bind(o([["mousemove",function(i){var e={x:i.pageX,y:i.pageY,timeStamp:(new Date).getTime()};if(l){var s=Math.abs(l.x-e.x),o=Math.abs(l.y-e.y);if((s>0||o>0)&&2>=s&&2>=o&&300>=e.timeStamp-l.timeStamp&&(r=!0,u)){var a=t(i.target).closest("a");a.is("a")&&t.each(n,function(){return t.contains(this.$root[0],a[0])?(this.itemEnter({currentTarget:a[0]}),!1):void 0}),u=!1}}l=e}],[s()?"touchstart":"pointerover pointermove pointerout MSPointerOver MSPointerMove MSPointerOut",function(t){e(t.originalEvent)&&(r=!1)}]],a)),h=!0}}function e(t){return!/^(4|mouse)$/.test(t.pointerType)}function s(){return"ontouchstart"in window}function o(i,e){e||(e="");var s={};return t.each(i,function(t,i){s[i[0].split(" ").join(e+" ")+e]=i[1]}),s}var n=[],a=!!window.createPopup,r=!1,h=!1;t.SmartMenus=function(i,e){this.$root=t(i),this.opts=e,this.rootId="",this.$subArrow=null,this.subMenus=[],this.activatedItems=[],this.visibleSubMenus=[],this.showTimeout=0,this.hideTimeout=0,this.scrollTimeout=0,this.clickActivated=!1,this.zIndexInc=0,this.$firstLink=null,this.$firstSub=null,this.disabled=!1,this.$disableOverlay=null,this.isTouchScrolling=!1,this.init()},t.extend(t.SmartMenus,{hideAll:function(){t.each(n,function(){this.menuHideAll()})},destroy:function(){for(;n.length;)n[0].destroy();i(!0)},prototype:{init:function(e){var s=this;if(!e){n.push(this),this.rootId=((new Date).getTime()+Math.random()+"").replace(/\D/g,""),this.$root.hasClass("sm-rtl")&&(this.opts.rightToLeftSubMenus=!0);var a=".smartmenus";this.$root.data("smartmenus",this).attr("data-smartmenus-id",this.rootId).dataSM("level",1).bind(o([["mouseover focusin",t.proxy(this.rootOver,this)],["mouseout focusout",t.proxy(this.rootOut,this)]],a)).delegate("a",o([["mouseenter",t.proxy(this.itemEnter,this)],["mouseleave",t.proxy(this.itemLeave,this)],["mousedown",t.proxy(this.itemDown,this)],["focus",t.proxy(this.itemFocus,this)],["blur",t.proxy(this.itemBlur,this)],["click",t.proxy(this.itemClick,this)],["touchend",t.proxy(this.itemTouchEnd,this)]],a)),a+=this.rootId,this.opts.hideOnClick&&t(document).bind(o([["touchstart",t.proxy(this.docTouchStart,this)],["touchmove",t.proxy(this.docTouchMove,this)],["touchend",t.proxy(this.docTouchEnd,this)],["click",t.proxy(this.docClick,this)]],a)),t(window).bind(o([["resize orientationchange",t.proxy(this.winResize,this)]],a)),this.opts.subIndicators&&(this.$subArrow=t("<span/>").addClass("sub-arrow"),this.opts.subIndicatorsText&&this.$subArrow.html(this.opts.subIndicatorsText)),i()}if(this.$firstSub=this.$root.find("ul").each(function(){s.menuInit(t(this))}).eq(0),this.$firstLink=this.$root.find("a").eq(0),this.opts.markCurrentItem){var r=/(index|default)\.[^#\?\/]*/i,h=/#.*/,u=window.location.href.replace(r,""),l=u.replace(h,"");this.$root.find("a").each(function(){var i=this.href.replace(r,""),e=t(this);(i==u||i==l)&&(e.addClass("current"),s.opts.markCurrentTree&&e.parent().parentsUntil("[data-smartmenus-id]","li").children("a").addClass("current"))})}},destroy:function(){this.menuHideAll();var i=".smartmenus";this.$root.removeData("smartmenus").removeAttr("data-smartmenus-id").removeDataSM("level").unbind(i).undelegate(i),i+=this.rootId,t(document).unbind(i),t(window).unbind(i),this.opts.subIndicators&&(this.$subArrow=null);var e=this;t.each(this.subMenus,function(){this.hasClass("mega-menu")&&this.find("ul").removeDataSM("in-mega"),this.dataSM("shown-before")&&((e.opts.subMenusMinWidth||e.opts.subMenusMaxWidth)&&this.css({width:"",minWidth:"",maxWidth:""}).removeClass("sm-nowrap"),this.dataSM("scroll-arrows")&&this.dataSM("scroll-arrows").remove(),this.css({zIndex:"",top:"",left:"",marginLeft:"",marginTop:"",display:""})),e.opts.subIndicators&&this.dataSM("parent-a").removeClass("has-submenu").children("span.sub-arrow").remove(),this.removeDataSM("shown-before").removeDataSM("ie-shim").removeDataSM("scroll-arrows").removeDataSM("parent-a").removeDataSM("level").removeDataSM("beforefirstshowfired").parent().removeDataSM("sub")}),this.opts.markCurrentItem&&this.$root.find("a.current").removeClass("current"),this.$root=null,this.$firstLink=null,this.$firstSub=null,this.$disableOverlay&&(this.$disableOverlay.remove(),this.$disableOverlay=null),n.splice(t.inArray(this,n),1)},disable:function(i){if(!this.disabled){if(this.menuHideAll(),!i&&!this.opts.isPopup&&this.$root.is(":visible")){var e=this.$root.offset();this.$disableOverlay=t('<div class="sm-jquery-disable-overlay"/>').css({position:"absolute",top:e.top,left:e.left,width:this.$root.outerWidth(),height:this.$root.outerHeight(),zIndex:this.getStartZIndex(!0),opacity:0}).appendTo(document.body)}this.disabled=!0}},docClick:function(i){return this.isTouchScrolling?(this.isTouchScrolling=!1,void 0):((this.visibleSubMenus.length&&!t.contains(this.$root[0],i.target)||t(i.target).is("a"))&&this.menuHideAll(),void 0)},docTouchEnd:function(){if(this.lastTouch){if(!(!this.visibleSubMenus.length||void 0!==this.lastTouch.x2&&this.lastTouch.x1!=this.lastTouch.x2||void 0!==this.lastTouch.y2&&this.lastTouch.y1!=this.lastTouch.y2||this.lastTouch.target&&t.contains(this.$root[0],this.lastTouch.target))){this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0);var i=this;this.hideTimeout=setTimeout(function(){i.menuHideAll()},350)}this.lastTouch=null}},docTouchMove:function(t){if(this.lastTouch){var i=t.originalEvent.touches[0];this.lastTouch.x2=i.pageX,this.lastTouch.y2=i.pageY}},docTouchStart:function(t){var i=t.originalEvent.touches[0];this.lastTouch={x1:i.pageX,y1:i.pageY,target:i.target}},enable:function(){this.disabled&&(this.$disableOverlay&&(this.$disableOverlay.remove(),this.$disableOverlay=null),this.disabled=!1)},getClosestMenu:function(i){for(var e=t(i).closest("ul");e.dataSM("in-mega");)e=e.parent().closest("ul");return e[0]||null},getHeight:function(t){return this.getOffset(t,!0)},getOffset:function(t,i){var e;"none"==t.css("display")&&(e={position:t[0].style.position,visibility:t[0].style.visibility},t.css({position:"absolute",visibility:"hidden"}).show());var s=t[0].getBoundingClientRect&&t[0].getBoundingClientRect(),o=s&&(i?s.height||s.bottom-s.top:s.width||s.right-s.left);return o||0===o||(o=i?t[0].offsetHeight:t[0].offsetWidth),e&&t.hide().css(e),o},getStartZIndex:function(t){var i=parseInt(this[t?"$root":"$firstSub"].css("z-index"));return!t&&isNaN(i)&&(i=parseInt(this.$root.css("z-index"))),isNaN(i)?1:i},getTouchPoint:function(t){return t.touches&&t.touches[0]||t.changedTouches&&t.changedTouches[0]||t},getViewport:function(t){var i=t?"Height":"Width",e=document.documentElement["client"+i],s=window["inner"+i];return s&&(e=Math.min(e,s)),e},getViewportHeight:function(){return this.getViewport(!0)},getViewportWidth:function(){return this.getViewport()},getWidth:function(t){return this.getOffset(t)},handleEvents:function(){return!this.disabled&&this.isCSSOn()},handleItemEvents:function(t){return this.handleEvents()&&!this.isLinkInMegaMenu(t)},isCollapsible:function(){return"static"==this.$firstSub.css("position")},isCSSOn:function(){return"block"==this.$firstLink.css("display")},isFixed:function(){var i="fixed"==this.$root.css("position");return i||this.$root.parentsUntil("body").each(function(){return"fixed"==t(this).css("position")?(i=!0,!1):void 0}),i},isLinkInMegaMenu:function(t){return!t.parent().parent().dataSM("level")},isTouchMode:function(){return!r||this.isCollapsible()},itemActivate:function(i){var e=i.parent(),s=e.parent(),o=s.dataSM("level");if(o>1&&(!this.activatedItems[o-2]||this.activatedItems[o-2][0]!=s.dataSM("parent-a")[0])){var n=this;t(s.parentsUntil("[data-smartmenus-id]","ul").get().reverse()).add(s).each(function(){n.itemActivate(t(this).dataSM("parent-a"))})}if(this.visibleSubMenus.length>o&&this.menuHideSubMenus(this.activatedItems[o-1]&&this.activatedItems[o-1][0]==i[0]?o:o-1),this.activatedItems[o-1]=i,this.visibleSubMenus[o-1]=s,this.$root.triggerHandler("activate.smapi",i[0])!==!1){var a=e.dataSM("sub");a&&(this.isTouchMode()||!this.opts.showOnClick||this.clickActivated)&&this.menuShow(a)}},itemBlur:function(i){var e=t(i.currentTarget);this.handleItemEvents(e)&&this.$root.triggerHandler("blur.smapi",e[0])},itemClick:function(i){if(this.isTouchScrolling)return this.isTouchScrolling=!1,i.stopPropagation(),!1;var e=t(i.currentTarget);if(this.handleItemEvents(e)){if(e.removeDataSM("mousedown"),this.$root.triggerHandler("click.smapi",e[0])===!1)return!1;var s=e.parent().dataSM("sub");if(this.isTouchMode()){if(e.dataSM("href")&&e.attr("href",e.dataSM("href")).removeDataSM("href"),s&&(!s.dataSM("shown-before")||!s.is(":visible"))&&(this.itemActivate(e),s.is(":visible")))return!1}else if(this.opts.showOnClick&&1==e.parent().parent().dataSM("level")&&s)return this.clickActivated=!0,this.menuShow(s),!1;return e.hasClass("disabled")?!1:this.$root.triggerHandler("select.smapi",e[0])===!1?!1:void 0}},itemDown:function(i){var e=t(i.currentTarget);this.handleItemEvents(e)&&e.dataSM("mousedown",!0)},itemEnter:function(i){var e=t(i.currentTarget);if(this.handleItemEvents(e)){if(!this.isTouchMode()){this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0);var s=this;this.showTimeout=setTimeout(function(){s.itemActivate(e)},this.opts.showOnClick&&1==e.parent().parent().dataSM("level")?1:this.opts.showTimeout)}this.$root.triggerHandler("mouseenter.smapi",e[0])}},itemFocus:function(i){var e=t(i.currentTarget);this.handleItemEvents(e)&&(this.isTouchMode()&&e.dataSM("mousedown")||this.activatedItems.length&&this.activatedItems[this.activatedItems.length-1][0]==e[0]||this.itemActivate(e),this.$root.triggerHandler("focus.smapi",e[0]))},itemLeave:function(i){var e=t(i.currentTarget);this.handleItemEvents(e)&&(this.isTouchMode()||(e[0].blur&&e[0].blur(),this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0)),e.removeDataSM("mousedown"),this.$root.triggerHandler("mouseleave.smapi",e[0]))},itemTouchEnd:function(i){var e=t(i.currentTarget);if(this.handleItemEvents(e)){var s=e.parent().dataSM("sub");"#"===e.attr("href").charAt(0)||!s||s.dataSM("shown-before")&&s.is(":visible")||(e.dataSM("href",e.attr("href")),e.attr("href","#"))}},menuFixLayout:function(t){t.dataSM("shown-before")||t.hide().dataSM("shown-before",!0)},menuHide:function(t){if(this.$root.triggerHandler("beforehide.smapi",t[0])!==!1&&(t.stop(!0,!0),t.is(":visible"))){var i=function(){t.css("z-index","")};this.isCollapsible()?this.opts.collapsibleHideFunction?this.opts.collapsibleHideFunction.call(this,t,i):t.hide(this.opts.collapsibleHideDuration,i):this.opts.hideFunction?this.opts.hideFunction.call(this,t,i):t.hide(this.opts.hideDuration,i),t.dataSM("ie-shim")&&t.dataSM("ie-shim").remove(),t.dataSM("scroll")&&(this.menuScrollStop(t),t.css({"touch-action":"","-ms-touch-action":""}).unbind(".smartmenus_scroll").removeDataSM("scroll").dataSM("scroll-arrows").hide()),t.dataSM("parent-a").removeClass("highlighted");var e=t.dataSM("level");this.activatedItems.splice(e-1,1),this.visibleSubMenus.splice(e-1,1),this.$root.triggerHandler("hide.smapi",t[0])}},menuHideAll:function(){this.showTimeout&&(clearTimeout(this.showTimeout),this.showTimeout=0),this.menuHideSubMenus(),this.opts.isPopup&&(this.$root.stop(!0,!0),this.$root.is(":visible")&&(this.opts.hideFunction?this.opts.hideFunction.call(this,this.$root):this.$root.hide(this.opts.hideDuration),this.$root.dataSM("ie-shim")&&this.$root.dataSM("ie-shim").remove())),this.activatedItems=[],this.visibleSubMenus=[],this.clickActivated=!1,this.zIndexInc=0},menuHideSubMenus:function(t){t||(t=0);for(var i=this.visibleSubMenus.length-1;i>t;i--)this.menuHide(this.visibleSubMenus[i])},menuIframeShim:function(i){a&&this.opts.overlapControlsInIE&&!i.dataSM("ie-shim")&&i.dataSM("ie-shim",t("<iframe/>").attr({src:"javascript:0",tabindex:-9}).css({position:"absolute",top:"auto",left:"0",opacity:0,border:"0"}))},menuInit:function(t){if(!t.dataSM("in-mega")){this.subMenus.push(t),t.hasClass("mega-menu")&&t.find("ul").dataSM("in-mega",!0);for(var i=2,e=t[0];(e=e.parentNode.parentNode)!=this.$root[0];)i++;t.dataSM("parent-a",t.prevAll("a").eq(-1)).dataSM("level",i).parent().dataSM("sub",t),this.opts.subIndicators&&t.dataSM("parent-a").addClass("has-submenu")[this.opts.subIndicatorsPos](this.$subArrow.clone())}},menuPosition:function(i){var e,n,a=i.dataSM("parent-a"),r=i.parent().parent(),h=i.dataSM("level"),u=this.getWidth(i),l=this.getHeight(i),c=a.offset(),d=c.left,m=c.top,p=this.getWidth(a),f=this.getHeight(a),v=t(window),S=v.scrollLeft(),b=v.scrollTop(),M=this.getViewportWidth(),g=this.getViewportHeight(),w=r.hasClass("sm")&&!r.hasClass("sm-vertical"),T=2==h?this.opts.mainMenuSubOffsetX:this.opts.subMenusSubOffsetX,$=2==h?this.opts.mainMenuSubOffsetY:this.opts.subMenusSubOffsetY;if(w?(e=this.opts.rightToLeftSubMenus?p-u-T:T,n=this.opts.bottomToTopSubMenus?-l-$:f+$):(e=this.opts.rightToLeftSubMenus?T-u:p-T,n=this.opts.bottomToTopSubMenus?f-$-l:$),this.opts.keepInViewport&&!this.isCollapsible()){var I=d+e,y=m+n;if(this.opts.rightToLeftSubMenus&&S>I?e=w?S-I+e:p-T:!this.opts.rightToLeftSubMenus&&I+u>S+M&&(e=w?S+M-u-I+e:T-u),w||(g>l&&y+l>b+g?n+=b+g-l-y:(l>=g||b>y)&&(n+=b-y)),w&&(y+l>b+g+.49||b>y)||!w&&l>g+.49){var x=this;i.dataSM("scroll-arrows")||i.dataSM("scroll-arrows",t([t('<span class="scroll-up"><span class="scroll-up-arrow"></span></span>')[0],t('<span class="scroll-down"><span class="scroll-down-arrow"></span></span>')[0]]).bind({mouseenter:function(){i.dataSM("scroll").up=t(this).hasClass("scroll-up"),x.menuScroll(i)},mouseleave:function(t){x.menuScrollStop(i),x.menuScrollOut(i,t)},"mousewheel DOMMouseScroll":function(t){t.preventDefault()}}).insertAfter(i));var C=".smartmenus_scroll";i.dataSM("scroll",{step:1,itemH:f,subH:l,arrowDownH:this.getHeight(i.dataSM("scroll-arrows").eq(1))}).bind(o([["mouseover",function(t){x.menuScrollOver(i,t)}],["mouseout",function(t){x.menuScrollOut(i,t)}],["mousewheel DOMMouseScroll",function(t){x.menuScrollMousewheel(i,t)}]],C)).dataSM("scroll-arrows").css({top:"auto",left:"0",marginLeft:e+(parseInt(i.css("border-left-width"))||0),width:u-(parseInt(i.css("border-left-width"))||0)-(parseInt(i.css("border-right-width"))||0),zIndex:i.css("z-index")}).eq(w&&this.opts.bottomToTopSubMenus?0:1).show(),this.isFixed()&&i.css({"touch-action":"none","-ms-touch-action":"none"}).bind(o([[s()?"touchstart touchmove touchend":"pointerdown pointermove pointerup MSPointerDown MSPointerMove MSPointerUp",function(t){x.menuScrollTouch(i,t)}]],C))}}i.css({top:"auto",left:"0",marginLeft:e,marginTop:n-f}),this.menuIframeShim(i),i.dataSM("ie-shim")&&i.dataSM("ie-shim").css({zIndex:i.css("z-index"),width:u,height:l,marginLeft:e,marginTop:n-f})},menuScroll:function(t,i,e){var s,o=t.dataSM("scroll"),n=t.dataSM("scroll-arrows"),a=parseFloat(t.css("margin-top")),h=o.up?o.upEnd:o.downEnd;if(!i&&o.velocity){if(o.velocity*=.9,s=o.velocity,.5>s)return this.menuScrollStop(t),void 0}else s=e||(i||!this.opts.scrollAccelerate?this.opts.scrollStep:Math.floor(o.step));var u=t.dataSM("level");this.visibleSubMenus.length>u&&this.menuHideSubMenus(u-1);var l=o.up&&a>=h||!o.up&&h>=a?a:Math.abs(h-a)>s?a+(o.up?s:-s):h;if(t.add(t.dataSM("ie-shim")).css("margin-top",l),r&&(o.up&&l>o.downEnd||!o.up&&o.upEnd>l)&&n.eq(o.up?1:0).show(),l==h)r&&n.eq(o.up?0:1).hide(),this.menuScrollStop(t);else if(!i){this.opts.scrollAccelerate&&o.step<this.opts.scrollStep&&(o.step+=.5);var c=this;this.scrollTimeout=setTimeout(function(){c.menuScroll(t)},this.opts.scrollInterval)}},menuScrollMousewheel:function(t,i){if(this.getClosestMenu(i.target)==t[0]){i=i.originalEvent;var e=(i.wheelDelta||-i.detail)>0;t.dataSM("scroll-arrows").eq(e?0:1).is(":visible")&&(t.dataSM("scroll").up=e,this.menuScroll(t,!0))}i.preventDefault()},menuScrollOut:function(i,e){r&&(/^scroll-(up|down)/.test((e.relatedTarget||"").className)||(i[0]==e.relatedTarget||t.contains(i[0],e.relatedTarget))&&this.getClosestMenu(e.relatedTarget)==i[0]||i.dataSM("scroll-arrows").css("visibility","hidden"))},menuScrollOver:function(t,i){if(r&&!/^scroll-(up|down)/.test(i.target.className)&&this.getClosestMenu(i.target)==t[0]){this.menuScrollRefreshData(t);var e=t.dataSM("scroll");t.dataSM("scroll-arrows").eq(0).css("margin-top",e.upEnd).end().eq(1).css("margin-top",e.downEnd+e.subH-e.arrowDownH).end().css("visibility","visible")}},menuScrollRefreshData:function(i){var e=i.dataSM("scroll"),s=t(window),o=s.scrollTop()-i.dataSM("parent-a").offset().top-e.itemH;t.extend(e,{upEnd:o,downEnd:o+this.getViewportHeight()-e.subH})},menuScrollStop:function(i){return this.scrollTimeout?(clearTimeout(this.scrollTimeout),this.scrollTimeout=0,t.extend(i.dataSM("scroll"),{step:1,velocity:0}),!0):void 0},menuScrollTouch:function(i,s){if(s=s.originalEvent,e(s)){var o=this.getTouchPoint(s);if(this.getClosestMenu(o.target)==i[0]){var n=i.dataSM("scroll");if(/(start|down)$/i.test(s.type))this.menuScrollStop(i)?(s.preventDefault(),this.isTouchScrolling=!0):this.isTouchScrolling=!1,this.menuScrollRefreshData(i),t.extend(n,{touchY:o.pageY,touchTimestamp:s.timeStamp,velocity:0});else if(/move$/i.test(s.type)){var a=n.touchY;void 0!==a&&a!=o.pageY&&(this.isTouchScrolling=!0,t.extend(n,{up:o.pageY>a,touchY:o.pageY,touchTimestamp:s.timeStamp,velocity:n.velocity+.5*Math.abs(o.pageY-a)}),this.menuScroll(i,!0,Math.abs(n.touchY-a))),s.preventDefault()}else void 0!==n.touchY&&(120>s.timeStamp-n.touchTimestamp&&n.velocity>0&&(n.velocity*=.5,this.menuScrollStop(i),this.menuScroll(i),s.preventDefault()),delete n.touchY)}}},menuShow:function(t){if((t.dataSM("beforefirstshowfired")||(t.dataSM("beforefirstshowfired",!0),this.$root.triggerHandler("beforefirstshow.smapi",t[0])!==!1))&&this.$root.triggerHandler("beforeshow.smapi",t[0])!==!1&&(this.menuFixLayout(t),t.stop(!0,!0),!t.is(":visible"))){if(t.css("z-index",this.zIndexInc=(this.zIndexInc||this.getStartZIndex())+1),(this.opts.keepHighlighted||this.isCollapsible())&&t.dataSM("parent-a").addClass("highlighted"),(this.opts.subMenusMinWidth||this.opts.subMenusMaxWidth)&&(t.css({width:"auto",minWidth:"",maxWidth:""}).addClass("sm-nowrap"),this.opts.subMenusMinWidth&&t.css("min-width",this.opts.subMenusMinWidth),this.opts.subMenusMaxWidth)){var i=this.getWidth(t);t.css("max-width",this.opts.subMenusMaxWidth),i>this.getWidth(t)&&t.removeClass("sm-nowrap").css("width",this.opts.subMenusMaxWidth)}this.menuPosition(t),t.dataSM("ie-shim")&&t.dataSM("ie-shim").insertBefore(t);var e=function(){t.css("overflow","")};this.isCollapsible()?this.opts.collapsibleShowFunction?this.opts.collapsibleShowFunction.call(this,t,e):t.show(this.opts.collapsibleShowDuration,e):this.opts.showFunction?this.opts.showFunction.call(this,t,e):t.show(this.opts.showDuration,e),this.visibleSubMenus[t.dataSM("level")-1]=t,this.$root.triggerHandler("show.smapi",t[0])}},popupHide:function(t){this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0);var i=this;this.hideTimeout=setTimeout(function(){i.menuHideAll()},t?1:this.opts.hideTimeout)},popupShow:function(t,i){if(!this.opts.isPopup)return alert('SmartMenus jQuery Error:\n\nIf you want to show this menu via the "popupShow" method, set the isPopup:true option.'),void 0;if(this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0),this.menuFixLayout(this.$root),this.$root.stop(!0,!0),!this.$root.is(":visible")){this.$root.css({left:t,top:i}),this.menuIframeShim(this.$root),this.$root.dataSM("ie-shim")&&this.$root.dataSM("ie-shim").css({zIndex:this.$root.css("z-index"),width:this.getWidth(this.$root),height:this.getHeight(this.$root),left:t,top:i}).insertBefore(this.$root);var e=this,s=function(){e.$root.css("overflow","")};this.opts.showFunction?this.opts.showFunction.call(this,this.$root,s):this.$root.show(this.opts.showDuration,s),this.visibleSubMenus[0]=this.$root}},refresh:function(){this.menuHideAll(),this.$root.find("ul").each(function(){var i=t(this);i.dataSM("scroll-arrows")&&i.dataSM("scroll-arrows").remove()}).removeDataSM("in-mega").removeDataSM("shown-before").removeDataSM("ie-shim").removeDataSM("scroll-arrows").removeDataSM("parent-a").removeDataSM("level").removeDataSM("beforefirstshowfired"),this.$root.find("a.has-submenu").removeClass("has-submenu").parent().removeDataSM("sub"),this.opts.subIndicators&&this.$root.find("span.sub-arrow").remove(),this.opts.markCurrentItem&&this.$root.find("a.current").removeClass("current"),this.subMenus=[],this.init(!0)},rootOut:function(t){if(this.handleEvents()&&!this.isTouchMode()&&t.target!=this.$root[0]&&(this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0),!this.opts.showOnClick||!this.opts.hideOnClick)){var i=this;this.hideTimeout=setTimeout(function(){i.menuHideAll()},this.opts.hideTimeout)}},rootOver:function(t){this.handleEvents()&&!this.isTouchMode()&&t.target!=this.$root[0]&&this.hideTimeout&&(clearTimeout(this.hideTimeout),this.hideTimeout=0)},winResize:function(t){if(this.handleEvents())this.isCollapsible()||"onorientationchange"in window&&"orientationchange"!=t.type||(this.activatedItems.length&&this.activatedItems[this.activatedItems.length-1][0].blur(),this.menuHideAll());else if(this.$disableOverlay){var i=this.$root.offset();this.$disableOverlay.css({top:i.top,left:i.left,width:this.$root.outerWidth(),height:this.$root.outerHeight()})}}}}),t.fn.dataSM=function(t,i){return i?this.data(t+"_smartmenus",i):this.data(t+"_smartmenus")},t.fn.removeDataSM=function(t){return this.removeData(t+"_smartmenus")},t.fn.smartmenus=function(i){if("string"==typeof i){var e=arguments,s=i;return Array.prototype.shift.call(e),this.each(function(){var i=t(this).data("smartmenus");i&&i[s]&&i[s].apply(i,e)})}var o=t.extend({},t.fn.smartmenus.defaults,i);return this.each(function(){new t.SmartMenus(this,o)})},t.fn.smartmenus.defaults={isPopup:!1,mainMenuSubOffsetX:0,mainMenuSubOffsetY:0,subMenusSubOffsetX:0,subMenusSubOffsetY:0,subMenusMinWidth:"10em",subMenusMaxWidth:"20em",subIndicators:!0,subIndicatorsPos:"prepend",subIndicatorsText:"+",scrollStep:30,scrollInterval:30,scrollAccelerate:!0,showTimeout:250,hideTimeout:500,showDuration:0,showFunction:null,hideDuration:0,hideFunction:function(t,i){t.fadeOut(200,i)},collapsibleShowDuration:0,collapsibleShowFunction:function(t,i){t.slideDown(200,i)},collapsibleHideDuration:0,collapsibleHideFunction:function(t,i){t.slideUp(200,i)},showOnClick:!1,hideOnClick:!0,keepInViewport:!0,keepHighlighted:!0,markCurrentItem:!1,markCurrentTree:!0,rightToLeftSubMenus:!1,bottomToTopSubMenus:!1,overlapControlsInIE:!0}})(jQuery);

    $('#main-menu').smartmenus({
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8,
        subMenusMaxWidth: 720
    });
    $('#main-menu > li > a span.sub-arrow').text('');

    /* ======== Sticky Menu ======== */
    $("#main-nav-wrap.sticky-navigation").sticky({topSpacing:0});
    var $wpAdminBar = $('#wpadminbar');
    if ($wpAdminBar.length) {
        $('#main-nav-wrap').css('margin-top',$wpAdminBar.height()+'px');
    }

    /* ======== Tabs ======== */
    $('.tabs .nav-tabs').each(function(){
        if( $(this).find('li').length > 0 ) {
            $(this).find('li').first().addClass("active");
            $(this).siblings().find('.tab-pane').first().addClass('active');
        }
    });

    /* ======== Header Search ======== */
    $('.search-icon').on( "click", function() {
        $("i.fa",this).toggleClass("fa-times");
        $('#main-menu, .header-search').toggle();
        $('.header-search input[type=text]').focus();
    });


    /* ======== Responsive Menu ======== */
    $('#menu-button').click(function() {
        var $this = $(this),
            $menu = $('#main-menu');
        if ($menu.is(':animated')) {
            return false;
        }
        if (!$this.hasClass('collapsed')) {
            $menu.slideUp(250, function() { $(this).addClass('collapsed').css('display', ''); });
            $this.addClass('collapsed');
            $('.header-search').hide();
            $('#main-menu > li:first-child a').css('padding-left' , '0');
        } else {
            $menu.slideDown(250, function() { $(this).removeClass('collapsed'); });
            $this.removeClass('collapsed');
            $('.header-search').show();
            $('#main-menu > li:first-child a').css('padding-left' , '20px');

        }
        return false;
    });

}); //$(document).ready(function () {