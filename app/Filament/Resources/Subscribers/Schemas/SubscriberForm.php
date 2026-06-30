<?php

namespace App\Filament\Resources\Subscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('phone_number')
                    ->label('Phone Number')
                    ->tel()
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
                DateTimePicker::make('subscribed_at'),
            ]);
    }
}
