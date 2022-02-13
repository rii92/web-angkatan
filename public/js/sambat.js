/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/sambat.js ***!
  \********************************/
var descriptionSambat = function descriptionSambat(description) {
  var limitText = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
  return {
    description: null,
    showFull: false,
    needReadMore: null,
    displayText: '',
    limitText: limitText,
    viewer: null,
    init: function init() {
      this.description = description;
      this.needReadMore = description.length > this.limitText;
      this.needReadMore ? this.showLessText() : this.showFullText();
    },
    showFullText: function showFullText() {
      this.displayText = this.description;
      this.showFull = true;
    },
    showLessText: function showLessText() {
      this.displayText = this.description.slice(0, this.limitText) + '...';
      this.showFull = false;
    },
    initViewer: function initViewer(element) {
      if (!this.viewer) {
        this.viewer = new Viewer(element, {
          inline: false,
          zoomRatio: 0.2
        });
      }
    }
  };
};

window.descriptionSambat = descriptionSambat;
/******/ })()
;