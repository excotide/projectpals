<?php

namespace App\Filament\Resources\UserSkills;

use App\Filament\Resources\UserSkills\Pages\CreateUserSkill;
use App\Filament\Resources\UserSkills\Pages\EditUserSkill;
use App\Filament\Resources\UserSkills\Pages\ListUserSkills;
use App\Filament\Resources\UserSkills\Schemas\UserSkillForm;
use App\Filament\Resources\UserSkills\Tables\UserSkillsTable;
use App\Models\UserSkill;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserSkillResource extends Resource
{
    protected static ?string $model = UserSkill::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'skill_name';

    public static function form(Schema $schema): Schema
    {
        return UserSkillForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserSkillsTable::configure($table);
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
            'index' => ListUserSkills::route('/'),
            'create' => CreateUserSkill::route('/create'),
            'edit' => EditUserSkill::route('/{record}/edit'),
        ];
    }
}
