const setCalendar = (events = []) => {
    const MONTH_NAMES = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    const DAYS = [
        "Sunday",
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
    ];
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

        init() {
            const today = new Date();
            this.active_day = today;
            this.month = today.getMonth();
            this.year = today.getFullYear();
            this.events = events;
            this.getNoOfDays();
            this.eventToDisplay = this.getEventDate(today.getDate());
        },

        getEventDate(day) {
            let month = this.month + 1;
            if (month < 10) month = `0${month}`;
            if (day < 10) day = `0${day}`;

            const fullDate = new Date(`${this.year}-${month}-${day}`);
            return this.events.filter((event) => {
                const afterStartDate =
                    new Date(event.start_date).getTime() <= fullDate.getTime();
                const beforeEndDate =
                    new Date(event.end_date).getTime() >= fullDate.getTime();
                return afterStartDate && beforeEndDate;
            });
        },

        formatDate() {
            const active_day = this.active_day;
            return dateFormat(active_day, "dddd, d mmmm yyyy");
        },

        getColorDate(day) {
            const events = this.getEventDate(day);
            if (!events.length) return null;
            return events[0]["color"];
        },

        changeActiveDate(day) {
            this.active_day = new Date(this.year, this.month, day);
            this.eventToDisplay = this.getEventDate(day);
        },

        isActive(date) {
            return (
                this.active_day.toDateString() ===
                new Date(this.year, this.month, date).toDateString()
            );
        },

        changeMonth() {
            // if desember change to january next year
            if (this.month == 12) {
                this.month = 0;
                this.year++;
            }

            // if january change to desember last year
            if (this.month == -1) {
                this.month = 11;
                this.year--;
            }
            this.getNoOfDays();
        },

        // find where to start calendar day of week
        getNoOfDays() {
            this.blankdays = [];
            this.no_of_days = [];

            const dayOfWeek = new Date(this.year, this.month).getDay();
            const daysInMonth = new Date(
                this.year,
                this.month + 1,
                0
            ).getDate();

            for (let i = 1; i <= dayOfWeek; i++) this.blankdays.push(i);
            for (let i = 1; i <= daysInMonth; i++)
                this.no_of_days.push({
                    day: i,
                    color: this.getColorDate(i),
                });
        },
    };
};

window.setCalendar = setCalendar
