<?php
/**
 * Created by PhpStorm.
 * User: HP1
 * Date: 12/28/2018
 * Time: 2:41 PM
 */

namespace App\Service;


use App\Repository\AppointmentRepository;

class AppointmentService
{


    /**
     * @var AppointmentRepository
     */
    private $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {


        $this->appointmentRepository = $appointmentRepository;
    }


    public function createAppointment($patient_id, $attributes)
    {

        return $this->appointmentRepository->createAppointment($patient_id, $attributes);
    }


    public function confirmAppointment($appointment_id)
    {
        return $this->appointmentRepository->confirmAppointment($appointment_id);
    }

    public function cancelAppointment($appointment_id)
    {
        return $this->appointmentRepository->cancelAppointment($appointment_id);
    }

    public function deleteAppointment($appointment_id)
    {
        return $this->appointmentRepository->deleteAppointment($appointment_id);

    }

    public function updateAppointment($appointment_id, $attributes)
    {
        return $this->appointmentRepository->updateAppointment($appointment_id, $attributes);

    }


    public function getPatientAppointments($patient_id)
    {
        return $this->appointmentRepository->getPatientAppointments($patient_id);

    }

    public function allAppointments($branch_id = null, $appointment_date = null)
    {

        return $this->appointmentRepository->allAppointments($branch_id, $appointment_date);
    }


}