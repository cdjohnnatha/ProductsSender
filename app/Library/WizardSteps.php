<?php

namespace App\Library;

use stdClass;

class WizardSteps
{
    private $wizardSteps;

    public function __construct($totalSteps)
    {
        $this->wizardSteps = new stdClass();
        $this->wizardSteps->steps = $totalSteps;
        $this->wizardSteps->step = 1;
    }

    public function getWizardSteps()
    {
        return $this->wizardSteps;
    }

    public function getTotalSteps()
    {
        return $this->wizardSteps->steps;
    }

    public function setTotalSteps($steps)
    {
        $this->wizardSteps->steps = $steps;
    }

    public function getStep()
    {
        return $this->wizardSteps->step;
    }

    public function setStep($step)
    {
        $this->wizardSteps->step = $step;
    }

    public function next()
    {
        $this->wizardSteps->step++;
        if($this->wizardSteps->step > $this->wizardSteps->steps) {
            $this->wizardSteps->step = $this->wizardSteps->steps;
        }
    }

    public function previous()
    {
        $this->wizardSteps->step--;
        if($this->wizardSteps->step <= 0) {
            $this->wizardSteps->step = 0;
        }
    }

}