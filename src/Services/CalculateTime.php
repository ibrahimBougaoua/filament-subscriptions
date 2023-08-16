<?php

namespace IbrahimBougaoua\FilamentSubscription\Services;
use Carbon\Carbon;

class CalculateTime
{
    public $period;

    public $trial_days = 8;

    public $number_years = 1;

    public $number_months = 1;

    public $trial_ends_at;

    public $starts_at;

    public $ends_at;

    public function __construct($period) {
        $this->period = $period;
    }

    public function setTrialDays($trial_days)
    {
        $this->trial_days = $trial_days;
    }

    public function setNumberYears($number_years)
    {
        $this->number_years = $number_years;
    }

    public function setNumberMonths($number_months)
    {
        $this->number_months = $number_months;
    }

    public function trialEndsAt()
    {
        return $this->trial_ends_at = $this->period == Period::Trial->name ? Carbon::now()->addDays($this->trial_days) : null;
    }

    public function startsAt()
    {
        return $this->starts_at = $this->period != Period::Trial->name ? Carbon::now() : null;
    }

    public function endsAt()
    {
        if($this->period == Period::Yearly->name)
            return $this->ends_at = Carbon::now()->addYears($this->number_years);
        elseif($this->period == Period::Monthly->name)
            return $this->ends_at = $this->ends_at ?? Carbon::now()->addMonths($this->number_months);
        else
            return $this->startsAt();
    }

    public function getTrialEndsAt()
    {
        return $this->trial_ends_at = $this->trial_ends_at ?? $this->trialEndsAt();
    }

    public function getStartsAt()
    {
        return $this->starts_at;
    }

    public function getEndsAt()
    {
        return $this->ends_at;
    }
}