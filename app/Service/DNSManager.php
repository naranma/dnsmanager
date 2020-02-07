<?php

namespace App\Service;

use App\Models\Zone;
use App\Models\RecordGroup;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

class DNSManager
{
    public static function makeFile(Zone $zone)
    {
        // $groups = RecordGroup::with(['records' => function ($query) use($zone) {
        //     $query->where('zone_id', '=', $zone->id)->whereNotIn('record_type_id', [3, 4, 7]);
        // }])->get();

        $groups = RecordGroup::with(['records' => function ($query) use($zone) {
            $query->where('zone_id', '=', $zone->id)->whereDoesntHave('type', function ($query) {
                $query->whereIn('name', ['NS', 'MX', 'TXT']);
            });
        }])->get();

        $ns_records = $zone->records()->whereHas('type', function ($query) {
            $query->where('name', 'NS');
        })->get();

        $mx_records = $zone->records()->whereHas('type', function ($query) {
            $query->where('name', 'MX');
        })->get();

        $txt_records = $zone->records()->whereHas('type', function ($query) {
            $query->where('name', 'TXT');
        })->get();

        $content = view('template.zone', compact('zone', 'groups', 'ns_records', 'mx_records', 'txt_records'))->render();

        //dd( $content );

        Storage::disk('dns')->put($zone->file, $content);

        self::restartService(env('DNS_RESTART_SERVICE_COMMAND'));
    }

    public static function restartService(String $command)
    {
        $process = new Process($command);
        $process->setTimeout(10);
        $process->run();

        $message = "Command: ".$command." output: ".$process->getErrorOutput();

        \Log::error($message);
    }
}

