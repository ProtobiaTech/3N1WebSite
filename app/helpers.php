<?php

/**
 * translate
 *
 * @param string
 * @return string
 */
function i18n($text, $params = [])
{
    return str_replace('app.', '', trans($text, $params));
}
