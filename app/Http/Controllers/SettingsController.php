<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;
use App\Repositories\SettingsRepository;
use App\Services\Settings\SettingsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = SettingsRepository::first();
        return view('settings.edit', ['settings' => $settings]);
    }

    public function update(UpdateSettingsRequest $request): RedirectResponse
    {
        SettingsService::update($request->validated());
        return Redirect::route('settings.edit')->with('status', 'settings-updated');
    }
}
