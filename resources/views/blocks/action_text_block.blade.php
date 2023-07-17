@php
    $actionText = '<b>';
    $brFlag = false;
    $textParts = explode(' ',$action->head);
    foreach ($textParts as $k => $part) {
        if (
            ($k >= count($textParts)/2 && $part != '–' && !$brFlag) ||
            (strlen($actionText) > strlen($action->head)/2.2 && !$brFlag)
        ){
            $actionText .= '</b><br>';
            $brFlag = true;
        }
        $actionText .= ' '.$part;
    }
@endphp
{!! $actionText !!}
