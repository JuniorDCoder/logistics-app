<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailTemplate;
use Illuminate\Http\Request;

class MailTemplateController extends Controller
{
    public function index()
    {
        $templates = MailTemplate::orderBy('name')->get();
        return view('admin.mail-templates.index', compact('templates'));
    }

    public function edit(MailTemplate $mailTemplate)
    {
        return view('admin.mail-templates.edit', ['template' => $mailTemplate]);
    }

    public function update(Request $request, MailTemplate $mailTemplate)
    {
        $validated = $request->validate([
            'subject' => ['required', 'string', 'max:255'],
            'body'    => ['required', 'string'],
        ]);

        $mailTemplate->update([
            'subject'   => $validated['subject'],
            'body'      => $validated['body'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.mail-templates.index')
            ->with('success', 'Mail template updated successfully.');
    }
}
