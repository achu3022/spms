<section x-data="passwordValidation()">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" x-model="password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            
            <!-- Real-time Password Requirements -->
            <div x-cloak x-show="password.length > 0" x-transition class="req-block">
                <p class="req-title">Password requirements:</p>
                <ul class="req-list">
                    <li :style="password.length >= 8 ? 'color: #059669;' : 'color: #94a3b8;'">
                        <svg style="width: 16px; height: 16px;" x-show="password.length >= 8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <svg style="width: 16px; height: 16px;" x-show="password.length < 8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        At least 8 characters
                    </li>
                    <li :style="/[A-Z]/.test(password) ? 'color: #059669;' : 'color: #94a3b8;'">
                        <svg style="width: 16px; height: 16px;" x-show="/[A-Z]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <svg style="width: 16px; height: 16px;" x-show="!/[A-Z]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        At least 1 uppercase letter
                    </li>
                    <li :style="/[a-z]/.test(password) ? 'color: #059669;' : 'color: #94a3b8;'">
                        <svg style="width: 16px; height: 16px;" x-show="/[a-z]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <svg style="width: 16px; height: 16px;" x-show="!/[a-z]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        At least 1 lowercase letter
                    </li>
                    <li :style="/[0-9]/.test(password) ? 'color: #059669;' : 'color: #94a3b8;'">
                        <svg style="width: 16px; height: 16px;" x-show="/[0-9]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <svg style="width: 16px; height: 16px;" x-show="!/[0-9]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        At least 1 number
                    </li>
                    <li :style="/[\W_]/.test(password) ? 'color: #059669;' : 'color: #94a3b8;'">
                        <svg style="width: 16px; height: 16px;" x-show="/[\W_]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <svg style="width: 16px; height: 16px;" x-show="!/[\W_]/.test(password)" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        At least 1 special character
                    </li>
                </ul>

                <!-- Password Strength Indicator -->
                <div style="margin-top: 16px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                        <span style="font-size: 13px; font-weight: 500; color: #475569;">Password strength</span>
                        <span style="font-size: 13px; font-weight: 700;" :style="strengthTextColor" x-text="strengthLabel"></span>
                    </div>
                    <div class="strength-bar-container">
                        <div class="strength-bar" :style="`width: ${strength}%; background-color: ${strengthColor};`"></div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div style="position: relative;">
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" style="padding-right: 40px;" autocomplete="new-password" x-model="password_confirmation" />
                <div x-cloak x-show="password_confirmation.length > 0" class="match-icon">
                    <svg style="width: 20px; height: 20px; color: #10b981;" x-show="password === password_confirmation" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <svg style="width: 20px; height: 20px; color: #ef4444;" x-show="password !== password_confirmation" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
            </div>
            <p x-cloak x-show="password_confirmation.length > 0 && password !== password_confirmation" style="margin-top: 8px; font-size: 14px; color: #ef4444;">
                Passwords do not match.
            </p>
            <p x-cloak x-show="password_confirmation.length > 0 && password === password_confirmation" style="margin-top: 8px; font-size: 14px; color: #10b981;">
                Passwords match.
            </p>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button x-bind:disabled="password.length > 0 && !isValid" x-bind:class="{ 'opacity-50 cursor-not-allowed': password.length > 0 && !isValid }">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600 dark:text-green-400 font-medium"
                >
                    <span class="flex items-center gap-1">
                        <svg style="width: 16px; height: 16px;" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ __('Saved.') }}
                    </span>
                </p>
            @endif
        </div>
    </form>
</section>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('passwordValidation', () => ({
            password: '',
            password_confirmation: '',
            
            get strength() {
                let score = 0;
                if (this.password.length === 0) return 0;
                if (this.password.length >= 8) score += 20;
                if (/[A-Z]/.test(this.password)) score += 20;
                if (/[a-z]/.test(this.password)) score += 20;
                if (/[0-9]/.test(this.password)) score += 20;
                if (/[\W_]/.test(this.password)) score += 20;
                return score;
            },

            get strengthColor() {
                if (this.strength <= 40) return '#ef4444';
                if (this.strength <= 80) return '#eab308';
                return '#10b981';
            },
            
            get strengthTextColor() {
                if (this.strength === 0) return 'color: transparent;';
                if (this.strength <= 40) return 'color: #ef4444;';
                if (this.strength <= 80) return 'color: #eab308;';
                return 'color: #10b981;';
            },

            get strengthLabel() {
                if (this.strength === 0) return '';
                if (this.strength <= 40) return 'Weak';
                if (this.strength <= 80) return 'Medium';
                return 'Strong';
            },

            get isValid() {
                return this.strength === 100 && this.password === this.password_confirmation;
            }
        }))
    })
</script>
