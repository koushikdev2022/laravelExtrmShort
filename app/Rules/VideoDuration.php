<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use FFMpeg\FFProbe;

class VideoDuration implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $ffmpeg = FFProbe::create();
        $duration = $ffmpeg->format($value)->get('duration');
        // Assuming you have a maximum duration of 10 minutes (600 seconds)
        return $duration <= 60;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The file duration must be less than 60 seconds.';
    }
}
