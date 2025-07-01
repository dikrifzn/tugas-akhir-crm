<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $pluralModelLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->label('Nama Produk'),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi'),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->required()
                ->label('Harga'),

            Forms\Components\Select::make('condition')
                ->options([
                    'baru' => 'Baru',
                    'bekas' => 'Bekas',
                ])
                ->required()
                ->label('Kondisi'),

            Forms\Components\Select::make('gender')
                ->options([
                    'pria' => 'Pria',
                    'wanita' => 'Wanita',
                    'unisex' => 'Unisex',
                ])
                ->required()
                ->label('Gender'),

            Forms\Components\FileUpload::make('image_url')
                ->image()
                ->directory('image/product')
                ->label('Gambar Produk'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')->label('Nama')->searchable(),
            Tables\Columns\ImageColumn::make('image_url')->label('Gambar'),
            Tables\Columns\TextColumn::make('price')->money('IDR')->label('Harga'),
            Tables\Columns\TextColumn::make('condition')->label('Kondisi'),
            Tables\Columns\TextColumn::make('gender')->label('Gender'),
            ])
            ->filters([
                //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
