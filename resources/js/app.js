require("./bootstrap");

import Alpine from "alpinejs";
import dateFormat from 'dateformat'

window.Alpine = Alpine;
window.dateFormat = dateFormat

Alpine.data("initData", () => ({
    isSideMenuOpen: false,
    toggleSideMenu() {
        this.isSideMenuOpen = !this.isSideMenuOpen;
    },
    closeSideMenu() {
        this.isSideMenuOpen = false;
    },
}));

Alpine.start();
