<?php

function getRecordLabelAndStatus($record) {
    switch ($record->status) {
        case 0:
            $label = 'danger';
            $status = trans('records.record_status_new');
            break;
        case 1:
            $label = 'warning';
            $status = trans('records.record_status_arrived');
            break;
        case 2:
            $label = 'primary';
            $status = trans('records.record_status_in_work');
            break;
        case 3:
            $label = 'success';
            $status = trans('records.record_status_done');
            break;
        case 4:
            $label = 'default';
            $status = trans('records.record_status_leave');
            break;
        case 5:
            $label = 'info';
            $status = trans('records.record_status_cancel');
            break;
        default:
            $label = 'danger';
            $status = trans('records.record_status_new');
            break;
    }
    return [$label, $status];
}
