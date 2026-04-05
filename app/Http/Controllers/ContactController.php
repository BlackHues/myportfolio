<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use App\Mail\ContactInquiryMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactFormRequest $request): RedirectResponse
    {
        if ($request->filled('contact_hp')) {
            return redirect()->route('home')->withFragment('contact')->with('contact_success', true);
        }

        $inbox = config('mail.contact_inbox');
        $data = $request->validated();

        $projectLabel = config('contact.project_types.'.$data['project_type'], $data['project_type']);
        $message = isset($data['message']) ? trim($data['message']) : '';
        $message = $message === '' ? null : $message;

        try {
            Mail::to($inbox)->send(new ContactInquiryMail(
                $data['name'],
                $data['phone'],
                $projectLabel,
                $message,
            ));
        } catch (\Throwable $e) {
            Log::error('Contact form mail failed', ['exception' => $e]);

            return redirect()
                ->route('home')
                ->withFragment('contact')
                ->withInput()
                ->with('contact_error', 'Something went wrong sending your message. Please email arjunh2194@gmail.com directly.');
        }

        return redirect()->route('home')->withFragment('contact')->with('contact_success', true);
    }
}
