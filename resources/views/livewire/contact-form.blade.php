<div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 3rem; box-shadow: var(--shadow-md);">
    
    @if($submitted)
    <div style="text-align: center; padding: 2rem 0;" class="reveal">
        <div style="width: 4.5rem; height: 4.5rem; border-radius: 50%; background: rgba(16,185,129,.15); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: #10B981; margin: 0 auto 1.5rem;">
            <i class="fas fa-check"></i>
        </div>
        <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--text-main); margin-bottom: .75rem;">Message Sent!</h3>
        <p style="color: var(--text-muted); font-size: .9375rem; line-height: 1.6; max-width: 320px; margin: 0 auto 2rem;">
            Thank you for reaching out. A developer from our team will contact you very soon.
        </p>
        <button wire:click="$set('submitted', false)" class="btn btn-primary" style="margin: 0 auto;" id="send-another-btn">
            Send Another Message
        </button>
    </div>
    @else
    <form wire:submit.prevent="submit" style="display: flex; flex-direction: column; gap: 1.5rem;" aria-label="Contact Form">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            {{-- Name --}}
            <div class="form-group">
                <label for="name">Full Name <span style="color:#EF4444;">*</span></label>
                <input type="text" id="name" wire:model="name" class="form-control @error('name') error @enderror" placeholder="John Doe">
                @error('name')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email Address <span style="color:#EF4444;">*</span></label>
                <input type="email" id="email" wire:model="email" class="form-control @error('email') error @enderror" placeholder="john@example.com">
                @error('email')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            {{-- Phone --}}
            <div class="form-group">
                <label for="phone">Phone Number (Optional)</label>
                <input type="text" id="phone" wire:model="phone" class="form-control @error('phone') error @enderror" placeholder="+88017...">
                @error('phone')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Subject --}}
            <div class="form-group">
                <label for="subject">Subject <span style="color:#EF4444;">*</span></label>
                <input type="text" id="subject" wire:model="subject" class="form-control @error('subject') error @enderror" placeholder="Project Inquiry">
                @error('subject')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Message --}}
        <div class="form-group">
            <label for="message">Your Message <span style="color:#EF4444;">*</span></label>
            <textarea id="message" wire:model="message" rows="5" class="form-control @error('message') error @enderror" placeholder="Tell us about your project requirements..."></textarea>
            @error('message')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit Button --}}
        <button type="submit" class="btn btn-primary" style="justify-content: center; width: 100%;" id="submit-contact-form-btn">
            <span wire:loading.remove wire:target="submit"><i class="fas fa-paper-plane"></i> Send Message</span>
            <span wire:loading wire:target="submit"><i class="fas fa-spinner fa-spin"></i> Sending...</span>
        </button>

    </form>
    @endif

</div>
