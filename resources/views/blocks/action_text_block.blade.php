@php
    $actionText = '<b>';
    $brFlag = false;
    $textParts = explode(' ',$action->text);
    foreach ($textParts as $k => $part) {
        if (
            ($k >= count($textParts)/2 && $part != '–' && !$brFlag) ||
            (strlen($actionText) > strlen($action->text)/2.2 && !$brFlag)
        ){
            $actionText .= '</b><br>';
            $brFlag = true;
        }
        $actionText .= ' '.$part;
    }
@endphp
{!! $actionText !!}
