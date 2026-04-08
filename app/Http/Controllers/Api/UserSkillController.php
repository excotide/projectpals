<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSkill;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserSkillController extends Controller
{
    private function resolveUserId(string $userName): int
    {
        $user = User::firstOrCreate(
            ['name' => $userName],
            [
                'email' => Str::slug($userName).'-'.Str::lower(Str::random(6)).'@projectpals.local',
                'password' => Str::random(20),
            ]
        );

        return $user->id;
    }

    public function index()
    {
        return response()->json(
            UserSkill::query()
                ->with('user:id,name')
                ->latest()
                ->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => ['required', 'string', 'max:100'],
            'skill_name' => ['required', 'string', 'max:100'],
            'skill_level' => ['nullable', 'string', 'max:30'],
        ]);

        $skill = UserSkill::create([
            'user_id' => $this->resolveUserId($validated['user_name']),
            'skill_name' => $validated['skill_name'],
            'skill_level' => $validated['skill_level'] ?? null,
        ]);

        return response()->json($skill->load('user:id,name'), 201);
    }

    public function show(UserSkill $userSkill)
    {
        return response()->json($userSkill->load('user:id,name'));
    }

    public function update(Request $request, UserSkill $userSkill)
    {
        $validated = $request->validate([
            'user_name' => ['sometimes', 'required', 'string', 'max:100'],
            'skill_name' => ['sometimes', 'required', 'string', 'max:100'],
            'skill_level' => ['nullable', 'string', 'max:30'],
        ]);

        $payload = [];

        if (array_key_exists('skill_name', $validated)) {
            $payload['skill_name'] = $validated['skill_name'];
        }

        if (array_key_exists('skill_level', $validated)) {
            $payload['skill_level'] = $validated['skill_level'];
        }

        if (array_key_exists('user_name', $validated)) {
            $payload['user_id'] = $this->resolveUserId($validated['user_name']);
        }

        $userSkill->update($payload);

        return response()->json($userSkill->fresh()->load('user:id,name'));
    }

    public function destroy(UserSkill $userSkill)
    {
        $userSkill->delete();

        return response()->json(['message' => 'User skill deleted']);
    }
}
