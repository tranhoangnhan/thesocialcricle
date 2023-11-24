import Echo from "laravel-echo";
window.laravel_echo_port = 6001;
window.Echo = new Echo({
    broadcaster: "socket.io",
    host: window.location.hostname + ":" + window.laravel_echo_port,
});
window.Echo.channel("chat").listen("MessageEvent", (data) => {
    Livewire.dispatch("chat");
});
