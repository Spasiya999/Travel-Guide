<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    // Display a listing of the configs
    public function index()
    {
        $configs = Config::all();
        return view('configs.index', compact('configs'));
    }

    // Show the form for creating a new config
    public function create()
    {
        return view('configs.create');
    }

    // Store a newly created config
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:configs,name',
            'value' => 'required|string',
            'status' => 'required|boolean',
        ]);

        Config::create($validated);

        return redirect()->route('configs.index')->with('success', 'Configuration created successfully.');
    }

    // Show the form for editing the specified config
    public function edit(Config $config)
    {
        return view('configs.edit', compact('config'));
    }

    // Update the specified config
    public function update(Request $request, Config $config)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:configs,name,' . $config->id,
            'value' => 'required|string',
            'status' => 'required|boolean',
        ]);

        $config->update($validated);

        return redirect()->route('configs.index')->with('success', 'Configuration updated successfully.');
    }

    // Delete the specified config
    public function destroy(Config $config)
    {
        $config->delete();
        return redirect()->route('configs.index')->with('success', 'Configuration deleted successfully.');
    }
}
