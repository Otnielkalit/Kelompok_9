<?php

namespace App\Http\Controllers;

use App\Http\Requests\DropCalendarRequest;
use App\Http\Requests\GetCalendarRequest;
use App\Http\Requests\ResizeCalendarRequest;
use App\Http\Requests\StoreCalendarRequest;
use App\Http\Requests\UpdateCalendarRequest;
use App\Http\Resources\CalendarCollection;
use App\Http\Resources\CalendarResource;
use App\Models\Kegiatan;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CalendarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.event');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCalendarRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCalendarRequest $request)
    {
        Kegiatan::create($request->validated());
        return to_route('calendar.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Calendar $calendar
     * @return CalendarResource
     */
    public function edit(Kegiatan $calendar)
    {
        return new CalendarResource($calendar);
    }

    public function getEvents(GetCalendarRequest $request)
    {
        $date = $request->validated();
        return Kegiatan::whereDate('start', '>=', $date['start'])
            ->whereDate('end', '<=', $date['end'])
            ->get();
    }

    public function updateEvents(UpdateCalendarRequest $request)
    {
        Kegiatan::where('id', $request->id)
            ->update($request->validated());

        return to_route('calendar.index');
    }

    public function resizeEvents(ResizeCalendarRequest $request)
    {
        Kegiatan::where('id', $request->id)
            ->update($request->validated());

        return to_route('calendar.index');
    }

    public function dropEvents(DropCalendarRequest $request)
    {
        Kegiatan::where('id', $request->id)
            ->update($request->validated());

        return to_route('calendar.index');
    }
}
