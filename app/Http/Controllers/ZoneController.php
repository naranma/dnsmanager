<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\RecordGroup;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::all();
        return view('zone.list', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('zone.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'domain' => 'required|max:255',
            'name_server' => 'required|max:255',
            'email' => 'required|max:255',
            'file' => 'required|max:255',
            'refresh' => 'required|int',
            'retry' => 'required|int',
            'expire' => 'required|int',
            'minimum' => 'required|int',
            'ttl' => 'required|int',
        ]);

        $zone = new Zone();
        $zone->fill($request->input());
        $zone->serial = date("Ymd") . '01';
        $zone->save();

        return redirect()->route('zone.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        $groups = RecordGroup::with(['records' => function ($query) use($zone) {
            $query->where('zone_id', '=', $zone->id);
        }])->get();

        return view('zone.show', compact('zone', 'groups'))->with('sucesso', 'DNS alterado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        return view('zone.edit', compact('zone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'domain' => 'required|max:255',
            'name_server' => 'required|max:255',
            'email' => 'required|max:255',
            'file' => 'required|max:255',
            'refresh' => 'required|int',
            'retry' => 'required|int',
            'expire' => 'required|int',
            'minimum' => 'required|int',
            'ttl' => 'required|int',
        ]);

        $zone->fill($request->input());
        $zone->save();

        return redirect()->route('zone.show', $zone)->with('sucesso', 'DNS alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
    }
}
