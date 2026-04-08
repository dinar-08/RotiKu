<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KategoriRotiResource\Pages;
use App\Models\KategoriRoti;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KategoriRotiResource extends Resource
{
    protected static ?string $model = KategoriRoti::class;
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_kategori')
                ->required()
                ->label('Nama'),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('nama_kategori')->label('Nama'),
            Tables\Columns\TextColumn::make('deskripsi')->limit(30),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKategoriRotis::route('/'),
            'create' => Pages\CreateKategoriRoti::route('/create'),
            'edit' => Pages\EditKategoriRoti::route('/{record}/edit'),
        ];
    }
}
