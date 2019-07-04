<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 7/3/2017
 * Time: 12:25 AM
 */

function getPhotoName($State)
{
    switch ($State) {
        case 0:
            $PhotoName = 'white.png';
            break;
        case 1:
            $PhotoName = 'Hole.png';
            break;
        case 2:
            $PhotoName = 'Filled.png';
            break;
        default:
            $PhotoName = 'white.png';
            break;

    }

    return $PhotoName;
}


function getToothStatusPhoto($State, $tooth)
{

    if ($tooth <= 3 && $State == 0) {
        $PhotoName = 'Tooth2.png';
    } else {
        switch ($State) {
            case 0:
                $PhotoName = 'Tooth.png';
                break;
            case 2:
                $PhotoName = 'Extracted.png';
                break;
            case 1:
                $PhotoName = 'ToExtract.png';
                break;
            case 3:
                $PhotoName = 'Empty.png';
                break;
            default:
                $PhotoName = 'Tooth.png';
                break;

        }

    }

    return $PhotoName;
}

function age(DateTime $born, DateTime $reference = null, $Type = 0)
{
    $reference = $reference ?: new DateTime;

    if ($born > $reference)
        throw new \InvalidArgumentException('Provided birthday cannot be in future compared to the reference date.');

    $diff = $reference->diff($born);

    // Not very readable, but all it does is joining age
    // parts using either ',' or 'and' appropriately
    $age = ($d = $diff->d) ? ' and ' . $d . ' ' . str_plural('day', $d) : '';
    $age = ($m = $diff->m) ? ($age ? ', ' : ' and ') . $m . ' ' . str_plural('month', $m) . $age : $age;
    $age = ($y = $diff->y) ? $y . ' ' . str_plural('year', $y) . $age : $age;
    $AgeYear = ($y = $diff->y);

    // trim redundant ',' or 'and' parts
    if ($Type == 1) {
        return $AgeYear;
    } else {
        return ($s = trim(trim($age, ', '), ' and ')) ? $s . ' old' : 'newborn';
    }

}