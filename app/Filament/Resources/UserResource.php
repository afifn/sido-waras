<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use BezhanSalleh\FilamentShield\Contracts\HasShieldPermissions;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction;
use Spatie\Permission\Models\Role;
use Teguh02\IndonesiaTerritoryForms\IndonesiaTerritoryForms;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'User Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('User Detail')
                    ->description('Put the user name details in.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone_number')
                            // ->prefix('+62')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->required()
                            ->maxLength(255),
                    ]),
                Repeater::make('Address')
                    ->columnSpanFull()

                    ->schema([
                        TextInput::make('address')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('district')
                            ->required(),
                        TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('state')
                            ->label('Province')
                            ->required(),
                        TextInput::make('postal_code')
                            ->required()
                            ->maxLength(5),
                    ])
                    ->mutateRelationshipDataBeforeCreateUsing(function (array $data, $livewire): array {
                        // dd($livewire);
                        $data['user_id'] = $livewire->record->id;
                        return $data;
                    })
                    ->mutateRelationshipDataBeforeSaveUsing(function (array $data, Get $get): array {
                        $data['user_id'] = $get('id');
                        return $data;
                    })
                    ->columns(2)
                    ->relationship('address')
                    ->defaultItems(1)
                // ->hidden(fn($record) => $record === null)
                ,
                Section::make('Credentials')
                    ->description('Put the user credentials details in.')
                    ->schema([
                        TextInput::make('email')
                            ->unique(table: 'users', ignoreRecord: true)
                            ->email()
                            ->required(),
                        TextInput::make('password')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create')
                            ->maxLength(255),
                    ]),
                Section::make('Roles')
                    ->description('Put the user roles details in.')
                    ->schema([
                        Select::make('roles')
                            ->label('Assign Role')
                            ->options(Role::all()->pluck('name', 'id'))
                            ->relationship('roles', 'name')
                            ->required(),
                    ]),
                // SpatieMediaLibraryFileUpload::make('avatar')
                //     ->collection('avatars')
                //     ->imageResizeTargetHeight('512')
                //     ->imageResizeTargetWidth('512')
                //     ->avatar()
                //     ->openable()
                //     ->circleCropper(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                ->label('')->circular()->defaultImageUrl('/storage/images/placeholder.webp'),
                // SpatieMediaLibraryImageColumn::make('avatar')
                //     ->collection('avatars')
                //     ->circular()
                //     ->defaultImageUrl('/storage/images/placeholder.webp'),
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('roles.name'),
                TextColumn::make('email_verified_at'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
                // ActivityLogTimelineTableAction::make('Activities'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
