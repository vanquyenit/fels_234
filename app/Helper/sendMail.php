<?php

function getMail($input)
{
    $email = $input['email_to'];
    $emailFrom = $input['email_form'];
    $from = $input['from'];
    $subject = $input['subject'];
    $to = $input['to'];
    return Mail::send($input['url'], $input['data'],
        function ($msg) use ($email, $from, $subject, $to, $emailFrom) 
        {
            $msg->from($emailFrom, $from);
            $msg->to($email, $to)->subject($subject);
        }
    );
    
}
