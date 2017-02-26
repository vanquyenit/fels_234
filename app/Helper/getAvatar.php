<?php

function getAvatar($input)
{
    if ($input == 'user.png') {
        $image = 'images/user.png';
    } else {
        $image = Storage::url($input);
    }
    return $image;
}
