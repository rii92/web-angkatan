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

Livewire.on("reloadComponents", (name, index = 0, event = null) => {
    if (!event) Livewire.components.getComponentsByName(name)?.[index]?.$wire.$refresh();
    else Livewire.components.getComponentsByName(name)?.[index]?.$wire.emitSelf(event);
});
