<?php 

function getDataFromForget($col)
{

    if ( !empty(session()->get('subscripe.personal')) ) {
        $session_collection = collect(session()->get('subscripe.personal'));
        if ( count($session_collection) ) {
            return collect(session()->get('subscripe.personal'))[$col] ?? null;
        }
    }

    return null;
}

function getDataFromExam($col)
{

    if ( !empty(session()->get('exam.data')) ) {
        $session_collection = collect(session()->get('exam.data'));
        
        if ( count($session_collection) ) {
            return collect(session()->get('exam.data'))[$col] ?? null;
        }
    }

    return null;
}

function getPhoneNumberFromForget()
{
    return '+'.collect(session()->get('subscripe.personal'))['country_code'].collect(session()->get('subscripe.personal'))['phone'];
}

