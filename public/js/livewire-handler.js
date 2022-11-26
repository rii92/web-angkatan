/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/notyf/notyf.es.js":
/*!****************************************!*\
  !*** ./node_modules/notyf/notyf.es.js ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "DEFAULT_OPTIONS": () => (/* binding */ DEFAULT_OPTIONS),
/* harmony export */   "Notyf": () => (/* binding */ Notyf),
/* harmony export */   "NotyfArray": () => (/* binding */ NotyfArray),
/* harmony export */   "NotyfArrayEvent": () => (/* binding */ NotyfArrayEvent),
/* harmony export */   "NotyfEvent": () => (/* binding */ NotyfEvent),
/* harmony export */   "NotyfNotification": () => (/* binding */ NotyfNotification),
/* harmony export */   "NotyfView": () => (/* binding */ NotyfView)
/* harmony export */ });
/*! *****************************************************************************
Copyright (c) Microsoft Corporation.

Permission to use, copy, modify, and/or distribute this software for any
purpose with or without fee is hereby granted.

THE SOFTWARE IS PROVIDED "AS IS" AND THE AUTHOR DISCLAIMS ALL WARRANTIES WITH
REGARD TO THIS SOFTWARE INCLUDING ALL IMPLIED WARRANTIES OF MERCHANTABILITY
AND FITNESS. IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY SPECIAL, DIRECT,
INDIRECT, OR CONSEQUENTIAL DAMAGES OR ANY DAMAGES WHATSOEVER RESULTING FROM
LOSS OF USE, DATA OR PROFITS, WHETHER IN AN ACTION OF CONTRACT, NEGLIGENCE OR
OTHER TORTIOUS ACTION, ARISING OUT OF OR IN CONNECTION WITH THE USE OR
PERFORMANCE OF THIS SOFTWARE.
***************************************************************************** */

var __assign = function() {
    __assign = Object.assign || function __assign(t) {
        for (var s, i = 1, n = arguments.length; i < n; i++) {
            s = arguments[i];
            for (var p in s) if (Object.prototype.hasOwnProperty.call(s, p)) t[p] = s[p];
        }
        return t;
    };
    return __assign.apply(this, arguments);
};

var NotyfNotification = /** @class */ (function () {
    function NotyfNotification(options) {
        this.options = options;
        this.listeners = {};
    }
    NotyfNotification.prototype.on = function (eventType, cb) {
        var callbacks = this.listeners[eventType] || [];
        this.listeners[eventType] = callbacks.concat([cb]);
    };
    NotyfNotification.prototype.triggerEvent = function (eventType, event) {
        var _this = this;
        var callbacks = this.listeners[eventType] || [];
        callbacks.forEach(function (cb) { return cb({ target: _this, event: event }); });
    };
    return NotyfNotification;
}());
var NotyfArrayEvent;
(function (NotyfArrayEvent) {
    NotyfArrayEvent[NotyfArrayEvent["Add"] = 0] = "Add";
    NotyfArrayEvent[NotyfArrayEvent["Remove"] = 1] = "Remove";
})(NotyfArrayEvent || (NotyfArrayEvent = {}));
var NotyfArray = /** @class */ (function () {
    function NotyfArray() {
        this.notifications = [];
    }
    NotyfArray.prototype.push = function (elem) {
        this.notifications.push(elem);
        this.updateFn(elem, NotyfArrayEvent.Add, this.notifications);
    };
    NotyfArray.prototype.splice = function (index, num) {
        var elem = this.notifications.splice(index, num)[0];
        this.updateFn(elem, NotyfArrayEvent.Remove, this.notifications);
        return elem;
    };
    NotyfArray.prototype.indexOf = function (elem) {
        return this.notifications.indexOf(elem);
    };
    NotyfArray.prototype.onUpdate = function (fn) {
        this.updateFn = fn;
    };
    return NotyfArray;
}());

var NotyfEvent;
(function (NotyfEvent) {
    NotyfEvent["Dismiss"] = "dismiss";
    NotyfEvent["Click"] = "click";
})(NotyfEvent || (NotyfEvent = {}));
var DEFAULT_OPTIONS = {
    types: [
        {
            type: 'success',
            className: 'notyf__toast--success',
            backgroundColor: '#3dc763',
            icon: {
                className: 'notyf__icon--success',
                tagName: 'i',
            },
        },
        {
            type: 'error',
            className: 'notyf__toast--error',
            backgroundColor: '#ed3d3d',
            icon: {
                className: 'notyf__icon--error',
                tagName: 'i',
            },
        },
    ],
    duration: 2000,
    ripple: true,
    position: {
        x: 'right',
        y: 'bottom',
    },
    dismissible: false,
};

var NotyfView = /** @class */ (function () {
    function NotyfView() {
        this.notifications = [];
        this.events = {};
        this.X_POSITION_FLEX_MAP = {
            left: 'flex-start',
            center: 'center',
            right: 'flex-end',
        };
        this.Y_POSITION_FLEX_MAP = {
            top: 'flex-start',
            center: 'center',
            bottom: 'flex-end',
        };
        // Creates the main notifications container
        var docFrag = document.createDocumentFragment();
        var notyfContainer = this._createHTMLElement({ tagName: 'div', className: 'notyf' });
        docFrag.appendChild(notyfContainer);
        document.body.appendChild(docFrag);
        this.container = notyfContainer;
        // Identifies the main animation end event
        this.animationEndEventName = this._getAnimationEndEventName();
        this._createA11yContainer();
    }
    NotyfView.prototype.on = function (event, cb) {
        var _a;
        this.events = __assign(__assign({}, this.events), (_a = {}, _a[event] = cb, _a));
    };
    NotyfView.prototype.update = function (notification, type) {
        if (type === NotyfArrayEvent.Add) {
            this.addNotification(notification);
        }
        else if (type === NotyfArrayEvent.Remove) {
            this.removeNotification(notification);
        }
    };
    NotyfView.prototype.removeNotification = function (notification) {
        var _this = this;
        var renderedNotification = this._popRenderedNotification(notification);
        var node;
        if (!renderedNotification) {
            return;
        }
        node = renderedNotification.node;
        node.classList.add('notyf__toast--disappear');
        var handleEvent;
        node.addEventListener(this.animationEndEventName, (handleEvent = function (event) {
            if (event.target === node) {
                node.removeEventListener(_this.animationEndEventName, handleEvent);
                _this.container.removeChild(node);
            }
        }));
    };
    NotyfView.prototype.addNotification = function (notification) {
        var node = this._renderNotification(notification);
        this.notifications.push({ notification: notification, node: node });
        // For a11y purposes, we still want to announce that there's a notification in the screen
        // even if it comes with no message.
        this._announce(notification.options.message || 'Notification');
    };
    NotyfView.prototype._renderNotification = function (notification) {
        var _a;
        var card = this._buildNotificationCard(notification);
        var className = notification.options.className;
        if (className) {
            (_a = card.classList).add.apply(_a, className.split(' '));
        }
        this.container.appendChild(card);
        return card;
    };
    NotyfView.prototype._popRenderedNotification = function (notification) {
        var idx = -1;
        for (var i = 0; i < this.notifications.length && idx < 0; i++) {
            if (this.notifications[i].notification === notification) {
                idx = i;
            }
        }
        if (idx !== -1) {
            return this.notifications.splice(idx, 1)[0];
        }
        return;
    };
    NotyfView.prototype.getXPosition = function (options) {
        var _a;
        return ((_a = options === null || options === void 0 ? void 0 : options.position) === null || _a === void 0 ? void 0 : _a.x) || 'right';
    };
    NotyfView.prototype.getYPosition = function (options) {
        var _a;
        return ((_a = options === null || options === void 0 ? void 0 : options.position) === null || _a === void 0 ? void 0 : _a.y) || 'bottom';
    };
    NotyfView.prototype.adjustContainerAlignment = function (options) {
        var align = this.X_POSITION_FLEX_MAP[this.getXPosition(options)];
        var justify = this.Y_POSITION_FLEX_MAP[this.getYPosition(options)];
        var style = this.container.style;
        style.setProperty('justify-content', justify);
        style.setProperty('align-items', align);
    };
    NotyfView.prototype._buildNotificationCard = function (notification) {
        var _this = this;
        var options = notification.options;
        var iconOpts = options.icon;
        // Adjust container according to position (e.g. top-left, bottom-center, etc)
        this.adjustContainerAlignment(options);
        // Create elements
        var notificationElem = this._createHTMLElement({ tagName: 'div', className: 'notyf__toast' });
        var ripple = this._createHTMLElement({ tagName: 'div', className: 'notyf__ripple' });
        var wrapper = this._createHTMLElement({ tagName: 'div', className: 'notyf__wrapper' });
        var message = this._createHTMLElement({ tagName: 'div', className: 'notyf__message' });
        message.innerHTML = options.message || '';
        var mainColor = options.background || options.backgroundColor;
        // Build the icon and append it to the card
        if (iconOpts) {
            var iconContainer = this._createHTMLElement({ tagName: 'div', className: 'notyf__icon' });
            if (typeof iconOpts === 'string' || iconOpts instanceof String)
                iconContainer.innerHTML = new String(iconOpts).valueOf();
            if (typeof iconOpts === 'object') {
                var _a = iconOpts.tagName, tagName = _a === void 0 ? 'i' : _a, className_1 = iconOpts.className, text = iconOpts.text, _b = iconOpts.color, color = _b === void 0 ? mainColor : _b;
                var iconElement = this._createHTMLElement({ tagName: tagName, className: className_1, text: text });
                if (color)
                    iconElement.style.color = color;
                iconContainer.appendChild(iconElement);
            }
            wrapper.appendChild(iconContainer);
        }
        wrapper.appendChild(message);
        notificationElem.appendChild(wrapper);
        // Add ripple if applicable, else just paint the full toast
        if (mainColor) {
            if (options.ripple) {
                ripple.style.background = mainColor;
                notificationElem.appendChild(ripple);
            }
            else {
                notificationElem.style.background = mainColor;
            }
        }
        // Add dismiss button
        if (options.dismissible) {
            var dismissWrapper = this._createHTMLElement({ tagName: 'div', className: 'notyf__dismiss' });
            var dismissButton = this._createHTMLElement({
                tagName: 'button',
                className: 'notyf__dismiss-btn',
            });
            dismissWrapper.appendChild(dismissButton);
            wrapper.appendChild(dismissWrapper);
            notificationElem.classList.add("notyf__toast--dismissible");
            dismissButton.addEventListener('click', function (event) {
                var _a, _b;
                (_b = (_a = _this.events)[NotyfEvent.Dismiss]) === null || _b === void 0 ? void 0 : _b.call(_a, { target: notification, event: event });
                event.stopPropagation();
            });
        }
        notificationElem.addEventListener('click', function (event) { var _a, _b; return (_b = (_a = _this.events)[NotyfEvent.Click]) === null || _b === void 0 ? void 0 : _b.call(_a, { target: notification, event: event }); });
        // Adjust margins depending on whether its an upper or lower notification
        var className = this.getYPosition(options) === 'top' ? 'upper' : 'lower';
        notificationElem.classList.add("notyf__toast--" + className);
        return notificationElem;
    };
    NotyfView.prototype._createHTMLElement = function (_a) {
        var tagName = _a.tagName, className = _a.className, text = _a.text;
        var elem = document.createElement(tagName);
        if (className) {
            elem.className = className;
        }
        elem.textContent = text || null;
        return elem;
    };
    /**
     * Creates an invisible container which will announce the notyfs to
     * screen readers
     */
    NotyfView.prototype._createA11yContainer = function () {
        var a11yContainer = this._createHTMLElement({ tagName: 'div', className: 'notyf-announcer' });
        a11yContainer.setAttribute('aria-atomic', 'true');
        a11yContainer.setAttribute('aria-live', 'polite');
        // Set the a11y container to be visible hidden. Can't use display: none as
        // screen readers won't read it.
        a11yContainer.style.border = '0';
        a11yContainer.style.clip = 'rect(0 0 0 0)';
        a11yContainer.style.height = '1px';
        a11yContainer.style.margin = '-1px';
        a11yContainer.style.overflow = 'hidden';
        a11yContainer.style.padding = '0';
        a11yContainer.style.position = 'absolute';
        a11yContainer.style.width = '1px';
        a11yContainer.style.outline = '0';
        document.body.appendChild(a11yContainer);
        this.a11yContainer = a11yContainer;
    };
    /**
     * Announces a message to screenreaders.
     */
    NotyfView.prototype._announce = function (message) {
        var _this = this;
        this.a11yContainer.textContent = '';
        // This 100ms timeout is necessary for some browser + screen-reader combinations:
        // - Both JAWS and NVDA over IE11 will not announce anything without a non-zero timeout.
        // - With Chrome and IE11 with NVDA or JAWS, a repeated (identical) message won't be read a
        //   second time without clearing and then using a non-zero delay.
        // (using JAWS 17 at time of this writing).
        // https://github.com/angular/material2/blob/master/src/cdk/a11y/live-announcer/live-announcer.ts
        setTimeout(function () {
            _this.a11yContainer.textContent = message;
        }, 100);
    };
    /**
     * Determine which animationend event is supported
     */
    NotyfView.prototype._getAnimationEndEventName = function () {
        var el = document.createElement('_fake');
        var transitions = {
            MozTransition: 'animationend',
            OTransition: 'oAnimationEnd',
            WebkitTransition: 'webkitAnimationEnd',
            transition: 'animationend',
        };
        var t;
        for (t in transitions) {
            if (el.style[t] !== undefined) {
                return transitions[t];
            }
        }
        // No supported animation end event. Using "animationend" as a fallback
        return 'animationend';
    };
    return NotyfView;
}());

/**
 * Main controller class. Defines the main Notyf API.
 */
var Notyf = /** @class */ (function () {
    function Notyf(opts) {
        var _this = this;
        this.dismiss = this._removeNotification;
        this.notifications = new NotyfArray();
        this.view = new NotyfView();
        var types = this.registerTypes(opts);
        this.options = __assign(__assign({}, DEFAULT_OPTIONS), opts);
        this.options.types = types;
        this.notifications.onUpdate(function (elem, type) { return _this.view.update(elem, type); });
        this.view.on(NotyfEvent.Dismiss, function (_a) {
            var target = _a.target, event = _a.event;
            _this._removeNotification(target);
            // tslint:disable-next-line: no-string-literal
            target['triggerEvent'](NotyfEvent.Dismiss, event);
        });
        // tslint:disable-next-line: no-string-literal
        this.view.on(NotyfEvent.Click, function (_a) {
            var target = _a.target, event = _a.event;
            return target['triggerEvent'](NotyfEvent.Click, event);
        });
    }
    Notyf.prototype.error = function (payload) {
        var options = this.normalizeOptions('error', payload);
        return this.open(options);
    };
    Notyf.prototype.success = function (payload) {
        var options = this.normalizeOptions('success', payload);
        return this.open(options);
    };
    Notyf.prototype.open = function (options) {
        var defaultOpts = this.options.types.find(function (_a) {
            var type = _a.type;
            return type === options.type;
        }) || {};
        var config = __assign(__assign({}, defaultOpts), options);
        this.assignProps(['ripple', 'position', 'dismissible'], config);
        var notification = new NotyfNotification(config);
        this._pushNotification(notification);
        return notification;
    };
    Notyf.prototype.dismissAll = function () {
        while (this.notifications.splice(0, 1))
            ;
    };
    /**
     * Assigns properties to a config object based on two rules:
     * 1. If the config object already sets that prop, leave it as so
     * 2. Otherwise, use the default prop from the global options
     *
     * It's intended to build the final config object to open a notification. e.g. if
     * 'dismissible' is not set, then use the value from the global config.
     *
     * @param props - properties to be assigned to the config object
     * @param config - object whose properties need to be set
     */
    Notyf.prototype.assignProps = function (props, config) {
        var _this = this;
        props.forEach(function (prop) {
            // intentional double equality to check for both null and undefined
            config[prop] = config[prop] == null ? _this.options[prop] : config[prop];
        });
    };
    Notyf.prototype._pushNotification = function (notification) {
        var _this = this;
        this.notifications.push(notification);
        var duration = notification.options.duration !== undefined ? notification.options.duration : this.options.duration;
        if (duration) {
            setTimeout(function () { return _this._removeNotification(notification); }, duration);
        }
    };
    Notyf.prototype._removeNotification = function (notification) {
        var index = this.notifications.indexOf(notification);
        if (index !== -1) {
            this.notifications.splice(index, 1);
        }
    };
    Notyf.prototype.normalizeOptions = function (type, payload) {
        var options = { type: type };
        if (typeof payload === 'string') {
            options.message = payload;
        }
        else if (typeof payload === 'object') {
            options = __assign(__assign({}, options), payload);
        }
        return options;
    };
    Notyf.prototype.registerTypes = function (opts) {
        var incomingTypes = ((opts && opts.types) || []).slice();
        var finalDefaultTypes = DEFAULT_OPTIONS.types.map(function (defaultType) {
            // find if there's a default type within the user input's types, if so, it means the user
            // wants to change some of the default settings
            var userTypeIdx = -1;
            incomingTypes.forEach(function (t, idx) {
                if (t.type === defaultType.type)
                    userTypeIdx = idx;
            });
            var userType = userTypeIdx !== -1 ? incomingTypes.splice(userTypeIdx, 1)[0] : {};
            return __assign(__assign({}, defaultType), userType);
        });
        return finalDefaultTypes.concat(incomingTypes);
    };
    return Notyf;
}());




/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!******************************************!*\
  !*** ./resources/js/livewire-handler.js ***!
  \******************************************/
var notification = __webpack_require__(/*! notyf */ "./node_modules/notyf/notyf.es.js");

var notyf = new notification.Notyf({
  duration: 2000
}); // notification

Livewire.on("error", function (message) {
  notyf.error(message);
});
Livewire.on("success", function (message) {
  notyf.success(message);
}); // Reload table

Livewire.on("reloadComponents", function (name) {
  var _Livewire$components$, _Livewire$components$2, _Livewire$components$3, _Livewire$components$4;

  var index = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
  var event = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  if (!event) (_Livewire$components$ = Livewire.components.getComponentsByName(name)) === null || _Livewire$components$ === void 0 ? void 0 : (_Livewire$components$2 = _Livewire$components$[index]) === null || _Livewire$components$2 === void 0 ? void 0 : _Livewire$components$2.$wire.$refresh();else (_Livewire$components$3 = Livewire.components.getComponentsByName(name)) === null || _Livewire$components$3 === void 0 ? void 0 : (_Livewire$components$4 = _Livewire$components$3[index]) === null || _Livewire$components$4 === void 0 ? void 0 : _Livewire$components$4.$wire.emitSelf(event);
});
})();

/******/ })()
;