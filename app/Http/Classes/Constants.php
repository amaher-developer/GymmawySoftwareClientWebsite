<?php

namespace App\Http\Classes;

class Constants {

    const PAYTABS = 1;

    const SUCCESS = 1;
    const FAILED = 2;
    const PEND = 3;

    const NEW = "new";
    const PROCESSING = "processing";
    const COMPLETE = "complete";
    const REFUNDED = "refunded";
    const CANCELED = "canceled";
    const UNKNOWN = "unknown";
    const REJECTED = "rejected";


    const CASH_PAYMENT = 0;
    const ONLINE_PAYMENT = 1;
    const BANK_TRANSFER_PAYMENT = 2;


    const Active = 0;
    const Freeze = 1;
    const Expired = 2;

    const MALE = 1;
    const FEMALE = 2;

    const MADA = 1;
    const TABBY = 2;

    const CreateMember = 0;
    const RenewMember = 1;
    const EditMember = 2;
    const DeleteMember = 3;


    const Add = 0;
    const Sub = 1;

    const AUTHORIZED = "AUTHORIZED";
    const CLOSED = "CLOSED";
}
