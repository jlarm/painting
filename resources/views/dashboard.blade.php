<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col">
        <flux:heading size="xl">Welcome to Paint</flux:heading>
        
        <flux:card class="mt-6">
            <flux:heading size="lg">Get Started</flux:heading>
            
            <p class="mt-2 text-gray-600 dark:text-gray-400">
                @if(auth()->user()->isAdmin())
                    As an admin, you can create and manage painting competitions.
                @else
                    Participate in painting competitions by submitting your artwork and voting on others.
                @endif
            </p>
            
            <div class="mt-6">
                @if(auth()->user()->isAdmin())
                    <flux:button wire:navigate href="{{ route('competitions.admin') }}" variant="primary" icon="folder-plus">
                        Admin Competitions Dashboard
                    </flux:button>
                @else
                    <flux:button wire:navigate href="{{ route('competitions.user') }}" variant="primary" icon="photo">
                        View Competitions
                    </flux:button>
                @endif
            </div>
        </flux:card>
        
        <flux:card class="mt-6">
            <flux:heading size="lg">Profile Settings</flux:heading>
            
            <div class="mt-6 space-y-4">
                <flux:button wire:navigate href="{{ route('settings.profile') }}" icon="user">
                    Update Profile Information
                </flux:button>
                
                <flux:button wire:navigate href="{{ route('settings.password') }}" icon="key">
                    Update Password
                </flux:button>
                
                <flux:button wire:navigate href="{{ route('settings.appearance') }}" icon="swatch">
                    Appearance Settings
                </flux:button>
            </div>
        </flux:card>
    </div>
</x-layouts.app>
