<a href="tel:+7{{ substr(str_replace(['-','(',')','+',' '],'',$phone) ,1) }}">{!! isset($icon) && $icon ? '<i class="'.$icon.'"></i>' : $phone !!}</a>
