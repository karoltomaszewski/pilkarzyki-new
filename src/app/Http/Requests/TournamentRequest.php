<?php

namespace App\Http\Requests;

use App\Rules\EvenNumber;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $tournamentName
 * @property string $selectedGameMode
 * @property int $selectedRevanges
 * @property array|int[] $selectedPlayers
 */
class TournamentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'tournamentName' => 'min:3|required',
           # 'selectedGameMode' => 'min:3|required',
            'selectedRevanges' => 'required|numeric|min:1',
            'selectedPlayers' => ['required', 'array', 'min:4', new EvenNumber()],
            'selectedPlayers.*' => ['numeric'],
        ];
    }

    public function messages(): array
    {
        return [
            'tournamentName.min' => 'Name too short',
            'tournamentName.required' => 'Name is required',
            'selectedRevanges.numeric' => 'This field has to be numeric',
            'selectedRevanges.min' => 'Too low',
            'selectedPlayers.min' => 'Min 4 players',
        ];
    }
}
