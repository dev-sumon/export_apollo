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


function total_lead_amount($lead, $additional_links = 0)
{
    switch ($lead) {
        case '10k':
            return 30 + ($additional_links * 5);
            break;
        case '20k':
            return 60 + ($additional_links * 5);
            break;
        case '50k':
            return 150 + ($additional_links * 5);
            break;
        case '100k':
            return 280 + ($additional_links * 5);
            break;
        case '1m':
            return 2500 + ($additional_links * 5);
            break;
        default:
            return 0;
            break;
    }
}

function additional_lead_amount($additional_links)
{
    return $additional_links * 5;
}
