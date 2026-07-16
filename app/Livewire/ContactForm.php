<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ContactMessage;

class ContactForm extends Component
{
    public string $name    = '';
    public string $email   = '';
    public string $phone   = '';
    public string $subject = '';
    public string $message = '';
    public bool $submitted = false;
    public bool $loading   = false;

    protected array $rules = [
        'name'    => 'required|string|min:2|max:100',
        'email'   => 'required|email|max:255',
        'phone'   => 'nullable|string|max:20',
        'subject' => 'required|string|min:3|max:255',
        'message' => 'required|string|min:10|max:2000',
    ];

    protected array $messages = [
        'name.required'    => 'Please enter your full name.',
        'name.min'         => 'Name must be at least 2 characters.',
        'email.required'   => 'Please enter a valid email address.',
        'email.email'      => 'The email address format is invalid.',
        'subject.required' => 'Please enter a subject.',
        'subject.min'      => 'Subject must be at least 3 characters.',
        'message.required' => 'Please enter your message.',
        'message.min'      => 'Message must be at least 10 characters.',
        'message.max'      => 'Message must not exceed 2000 characters.',
    ];

    public function submit(): void
    {
        $this->loading = true;

        $this->validate();

        ContactMessage::create([
            'name'    => $this->name,
            'email'   => $this->email,
            'phone'   => $this->phone,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
        $this->submitted = true;
        $this->loading   = false;
    }

    public function resetForm(): void
    {
        $this->submitted = false;
        $this->loading   = false;
        $this->reset(['name', 'email', 'phone', 'subject', 'message']);
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.contact-form');
    }
}
