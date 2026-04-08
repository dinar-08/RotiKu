<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Models\Pesanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PesananResource extends Resource
{
    protected static ?string $model = Pesanan::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Pesanan';
    protected static ?string $pluralModelLabel = 'Pesanan';
    protected static ?string $navigationGroup = 'Manajemen Transaksi';

    public static function form(Form $form): Form
    {
        return $form->schema([]); // Tidak perlu form untuk Pesanan
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_pesanan')
                    ->label('Kode')
                    ->searchable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pemesan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('metode_pembayaran')
                    ->label('Bayar Via'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'menunggu', 'pending' => 'warning',
                        'settlement', 'berhasil' => 'success',
                        'expire', 'kedaluwarsa' => 'gray',
                        'cancel', 'dibatalkan' => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Pembayaran')
                    ->options([
                        '' => 'Semua',
                        'menunggu' => 'Belum Dibayar',
                        'berhasil' => 'Berhasil Dibayar',
                        'kedaluwarsa' => 'Kadaluarsa',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->default(null),

                Tables\Filters\Filter::make('created_at')
                    ->label('Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesanans::route('/'),
        ];
    }
}
