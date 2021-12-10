const notification = require("notyf");

const notyf = new notification.Notyf({ duration: 2000 });

// notification

Livewire.on("error", (message) => {
    notyf.error(message);
});

Livewire.on("success", (message) => {
    notyf.success(message);
});

// Reload table

Livewire.on("reloadComponents", (name) => {
    Livewire.components.getComponentsByName(name)[0].$wire.$refresh();
});
