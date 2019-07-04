<?php

namespace App;

class Permission extends \Spatie\Permission\Models\Permission

{
    //

    public static function defaultPermissions()
    {
        return [
            //Dashboard
            'view_dashboard',

            //Patient
            'view_patients',
            'add_patients',
            'edit_patients',
            'delete_patients',

            //Diagnosis
            'view_dental',
            'view_eye',
            'update_dental',
            'update_eye',


            //Drugs
            'administer_drug',

            //Appointment
            'add_appointment',
            'view_appointment',
            'edit_appointment',
            'delete_appointment',


            //Invoice
            'view_invoice',

            //Billing
            'bill_patient',

            //Staff
            'add_staff',
            'view_staff',
            'edit_staff',


            //Laboratory
            'add_tests',
            'view_tests',
            'edit_tests',
            'run_investigation',
            'view_results',


            //Pharmacy
            'add_drugs',
            'view_drugs',
            'dispense_drugs',


            //Store
            'add_stock',
            'view_store',
            'edit_stock',


            //Income
            'view_income',


            //Expenses
            'add_expenses',
            'view_expenses',

            //Branches
            'manage_branches',

            //Roles and Permission
            'manage_roles',

            //Store
            'add_stock',
            'update_stock',
            'manage_stock',

//Blood Bank
            'view_blood_bank',
            'add_blood_bank',
            'manage_blood_bank',

            //Pricing
            'add_pricing',
            'manage_pricing',
            'view_pricing',

            //Diagnostic
            'add_diagnostic',
            'view_diagnostic',
            'manage_diagnostic'

        ];
    }
}
