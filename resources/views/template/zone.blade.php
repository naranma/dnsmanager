$TTL    {{ $zone->ttl }}
$ORIGIN {{ $zone->domain }}.
@       IN      SOA     {{ $zone->name_server }} {{ $zone->email }} (
                                        {!!$zone->serial!!}     ; Serial
                                        {{ $zone->refresh }}   ; Refresh every 3 hours
                                        {{ $zone->retry }}    ; Retry every hour
                                        {{ $zone->expire }}  ; Expire after a week
                                        {{ $zone->minimum }} ) ; Minimum ttl of 1 day

; NS Records
@foreach($ns_records as $record)
{{ $record->active ? "" : ";"  }}{!! str_pad($record->name, 23) !!}{{ str_pad($record->ttl,5) }}{{ str_pad('IN', 8) }}{{ str_pad($record->type->name, 8) }}{{ str_pad($record->priority, 8) }}{!! $record->value !!}
@endforeach

; MX Records
@foreach($mx_records as $record)
{{ $record->active ? "" : ";"  }}{!! str_pad($record->name, 23) !!}{{ str_pad($record->ttl,5) }}{{ str_pad('IN', 8) }}{{ str_pad($record->type->name, 8) }}{{ str_pad($record->priority, 8) }}{!! $record->value !!}
@endforeach

; TXT Records
@foreach($txt_records as $record)
{{ $record->active ? "" : ";"  }}{!! str_pad($record->name, 23) !!}{{ str_pad($record->ttl,5) }}{{ str_pad('IN', 8) }}{{ str_pad($record->type->name, 8) }}{{ str_pad($record->priority, 8) }}{!! $record->value !!}
@endforeach

; Loopback
localhost               IN      A       127.0.0.1

@foreach($groups as $group)
@if(count($group->records))
; {{ $group->name }}
@foreach($group->records as $record)
{{ $record->active ? "" : ";"  }}{!! str_pad($record->name, 23) !!}{{ str_pad($record->ttl,5) }}{{ str_pad('IN', 8) }}{{ str_pad($record->type->name, 8) }}{{ str_pad($record->priority, 8) }}{!! $record->value !!}
@endforeach

@endif
@endforeach
