<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AdminResource extends Resource
{
    protected static ?string $model = Admin::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Manajemen Admin';
    protected static ?string $pluralModelLabel = 'Admin';
    protected static ?string $navigationGroup = 'Manajemen Pengguna';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('username')
                ->label('Username')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('password')
                ->label('Password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => \Hash::make($state))
                ->required(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                ->dehydrated(fn ($state) => filled($state)),

            Forms\Components\Select::make('role')
                ->label('Role')
                ->options([
                    'admin' => 'Admin',
                    'pemilik' => 'Pemilik',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
            Tables\Columns\TextColumn::make('username')->searchable(),
            Tables\Columns\TextColumn::make('role')->badge()->color(fn (string $state): string => match ($state) {
                'admin' => 'primary',
                'pemilik' => 'success',
                default => 'gray',
            }),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
