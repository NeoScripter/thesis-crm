<?php

declare(strict_types=1);

function is_email_valid(string $input_field) {
    if (filter_var($input_field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_input_empty(string $input_field) {
    if (empty($input_field)) {
        return true;
    } else {
        return false;
    }
}