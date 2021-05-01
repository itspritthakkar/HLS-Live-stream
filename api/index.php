<!DOCTYPE html>
<html>
<head>
    <script src='https://cdn.jwplayer.com/libraries/OwqIVJkD.js'></script>
</head>
<body>
    <div id="player">Loading the player...</div>
    <script>
        // Setup the player
        const player = jwplayer('player').setup({
            file: 'output/output.m3u8'
        });

        // Listen to an event
        player.on('pause', (event) => {
            alert('Why did my user pause their video instead of watching it?');
        });

        // Call the API
        const bumpIt = () => {
            const vol = player.getVolume();
            player.setVolume(vol + 10);
        }
        bumpIt();
    </script>
</body>
</html>