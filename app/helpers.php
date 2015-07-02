<?php

/**
 * translate
 *
 * @param string
 * @return string
 */
function i18n($text)
{
    return str_replace('app.', '', trans($text));
}
