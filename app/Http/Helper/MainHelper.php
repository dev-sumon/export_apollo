<?php
function storage_url($urlOrArray)
{
    if (is_array($urlOrArray) || is_object($urlOrArray)) {
        $result = '';
        $count = 0;
        $itemCount = count($urlOrArray);
        foreach ($urlOrArray as $index => $url) {

            $result .= !empty($url) ? asset('storage/' . $url) : asset('default_img\other.png');

            if ($count === $itemCount - 1) {
                $result .= '';
            } else {
                $result .= ', ';
            }
            $count++;
        }
        return $result;
    } else {
        return !empty($urlOrArray) ? asset('storage/' . $urlOrArray) : asset('default_img\other.png');
    }
}

function timeFormat($time)
{
    return date(('d M, Y H:i A'), strtotime($time));
}
function admin()
{
    return auth()->guard('web')->user();
}
function c_user_name($user)
{
    return $user->name ?? 'System';
}
function u_user_name($user)
{
    return $user->name ?? 'Null';
}
