<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (string) $user->alias === (string) $id;
});

Broadcast::channel('user.{toUserId}', function ($user, $toUserId) {
    return $user->alias == $toUserId;
});
