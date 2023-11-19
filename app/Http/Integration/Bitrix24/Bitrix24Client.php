<?php

namespace App\Http\Integration\Bitrix24;


use App\Models\Feedback;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class Bitrix24Client
{
    protected Client $bitrix24Client;
    public function __construct()
    {
        $this->bitrix24Client = new Client([
                'base_uri' => config('bitrix24.webhook')
            ]
        );
    }

    /**
     * @throws GuzzleException
     */
    public function addLead(Feedback $feedback): ResponseInterface
    {
        return $this->bitrix24Client->post('crm.lead.add', [
            'form_params' => [
                'fields' => [
                    'TITLE' => 'Клиент ' . $feedback->lastname . ' ' . $feedback->firstname,
                    'CONTACT_ID' => $feedback->contact_id ?? '',
                    'DATE_CREATE' => $feedback->created_at
                ]
            ]
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function addContact(Feedback $feedback): ResponseInterface
    {
        return $this->bitrix24Client->post('crm.contact.add', [
            'form_params' => [
                'fields' => [
                    'NAME' => $feedback->firstname,
                    'SECOND_NAME' => $feedback->middlename ?? '',
                    'LAST_NAME' => $feedback->lastname,
                    "TYPE_ID" => "CLIENT",
                    'PHONE' => [
                        ['VALUE' => $feedback->phone, 'VALUE_TYPE' => "WORK"]
                    ],
                    'EMAIL' => [
                        ['VALUE' => $feedback->email, 'VALUE_TYPE' => "WORK"]
                    ],
                    'BIRTHDATE' => $feedback->birthday,
                    'DATE_CREATE' => $feedback->created_at
                ]
            ]
        ]);
    }
}
