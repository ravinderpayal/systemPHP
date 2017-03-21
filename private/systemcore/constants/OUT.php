<?php

/**
* Class for Defining Output Constants.
* @since v20150515
* @version vOUT20170121
* @author Ravinder Payal <ravinder@kwik.social>
*
*/
class OUT {
    const SUDDEN_HALT = 50;
    const RESPONSE_OK = 01;
    const RESPONSE_WRONG = 02;

    const REQ_UNAUTHORISED = 11;

    /**
     * Server Error 05-10
     */
    const DATABASE_FAILURE=05;
    const SERVER_FAILURE=06;
    const SERVER_DOWN=07;

    /**
     * Constants related to Forms
     */
    const INPUT_WRONG = 21;
    const INPUT_INCOMPLETE = 22;
    const INPUT_WRONG_FORMAT = 26;
    const INPUT_WRONG_PASSWORD = 31;


    /**
     * Login/Registration
     */
    const LOGIN_FAILED = 41;
    const REGISTRATION_EMAIL_USED = 46;
    const REGISTRATION_FAILED = 49;

    /**
    *Database Related Constants
    */

    const DATABASE_INSERT_FAILED=801;
}