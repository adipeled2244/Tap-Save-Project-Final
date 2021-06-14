$(document).ready(
    $(function() {

        $('.containerTextTitle').typeChar({
            html: $("<h1>Welcome, Let's save food together! </h1>"),
            completed: $.noop
        });

    }));