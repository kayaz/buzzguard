/*

	Obsługa wszystkich funkcji jQuery

*/
// Toad
"function"!=typeof Object.create&&(Object.create=function(t){function o(){}return o.prototype=t,new o}),function(t,o,i,s){"use strict";var n={_positionClasses:["bottom-left","bottom-right","top-right","top-left","bottom-center","top-center","mid-center"],_defaultIcons:["success","error","info","warning"],init:function(o,i){this.prepareOptions(o,t.toast.options),this.process()},prepareOptions:function(o,i){var s={};"string"==typeof o||o instanceof Array?s.text=o:s=o,this.options=t.extend({},i,s)},process:function(){this.setup(),this.addToDom(),this.position(),this.bindToast(),this.animate()},setup:function(){var o="";if(this._toastEl=this._toastEl||t("<div></div>",{class:"jq-toast-single"}),o+='<span class="jq-toast-loader"></span>',this.options.allowToastClose&&(o+='<span class="close-jq-toast-single">&times;</span>'),this.options.text instanceof Array){this.options.heading&&(o+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),o+='<ul class="jq-toast-ul">';for(var i=0;i<this.options.text.length;i++)o+='<li class="jq-toast-li" id="jq-toast-item-'+i+'">'+this.options.text[i]+"</li>";o+="</ul>"}else this.options.heading&&(o+='<h2 class="jq-toast-heading">'+this.options.heading+"</h2>"),o+=this.options.text;this._toastEl.html(o),!1!==this.options.bgColor&&this._toastEl.css("background-color",this.options.bgColor),!1!==this.options.textColor&&this._toastEl.css("color",this.options.textColor),this.options.textAlign&&this._toastEl.css("text-align",this.options.textAlign),!1!==this.options.icon&&(this._toastEl.addClass("jq-has-icon"),-1!==t.inArray(this.options.icon,this._defaultIcons)&&this._toastEl.addClass("jq-icon-"+this.options.icon)),!1!==this.options.class&&this._toastEl.addClass(this.options.class)},position:function(){"string"==typeof this.options.position&&-1!==t.inArray(this.options.position,this._positionClasses)?"bottom-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,bottom:20}):"top-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,top:20}):"mid-center"===this.options.position?this._container.css({left:t(o).outerWidth()/2-this._container.outerWidth()/2,top:t(o).outerHeight()/2-this._container.outerHeight()/2}):this._container.addClass(this.options.position):"object"==typeof this.options.position?this._container.css({top:this.options.position.top?this.options.position.top:"auto",bottom:this.options.position.bottom?this.options.position.bottom:"auto",left:this.options.position.left?this.options.position.left:"auto",right:this.options.position.right?this.options.position.right:"auto"}):this._container.addClass("bottom-left")},bindToast:function(){var t=this;this._toastEl.on("afterShown",function(){t.processLoader()}),this._toastEl.find(".close-jq-toast-single").on("click",function(o){o.preventDefault(),"fade"===t.options.showHideTransition?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):"slide"===t.options.showHideTransition?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))}),"function"==typeof this.options.beforeShow&&this._toastEl.on("beforeShow",function(){t.options.beforeShow(t._toastEl)}),"function"==typeof this.options.afterShown&&this._toastEl.on("afterShown",function(){t.options.afterShown(t._toastEl)}),"function"==typeof this.options.beforeHide&&this._toastEl.on("beforeHide",function(){t.options.beforeHide(t._toastEl)}),"function"==typeof this.options.afterHidden&&this._toastEl.on("afterHidden",function(){t.options.afterHidden(t._toastEl)}),"function"==typeof this.options.onClick&&this._toastEl.on("click",function(){t.options.onClick(t._toastEl)})},addToDom:function(){var o=t(".jq-toast-wrap");if(0===o.length?(o=t("<div></div>",{class:"jq-toast-wrap",role:"alert","aria-live":"polite"}),t("body").append(o)):this.options.stack&&!isNaN(parseInt(this.options.stack,10))||o.empty(),o.find(".jq-toast-single:hidden").remove(),o.append(this._toastEl),this.options.stack&&!isNaN(parseInt(this.options.stack),10)){var i=o.find(".jq-toast-single").length-this.options.stack;i>0&&t(".jq-toast-wrap").find(".jq-toast-single").slice(0,i).remove()}this._container=o},canAutoHide:function(){return!1!==this.options.hideAfter&&!isNaN(parseInt(this.options.hideAfter,10))},processLoader:function(){if(!this.canAutoHide()||!1===this.options.loader)return!1;var t=this._toastEl.find(".jq-toast-loader"),o=(this.options.hideAfter-400)/1e3+"s",i=this.options.loaderBg,s=t.attr("style")||"";s=s.substring(0,s.indexOf("-webkit-transition")),s+="-webkit-transition: width "+o+" ease-in;                       -o-transition: width "+o+" ease-in;                       transition: width "+o+" ease-in;                       background-color: "+i+";",t.attr("style",s).addClass("jq-toast-loaded")},animate:function(){t=this;if(this._toastEl.hide(),this._toastEl.trigger("beforeShow"),"fade"===this.options.showHideTransition.toLowerCase()?this._toastEl.fadeIn(function(){t._toastEl.trigger("afterShown")}):"slide"===this.options.showHideTransition.toLowerCase()?this._toastEl.slideDown(function(){t._toastEl.trigger("afterShown")}):this._toastEl.show(function(){t._toastEl.trigger("afterShown")}),this.canAutoHide()){var t=this;o.setTimeout(function(){"fade"===t.options.showHideTransition.toLowerCase()?(t._toastEl.trigger("beforeHide"),t._toastEl.fadeOut(function(){t._toastEl.trigger("afterHidden")})):"slide"===t.options.showHideTransition.toLowerCase()?(t._toastEl.trigger("beforeHide"),t._toastEl.slideUp(function(){t._toastEl.trigger("afterHidden")})):(t._toastEl.trigger("beforeHide"),t._toastEl.hide(function(){t._toastEl.trigger("afterHidden")}))},this.options.hideAfter)}},reset:function(o){"all"===o?t(".jq-toast-wrap").remove():this._toastEl.remove()},update:function(t){this.prepareOptions(t,this.options),this.setup(),this.bindToast()},close:function(){this._toastEl.find(".close-jq-toast-single").click()}};t.toast=function(t){var o=Object.create(n);return o.init(t,this),{reset:function(t){o.reset(t)},update:function(t){o.update(t)},close:function(){o.close()}}},t.toast.options={text:"",heading:"",showHideTransition:"fade",allowToastClose:!0,hideAfter:3e3,loader:!0,loaderBg:"#9EC600",stack:5,position:"bottom-left",bgColor:!1,textColor:!1,textAlign:"left",icon:!1,beforeShow:function(){},afterShown:function(){},beforeHide:function(){},afterHidden:function(){},onClick:function(){}}}(jQuery,window,document);

// Potwierdzenie
(function(a){a.confirm=function(c){if(a("#confirmOverlay").length){return false}var f="";a.each(c.buttons,function(h,g){f+='<a href="#" class="'+g["class"]+'">'+h+"<span></span></a>";if(!g.action){g.action=function(){}}});var e=['<div id="confirmOverlay">','<div class="modal fade show" id="confirmBox"><div class="modal-dialog modal-dialog-centered"><div class="modal-content">','<div class="modal-header"><h5 class="modal-title">',c.title,"</h5></div>",'<div class="modal-body">',c.message,"</div>",'<div id="confirmButtons" class="modal-footer">',f,"</div></div></div>"].join("");a(e).hide().appendTo("body").fadeIn();var b=a("#confirmBox .btn"),d=0;a.each(c.buttons,function(g,h){b.eq(d++).click(function(){h.action();a.confirm.hide();return false})})};a.confirm.hide=function(){a("#confirmOverlay").fadeOut(function(){a(this).remove()})}})(jQuery);

function show5(){if(document.layers||document.all||document.getElementById){var e=new Date,c=e.getHours(),o=e.getMinutes(),t=e.getSeconds();0==c&&(c=12),o<=9&&(o="0"+o),t<=9&&(t="0"+t),myclock=c+":"+o+":"+t+" ",document.layers?(document.layers.liveclock.document.write(myclock),document.layers.liveclock.document.close()):document.all?liveclock.innerHTML=myclock:document.getElementById&&(document.getElementById("liveclock").innerHTML=myclock),setTimeout("show5()",1e3)}}window.onload=show5;

// Pomoc przy sortowaniu
var fixHelper=function(b,a){a.children().each(function(){var c=$(this).clone();$(this).width($(this).width())});return a};

// Sortowanie listy
jQuery.fn.sortuj = function(a) {
    this.sortable({
        cursor: "move",
        handle: ".move-button",
        start: function(d, c) {
            var b = $(this).sortable("instance");
            c.placeholder.height(c.helper.height());
            b.containment[3] += c.helper.height() * 1.5 - b.offset.click.top;
            b.containment[1] -= b.offset.click.top
        },
        helper: function(b, c) {
            c.children().each(function() {
                $(this).width($(this).width())
            });
            return c
        },
        zIndex: 9999,
        containment: "#sortable",
        axis: "y",
        update: function() {
            var b = $(this).sortable("serialize");
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                data: b,
                type: "POST",
                url: a,
                success: function(c) {
                    $("#jqalert").prepend('<div class="alert alert-success border-0 none mb-0" role="alert">Zmiana zapisana</div>');
                    $(".alert").fadeIn(500);
                    setTimeout(function() {
                        $(".alert").slideUp(500,function(){$(this).remove()})
                    }, 3000)
                },
                error: function() {
                    $("#jqalert").prepend('<div class="alert alert-danger border-0 none mb-0" role="alert">Wystąpił błąd</div>');
                    $(".alert").fadeIn(500);
                    setTimeout(function() {
                        $(".alert").slideUp(500,function(){$(this).remove()})
                    }, 3000)
                }
            })
        }
    }).disableSelection()
};

// Sortowanie galerii
jQuery.fn.sortujGal = function(a) {
    this.sortable({
        cursor: "move",
        handle: ".move-button",
        zIndex: 9999,
        containment: "#sortable",
        dropOnEmpty: false,
        start: function(d, c) {
            var b = $(this).sortable("instance");
            b.containment[3] += c.helper.height() * 1.5 - b.offset.click.top;
            b.containment[1] -= b.offset.click.top
        },
        update: function() {
            var b = $(this).sortable("serialize");
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                data: b,
                type: "POST",
                url: a,
                success: function(c) {
                    $("#jqalert").prepend('<div class="alert alert-success border-0 none mb-0" role="alert">Zmiana zapisana</div>');
                    $(".alert").fadeIn(500);
                    setTimeout(function() {
                        $(".alert").slideUp(500,function(){$(this).remove()})
                    }, 3000)
                },
                error: function() {
                    $("#jqalert").prepend('<div class="alert alert-danger border-0 none mb-0" role="alert">Wystąpił błąd</div>');
                    $(".alert").fadeIn(500);
                    setTimeout(function() {
                        $(".alert").slideUp(500,function(){$(this).remove()})
                    }, 3000)
                }
            })
        }
    }).disableSelection()
};

$(document).ready(function(){
	$('#togglemenu').click(function(e) {
		e.preventDefault();
		$('body').toggleClass('icon-menu');
	});

	$('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="tooltip"]').click(function () {
        $('[data-toggle="tooltip"]').tooltip("hide");
    });

    $(".confirm").click(function(d) {
        d.preventDefault();
        var c = $(this).closest("form");
        var a = c.attr("action");
        var f = $(this).data("id");
        var b = $("meta[name='csrf-token']").attr("content");
        $.confirm({
            title: "Potwierdzenie usunięcia",
            message: "Czy na pewno chcesz usunąć?",
            buttons: {
                Tak: {
                    "class": "btn btn-primary",
                    action: function() {
                        $.ajax({
                            url: a,
                            type: "DELETE",
                            data: {
                                _token: b,
                            },
                            success: function() {
                                location.reload();
                            }
                        })
                    }
                },
                Nie: {
                    "class": "btn btn-secondary",
                    action: function() {}
                }
            }
        })
    });

    $('#toggleparam').click(function(e){
        e.preventDefault();
        $('.toggleRow').toggle();
    });

    $('#form_metry').keyup(function() {
        var number = $(this).val().replace(/,/g, '.')
        $('#form_szukaj_metry').val(Math.round(number));
    });

});
