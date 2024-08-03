<?php
function validateDate(string $date): bool {
    $dateBlocks = explode("-", $date);

    if(count($dateBlocks) < 3){
        return false;
    }

    if(isset($dateBlocks[0]) && $dateBlocks[0] > 31) {
        return false;
    }

    if(isset($dateBlocks[1]) && $dateBlocks[0] > 12) {
        return false;
    }

    if(isset($dateBlocks[2]) && $dateBlocks[2] > date('Y')) {
        return false;
    }

    return true;
}

function validateName(string $string): bool
{
    $length = mb_strlen($string, 'UTF-8');
    $count = count(explode(" ", $string));

    if ($length !== 0 && $length <= 100 && $count === 2) {
        return true;
    } else {
        return false;
    }
}