$(document).ready(function ()
{
    if (/iPhone/.test(navigator.userAgent) && !window.MSStream)
    {
        $(document).on("focus", "input, textarea, select", function()
        {
            $('meta[name=viewport]').remove();
            $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">');
        });

        $(document).on("blur", "input, textarea, select", function()
        {
            $('meta[name=viewport]').remove();
            $('head').append('<meta name="viewport" content="width=device-width, initial-scale=1">');
        });
    }
});