/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/calendar.js ***!
  \**********************************/
var setCalendar = function setCalendar() {
  var events = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : [];
  var MONTH_NAMES = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var DAYS = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  return {
    month: "",
    year: "",
    no_of_days: [],
    blankdays: [],
    events: [],
    active_day: "",
    displayDate: "",
    eventToDisplay: [],
    DAYS: DAYS,
    MONTH_NAMES: MONTH_NAMES,
    init: function init() {
      var today = new Date();
      this.active_day = today;
      this.month = today.getMonth();
      this.year = today.getFullYear();
      this.events = events;
      this.getNoOfDays();
      this.eventToDisplay = this.getEventDate(today.getDate());
    },
    getEventDate: function getEventDate(day) {
      var month = this.month + 1;
      if (month < 10) month = "0".concat(month);
      if (day < 10) day = "0".concat(day);
      var fullDate = new Date("".concat(this.year, "-").concat(month, "-").concat(day));
      return this.events.filter(function (event) {
        var afterStartDate = new Date(event.start_date).getTime() <= fullDate.getTime();
        var beforeEndDate = new Date(event.end_date).getTime() >= fullDate.getTime();
        return afterStartDate && beforeEndDate;
      });
    },
    formatDate: function formatDate() {
      var active_day = this.active_day;
      return dateFormat(active_day, "dddd, d mmmm yyyy");
    },
    getColorDate: function getColorDate(day) {
      var events = this.getEventDate(day);
      if (!events.length) return null;
      return events[0]["color"];
    },
    changeActiveDate: function changeActiveDate(day) {
      this.active_day = new Date(this.year, this.month, day);
      this.eventToDisplay = this.getEventDate(day);
    },
    isActive: function isActive(date) {
      return this.active_day.toDateString() === new Date(this.year, this.month, date).toDateString();
    },
    changeMonth: function changeMonth() {
      // if desember change to january next year
      if (this.month == 12) {
        this.month = 0;
        this.year++;
      } // if january change to desember last year


      if (this.month == -1) {
        this.month = 11;
        this.year--;
      }

      this.getNoOfDays();
    },
    // find where to start calendar day of week
    getNoOfDays: function getNoOfDays() {
      this.blankdays = [];
      this.no_of_days = [];
      var dayOfWeek = new Date(this.year, this.month).getDay();
      var daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

      for (var i = 1; i <= dayOfWeek; i++) {
        this.blankdays.push(i);
      }

      for (var _i = 1; _i <= daysInMonth; _i++) {
        this.no_of_days.push({
          day: _i,
          color: this.getColorDate(_i)
        });
      }
    }
  };
};

window.setCalendar = setCalendar;
/******/ })()
;