<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CanUpdateIfStatus implements Rule
{

    private $internship;
    private $internshipReport;
    private $validateStatus;
    private $allowedRole;

    /**
     * Create a new rule instance.
     *
     * @param $internshipReport
     * @param $internship
     * @param $validateStatus
     * @param $allowedRole
     */
    public function __construct($internshipReport, $internship, $validateStatus, $allowedRole)
    {
        $this->internshipReport = $internshipReport;
        $this->internship = $internship;
        $this->validateStatus = $validateStatus;
        $this->allowedRole = $allowedRole;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // solo el representante puede actualizar
        // mientras el estado sea 'pending_representative'
        return $value === $this->internshipReport[$attribute]
            || ($this->internshipReport->status === $this->validateStatus
                && Auth::id() === $this->internship[$this->allowedRole]->user->id);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not allowed to update :attribute';
    }
}
