<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\Zone;
use App\Models\RecordType;
use App\Models\RecordGroup;
use Illuminate\Http\Request;
use App\Util\SerialGenerate;
use App\Service\DNSManager;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Zone $zone)
    {
        $types = RecordType::all();
        $groups = RecordGroup::all();

        return view('record.create', compact('zone', 'types', 'groups'));
    }


    public function create_tese(Zone $zone)
    {
        $types = RecordType::all();
        $groups = RecordGroup::all();

        return view('record.create', compact('zone', 'types', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Zone $zone)
    {
        $this->validate($request,[
            'name' => 'required',
            'value' => 'required',
            'record_type_id' => 'required',
            'record_group_id' => 'required',
            'ttl' => 'nullable|int',
            'priority' => 'nullable|int',
            'active' => 'boolean',
        ]);
        $record = new Record;
        $record->fill($request->all());
        $zone->records()->save($record);

        $serial = SerialGenerate::generator($zone->serial);
        $zone->serial = $serial;
        $zone->save();

        DNSManager::makeFile($zone);

        return redirect()->route('zone.show', $zone)->with('sucesso', 'DNS cadastrado com sucesso!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone, Record $record)
    {
        return $record;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone, Record $record)
    {
        $types = RecordType::all();
        $groups = RecordGroup::all();

        return view('record.edit', compact('zone', 'record', 'types', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone, Record $record)
    {
        $this->validate($request,[
            'name' => 'required',
            'value' => 'required',
            'record_type_id' => 'required',
            'record_group_id' => 'required',
            'ttl' => 'nullable|int',
            'priority' => 'nullable|int',
            'active' => 'boolean',
        ]);

        $record->fill($request->all());
        $record->save();

        $serial = SerialGenerate::generator($zone->serial);
        $zone->serial = $serial;
        $zone->save();

        // // Generate zone file
        // Storage::disk('dns')->put(env('ARQUIVO_DNS_REVERSO', 'reverso.txt'), view('arquivos.reverso', compact('grupos', 's'))->render());

        // // Service restart
        // $process = new Process('sudo systemctl restart named-chroot.service');
        // $process->run();

        DNSManager::makeFile($zone);


        return redirect()->route('zone.show', $zone)->with('sucesso', 'DNS alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }

    public function active(Zone $zone, Record $record)
    {
        $record->active = !$record->active;
        $record->save();

        DNSManager::makeFile($zone);

        return redirect()->route('zone.show', $zone)->with('sucesso', 'DNS alterado com sucesso!');
    }
}
