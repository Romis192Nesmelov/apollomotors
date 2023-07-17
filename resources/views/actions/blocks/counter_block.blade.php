<div class="counter-block">
    <div class="text-mark">{{ trans('timer.count-down') }}</div>
    <div class="counter" id="timer">
        <span class="time days">
            <?php $days = floor(($time-time())/(60*60*24)); ?>
            <div class="digits">{{ strlen($days) == 1 ? '0'.$days : $days }}</div>
            <div class="text-mark">{{ trans('timer.days') }}</div>
        </span>
        <span class="time hours">
            <?php $hours = floor((($time-time())/(60*60))%24) - 3; ?>
            <div class="digits">{{ strlen($hours) == 1 ? '0'.$hours : $hours }}</div>
            <div class="text-mark">{{ trans('timer.hours') }}</div>
        </span>
        <span class="time minutes">
            <?php $minutes = floor(($time-time())/60%60); ?>
            <div class="digits">{{ strlen($minutes) == 1 ? '0'.$minutes : $minutes }}</div>
            <div class="text-mark">{{ trans('timer.minutes') }}</div>
        </span>
        <span class="time seconds">
            <?php $seconds = floor(($time-time())%60); ?>
            <div class="digits">{{ strlen($seconds) == 1 ? '0'.$seconds : $seconds }}</div>
            <div class="text-mark">{{ trans('timer.seconds') }}</div>
        </span>
    </div>
</div>

<script>startTimer("{{ $time }}");</script>
