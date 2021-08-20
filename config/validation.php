<?php

function is_date_valid(string $date): bool
{
    $date_valid = true;

    if (!empty($date)) {
        if (preg_match("/\d{4}-\d{2}-\d{2}/", $date) && DateTime::createFromFormat('Y-m-d', $date)) {
            [$year, $month, $day] = explode('-', $date);
            $date_valid  = checkdate($month, $day, $year);
        } else {
            $date_valid = false;
        }
    }

    return $date_valid;
}

function is_birthday_valid($date): bool
{
    if (is_date_valid($date)) {
        [$year] = explode('-', $date);
        return $year <= date('Y');
    }

    return false;
}
