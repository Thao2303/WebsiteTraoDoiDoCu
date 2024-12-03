<!DOCTYPE html>
<html lang="en">
<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        Pusher.logToConsole = true;
        var pusher = new Pusher('f9bb310e30380cc49d62', {
        cluster: 'mt1'
        });
        var channel = pusher.subscribe('my-channel');
        channel.bind('form-submitted', function(data) {
        if (data && data.user && data.user.name && data.user.email) {
            toastr.success('New Post Created', 'Author: ' + data.user.name + '<br>Title: ' + data.user.email, {
            timeOut: 0,  
            extendedTimeOut: 0,  
            });
        } else {
            console.error('Invalid data structure received:', data);
        }
        });
    </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>