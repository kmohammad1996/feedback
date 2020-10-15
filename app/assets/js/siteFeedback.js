$('#rateFive').on("click", function() {
  "use strict";
  $('#rateValue').val('5');
  $('#rateFive').addClass('lw-active');
  $('#rateFour').removeClass('lw-active');
  $('#rateThree').removeClass('lw-active');
  $('#rateTwo').removeClass('lw-active');
  $('#rateOne').removeClass('lw-active');

});
$('#rateFour').on("click", function() {
  "use strict";
  $('#rateValue').val('4');
  $('#rateFive').removeClass('lw-active');
  $('#rateFour').addClass('lw-active');
  $('#rateThree').removeClass('lw-active');
  $('#rateTwo').removeClass('lw-active');
  $('#rateOne').removeClass('lw-active');
});
$('#rateThree').on("click", function() {
  "use strict";
  $('#rateValue').val('3');
  $('#rateFive').removeClass('lw-active');
  $('#rateFour').removeClass('lw-active');
  $('#rateThree').addClass('lw-active');
  $('#rateTwo').removeClass('lw-active');
  $('#rateOne').removeClass('lw-active');
});
$('#rateTwo').on("click", function() {
  "use strict";
  $('#rateValue').val('2');
  $('#rateFive').removeClass('lw-active');
  $('#rateFour').removeClass('lw-active');
  $('#rateThree').removeClass('lw-active');
  $('#rateTwo').addClass('lw-active');
  $('#rateOne').removeClass('lw-active');
});
$('#rateOne').on("click", function() {
  "use strict";
  $('#rateValue').val('1');
  $('#rateFive').removeClass('lw-active');
  $('#rateFour').removeClass('lw-active');
  $('#rateThree').removeClass('lw-active');
  $('#rateTwo').removeClass('lw-active');
  $('#rateOne').addClass('lw-active');

});

$(function() {
  "use strict";
    var request;

    $("#feedbackForm").on("submit", function(event){

        event.preventDefault();

        if (request) {
            request.abort();
        }
        var $form = $(this);

        var $inputs = $form.find("input, select, button, textarea");

        var serializedData = $form.serialize();

        $inputs.prop("disabled", true);
        $("#feedbackSubmit").html("Submitting...");

        request = $.ajax({
            url: postUrl,
            type: "post",
            data: serializedData,
            crossDomain: true
        });

        request.done(function (response, textStatus, jqXHR){
          $("#feedbackForm").hide();
          $("#widgetHeader").hide();
            $("#response").append(response);
        });


request.fail(function (jqXHR, textStatus, errorThrown){
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });

        request.always(function () {
            $inputs.prop("disabled", false);
            $("#feedbackSubmit").html("Send feedback");
        });

    });
});

(function () {

    document.addEventListener("DOMContentLoaded", function () {
        var widget = document.querySelector('.lw-widget[data-lw-onload]');
        if (widget != null) {
            var openDelay = 0;
            if (widget.dataset.lwOnload.length) {
                openDelay = widget.dataset.lwOnload;
            }
            setTimeout(function () {
                showWidget(widget);
            }, openDelay);
        }
    });

    document.addEventListener('click', function (e) {
        if ('lwOnclick' in e.target.dataset) {
            var widget = document.querySelector(e.target.dataset.lwOnclick);
            showWidget(widget);
        }
    });


    var onscrollTriggers = document.querySelectorAll('[data-lw-onscroll]');
    if (onscrollTriggers.length) {
        window.addEventListener('scroll', function (e) {
            onscrollTriggers.forEach(function (item) {
                if (!item.classList.contains('lw-inited')) {
                    var windowScrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    if (windowScrollTop + window.innerHeight >= item.offsetTop) {
                        var widget = document.querySelector(item.dataset.lwOnscroll);
                        showWidget(widget);
                        item.classList.add('lw-inited');
                    };
                };
            });
        });
    };

    var openFlag = true,
        pressedEscape = false;

    document.addEventListener('click', closeWidget);
    document.addEventListener('touchstart', closeWidget);
    document.addEventListener('keydown', function (e) {
        closeWidget(e);
    });

    function closeWidget(e) {
        if ('lwClose' in e.target.dataset) {
            e.preventDefault();
        }
        if ('lwClose' in e.target.dataset || pressedEscape) {
            if (openFlag) {
                var hideItem = function hideItem(item) {
                    item.classList.remove('lw-visible');
                    item.classList.add('lw-animate-reverse');
                    setTimeout(function () {
                        item.classList.remove('lw-animate-reverse');
                    }, 400);
                };

                var hideWidget = function hideWidget() {
                    if (powered != undefined) {
                        powered.classList.remove('lw-visible');
                        powered.classList.add('lw-animate-reverse');
                    }
                    setTimeout(function () {
                        widget.classList.remove('lw-animate');
                        setTimeout(function () {
                            widget.classList.remove('lw-open');
                            if (powered != undefined) {
                                powered.classList.remove('lw-animate-reverse');
                            }
                            openFlag = true;
                            items.forEach(function (item) {
                                if (items.length > 1) {
                                    item.animate([{ height: 0, marginTop: 0 }, { height: item.dataset.height, marginTop: item.dataset.marginTop }], {
                                        duration: 0,
                                        fill: 'forwards'
                                    });
                                }
                                setTimeout(function () {
                                    item.classList.remove('lw-animated');

                                    if (items.length > 1) {
                                        delete item.dataset.height;
                                        delete item.dataset.marginTop;
                                    }
                                }, 10);
                            });
                        }, 400);
                    }, 400);
                };

                var widget = undefined;
                if (pressedEscape) {
                    widget = document.querySelector('.lw-widget.lw-open');
                } else {
                    widget = getParents(e.target, '.lw-widget')[0];
                }

                var overlay = widget.querySelector('.lw-overlay'),
                    items = widget.querySelectorAll('.lw-item'),
                    powered = widget.querySelector('.lw-powered');

                if (e.target.classList.contains('lw-overlay') || pressedEscape) {
                    openFlag = false;
                    items.forEach(function (item) {
                        if (!item.classList.contains('lw-animated')) {
                            hideItem(item);
                        }
                        hideWidget();
                    });
                } else {
                    var visibleItems = widget.querySelectorAll('.lw-item.lw-visible'),
                        item = getParents(e.target, '.lw-item')[0];

                    item.classList.add('lw-animated');
                    hideItem(item);
                    if (visibleItems.length > 1) {
                        item.animate([{ height: item.dataset.height, marginTop: item.dataset.marginTop }, { height: 0, marginTop: 0 }], {
                            delay: 400,
                            duration: 300,
                            fill: 'forwards'
                        });
                    }

                    if (visibleItems.length == 1) {
                        hideWidget();
                    }
                }
            }
        }
    }

    function showWidget(widget) {
        var overlay = widget.querySelector('.lw-overlay'),
            items = widget.querySelectorAll('.lw-item'),
            powered = widget.querySelector('.lw-powered');

        widget.classList.add('lw-open');
        setTimeout(function () {
            widget.classList.add('lw-animate');
            if (powered != undefined) {
                powered.classList.add('lw-animate');
                setTimeout(function () {
                    powered.classList.remove('lw-animate');
                    powered.classList.add('lw-visible');
                }, 400);
            }
        }, 10);

        items.forEach(function (item) {
            item.classList.add('lw-animate');
            setTimeout(function () {
                item.classList.remove('lw-animate');
                item.classList.add('lw-visible');
                if (items.length > 1) {
                    if (!item.dataset.height) {
                        item.dataset.height = window.getComputedStyle(item).height;
                    }
                    if (!item.dataset.marginTop) {
                        item.dataset.marginTop = window.getComputedStyle(item).marginTop;
                    }
                }
            }, 400);
        });
    };
})();

//
function lwCssAnimationIsEnd(el, callback) {
    el.addEventListener('webkitAnimationEnd', callback, false);
    el.addEventListener('animationend', callback, false);
    el.addEventListener('oanimationend', callback, false);
}

function lwCssTransitionIsEnd(el, callback) {
    el.addEventListener('webkitTransitionEnd', callback, false);
    el.addEventListener('transitionend', callback, false);
    el.addEventListener('otransitionend', callback, false);
}

var getParents = function getParents(elem, selector) {

    var parents = [];
    var firstChar;
    if (selector) {
        firstChar = selector.charAt(0);
    }

    for (; elem && elem !== document; elem = elem.parentNode) {
        if (selector) {

            if (firstChar === '.') {
                if (elem.classList.contains(selector.substr(1))) {
                    parents.push(elem);
                }
            }

            if (firstChar === '#') {
                if (elem.id === selector.substr(1)) {
                    parents.push(elem);
                }
            }

            if (firstChar === '[') {
                if (elem.hasAttribute(selector.substr(1, selector.length - 1))) {
                    parents.push(elem);
                }
            }

            if (elem.tagName.toLowerCase() === selector) {
                parents.push(elem);
            }
        } else {
            parents.push(elem);
        }
    }

    if (parents.length === 0) {
        return null;
    } else {
        return parents;
    }
};
