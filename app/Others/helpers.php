<?php

/**
 * translate
 *
 * @param string $text
 * @param array $params
 *
 * @return string
 */
function i18n($text, $params = [])
{
    return str_replace('app.', '', trans($text, $params));
}

/**
 * Time difference calculating
 *
 * @param string Time
 *
 * @return string
 */
function timeAgo($time)
{
    $now = new DateTime();
    $time = new DateTime($time);
    $diff = $now->diff($time);
    if ($diff->y) {
        return trans('app.year ago', ['num' => $diff->y]);
    } elseif ($diff->m) {
        return trans('app.month ago', ['num' => $diff->m]);
    } elseif ($diff->d) {
        return trans('app.day ago', ['num' => $diff->d]);
    } elseif ($diff->h) {
        return trans('app.hour ago', ['num' => $diff->h]);
    } elseif ($diff->i) {
        return trans('app.minute ago', ['num' => $diff->i]);
    } else {
        return trans('app.nowTime');
    }
}

/**
 *
 */
function getYMD4datetime($time)
{
    $time = new DateTime($time);
    return $time->format('Y-m-d');
}
