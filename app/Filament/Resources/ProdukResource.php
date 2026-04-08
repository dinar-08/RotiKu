<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\ProdukRoti;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Str;

class ProdukResource extends Resource
{
    protected static ?string $model = ProdukRoti::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Produk Roti';
    protected static ?string $pluralModelLabel = 'Produk Roti';
    protected static ?string $slug = 'produk-roti';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kategori_id')
                    ->relationship('kategori', 'nama_kategori')
                    ->label('Kategori')
                    ->required(),

                Forms\Components\TextInput::make('nama_produk')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->disabled() // hanya tampil, tidak bisa diubah manual
                    ->dehydrated() // tetap disimpan ke database
                    ->maxLength(100),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required(),

                Forms\Components\TextInput::make('harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                Forms\Components\TextInput::make('stok')
                    ->numeric()
                    ->required(),

                Forms\Components\FileUpload::make('gambar')
                    ->label('Gambar')
                    ->image()
                    ->directory('produk') // Disimpan di storage/app/public/produk
                    ->disk('public')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('gambar')
                    ->label('Gambar')
                    ->formatStateUsing(fn($state) => '<img src="' . asset('storage/' . $state) . '" height="50" width="50" style="object-fit: cover; border-radius: 6px;" />')
                    ->html(),

                TextColumn::make('kategori.nama_kategori')->label('Kategori'),
                TextColumn::make('nama_produk')->label('Nama Produk')->searchable(),
                TextColumn::make('harga')->money('IDR', true)->label('Harga'),
                TextColumn::make('stok')->label('Stok'),
                TextColumn::make('created_at')->dateTime('d M Y')->label('Dibuat'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }

    // Tambahkan ini untuk slug unik otomatis
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $slug = Str::slug($data['nama_produk']);
        $originalSlug = $slug;
        $counter = 1;

        while (ProdukRoti::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $data['slug'] = $slug;

        return $data;
    }

    public static function mutateFormDataBeforeSave(array $data): array
    {
        $slug = Str::slug($data['nama_produk']);
        $originalSlug = $slug;
        $counter = 1;

        while (ProdukRoti::where('slug', $slug)
            ->where('id', '!=', $data['id'] ?? null)
            ->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $data['slug'] = $slug;

        return $data;
    }
}
