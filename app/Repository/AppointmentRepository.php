<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 2:36 PM
 */

namespace App\Repository;


use App\Appointment;
use Carbon\Carbon;

class AppointmentRepository
{
    /**
     * @var Appointment
     */
    private $appointment;

    public function __construct(Appointment $appointment)
    {

        $this->appointment = $appointment;
    }


    public function createAppointment($patient_id, $attributes)
    {

        return $this->appointment->create(
            [
                'patient_id' => $patient_id,
                'appointment_date' => $attributes->appointment_date,
                'user_id' => auth()->user()->id,
                'branch_id' => $attributes->branch,
                'doc_id' => $attributes->user,
                'is_active' => true,
                'created_at' => new Carbon(),
                'updated_at' => new Carbon(),
            ]);
    }


    public function confirmAppointment($appointment_id)
    {
        return $this->appointment
            ->where('id', $appointment_id)
            ->update([
                'status' => 1,
            ]);
    }

    public function cancelAppointment($appointment_id)
    {
        return $this->appointment
            ->where('id', $appointment_id)
            ->update([
                'status' => 2,
            ]);
    }

    public function deleteAppointment($appointment_id)
    {
        return $this->appointment
            ->where('id', $appointment_id)
            ->update([
                'is_active' => false,
            ]);
    }

    public function updateAppointment($appointment_id, $attributes)
    {
        return $this->appointment
            ->where('id', $appointment_id)
            ->update([
                'appointment_date' => $attributes->appointment_date,
                'branch_id' => $attributes->branch,
                'doc_id' => $attributes->user,
                'updated_at' => new Carbon(),
            ]);
    }


    public function getPatientAppointments($patient_id)
    {
        return $this->appointment
            ->where('patient_id', $patient_id)
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function allAppointments($branch_id, $appointment_date)
    {


        $appointments = $this->appointment->where('is_active', true);

        if ($branch_id != null) {
            $appointments = $appointments->where('branch_id', $branch_id);
        }

        if ($appointment_date != null) {
            $appointments = $appointments->whereDate('appointment_date', $appointment_date);
        }

        $appointments = $appointments->orderBy('id', 'desc')
            ->get();

        return $appointments;
    }

}