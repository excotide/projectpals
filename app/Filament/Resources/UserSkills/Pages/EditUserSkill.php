<?php

namespace App\Filament\Resources\UserSkills\Pages;

use App\Filament\Resources\UserSkills\UserSkillResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserSkill extends EditRecord
{
    protected static string $resource = UserSkillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
