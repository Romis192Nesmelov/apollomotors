<div class="{{ isset($addClass) ? $addClass : '' }} form-group has-feedback">
    <div class="input-group">
        <span class="input-group-addon"><i class="icon-alarm"></i></span>
        <input type="text" id="pickatime-{{ $name }}" name="{{ $name }}" class="form-control pickatime-limits" placeholder="{{ $placeholder }}" value="{{ !count($errors) ? $value : old($name) }}">
    </div>
</div>
<script>
    $("#pickatime-{{ $name }}").pickatime({
        format: 'H:i',
        interval: parseInt("{{ $interval }}"),
        min: [parseInt("{{ $min }}"),parseInt("{{ $start }}")],
        max: [parseInt("{{ $max }}"),0]
    });
</script>
